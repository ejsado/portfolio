<!DOCTYPE html>
<html>
    <head>
        <title>About &rtrif; Eric J.S.</title>
        <?php include '../head-links.php' ?>
		<!-- page metadata --> 
		<meta property="og:title" content="About Eric J.S." />
		<meta property="og:description" content="I'm looking for a full-time position in the GIS sector. Here is my digital resume." />
		<meta property="og:url" content="https://www.ericjs.net/about/" />
		<?php include '../head-logo-metadata.php' ?>
    </head>
    <body>
        <!-- index -->
        <div id="body-container">
            <?php 
                include '../logo-header.php';
                $currentPage = "about";
                include '../nav.php';
                include 'about.php';
				include '../footer.php';
            ?>
        </div>
    </body>
</html>