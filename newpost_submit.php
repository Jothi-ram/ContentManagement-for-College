<?php
	require 'functions/functions.php';
	session_start();
	$conn = connect();
    if($_POST['mytextarea'])
	   $caption = $_POST['mytextarea'];
    else
        $caption="";
	$poster = $_SESSION['user_id'];
    $has_image = 0;
    //if(!empty($_FILES['fileUpload']['name']))
    //    $has_image=1;
    $sql = "INSERT INTO posts (post_caption, post_public, post_time, post_by)
            VALUES ('$caption', 'Y', NOW(), $poster)";
    $query = mysqli_query($conn, $sql);
    $sql = "SELECT MAX(POST_ID) FROM posts WHERE post_by=$poster";
    $postrow = mysqli_fetch_array(mysqli_query($conn, $sql))[0];
    foreach($_POST['departments'] as $deps){
        //echo $deps;
    	$sql = "INSERT INTO post_publish(POSTID,GROUP_ID) VALUES ($postrow,$deps)";
        $res = mysqli_query($conn, $sql);
    }
    $_SESSION['toast_text'] = "Error while processing request";
    if($query){
        // Upload Post Image If a file was choosen
        if (!empty($_FILES['fileUpload']['name'])) {
           // echo "sdsd";
            include 'functions/upload.php';
        }
        if(!isset($_SESSION['toast_text'])||$_SESSION['toast_text'] == "Error while processing request")
            $_SESSION['toast_text'] = "Posted successfully !";
        header("location: home.php");
    }

    mysqli_close($conn);
?>