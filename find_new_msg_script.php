<?php
	$conn = connect();
	//session_start();
	$sql = "SELECT COUNT(1) FROM user_chat WHERE chat_to=".$_SESSION['user_id']." AND red_by_admin=0";
	$res = mysqli_query($conn, $sql);
	$row = mysqli_fetch_array($res);
	$cnt = $row[0];
	if($cnt>0)
		echo "($cnt)";
	//mysqli_close($conn);
?>