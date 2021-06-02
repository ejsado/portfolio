<!-- adventure content -->
<main id="adventures">
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
                        <img class="photo-image" src="' . $photosPath . $imageRef . '" alt="Instagram highlight" loading="lazy">
                    </div>';
                }
            }
        ?>
        <!--
        <div class="photo-container">
            <img class="photo-image" src="" alt="Instagram highlight" loading="lazy">
        </div>
        -->
    </section>
</main>