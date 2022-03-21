<?php
ob_start();
session_start();

if(isset($_SESSION['username'])) {
    header("Location: ./");
    exit;
}

require 'php/database.php';
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

	<title>Create Account</title>

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

<div class="flex-wrap">
<div class="form-wrap" >
	<form id="newacc-form" class="form" action="php/newacc.php" method="post">
		<div class="">

			<div class="form-content-wrap">

				<div>
					<img class="login-logo" src="./assets/logo.png">
				</div>

				<div class="login-wrap">
					<h3 class="login">Create <br>Account</h3>
				</div>

				<div class="username-field-wrap">
					<input required class="username" placeholder="First Name:"name="first_name" id="fist_name" value="" type="text">
				</div>
				</br>

				<div class="username-field-wrap">
					<input required class="username" placeholder="Last Name:"name="last_name" id="last_name" value="" type="text">
				</div>
				</br>

				<div class="username-field-wrap">
					<input required class="username" placeholder="Username:" minlength="4" name="username" id="username" value="" type="text">
				</div>
				<?php 
					if(isset($_GET['error'])){
						if(($_GET['error'] == '1')){
						echo '<div class=".error-user-pass">
							<span> The Username is already taken</span>
							</div>
						';
						}
					}
				?>
				</br>
					<div class="password-field-wrap">
				  	<input class="password" required minlength="5" placeholder="Password:" name="password" id="password" type="password" onkeyup='check();' />
					</div>
				<br>
					<div class="password-field-wrap">
				  	<input class="password" required minlength="5" placeholder="Confirm Password:" type="password" name="confirm_password" id="confirm_password"  onkeyup='check();' /> 
					</div>

			</div>
			<span id='message' class="error-user-pass" style="font-weight: bold;"></span>
		</div>
		<div class="">
			<button style="background-color: #c9a77d;" id="submitbutton" class="submit" disabled type="submit"><b>Create</b></button>
		</div>
	</form>
</div>
</div>


<script type="text/javascript">

var check = function() {
  if (document.getElementById('password').value ==
    document.getElementById('confirm_password').value) {
    document.getElementById('message').style.color = 'green';
    document.getElementById('message').innerHTML = 'Matching';
    document.getElementById('submitbutton').disabled = null;
    document.getElementById('submitbutton').style.backgroundColor = '#FB8C00';

  } else {
    document.getElementById('message').style.color = 'red';
    document.getElementById('message').innerHTML = 'Not Matching';
    document.getElementById('submitbutton').disabled = 'disabled';
    document.getElementById('submitbutton').style.backgroundColor = '#c9a77d';
  }
}

</script>


</body>

</html>
