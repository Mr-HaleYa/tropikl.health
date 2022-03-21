<?php
ob_start();
session_start();
require './php/database.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link rel="apple-touch-icon" sizes="180x180" href="/assets/favicon/apple-touch-icon.png">
	<link rel="icon" type="image/png" sizes="32x32" href="/assets/favicon/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="16x16" href="/assets/favicon/favicon-16x16.png">
	<link rel="manifest" href="/assets/favicon/site.webmanifest">
	<link rel="mask-icon" href="/assets/favicon/safari-pinned-tab.svg" color="#5bbad5">
	<link rel="shortcut icon" href="/assets/favicon/favicon.ico">
	<meta name="msapplication-TileColor" content="#da532c">
	<meta name="msapplication-config" content="/assets/favicon/browserconfig.xml">
	<meta name="theme-color" content="#ffffff">

	<title>Login</title>

<style type="text/css">

body {
	background: #0282BE;
}

</style>

	<?php
	    echo '
	        <link href="./styles/style.css?'. filemtime("styles/style.css") . '" rel="stylesheet">
	    ';
	?>


</head>
<body>

<?php

if ( isset($_COOKIE['username']) && isset($_COOKIE['passHash']) ){

echo '
	<div class="flex-wrap" >
				<div class="form-wrap" >
					<form id="resume-form" class="form" action="php/auth.php" method="post">
						<div class="form-content-wrap">

							<div>
								<img class="login-logo" src="./assets/logo.png">
							</div>

							<div class="login-wrap">
								<h3 class="login">Resume Session</h3>
							</div>
							<div class="submit" style="cursor: pointer;" onClick="document.forms[\'resume-form\'].submit();" class="">
								<div class="">
';

	$pdo = Database::connect();
//first_name, last_name
	$query= "SELECT first_name,last_name FROM users WHERE user_login='".$_COOKIE['username']."' AND user_pass='".$_COOKIE['passHash']."'";
	$res = $pdo->query($query);
	$name= $res->fetch(PDO::FETCH_ASSOC);

echo '					<div class="">
									<div class="" ></div>
									<div class="" >
											<h3 class="">'; echo $name['first_name'] . ' ' . $name['last_name']; echo ' </h3>
									</div>
								</div>

							<input name="username" id="username" value="'; echo $_COOKIE["username"]; echo '" type="hidden">
							<input name="password" id="password" value="'; echo $_COOKIE["passHash"]; echo'" type="hidden">
							<input name="resume" value="resume" type="hidden">
						</div>
					</div>
						</div>
						<div class="">
							<div class="">
								<button class="not-me" type="submit" name="notme" value="notme"><b>Not Me</b></button>
							</div>
						</div>
					</form>
				</div>
	</div>
';

} else {

echo '
	<div class="flex-wrap">
				<div class="form-wrap">
					<form id="login-form" class="form" action="php/auth.php" method="post">
						<div class="form-content-wrap">

							<div class="">
								<img class="login-logo" src="./assets/logo.png">
							</div>

							<div class="login-wrap">
								<h3 class="login">Login</h3>
							</div>
';
	if(isset($_GET['error'])){
		if(($_GET['error'] == '1')){
			echo '
			<div class="error-user-pass">
				<span> You entered invalid <br> username or password.</span>
			</div>
			';
		}
	}
	if(isset($_GET['success'])){
		if(($_GET['success'] == '1')){
			echo '
			<div class=".error-user-pass">
				<span>Account created Successfully</br>Please Login</span>
			</div>
			';
		}
	}
echo '
							<div class="username-field-wrap">
								<div class="username-label-wrap">
									<label for="username" class="username-label">Username</label>
								</div>
							
							<div class="username">
								<input type="text" name="username" id="username"">
							</div>
							</div>
							<div class="password-field-wrap">
								<div class="password-label-wrap">
									<label for="password" class="password-label">Password</label>
								</div>
								<div class="password">
									<input type="password" name="password" id="password" >
								</div>
							</div>
						</div>
							<div class="submit-wrapper">
								<button class="submit" type="submit" name="login" value="login"><b>Login</b></button>
							</div>
					</form>
					<div class="">
						 <a href="./createacc" style="font-style: italic; text-decoration: underline; color: inherit;">Need an Account?</a>
					</div>
				</div>
	</div>
';
}

?>

</body>

</html>
