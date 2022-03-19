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

        $sql= "SELECT * FROM users WHERE user_login = '$username' AND user_pass = '$pass_hash' ";

        $query = $pdo->query($sql);
        $count = count($query->fetchAll(PDO::FETCH_ASSOC));

        if($count == 1 ){

            $_SESSION["username"] = $username; 

            $user_id_query = "SELECT * FROM users WHERE user_login = '$username'";
            $user_id = $pdo->query($user_id_query);
            $name = $user_id->fetch(PDO::FETCH_ASSOC);
            $_SESSION["user_id"] = $name["id"];
            $_SESSION["first_name"] = $name["first_name"];
            $_SESSION["last_name"] = $name["last_name"];

        // Create the cookie
            $cookieTime = time() + 3600 * 24 * 30; //delete cookie after 30 days
            setcookie('username', $username, $cookieTime, '/', '.'.getenv('HTTP_HOST'));
            setcookie('passHash', $pass_hash, $cookieTime, '/', '.'.getenv('HTTP_HOST'));

            header('Location: ../');   //send user to homepage after login
        } else {
            session_destroy();
        // Expire the cookie
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

        $sql= "SELECT * FROM users WHERE user_login = '$username' AND user_pass = '$passInput' ";

        $query = $pdo->query($sql);

        $count = count($query->fetchAll(PDO::FETCH_ASSOC));
        if( $count == 1 ){

            $_SESSION["username"] = $username; 

            $user_id_query = "SELECT * FROM users WHERE user_login = '$username'";
            $user_id = $pdo->query($user_id_query);
            $name = $user_id->fetch(PDO::FETCH_ASSOC);
            $_SESSION["user_id"] = $name["id"];
            $_SESSION["first_name"] = $name["first_name"];
            $_SESSION["last_name"] = $name["last_name"];

            header('Location: ../');   //send user to homepage after login
        } else {
            session_destroy();
        // Expire the cookie
            $hour = time() - 3600;
            setcookie('username', "", $hour, '/', '.'.getenv('HTTP_HOST'));
            setcookie('passHash', "", $hour, '/', '.'.getenv('HTTP_HOST'));
            header("Location:../login.php?error=1"); //invalid user
        }
    }
} else if ( $_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['notme']) ) {
    session_destroy();
    $hour = time() - 3600;
// Expire the cookie
    setcookie('username', "", $hour, '/', '.'.getenv('HTTP_HOST'));
    setcookie('passHash', "", $hour, '/', '.'.getenv('HTTP_HOST'));
    header("Location:../login");
    exit;
} else {
//    header("Location:../");
    echo '<pre>' . print_r(get_defined_vars(), true) . '</pre>';
//    die();
}

?>
