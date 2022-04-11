<?php
    $formType = $_GET["form"];
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Contact &rtrif; Eric J.S.</title>
        <?php include '../head-links.php' ?>
		<!-- page metadata --> 
		<meta property="og:title" content="Contact Eric J.S." />
		<meta property="og:description" content="Request a resume or send a general message." />
		<meta property="og:url" content="https://www.ericjs.net/contact/" />
		<?php include '../head-logo-metadata.php' ?>
    </head>
    <body>
        <!-- index -->
        <div id="body-container">
            <?php
				include '../logo-header.php';
				$currentPage = "contact";
				include '../nav.php';
			?>
            <main id="contact">
                <!-- <section id="alt-form-link">
                    <?php
                        // if($formType == "resume") {
                        //     echo '<a class="action-button outline" href="./">Want to send a general message instead?</a>';
                        // } else {
                        //     echo '<a class="action-button outline" href="./?form=resume">Want to request a resume instead?</a>';
                        // }
                    ?>
                </section> -->
                <section id="contact-iframe-container">
                    <?php
                        // if($formType == "resume") {
                        //     echo '<iframe id="contact-iframe" src="https://docs.google.com/forms/d/e/1FAIpQLScQCbilO3f1kGRLXYdxlfSd01cmPnlVBApTjBp4cTYSYuzZbA/viewform?embedded=true" width="100%" height="1000px" frameborder="0" marginheight="0" marginwidth="0" scrolling="no">Loading…</iframe>';
                        // } else {
                        //     echo '<iframe id="contact-iframe" src="https://docs.google.com/forms/d/e/1FAIpQLScQMV7QoIEY_ClezdzR9TF6c8k0NcjOy8b4Jsrn2fpXGV6pnw/viewform?embedded=true" width="100%" height="1000px" frameborder="0" marginheight="0" marginwidth="0" scrolling="no">Loading…</iframe>';
                        // }
                    ?>
					<iframe id="contact-iframe" 
						src="https://docs.google.com/forms/d/e/1FAIpQLScQMV7QoIEY_ClezdzR9TF6c8k0NcjOy8b4Jsrn2fpXGV6pnw/viewform?embedded=true" 
						width="100%" height="1400px" frameborder="0" marginheight="0" marginwidth="0" scrolling="no">
						Loading…
					</iframe>
                </section>
            </main>
			<?php include '../footer.php'; ?>
        </div>
    </body>
</html>