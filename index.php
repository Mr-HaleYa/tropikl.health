<?php
session_start();
require 'php/database.php';

$pdo = Database::connect();

if(!isset($_SESSION['username'])) {
    header("Location: login");
    exit;
}

$time = date("Y-m-d");

$sql = "SELECT * from data WHERE user_id='".$_SESSION['user_id']."' AND date='$time' ORDER BY id DESC LIMIT 1 ";
$result = $pdo->query($sql);

$temparray = array();
while ($row = $result->fetch(PDO::FETCH_ASSOC)){
    $temparray[] = $row;
}

echo '
<script defer>
    var fishData = '.json_encode($temparray).';
</script>
';


?>


<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <?php
    // Scripts
    echo '
        <script src="scripts/jquery-3.6.0.min.js?'. filemtime("scripts/jquery-3.6.0.min.js") . '" defer></script>
        <script src="scripts/script.js?'. filemtime("scripts/script.js") . '" type="module" defer></script>
        <script src="./scripts/fish.js?'. filemtime("scripts/fish.js") . '" defer type="module"></script>
        <script src="./scripts/prog-bar.js?'. filemtime("scripts/prog-bar.js") . '" type="module" defer></script>
    ';
    // CSS
    echo '
        <link href="styles/style.css?'. filemtime("styles/style.css") . '" rel="stylesheet">
    ';

    ?>

<!-- <script defer>

    var xReq = new XMLHttpRequest();
    xReq.open("HEAD", "./scripts/fish.js", false);
    xReq.send(null);
    var lastModified = xReq.getResponseHeader("Last-Modified");
    var myDate = new Date(lastModified);
    var myEpoch = myDate.getTime()/1000.0;
    document.write(myEpoch);

</script> -->

<script type="text/javascript">
    if(window.IDInterface)
        window.IDInterface.setId(<?php echo $_SESSION['user_id']; ?>);
</script>

    <title>Tropikl</title>
</head>
<body>
    <div class="wrap">
    <img class="bg-image" src="./assets/tropiklBG.svg" alt="">
    


        <!-- Preloader -->
        <div id="loader-wrapper">
            <div id="loader"></div>
            <div class="loader-section section-left"></div>
            <div class="loader-section section-right"></div>
        </div>

    <!-- end of preloader -->

        <img class="bg-image" src="./assets/tropiklBG.svg">
        
        
        <img class="help" src="./assets/help.svg">
        <div id="tooltip" style="display:none">
            <a href="./php/logout" class="logout">LOGOUT</a>
            <p class="help-text">Welcome to Tropikl! Our goal is to help you eat healthier every single day. We want to help you eat the rainbow! Download our app and track what colors of food you eat. Your fish friends will get prettier as you eat different colored foods. Try to eat at least one healthy food of each color every day and build your streak!</p>
            <img src="./assets/logo.png" alt="Tropikl Logo" class="login-logo">
            <span class="authors">~By: Kavika Faleumu, Koby Hale, and Chayse Thompson</span>
        </div>

        <div class="score-board">
            <h3 class="streak-label">All<br>Time:</h3><span class="streak">0</span>
            <h3 class="score-label">Total<br>Score:</h3><span class="total-score">0</span>
        </div>

        <div class="prog-bar">
        <img class="redProg" src="./assets/red-empty.png" alt="">
        <img class="orangeProg" src="./assets/orange-empty.png" alt="">
        <img class="yellowProg" src="./assets/yellow-empty.png" alt="">
        <img class="greenProg" src="./assets/green-empty.png" alt="">
        <img class="bluePurpleProg" src="./assets/bluePurple-empty.png" alt="">
        <img class="brownProg" src="./assets/brown-empty.png" alt="">
        </div>
    </div>
</body>

</html>
