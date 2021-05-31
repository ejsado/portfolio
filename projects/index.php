<?php
    include '../utility/parsedown-1.7.4/Parsedown.php';

    $projectName = $_GET["name"];
    $formattedName = ucwords(str_replace("-", " ", $projectName));
    include $projectName . '/metadata.php';
    // title
    // dateAdded
    // dateUpdated
    // staticMap
    // interactiveMap
    $projectDirectory = $projectName . "/";
?>
<!DOCTYPE html>
<html>
    <head>
        <title><?php echo $formattedName ?> &rtrif; Eric J.S.</title>
        <?php include '../head-links.php' ?>
    </head>
    <body>
        <!-- index -->
        <div id="body-container">
            <header>
                <a href="/" id="logo-link-small">
                    <img
                        id="logo-svg-small"
                        src="/media/logo-initials-display.svg"
                        alt="Eric J.S."
                        height="153"
                        width="582"
                        />
                </a>
            </header>
            <main id="project-info">
                <h1>
                    <?php echo $title ?>
                </h1>
                <section id="project-metadata">
                    <div id="project-details">
                        <div>
                            <p>Created by</p>
                            <p>Eric J.S.</p>
                        </div>
                        <div>
                            <p>Added</p>
                            <p>
                                <?php echo date("F j, Y", $dateAdded) ?>
                            </p>
                        </div>
                        <div>
                            <p>Last updated</p>
                            <p>
                                <?php echo date("F j, Y", $dateUpdated) ?>
                            </p>
                        </div>
                    </div>
                    <div id="project-map">
                        <?php
                            if ($interactiveMap != "") {
                                $imageLink = $projectDirectory . $interactiveMap;
                            } else {
                                $imageLink = $projectDirectory . $staticMap;
                            }
                        ?>
                        <a href="<?php echo $imageLink ?>" id="full-map-image-link">
                            <img src="<?php echo $projectDirectory ?>full-map.png" alt="Full map image">
                        </a>
                    </div>
                    <div id="project-buttons">
                        <?php
                            if ($interactiveMap != "") {
                                echo '<a href="' . $interactiveMap . '" class="action-button solid">
                                        <span class="material-icons text-size-large vertical-align-sub">map</span>
                                        View the interactive map
                                    </a>';
                            }
                            if ($staticMap != "") {
                                if (substr($staticMap, -3) == "pdf") {
                                    echo '<a href="' . $projectDirectory . $staticMap . '" class="action-button outline">
                                            <span class="material-icons text-size-large vertical-align-sub">description</span>
                                            View the PDF map
                                        </a>';
                                } else {
                                    echo '<a href="' . $projectDirectory . $staticMap . '" class="action-button outline">
                                            <span class="material-icons text-size-large vertical-align-sub">image</span>
                                            View the high resolution map
                                        </a>';
                                }
                            }
                        ?>
                    </div>
                </section>
                <section id="project-report">
                    <?php 
                        $projectReport = file_get_contents($projectName . '/project-report.md');
                        $Parsedown = new Parsedown();
                        echo $Parsedown->text($projectReport);
                    ?>
                </section>

                <?php include '../nav.php' ?>
            </main>
        </div>
    </body>
</html>