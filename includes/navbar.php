<div class="usernav">
  
    <ul> <!-- Ensure there are no enter escape characters.-->
        <li><a href="profile.php">Profile</a></li><li style="cursor:pointer;color:white" id="chatbox" onclick="chatfunction(<?php echo $poster; ?>)">&nbsp;&nbsp;<a href="chatroom.php" >Chat</a>
            <?php
                $chat_sql = "SELECT * FROM user_chat WHERE chat_to=".$_SESSION['user_id']." AND red_by_admin=0";
                //echo $chat_sql;
                $chat_ntfc_res = mysqli_query($conn, $chat_sql);
                if(mysqli_num_rows($chat_ntfc_res)>0)
                    echo "<span style='background-color: red;color:white; border-radius:10pt;'>&nbsp;&nbsp;".mysqli_num_rows($chat_ntfc_res)."&nbsp;&nbsp;</span>";
            ?></li><li><a href="home.php">Home</a></li><li><a href="logout.php">Log Out</a></li>
    </ul>
    <!--<div class="globalsearch">
        <form method="get" action="search.php" onsubmit="return validateField()"> Ensure there are no enter escape characters.
            <select name="location">
                <option value="emails">Emails</option>
                <option value="names">Names</option>
                <option value="hometowns">Hometowns</option>
                <option value="posts">Posts</option>
            </select><input type="text" placeholder="Search" name="query" id="query"><input type="submit" value="Search" id="querybutton">
        </form>
    </div>-->
</div>

<script>
function validateField(){
    var query = document.getElementById("query");
    var button = document.getElementById("querybutton");
    if(query.value == "") {
        query.placeholder = 'Type something!';
        return false;
    }
    return true;
}
</script>