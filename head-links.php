<!-- styles -->
<link rel="stylesheet" href="https://unpkg.com/sanitize.css">
<link rel="preconnect" href="https://fonts.gstatic.com">
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Heebo:wght@300;400;500;600;700&display=swap">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<?php
    if($_SERVER['HTTP_HOST'] == "dev.ericjs.net") {
        echo '<link rel="stylesheet" href="/styles/main.css">';
    } else {
        echo '<link rel="stylesheet" href="/styles/main.min.css">';
    }
?>

<!-- favicon -->
<link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
