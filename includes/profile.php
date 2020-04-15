<?php
echo '<div class="profile">';
echo '<center>';
$row = mysqli_fetch_assoc($profilequery);
// Name and Nickname
if(!empty($row['user_nickname']))
    echo $row['user_firstname'] . ' ' . $row['user_lastname'] . ' (' . $row['user_nickname'] . ')';
else
    echo $row['user_firstname'] . ' ' . $row['user_lastname'];
echo '<br>';
// Profile Info & View
$width = '168px';
$height = '168px';
include 'includes/profile_picture.php';
echo '<br>';
// Gender
if($row['user_gender'] == "M")
    echo 'Male';
else if($row['user_gender'] == "F")
    echo 'Female';
echo '<br>';
echo '<center>'; 
echo'</div>';

$query4 = mysqli_query($conn, "SELECT * FROM user_phone WHERE user_id = {$row['user_id']}");
if(!$query4){
    echo mysqli_error($conn);
}
if(mysqli_num_rows($query4) > 0){
    echo '<br>';
    echo '<div class="profile">';
    echo '<center class="changeprofile">'; 
    echo 'Phones:';
    echo '<br>';
    while($row4 = mysqli_fetch_assoc($query4)){
        echo $row4['user_phone'];
        echo '<br>';
    }
    echo '</center>';
    echo '</div>';
}

?>