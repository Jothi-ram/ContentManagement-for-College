<?php
	$conn = mysqli_connect('localhost','root','','socialnetwork');
	$sql = "DELETE FROM posts WHERE post_id=".$_POST['postid'];
	$res = mysqli_query($conn,$sql);
	session_start();
	$_SESSION['toast_text'] = "Deleted post successfully";
	header('Location:home.php');
?>