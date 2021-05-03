<!-- projects content -->
<main class="projects">
    <?php
        //echo 'PHP' . phpversion();
        $directoryContents = scandir('projects');
        //print_r($directoryContents);
        foreach($directoryContents as $projectRef) {
            if(gettype(strpos($projectRef, '.')) == 'boolean') {
                $question = 'Placeholder map title';
                include 'projects/' . $projectRef . '/metadata.php';
                echo '<section class="project-thumbnail"
                    style="background-image: url(/projects/' . $projectRef . '/thumbnail.png)">
                    <a class="project-link" href="/projects/' . $projectRef . '/">
                        <p class="text-size-large">' . $question . '</p>
                    </a>
                </section>';
            }
        }
    ?>
    <!--
    <section class="project-thumbnail"
        style="background-image: url('/projects/test-project/thumbnail.png')">
        <a class="project-link" href="/projects/test-project/">
            <p class="text-size-large">Question text</p>
        </a>
    </section>
    -->
</main>