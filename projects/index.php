<?php
    $projectName = $_GET["name"];
	
	include 'metadata.php';
	if(!array_key_exists($projectName, $metadata)) {
		http_response_code(404);
		include '../404.php';
		die();
	}
	$projectMetadata = $metadata[$projectName];
    // title
    // dateAdded
    // dateUpdated
    // tools
    // staticProduct
    // interactiveProduct
    $projectDirectory = $projectName . "/";

    $searchArray = array("-", "us", "nyc");
    $replaceArray = array(" ", "U.S.", "NYC");
    $formattedName = str_replace($searchArray, $replaceArray, $projectName);
    $formattedName = ucwords($formattedName);

	include '../utility/parsedown-1.7.4/Parsedown.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <title><?php echo $formattedName ?> &rtrif; Eric J.S.</title>
		
        <?php include '../head-links.php' ?>

		<link href="/utility/prism-1.28.0/prism.css" rel="stylesheet" />

		<meta property="og:title" content="<?php echo $formattedName ?>" />
		<meta property="og:description" content="<?php echo $projectMetadata['title'] ?>" />
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
		<meta property="og:image:alt" content="Project preview" />
    </head>
    <body class="line-numbers"> <!-- enabled line numbers in prism syntax highlighting for the whole page -->
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
                    <?php echo $projectMetadata['title'] ?>
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
                                <?php echo date("F j, Y", $projectMetadata['dateAdded']) ?>
                            </p>
                        </div>
                        <div>
                            <p>Last updated</p>
                            <p>
                                <?php echo date("F j, Y", $projectMetadata['dateUpdated']) ?>
                            </p>
                        </div>
						<div>
                            <p>Category</p>
                            <p>
                            	<?php echo $projectMetadata['category'] ?>
                            </p>
                        </div>
                        <div>
                            <p>Tools Used</p>
                            <p>
                            <?php
                                foreach($projectMetadata['tools'] as $tool) {
                                    echo '<span>' . $tool . '</span>';
                                }
                            ?>
                            </p>
                        </div>
                    </div>
                    <div id="project-preview">
                        <?php
                            if ($projectMetadata['interactiveProduct'] != "") {
                                $imageLink = $projectMetadata['interactiveProduct'];
                            } elseif ($projectMetadata['staticProduct'] != "") {
                                $imageLink = $projectDirectory . $projectMetadata['staticProduct'];
                            } else {
								$imageLink = $projectDirectory . $projectMetadata['codeProduct'];
							}
                        ?>
                        <a href="<?php echo $imageLink ?>" id="full-project-link">
                            <img src="<?php echo $projectDirectory ?>full-image-low-res.png" alt="Full image">
                        </a>
                    </div>
                    <div id="project-buttons">
                        <?php
                            if ($projectMetadata['interactiveProduct'] != "") {
                                echo '<a href="' . $projectMetadata['interactiveProduct'] . '" class="action-button solid">
                                        <span class="material-icons text-size-large vertical-align-sub">map</span>
                                        View the interactive version
                                    </a>';
                            }
                            if ($projectMetadata['staticProduct'] != "") {
                                if (substr($projectMetadata['staticProduct'], -3) == "pdf") {
                                    echo '<a href="' . $projectDirectory . $projectMetadata['staticProduct'] . '" class="action-button outline">
                                            <span class="material-icons text-size-large vertical-align-sub">description</span>
                                            View the PDF
                                        </a>';
                                } else {
                                    echo '<a href="' . $projectDirectory . $projectMetadata['staticProduct'] . '" class="action-button outline">
                                            <span class="material-icons text-size-large vertical-align-sub">image</span>
                                            View the high resolution image
                                        </a>';
                                }
                            }
							if ($projectMetadata['codeProduct'] != "") {
                                echo '<a href="' . $projectMetadata['codeProduct'] . '" class="action-button solid">
                                        <span class="material-icons text-size-large vertical-align-sub">code</span>
                                        View the code
                                    </a>';
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
            </main>
			<?php
				include '../nav.php';
				include '../actions.php';
				include '../footer.php';
			?>
        </div>
		<script src="/utility/prism-1.28.0/prism.js"></script>
		<script src="/utility/collapse-pre/collapse-pre.js"></script>
    </body>
</html>