<!-- projects content -->
<main id="projects">
	<input type="checkbox" id="collapse-toggle" checked>
	<input type="checkbox" name="category" id="filter-analysis" >
	<input type="checkbox" name="category" id="filter-cartography">
	<input type="checkbox" name="tool" id="filter-arcgis-pro" >
	<input type="checkbox" name="tool" id="filter-qgis">
	<input type="checkbox" name="tool" id="filter-arcmap">
	<input type="checkbox" name="tool" id="filter-python">
	<input type="checkbox" name="tool" id="filter-arcgis-online">
	<input type="checkbox" name="tool" id="filter-image-editor">
	<div id="projects-filters">
		<div>
			<label for="collapse-toggle">Filters</label>
		</div>
		<div id="collapse-container">
			<div>
				<div>
					<p>Categories</p>
				</div>
				<div class="filter-labels-container">
					<label for="filter-analysis">Analysis</label>
					<label for="filter-cartography">Cartography</label>
				</div>
			</div>
			<div>
				<div>
					<p>Tools</p>
				</div>
				<div class="filter-labels-container">
					<label for="filter-arcgis-pro">ArcGIS Pro</label>
					<label for="filter-qgis">QGIS</label>
					<label for="filter-arcmap">ArcMap</label>
					<label for="filter-python">Python</label>
					<label for="filter-arcgis-online">ArcGIS Online</label>
					<label for="filter-image-editor">Image Editor</label>
				</div>
			</div>
		</div>
	</div>
	<div id="projects-flex">
    <?php
        //echo 'PHP' . phpversion();

		// include metadata
		include 'projects/metadata.php';

        // define project thumbnail element metadata
        class ProjectThumbnail {
            public $name;
            public $title;
            public $dateAdded;
            public $dateUpdated;
            public function __construct($name, $title, $dateAdded, $dateUpdated, $tools, $tags) {
                $this->name = $name;
                $this->title = $title;
                $this->dateAdded = $dateAdded;
                $this->dateUpdated = $dateUpdated;
                $this->tools = $tools;
				$this->tags = $tags;
            }
            public function addToDate($num) {
                $this->dateAdded += $num;
                $this->dateUpdated += $num;
            }
            static function compareDateAdded($a, $b) {
                return $b->dateAdded - $a->dateAdded;
            }
        }

        // create an array for sorting projects
        $projects = array();

        // iterate through metadata array
        foreach($metadata as $key => $value) {
			// create new projectThumnail with this metadata and push it to the projects array
			array_push($projects, new ProjectThumbnail($key, $value['title'], $value['dateAdded'], $value['dateUpdated'], $value['tools'], $value['tags']));
			// get the current index and add it to the dates to make sure they are unique
			$projectsLength = count($projects) - 1;
			$projects[$projectsLength]->addToDate($projectsLength);
        }
		unset($value);
		
        // sort array based on date added
        usort($projects, array("ProjectThumbnail", "compareDateAdded"));

        // output HTML for each project
        foreach($projects as $thumbnail) {
			$cssClasses = 'project-thumbnail';
			foreach($thumbnail->tags as $tag) {
				$cssClasses = $cssClasses . ' ' . $tag;
			}
            echo    '<section class="' . $cssClasses . '"
                        style="background-image: url(/projects/' . $thumbnail->name . '/thumbnail.png)"
                        data-date-added="' . $thumbnail->dateAdded . '"
                        data-date-updated="' . $thumbnail->dateUpdated . '">
                        <a class="project-link" href="/projects/?name=' . $thumbnail->name . '">
                            <div class="project-space"></div>
                            <div class="project-tools">';
			$reversedTools = array_reverse($thumbnail->tools);
            foreach($reversedTools as $tool) {
                echo '          <span>' . $tool . '</span>';
            }
            echo            '</div>
                            <div class="project-title">
                                <p class="text-size-large text-weight-medium">' . $thumbnail->title . '</p>
                            </div>
                        </a>
                    </section>';
        }
    ?>
	</div>
</main>