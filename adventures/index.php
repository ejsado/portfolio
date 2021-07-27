<!DOCTYPE html>
<html>
    <head>
        <title>Adventures &rtrif; Eric J.S.</title>
        <?php include '../head-links.php' ?>
		<!-- page metadata --> 
		<meta property="og:title" content="Adventures with Eric J.S. @maryunleashed" />
		<meta property="og:description" content="I use Instagram to log all of my adventures, including road trips, vacations, and outdoor activities." />
		<meta property="og:url" content="https://www.ericjs.net/adventures/" />
		<?php include '../head-logo-metadata.php' ?>
    </head>
    <body>
        <!-- index -->
        <div id="body-container">
            <?php 
                include '../logo-header.php';
                include '../actions.php';
                $currentPage = "adventures";
                include '../nav.php';
                include 'adventures.php';
				include '../footer.php';
            ?>
        </div>
    </body>
</html>