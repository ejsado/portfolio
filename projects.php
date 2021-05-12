<!-- projects content -->
<main class="projects">
    <?php
        //echo 'PHP' . phpversion();

        // get an array of files and directories as strings
        $directoryContents = scandir('projects');
        //print_r($directoryContents);

        // define project thumbnail element metadata
        class ProjectThumbnail {
            public $name;
            public $question;
            public $dateAdded;
            public $dateUpdated;
            public function __construct($name, $question, $dateAdded, $dateUpdated) {
                $this->name = $name;
                $this->question = $question;
                $this->dateAdded = $dateAdded;
                $this->dateUpdated = $dateUpdated;
            }
            public function addToDate($num) {
                $this->dateAdded += $num;
                $this->dateUpdated += $num;
            }
            static function compareDateAdded($a, $b) {
                return $a->dateAdded - $b->dateAdded;
            }
        }

        // create an array for sorting projects
        $projects = array();

        // iterate through directory contents array
        foreach($directoryContents as $projectRef) {
            // if the file name does not contain a dot, consider it a directory and continue
            if(gettype(strpos($projectRef, '.')) == 'boolean') {
                // set default values
                $question = 'Placeholder map title';
                $dateAdded = time();
                $dateUpdated = time();
                // inject metadata file, which should overwrite above variables
                include 'projects/' . $projectRef . '/metadata.php';
                // create new projectThumnail with this metadata and push it to the projects array
                array_push($projects, new ProjectThumbnail($projectRef, $question, $dateAdded, $dateUpdated));
                // get the current index and add it to the dates to make sure they are unique
                $projectsLength = count($projects) - 1;
                $projects[$projectsLength]->addToDate($projectsLength);
            }
        }

        // sort array based on date added
        usort($projects, array("ProjectThumbnail", "compareDateAdded"));

        // output HTML for each project
        foreach($projects as $thumbnail) {
            echo '<section class="project-thumbnail"
                    style="background-image: url(/projects/' . $thumbnail->name . '/thumbnail.png)"
                    data-date-added="' . $thumbnail->dateAdded . '"
                    data-date-updated="' . $thumbnail->dateUpdated . '">
                    <a class="project-link" href="/projects/' . $thumbnail->name . '/">
                        <p class="text-size-large text-weight-medium">' . $thumbnail->question . '</p>
                        <p class="text-size-small text-align-right">' . date("F j, Y", $thumbnail->dateUpdated) . '</p>
                    </a>
                </section>';
        }
    ?>
    <!--
    <section class="project-thumbnail"
        style="background-image: url('/projects/test-project/thumbnail.png')"
        data-date-added=""
        data-date-updated="">
        <a class="project-link" href="/projects/test-project/">
            <p class="text-size-large text-weight-medium">Question text</p>
            <p class="text-size-small text-align-right">Date added</p>
        </a>
    </section>
    -->
</main>