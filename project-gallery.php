<!-- projects content -->
<main id="projects">
    <?php
        //echo 'PHP' . phpversion();

        // get an array of files and directories as strings
        $directoryContents = scandir('projects');
        //print_r($directoryContents);

        // define project thumbnail element metadata
        class ProjectThumbnail {
            public $name;
            public $title;
            public $dateAdded;
            public $dateUpdated;
            public function __construct($name, $title, $dateAdded, $dateUpdated, $tools) {
                $this->name = $name;
                $this->title = $title;
                $this->dateAdded = $dateAdded;
                $this->dateUpdated = $dateUpdated;
                $this->tools = $tools;
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

        // iterate through directory contents array
        foreach($directoryContents as $projectRef) {
            // if the file name does not contain a dot, consider it a directory and continue
            if(gettype(strpos($projectRef, '.')) == 'boolean') {
                // set default values
                $title = 'Placeholder map title';
                $dateAdded = time();
                $dateUpdated = time();
                // inject metadata file, which should overwrite above variables
                include 'projects/' . $projectRef . '/metadata.php';
                // create new projectThumnail with this metadata and push it to the projects array
                array_push($projects, new ProjectThumbnail($projectRef, $title, $dateAdded, $dateUpdated, $tools));
                // get the current index and add it to the dates to make sure they are unique
                $projectsLength = count($projects) - 1;
                $projects[$projectsLength]->addToDate($projectsLength);
            }
        }

        // sort array based on date added
        usort($projects, array("ProjectThumbnail", "compareDateAdded"));

        // output HTML for each project
        foreach($projects as $thumbnail) {
            echo    '<section class="project-thumbnail"
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
</main>