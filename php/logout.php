<?php
	session_start();
	session_destroy();
	$hour = time() - 3600;
	setcookie('username', "", $hour, '/', '.'.getenv('HTTP_HOST'));
	setcookie('passHash', "", $hour, '/', '.'.getenv('HTTP_HOST'));
	header("Location: ../");
?>