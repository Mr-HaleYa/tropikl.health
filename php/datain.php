<?php
session_start();
include './database.php';

$log = print_r(get_defined_vars(), true);
file_put_contents('./log_'.date("j.n.Y").'.log', $log, FILE_APPEND);

// array for JSON response
$response = array();

// check for required fields
if ( $_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['user_id']) ) {

$user_id = $red = $orange = $yellow = $green = $bluePurple = $brown = $redDB = $yellowDB = $greenDB = $bluePurpleDB = $brown = 0;

    $pdo = Database::connect();

    $user_id    = test_input($_POST['user_id']);
    $red        = test_input($_POST['red']);
    $orange     = test_input($_POST['orange']);
    $yellow     = test_input($_POST['yellow']);
    $green      = test_input($_POST['green']);
    $bluePurple = test_input($_POST['bluePurple']) ;
    $brown      = test_input($_POST['brown']);

    echo $brown;

    $time = date("Y-m-d");

    $sql1= "SELECT * FROM data WHERE user_id='$user_id' AND date='$time' ORDER BY id DESC LIMIT 1 ";
    echo $sql1;
    $query_res = $pdo->query($sql1);
    $count= count($query_res->fetchAll(PDO::FETCH_ASSOC));

    if( $count > 0){ // there is a row with username and date
        $query_res = $pdo->query($sql1);
        while ($row = $query_res->fetch(PDO::FETCH_ASSOC)){
            $streak_goalDB = $row['streak_goal'];
            $redDB = $row['red'];
            $orangeDB = $row['orange'];
            $yellowDB = $row['yellow'];
            $greenDB = $row['green'];
            $bluePurpleDB = $row['bluePurple'];
            $brownDB = $row['brown'];
        }

            if ( ($red || $redDB) && ($orange || $orangeDB) && ($yellow || $yellowDB) && ($green || $greenDB) && ($bluePurple || $bluePurpleDB) && ($brown || $brownDB) && (!$streak_goalDB)){
                $sql = "UPDATE `data` SET `streak_goal` = '1', `red` = '1', `orange` = '1', `yellow` = '1', `green` = '1', `bluePurple` = '1', `brown` = '1' WHERE user_id='" . $_POST["user_id"] . "' AND date='$time'";
                echo $sql;
                $stmt = $pdo->prepare($sql);
                $stmt->execute();
            } else {

                if ( $red ){
                    $sql = "UPDATE `data` SET `red` = '$red' WHERE user_id='" . $_POST["user_id"] . "' AND date='$time'";
                    $stmt = $pdo->prepare($sql);
                    $stmt->execute();
                }
                if ( $orange ){
                    $sql = "UPDATE `data` SET `orange` = '$orange' WHERE user_id='" . $_POST["user_id"] . "' AND date='$time'";
                    $stmt = $pdo->prepare($sql);
                    $stmt->execute();
                }
                if ( $yellow ){
                    $sql = "UPDATE `data` SET `yellow` = '$yellow' WHERE user_id='" . $_POST["user_id"] . "' AND date='$time'";
                    $stmt = $pdo->prepare($sql);
                    $stmt->execute();
                } 
                if ( $green ){
                    $sql = "UPDATE `data` SET `green` = '$green' WHERE user_id='" . $_POST["user_id"] . "' AND date='$time'";
                    $stmt = $pdo->prepare($sql);
                    $stmt->execute();
                }
                if ( $bluePurple ){
                    $sql = "UPDATE `data` SET `bluePurple` = '$bluePurple' WHERE user_id='" . $_POST["user_id"] . "' AND date='$time'";
                    $stmt = $pdo->prepare($sql);
                    $stmt->execute();
                }
                if ( $brown ){
                    $sql = "UPDATE `data` SET `brown` = '$brown' WHERE user_id='" . $_POST["user_id"] . "' AND date='$time'";
                    $stmt = $pdo->prepare($sql);
                    $stmt->execute();
                }
            }


    } else { // insert row with username and date
        if ( $red && $orange && $yellow && $green && $bluePurple && $brown ){
            $sql3 = "INSERT INTO `data` (`user_id`, `streak_goal`, `red`, `orange`, `yellow`, `green`, `bluePurple`, `brown`) VALUES ( $user_id, '1', $red, $orange, $yellow, $green, $bluePurple, $brown)";
            $stmt = $pdo->prepare($sql3);
            $stmt->execute();
        } else {
            $sql3 = "INSERT INTO `data` (`user_id`, `streak_goal`, `red`, `orange`, `yellow`, `green`, `bluePurple`, `brown`) VALUES ( $user_id, '0', $red, $orange, $yellow, $green, $bluePurple, $brown)";
            $stmt = $pdo->prepare($sql3);
            $stmt->execute();
        }

    }



} else {

    // required field is missing
    $response["success"] = 0;
    $response["message"] = "Required field(s) is missing";

    // echoing JSON response
    echo json_encode($response);
}

//echo '<pre>' . print_r(get_defined_vars(), true) . '</pre>';

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    if ($data != null){
        return $data;
    } else {
        return 0;
    }
}