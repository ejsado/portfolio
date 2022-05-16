<!-- projects content -->
<main id="projects">
	<div id="projects-filters" class="javascript-disabled">
		<input type="checkbox" id="collapse-toggle" checked>
		<div id="filters-container">
			<div id="collapse-label-container">
				<label id="collapse-label" for="collapse-toggle">Filters</label>
			</div>
			<div id="collapse-container">
				<div>
					<div>
						<div>
							<p>Categories</p>
						</div>
						<div class="filter-labels-container">
							<input  id="filter-analysis" 	class="filter-checkbox" name="category" type="checkbox">
							<label for="filter-analysis" 	>Analysis</label>

							<input  id="filter-cartography" class="filter-checkbox" name="category" type="checkbox">
							<label for="filter-cartography" >Cartography</label>

							<input 	id="filter-automation" 	class="filter-checkbox" name="category" type="checkbox">
							<label for="filter-automation" 	>Automation</label>
						</div>
					</div>
					<div>
						<div>
							<p>Tools</p>
						</div>
						<div class="filter-labels-container">
							<input  id="filter-arcgis-pro" 		class="filter-checkbox" name="tool" type="checkbox">
							<label for="filter-arcgis-pro"		>ArcGIS Pro</label>

							<input  id="filter-qgis" 			class="filter-checkbox" name="tool" type="checkbox">
							<label for="filter-qgis"			>QGIS</label>
							
							<input  id="filter-arcmap" 			class="filter-checkbox" name="tool" type="checkbox">
							<label for="filter-arcmap"			>ArcMap</label>

							<input  id="filter-python" 			class="filter-checkbox" name="tool" type="checkbox">
							<label for="filter-python"			>Python</label>

							<input  id="filter-r" 				class="filter-checkbox" name="tool" type="checkbox">
							<label for="filter-r"				>R</label>

							<input  id="filter-sql" 			class="filter-checkbox" name="tool" type="checkbox">
							<label for="filter-sql"				>SQL</label>

							<input  id="filter-arcgis-online" 	class="filter-checkbox" name="tool" type="checkbox">
							<label for="filter-arcgis-online"	>ArcGIS Online</label>

							<input  id="filter-image-editor" 	class="filter-checkbox" name="tool" type="checkbox">
							<label for="filter-image-editor"	>Image Editor</label>
						</div>
					</div>
					<div>
						<button id="clear-filters-button" onclick="clearFilters()">Clear Filters</button>
					</div>
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
            public function __construct($name, $title, $dateAdded, $dateUpdated, $tools, $category, $tags) {
                $this->name = $name;
                $this->title = $title;
                $this->dateAdded = $dateAdded;
                $this->dateUpdated = $dateUpdated;
                $this->tools = $tools;
				$this->category = $category;
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
			array_push($projects, new ProjectThumbnail($key, $value['title'], $value['dateAdded'], $value['dateUpdated'], $value['tools'], $value['category'], $value['tags']));
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
                            <div class="project-information">
                                <p class="text-size-large text-weight-medium">' . $thumbnail->title . '</p>
								<p class="text-size-small text-weight-light">' . $thumbnail->category . ' &mdash; ' . date("F j, Y", $thumbnail->dateAdded) . '</p>
								<div class="project-tools">';
            foreach($thumbnail->tools as $tool) {
                echo 				'<span>' . $tool . '</span>';
            }
            echo            	'</div>
                            </div>
                        </a>
                    </section>';
        }
    ?>
	</div>
	<div id="filter-no-results">
		<p class="text-weight-bold text-size-large text-align-center">
			No results.
		</p>
	</div>
	<script>
		// if javascript is allowed, show filters
		document.getElementById('projects-filters').classList.remove('javascript-disabled');
	</script>
	<script src="/utility/filter-thumbnails/filter-thumbnails.js"></script>
</main>