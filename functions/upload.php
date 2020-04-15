<?php
//echo "fg";
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $filename = basename($_FILES["fileUpload"]["name"]);
    $filetype = pathinfo($filename, PATHINFO_EXTENSION); // get file extension and check its type.
    if($filetype != "png" && $filetype != "jpg" && $filetype!= "jpeg" && $filetype != "gif"){
        ;//      echo 'Only JPG, JPEG, PNG & GIF formats are allowed.';
    }
        $filepath = "data/images/profiles/" . $_SESSION['user_id'] . '.' . $filetype;
        if(move_uploaded_file($_FILES["fileUpload"]["tmp_name"], $filepath)){
            $filepath2 = "data/images/posts/" . $postrow . '.' . $filetype;
            if(!copy($filepath,$filepath2))
                $_SESSION['toast_text']="Attachment upload failed";
            else{
                $sql = "UPDATE posts SET has_attachment='".$filetype."', attachment_name='".$_FILES["fileUpload"]["name"]."' WHERE post_id=".$postrow;
                $res = mysqli_query($conn, $sql);
                //echo $sql;
            }
        }
        else
            $_SESSION['toast_text']="Attachment upload failed";
    
}
?>