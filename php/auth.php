<?php
session_start();
include './database.php';

$conn = Database::connectMySQL();

if ( $_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['login']) && !isset($_POST['resume']) && !isset($_POST['notme']) ) {

    $username = strtolower($_POST['username']);
    $passInput = $_POST['password'];
    $pass_hash = md5($passInput);

    if(isset($username, $passInput)) {
        $pdo = Database::connect();

        $sql= "SELECT * FROM users WHERE (user_login = '$username' OR user_email = '$username' ) AND user_pass = '$pass_hash' ";

        $query = $pdo->query($sql);
        $count = count($query->fetchAll(PDO::FETCH_ASSOC));

        if($count == 1 ){
            if(filter_var($username, FILTER_VALIDATE_EMAIL)) {

                $query = "SELECT * FROM users WHERE user_email = '$username'";
                $uname = $pdo->query($query);
                $name = $uname->fetch(PDO::FETCH_ASSOC);
                $_SESSION["username"] = $name['user_login'];
                $_SESSION["user_id"] = $name["id"];
                $_SESSION["first_name"] = $name['first_name'];
                $_SESSION["last_name"] = $name["last_name"];
                $_SESSION["user_status"] = $name["user_status"];

            } else {

                $_SESSION["username"] = $username; 

                $user_id_query = "SELECT * FROM users WHERE user_login = '$username'";
                $user_id = $pdo->query($user_id_query);
                $name = $user_id->fetch(PDO::FETCH_ASSOC);
                $_SESSION["user_id"] = $name["id"];
                $_SESSION["first_name"] = $name["first_name"];
                $_SESSION["last_name"] = $name["last_name"];
                $_SESSION["user_status"] = $name["user_status"];

            }

    //update last login time
            $username = $_SESSION["username"];
            $timestamp = gmdate('Y-m-d H:i:s');
            $update_last_login = "UPDATE users SET last_login = '$timestamp' WHERE user_login ='$username'";
            $pdo->query($update_last_login);

            $cookieTime = time() + 3600 * 24 * 30; //delete cookie after 30 days
            setcookie('username', $username, $cookieTime, '/', '.'.getenv('HTTP_HOST'));
            setcookie('passHash', $pass_hash, $cookieTime, '/', '.'.getenv('HTTP_HOST'));

            header('Location: ../index');   //send user to homepage after login
        } else {
            session_destroy();
            $hour = time() - 3600;
            setcookie('username', "", $hour, '/', '.'.getenv('HTTP_HOST'));
            setcookie('passHash', "", $hour, '/', '.'.getenv('HTTP_HOST'));
            header("Location:../login.php?error=1"); //invalid user
        }
    }
} else if ( $_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['resume']) && !isset($_POST['login']) && !isset($_POST['notme']) ) {

    $username = $_COOKIE["username"];
    $passInput = $_COOKIE["passHash"];

    if(isset($username, $passInput)) {
        $pdo = Database::connect();

        $sql= "SELECT * FROM users WHERE (user_login = '$username' OR user_email = '$username' ) AND user_pass = '$passInput' ";

        $query = $pdo->query($sql);

        $count = count($query->fetchAll(PDO::FETCH_ASSOC));
        if( $count == 1 ){
            if(filter_var($username, FILTER_VALIDATE_EMAIL)) {

                $query = "SELECT * FROM users WHERE user_email = '$username'";
                $uname = $pdo->query($query);
                $name = $uname->fetch(PDO::FETCH_ASSOC);
                $_SESSION["username"] = $name['user_login'];
                $_SESSION["user_id"] = $name["id"];
                $_SESSION["first_name"] = $name['first_name'];
                $_SESSION["last_name"] = $name["last_name"];
                $_SESSION["user_status"] = $name["user_status"];

            } else {

                $_SESSION["username"] = $username; 

                $user_id_query = "SELECT * FROM users WHERE user_login = '$username'";
                $user_id = $pdo->query($user_id_query);
                $name = $user_id->fetch(PDO::FETCH_ASSOC);
                $_SESSION["user_id"] = $name["id"];
                $_SESSION["first_name"] = $name["first_name"];
                $_SESSION["last_name"] = $name["last_name"];
                $_SESSION["user_status"] = $name["user_status"];

            }

    //update last login time
            $username = $_SESSION["username"];
            $timestamp = gmdate('Y-m-d H:i:s');
            $update_last_login = "UPDATE users SET last_login = '$timestamp' WHERE user_login ='$username'";
            $pdo->query($update_last_login);

            header('Location: ../index');   //send user to homepage after login
        } else {
            session_destroy();
            $hour = time() - 3600;
            setcookie('username', "", $hour, '/', '.'.getenv('HTTP_HOST'));
            setcookie('passHash', "", $hour, '/', '.'.getenv('HTTP_HOST'));
            header("Location:../login.php?error=1"); //invalid user
        }
    }
} else if ( $_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['notme']) ) {
    session_destroy();
    $hour = time() - 3600;
    setcookie('username', "", $hour, '/', '.'.getenv('HTTP_HOST'));
    setcookie('passHash', "", $hour, '/', '.'.getenv('HTTP_HOST'));
    header("Location:../login.php");
    exit;
} else {
    header("Location:../");
    echo '<pre>' . print_r(get_defined_vars(), true) . '</pre>';
    die();
}

?>
