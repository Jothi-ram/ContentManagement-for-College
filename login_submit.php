<?php
	require 'functions/functions.php';
	session_start();
	if (isset($_SESSION['user_id'])) {
	    header("location:home.php");
	}
	$conn = connect();
	if ($_SERVER['REQUEST_METHOD'] == 'POST') { // A form is posted
	    $useremail = $_POST['rollno'];
	    $userpass = ($_POST['pwd']);
	    $query = mysqli_query($conn, "SELECT * FROM users WHERE user_email = '$useremail' AND user_password = '$userpass'");
	    if($query){
	        if(mysqli_num_rows($query) == 1) {
	            $row = mysqli_fetch_assoc($query);
	            $_SESSION['user_id'] = $row['user_id'];
	            $_SESSION['user_name'] = $row['user_firstname'] . " " . $row['user_lastname'];
				$_SESSION['USER_LEVEL'] = $row['USER_LEVEL'];
				$_SESSION['toast_text'] = "Logged-In successfully";
	            header("location:home.php");
	        }
	        else {
	            $_SESSION['toast_text']= "Invalid Login credentials";
	            header("location:main.php");
	        }
	    } else{
	        $_SESSION['toast_text'] = "Database connection failed. Please try again later";
	        header('Location:main.php');
	    }
	}
	mysqli_close($conn);
?>