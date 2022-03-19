<?php
session_start();
require 'php/database.php';
//$pdo = Database::connect();
?>

 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <script src="scripts/jquery-3.6.0.min.js" defer></script>
    <script src="scripts/script.js" defer></script>

    <?php
    echo " <link href='styles/style.css?". filemtime('styles/style.css') . "' rel='stylesheet'> ";
    ?>

    <title>Tropikl</title>
</head>
<body>
    <!-- Preloader -->
    <div id="loader-wrapper">
        <div id="loader"></div>
        <div class="loader-section section-left"></div>
        <div class="loader-section section-right"></div>
    </div>
    <!-- end of preloader -->
    <div class="wrap">
    <img class="bg-image" src="./assets/tropiklBG.svg" alt="">
    
    <div class="prog-bar">
        <img src="./assets/red-empty.png" alt="">
        <img src="./assets/orange-empty.png" alt="">
        <img src="./assets/yellow-empty.png" alt="">
        <img src="./assets/green-empty.png" alt="">
        <img src="./assets/bluePurple-empty.png" alt="">
        <img src="./assets/brown-empty.png" alt="">

    </div>
    </div>
</body>
</html>
