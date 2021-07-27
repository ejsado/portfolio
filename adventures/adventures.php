<!-- adventure content -->
<main id="adventures">
    <section>
        <div id="instagram-badge">
            <div>
                <a href="https://www.instagram.com/maryunleashed/">
                    <img src="/media/instagram-glyph.png" alt="Instagram logo">
                </a>
            </div>
            <div>
                <p>My Travel Photojournal</p>
                <p>I use Instagram to log all of my adventures, including road trips, vacations, and outdoor activities.</p>
                <p>
                    <a href="https://www.instagram.com/maryunleashed/">Check it out &rarr;</a>
                </p>
            </div>
        </div>
        <h3>Here are some highlights...</h3>
    </section>
    <section id="instagram-highlights">
        <?php
            $photosPath = '/media/small-photos/';
            // get an array of files and directories as strings
            $directoryContents = scandir('../media/small-photos');
            //print_r($directoryContents);


            // randomize image order
            shuffle($directoryContents);

            foreach($directoryContents as $imageRef) {
                if($imageRef != "." && $imageRef != "..") {
                    echo '<div class="photo-container" style="background-image: url(\'' . $photosPath . $imageRef . '\')">
                        <a href="https://www.instagram.com/maryunleashed/">
							<img class="photo-image" src="' . $photosPath . $imageRef . '" alt="Instagram highlight" loading="lazy">
						</a>
                    </div>';
                }
            }
        ?>
    </section>
</main>