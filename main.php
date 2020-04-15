<!DOCTYPE html>
<html lang="en">
<head>
  <title>Students Portal Login</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta autuhor="Jothi Ram">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
  <link href="https://fonts.googleapis.com/css?family=Muli&display=swap" rel="stylesheet">
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
          left: 15%;
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
  </style>
</head>
<body <?php
  session_start();
  if(isset($_SESSION['toast_text'])){
    echo 'onload="showtoast()"';
  }
?>
>
  <div class="container-fluid" style="padding:0pt">
    <div class="col-sm-9" style="height:100vh;background-image:linear-gradient(to bottom, rgba(0, 16, 33, 0.85), rgba(0, 20, 51, 0.73)), url('psg_tech_fly_over.jpeg');background-repeat: no-repeat; background-size:auto 100%; padding:8%; padding-left:4%" title="PSG College Of Technology">
        <span>
            <h1 style="color:#CCC;font-family:Muli, Calibri Light; font-size:600%">Students Portal</h1>
          
            <h5 style="color:#EEE;letter-spacing:2pt;font-family:Muli, Calibri Light; font-size:100%"><span style="font-size:120%;letter-spacing:1pt"><b></b></span></h5>
        </span>
    </div>
    <div class="col-sm-3" style="background-color:#DCDDDD;height:100vh"><img title="College Logo" src="p.png" style="width:80%">
        <form action="login_submit.php" method="post">
            <div class="form-group">
                <input type="text" maxlength="7" name="rollno" class="form-control" id="rollno" placeholder="Roll Number" required autofocus="">
              </div><BR>
              <div class="form-group">
                <input type="password" maxlength="20" name="pwd" placeholder="Password" class="form-control" required id="pwd">
              </div><BR>
              <center><button type="submit" class="btn btn-default" style="background:#2A4AAA;color:#EEE;letter-spacing: 1pt; font-size:12pt; border-radius:2pt">Sign In securely...</button></center>
            </div>
        </form>
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
</body>
</html>
