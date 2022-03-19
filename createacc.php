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


<div class="" >
	<form id="newacc-form" class="form" action="php/newacc.php" method="post">
		<div class="">

			<div class="">
				<h3 class="">Create Account</h3>
			</div>

			<div class="">

				<lable>First Name:
					<input required name="first_name" id="fist_name" value="" type="text">
				</label>
				</br>

				<lable>Last Name:
					<input required name="last_name" id="last_name" value="" type="text">
				</label>
				</br>

				<label>Username:
					<input required minlength="4" name="username" id="username" value="" type="text">
				</label>
				<?php 
					if(isset($_GET['error'])){
						if(($_GET['error'] == '1')){
						echo '
							<span> The Username is already taken</span>
						';
						}
					}
				?>
				</br>

				<label>Password :
				  <input required minlength="5" name="password" id="password" type="password" onkeyup='check();' />
				</label>

				<br>

				<label>Confirm Password:
				  <input required minlength="5" type="password" name="confirm_password" id="confirm_password"  onkeyup='check();' /> 
				  <span id='message'></span>
				</label>

			</div>
		</div>
		<div class="">
			<button id="submitbutton" class="" disabled type="submit"><b>Create</b></button>
		</div>
	</form>
</div>



<script type="text/javascript">

var check = function() {
  if (document.getElementById('password').value ==
    document.getElementById('confirm_password').value) {
    document.getElementById('message').style.color = 'green';
    document.getElementById('message').innerHTML = 'Matching';
    document.getElementById('submitbutton').disabled = null;
  } else {
    document.getElementById('message').style.color = 'red';
    document.getElementById('message').innerHTML = 'Not Matching';
    document.getElementById('submitbutton').disabled = 'disabled';
  }
}

</script>


</body>

</html>
