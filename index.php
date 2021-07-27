<!DOCTYPE html>
<html>
    <head>
        <title>Projects &rtrif; Eric J.S.</title>
        <?php include 'head-links.php' ?>
		<!-- page metadata --> 
		<meta property="og:title" content="Mapping Projects by Eric J.S." />
		<meta property="og:description" content="Personal projects to answer questions about spatial relationships, explore geographic data, and practice cartographic skills." />
		<meta property="og:url" content="https://www.ericjs.net/" />
		<?php include 'head-logo-metadata.php' ?>
    </head>
    <body>
        <!-- index -->
        <div id="body-container">
            <?php 
                include 'logo-header.php';
                include 'actions.php';
                $currentPage = "projects";
                include 'nav.php';
                include 'project-gallery.php';
				include 'footer.php';
            ?>
        </div>
    </body>
</html>