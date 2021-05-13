<?php
    $projectName = $_GET["name"];
    $formattedName = ucwords(str_replace("-", " ", $projectName));
    include $projectName . '/metadata.php';
    // question
    // dateAdded
    // dateUpdated
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
                    <?php echo $question ?>
                </h1>
                <section id="project-metadata">
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
                </section>
                <section>
                    <a href="<?php echo $projectName ?>/full-map.png" id="full-map-image-link">
                        <img src="<?php echo $projectName ?>/full-map.png" alt="Full map image">
                    </a>
                    <a href="" class="action-button solid">
                        <span class="material-icons text-size-large vertical-align-sub">map</span>
                        View the interactive map
                    </a>
                </section>

                <?php include '../nav.php' ?>
            </main>
        </div>
    </body>
</html>