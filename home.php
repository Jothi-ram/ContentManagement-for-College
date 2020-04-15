<?php
  session_start();
  require('functions/functions.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title><?php echo $_SESSION['user_name'] ?> - Home</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <link rel="icon" href="sun.ico">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
  <link href="https://fonts.googleapis.com/css?family=Muli&display=swap" rel="stylesheet">
  <script src="tinymce/tinymce.min.js"></script>
      <script>
        tinymce.init({
          selector: '#mytextarea',
          height: 350,
          menubar: 'edit insert view format tools',
          plugins:[
            "autolink lists link charmap print preview",
                "searchreplace fullscreen",
                "insertdatetime table paste"
          ],
          toolbar: "undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent"
        });
      </script>
  <style>
      .form-control{
        background-color:transparent;
        border:solid 1px #2A4AAA;
        color:#555;
      }
      #snackbar {
          visibility: hidden;
          min-width: 250px;
          margin-left: -125px;
          background-color: #0c2c61;
          color: #fff;
          text-align: center;
          border-radius: 2px;
          padding: 16px;
          letter-spacing: 1pt;
          position: fixed;
          font-family: Muli;
          z-index: 1;
          left: 12%;
          bottom: 30px;
          font-size: 17px;
        }

        #snackbar.show {
          visibility: visible;
          -webkit-animation: fadein 0.5s, fadeout 0.5s 2.5s;
          animation: fadein 0.5s, fadeout 0.5s 2.5s;
        }

        @-webkit-keyframes fadein {
          from {bottom: 0; opacity: 0;} 
          to {bottom: 30px; opacity: 1;}
        }

        @keyframes fadein {
          from {bottom: 0; opacity: 0;}
          to {bottom: 30px; opacity: 1;}
        }

        @-webkit-keyframes fadeout {
          from {bottom: 30px; opacity: 1;} 
          to {bottom: 0; opacity: 0;}
        }

        @keyframes fadeout {
          from {bottom: 30px; opacity: 1;}
          to {bottom: 0; opacity: 0;}
        }
        .container-fluid, .navbar, .navbar-header, .navbar-brand, a{
          background-color:#2A4AAA;
          border-radius: 0pt;
          color:#EEE !important;
        }
        .navbar-brand, .navbar-links{
          font-family: Muli;
          letter-spacing: 0.5pt;
          font-size:13pt;
          user-select: none;
          cursor:pointer !important;
        }
        a{
          text-decoration: none !important;
        }
        a:hover{
          text-decoration: underline !important;
        }
        ::-webkit-scrollbar {
          width: 10px;
        }
        ::-webkit-scrollbar-track {
          background: #DDD; 
        }
        ::-webkit-scrollbar-thumb {
          background: #0A2A7A; 
        }
        .post_items{
          border:solid 1px #AAA;
          border-top-right-radius: 5pt;
          border-top-left-radius: 5pt;
          width:95%;
          box-shadow: #AAA 5px 5px 5px 5px;
        }
        .postedby-name{
          font-size: 14pt;
          cursor:pointer;
        }
        .postedby-name:hover{
          text-decoration: underline;
        }
        .post_items_header{
          padding:10pt;
          border-top-right-radius: 3pt;
          border-top-left-radius: 3pt;
          color:#EEE;
          text-align:left;
          background-color: #2A4AAA;
        }
        .post_items_body{
          padding-left:10pt;
          padding-bottom:5pt;
          text-align: left;
          font-size:120%;
          border:solid 0px #444;
        }
        .post_button{
          padding:5pt;
          font-size:150%;
          padding-left:10pt;
          padding-right:10pt;
          background-color:#2A4AAA;
          color:#EEE;
          transition: color 0.3s, background-color 0.3s;
        }
        .post_button:hover{
          padding:5pt;
          font-size:150%;
          padding-left:10pt;
          padding-right:10pt;
          background-color:#EEE;
          color:#2A4AAA;
        }
        .post_link_attachment{
          background-color: #2A4AAA;
          padding:10pt;
          border-radius: 5pt;
        }

  </style>
</head>
<body style="background-color:#DEDEDE;overflow-y: hidden; overflow-y: hidden" <?php
  if(isset($_SESSION['toast_text'])){
    echo 'onload="showtoast()"';
  }
?>
>
<nav class="navbar navbar-inverse" style="box-shadow: #AAA 5px 5px 5px 5px;">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" style="font-size:14pt; font-weight:800" data-toggle="modal" data-target="#showProfileModal" onclick="show_profile(<?php echo $_SESSION['user_id']; ?>)"><?php echo $_SESSION['user_name']; ?></a>
    </div>
    <ul class="nav navbar-nav navbar-right">
      <?php if($_SESSION['USER_LEVEL']=='A'){?>
      <li><a class="navbar-links" data-toggle="modal" data-target="#newPostModal">New Post</a></li>
    <?php } ?>
      <li><a class="navbar-links" data-toggle="modal" data-target="#ChatModal"><span onclick="changemytext_inbox(this)">Inbox<?php
        include 'find_new_msg_script.php';
      ?></span></a></li>
      <li><a class="navbar-links" href="signout_submit.php">Logout</a></li>
    </ul>
  </div>
</nav>
<center>
  <div style="width:80%; border-left:solid 0px #AAA;height:88.5vh;overflow-y: scroll">
        <h2>News Feed</h2>
    <?php
      $usr_level=$_SESSION['USER_LEVEL'];
      $conn = connect();
      $sql = "SELECT  
                    posts.post_caption, 
                    TIMESTAMPDIFF(SECOND,posts.post_time,NOW()) post_time,  
                    posts.post_public, 
                    users.user_firstname,
                    users.user_lastname, 
                    users.user_id, 
                    users.user_gender, 
                    posts.post_id,
                    posts.has_attachment,
                    posts.attachment_name
                FROM posts
                JOIN users
                    ON posts.post_by = users.user_id
                WHERE 
                    (
                        posts.post_public = 'Y' 
                        OR
                        users.user_id = {$_SESSION['user_id']}
                    )
                    AND 
                    ( 
                        '$usr_level'='A' 
                        OR 
                        post_id IN 
                        (
                            SELECT 
                                post_id 
                            FROM post_publish 
                            WHERE 
                                group_id IN 
                                (
                                    SELECT 
                                        GROUP_ID 
                                    FROM groups_membership 
                                    WHERE USER_ID=".$_SESSION['user_id']."
                                )
                         )
                   )
                UNION
                SELECT 
                    posts.post_caption, 
                    TIMESTAMPDIFF(SECOND,posts.post_time,NOW()) post_time, 
                    posts.post_public, 
                    users.user_firstname,
                    users.user_lastname, 
                    users.user_id, 
                    users.user_gender, 
                    posts.post_id,
                    posts.has_attachment,
                    posts.attachment_name
                FROM posts
                JOIN users
                    ON posts.post_by = users.user_id
                WHERE 
                    posts.post_public = 'N'
                    AND 
                    (
                        '$usr_level'='A' 
                        OR
                        post_id IN 
                        (
                            SELECT 
                                post_id 
                            FROM post_publish 
                            WHERE group_id IN 
                            (
                                SELECT 
                                    GROUP_ID 
                                FROM groups_membership 
                                WHERE USER_ID=".$_SESSION['user_id']."
                            )
                        )
                    )
                ORDER BY post_time ASC";
        //echo $sql;
        $query = mysqli_query($conn, $sql);
        if(!$query){
            echo mysqli_error($conn);
        }
        if(mysqli_num_rows($query) == 0){
            echo '<div class="post">';
            if($_SESSION['USER_LEVEL']=='A')
              echo '<div style="padding:70px "><h3>Be the first admin to create a post !!...</h3></div>';
            else
              echo '<div style="padding:70px "><h3>Awaiting for admins to create their first post :-|</h3></div>';
            echo '</div>';
        }
        else{
            $width = '40px'; // Profile Image Dimensions
            $height = '40px';
            while($row = mysqli_fetch_assoc($query)){
                include 'includes/post.php';
                echo '<br>';
            }
        }
    ?>
  </div>
</center>
<!--<div class="container-fluid" style="border:solid 0px!important">
    <div class="col-sm-9">
    </div>
</div>-->
<div id="newPostModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header" style="background-color: #2A4AAA">
        <h4 class="modal-title" style="font-family: Muli; color:#EEE">Create post</h4>
      </div>
      <form action="newpost_submit.php" method="post" enctype="multipart/form-data">
      <div class="modal-body" style="height:60vh;overflow-y:scroll;background-color:#DDD">
        <textarea name="mytextarea" id="mytextarea"></textarea>
        <BR>
        <div class="col-sm-12">
            <label for="sel1">Departments visible (Hold Shift for multiple selection):</label>
            <select multiple style="width:30%" class="form-control" name="departments[]" id="sel1">
              <?php
               $deps_sql = "SELECT * FROM groups";
                $deps_res = mysqli_query($conn,$deps_sql);
                while($deps_row = mysqli_fetch_array($deps_res)){
                  echo "<option value=$deps_row[0]>".$deps_row[1]."</option>";
                }
              ?>
            </select>
        </div>
        <BR>
        <div class="col-sm-12">
          <BR>
          <center>
            <label for="postattachmentupload">
              <span style="background-color:#2A4AAA; color:#EEE" class="btn btn-default">Upload PDF / Pictures</span>
              <input type="file" name="fileUpload" id="postattachmentupload" accept="image/*,.pdf,/.docx" style="display:none" >
            </label>
          </center>
        </div>
        <BR><BR>
      </div>
      <div class="modal-footer" style="background-color:#DDD; border-top: solid 1px #AAA">
        <button type="button" class="btn btn-default" style="letter-spacing:1pt;background-color:#0A2A7A; color:#EEE;cursor: pointer" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-default" style="letter-spacing:1pt;background-color:#0A2A7A; color:#EEE;">Post</button>
      </div>
    </form>
    </div>

  </div>
</div>
<div id="ChatModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header" style="background-color: #2A4AAA">
        <h4 class="modal-title" style="font-family: Muli; color:#EEE">Chat Messenger</h4>
      </div>
      <div class="modal-body"  style="background-color:#DDD">
        <div id="chat_room_div" style="height:50vh;padding:70px 0; vertical-align: middle">
          <center><h3 style="letter-spacing: 1pt">No people initiated chat with you yet..</h3></center>
        </div>
      </div>
      <div class="modal-footer" style="background-color: #DDD"><BR>
        <button type="button" class="btn btn-default" style="letter-spacing:1pt;background-color:#0A2A7A; color:#EEE;cursor: pointer" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
<div id="showProfileModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header" style="background-color: #2A4AAA">
        <h4 class="modal-title" style="font-family: Muli; color:#EEE">User Profile</h4>
      </div>
      <div class="modal-body"  style="background-color:#DDD">
        <div id="user_profile_div" style="height:45vh;padding:70px 0; vertical-align: middle">
          <center><h3 style="letter-spacing: 1pt"></h3></center>
        </div>
      </div>
      <div class="modal-footer" style="background-color: #DDD"><BR>
        <button type="button" class="btn btn-default" style="letter-spacing:1pt;background-color:#0A2A7A; color:#EEE;cursor: pointer" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

<?php
      if(isset($_SESSION['toast_text'])){
        echo '<div id="snackbar">'.$_SESSION['toast_text'].'</div>';
        ?>
        <script>
          function showtoast() {
            var x = document.getElementById("snackbar");
            x.className = "show";
            setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
          }
        </script>
        <?php
        unset($_SESSION['toast_text']);
      }
      ?>
      <script>
        var myuserid = <?php echo $_SESSION['user_id']; ?>;
      var recipient;
      function show_profile(m){
          var xhttp = new XMLHttpRequest();
          xhttp.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200) {
              document.getElementById("user_profile_div").innerHTML = this.responseText;
            }
          };
          document.getElementById("user_profile_div").style.padding = "00px 00px 00px 00px";
          xhttp.open("GET", "load_user_profile.php?profile_id="+m, true);
          xhttp.send();
      }
      function load_chat(m, to_user, user_name){
        m.innerHTML = "<h4>"+user_name+"</h4>";
        var m1 = document.getElementById("msgtxtbox");
        m1.style.opacity="1";
        var lists = document.getElementsByClassName("user_lists");
        recipient = to_user;
        var i;
        for(i=0; i<lists.length; i++){
          lists[i].style.backgroundColor="#CCC";
          lists[i].style.color = "#2A4AAA";
          //alert('hi');
        }
        m.style.backgroundColor = "#2A4AAA";
        m.style.color="#EEE";
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("chat_display").innerHTML = this.responseText;
            document.getElementById('chat_display').scrollTop = document.getElementById('chat_display').scrollHeight;
          }
        };
        document.getElementById("msgbox").focus();
        xhttp.open("GET", "load_chat_script.php?user="+to_user, true);
        xhttp.send();
        recipient = to_user;
        load_all_messages();
      }
      function load_all_messages(){
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("chat_display").innerHTML = this.responseText;
            document.getElementById('chat_display').scrollTop = document.getElementById('chat_display').scrollHeight;
          }
        };
        document.getElementById("msgbox").focus();
        xhttp.open("GET", "load_chat_script.php?user="+to_user, true);
        xhttp.send();
        setTimeout(load_all_messages,2000);
      }
      function post_message(){
        var text = document.getElementById("msgbox").value;
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("chat_display").innerHTML = this.responseText;
          }
        };
        xhttp.open("GET", "post_msg.php?from="+myuserid+"&to="+recipient+"&msg_text="+text, true);
        xhttp.send();
        var m1 = document.getElementById("msgbox");
        m1.value="";
        m1.focus();
      }
      function check_to_send(m){
        if(m.keyCode==13){
          var txt = document.getElementById('msgbox');
          var str = txt.value;
          str = str.trim();
          if(str!=""){
            txt.value = str;
            post_message();
          }
        }
      }
        function changemytext_inbox(m){
          m.innerText=" Inbox";
          open_inbox();
        }
        function open_inbox(){
          var xhttp = new XMLHttpRequest();
          xhttp.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200) {
              document.getElementById("chat_room_div").innerHTML = this.responseText;
            }
          };
          document.getElementById("chat_room_div").style.padding = "00px 00px 00px 00px";
          xhttp.open("GET", "open_inbox_script.php", true);
          xhttp.send();
        }
        function open_chat_room(reci,from){
          var xhttp = new XMLHttpRequest();
          xhttp.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200) {
              document.getElementById("chat_room_div").innerHTML = this.responseText;
            }
          };
          document.getElementById("chat_room_div").style.padding = "00px 00px 00px 00px";
          xhttp.open("GET", "open_chat_script.php?from="+from+"&reci="+reci, true);
          xhttp.send();
        }
      </script>
</body>
</html>