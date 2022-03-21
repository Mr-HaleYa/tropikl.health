<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

require './database.php';
$pdo = Database::connect();



  if ( !empty($_POST)) {


    $sql1= "SELECT * FROM users WHERE user_login='" . $_POST["username"] . "'";
    $query_res = $pdo->query($sql1);
    $count= count($query_res->fetchAll(PDO::FETCH_ASSOC));
    if($count > 0){

      header("Location: ../createacc.php?error=1"); //invalid username

    } else {

      // keep track post values
      $uname = strtolower($_POST['username']);
      $pass = md5($_POST['password']);
      $fname = $_POST['first_name'];
      $lname = $_POST['last_name'];

      // insert data
      $pdo = Database::connect();
      $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      
      $sql = "INSERT INTO users (user_login,user_pass,first_name,last_name) values(? ,? ,? ,? )";
      $q = $pdo->prepare($sql);
      $q->execute(array($uname,$pass,$fname,$lname));
      Database::disconnect();
      header("Location: ../login.php?success=1");

    }
  }