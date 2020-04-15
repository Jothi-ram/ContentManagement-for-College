<?php
	session_destroy();
	session_start();
	$_SESSION['toast_text'] = "Successfully logged-out";
	header('Location:index.html');
?>