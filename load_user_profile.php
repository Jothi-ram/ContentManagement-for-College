<center>
<?php
	require 'functions/functions.php';
	$conn = connect();
	$sql = "SELECT * FROM users WHERE user_id=".$_GET['profile_id'];
	$res = mysqli_query($conn, $sql);
	$row = mysqli_fetch_assoc($res);
	$width=180;
	$height=180;
	include 'includes/profile_picture.php';
	echo '<BR><BR>';
	echo '<h3>'.$row['user_firstname'].' '.$row['user_lastname'].' ('.$row['user_email'].')</h3>';
	echo '<h5>';
	if($row['user_gender']=='M')
		echo 'Male';
	else if($row['user_gender']=='F')
		echo 'Female';
	else
		echo 'Others';
	echo '</h5>';
	echo '<h5><b>';
	if($row['USER_LEVEL']=='A')
		echo 'Role as Admin';
	else
		echo 'Role as User';
	echo '</b></h5>';
?>
</center>