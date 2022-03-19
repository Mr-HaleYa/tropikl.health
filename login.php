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

	<title>Login</title>

<style type="text/css">

body {
	background: #0282BE;
}

</style>

	<?php
	    echo '
	        <link href="styles/style.css?'. filemtime("styles/style.css") . '" rel="stylesheet">
	    ';
	?>


</head>
<body>

<?php

if ( isset($_COOKIE['username']) && isset($_COOKIE['passHash']) ){

echo '
	<div class="" >
		<div class="" >
			<div class="" >
				<div class="" >
					<form id="resume-form" class="form" action="php/auth.php" method="post">
						<div class="">

							<div class="">
								<img src="assets/icon.png">
							</div>

							<div class="">
								<h3 class="">Resume Session</h3>
							</div>
							<div style="cursor: pointer; border: 2px solid #36b9cc" onClick="document.forms[\'resume-form\'].submit();" class="">
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
								<button class="" type="submit" name="notme" value="notme"><b>Not Me</b></button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
';

} else {

echo '
	<div class="">
		<div class="">
			<div class="">
				<div class="">
					<form id="login-form" class="form" action="php/auth.php" method="post">
						<div class="">

							<div class="">
								<img src="assets/icon.png">
							</div>

							<div class="">
								<h3 class="">Login</h3>
							</div>
';
	if(isset($_GET['error'])){
		if(($_GET['error'] == '1')){
			echo '
			<div class="">
				<span> You entered invalid user name or password.</span>
			</div>
			';
		}
	}
	if(isset($_GET['success'])){
		if(($_GET['success'] == '1')){
			echo '
			<div class="">
				<span>Account created Successfully</br>Please Login</span>
			</div>
			';
		}
	}
echo '
							<div class="">
								<div class="">
									<label for="username" class="">Username</label>
								</div>
							</div>
							<div class="">
								<input type="text" name="username" id="username"">
							</div>
							<div class="">
								<div class="">
									<label for="password" class="">Password</label>
								</div>
							</div>
							<div class="">
								<input type="password" name="password" id="password" >
							</div>
						</div>
						<div class="">
							<div class="">
								<button class="" type="submit" name="login" value="login"><b>Login</b></button>
							</div>
						</div>
					</form>
					<div class="">
						 <a href="./createacc" style="text-decoration: underline; color: inherit;">Need an Account</a>
					</div>
				</div>
			</div>
		</div>
	</div>
';
}

?>

</body>

</html>
