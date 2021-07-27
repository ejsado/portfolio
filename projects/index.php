<?php
    include '../utility/parsedown-1.7.4/Parsedown.php';

    $projectName = $_GET["name"];
    $searchArray = array("-", "us");
    $replaceArray = array(" ", "U.S.");
    $formattedName = str_replace($searchArray, $replaceArray, $projectName);
    $formattedName = ucwords($formattedName);

    include $projectName . '/metadata.php';
    // title
    // dateAdded
    // dateUpdated
    // tools
    // staticMap
    // interactiveMap
    $projectDirectory = $projectName . "/";
?>
<!DOCTYPE html>
<html>
    <head>
        <title><?php echo $formattedName ?> &rtrif; Eric J.S.</title>
        <?php include '../head-links.php' ?>
		<meta property="og:title" content="<?php echo $formattedName ?> Map" />
		<meta property="og:description" content="<?php echo $title ?>" />
		<meta property="og:url" content="https://www.ericjs.net/projects/?name=<?php echo $projectName ?>" />
		<meta property="og:image" content="https://www.ericjs.net/projects/<?php echo $projectName ?>/thumbnail.png" />
		<meta property="og:image:type" content="image/png" />
		<?php
			$thumbnailFileName = $projectDirectory . "thumbnail.png";
			$thumbnailSize = getimagesize($thumbnailFileName);
			$thumbnailWidth = 100;
			$thumbnailHeight = 100;
			if($thumbnailSize) {
				$thumbnailWidth = $thumbnailSize[0];
				$thumbnailHeight = $thumbnailSize[1];
			}
		?>
		<meta property="og:image:width" content="<?php echo $thumbnailWidth ?>" />
		<meta property="og:image:height" content="<?php echo $thumbnailHeight ?>" />
		<meta property="og:image:alt" content="Map preview" />
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
                            <p>Posted</p>
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
                        <div>
                            <p>Tools Used</p>
                            <p>
                            <?php
                                foreach($tools as $tool) {
                                    echo '<span>' . $tool . '</span>';
                                }
                            ?>
                            </p>
                        </div>
                    </div>
                    <div id="project-map">
                        <?php
                            if ($interactiveMap != "") {
                                $imageLink = $interactiveMap;
                            } else {
                                $imageLink = $projectDirectory . $staticMap;
                            }
                        ?>
                        <a href="<?php echo $imageLink ?>" id="full-map-image-link">
                            <img src="<?php echo $projectDirectory ?>full-map-low-res.png" alt="Full map image">
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

                <?php
					include '../nav.php';
					include '../footer.php';
				?>
            </main>
        </div>
    </body>
</html>