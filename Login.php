<?php
   include('../session.php');
   $error = "Your Login Name or Password is invalid";
   if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form

      $myusername = mysqli_real_escape_string($db,$_POST['username']);
      $mypassword = mysqli_real_escape_string($db,$_POST['password']);
      $error = '<h5>Invalid Login Credentials. Please try again.</h5>';

        //Checks if entered details are not empty first.
        if ($myusername != "" && $mypassword != ""){

           //Selects the username based on the username entered.
           $query  = "SELECT * FROM users WHERE username = '$myusername'";
           $result = mysqli_query($db, $query);

           //Checks to see if the row is empty or not
           if(mysqli_num_rows($result) == 1){
             while ($row = mysqli_fetch_assoc($result)) {
               //verifies that the hashed password matches the unhashed one entered.
               if (password_verify($mypassword, $row['password'])) {
                  //Sets the session username and id
                  $_SESSION['username'] = $myusername;
                  $_SESSION['userId'] = $row['id'];
                  header("location: Index.php");
               }else{
                  $_SESSION['error'] = $error;
               }
             }
           }
         }
       }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Pharma User Login</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link href="style.css" rel="stylesheet" type="text/css" />


        <style type = "text/css">
         body {
            background-image: url('loginbackground.png');
             background-repeat: no-repeat;
             background-size: cover;
            font-family:Arial, Helvetica, sans-serif;
            font-size:14px;
         }
        label {
            font-weight:bold;
            width:100px;
            font-size:14px;
         }
        input[type=submit] {
            background-color: #337ab7;
            color: white;
            width: 80%;
            padding: 10px;
        }
        input[type=submit]:hover {
            background-color: lightblue;
        }
        input[type=text], input[type=password] {
            width: 100%;
            height: 40px;
            }
            .login {
                margin-top: 30px;
                width:350px;
                height: 400px;
                background-color: white;
                box-shadow:0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
            }

            h5 {
  color:red;
}
      </style>


</head>
<body>

<?php
    $page = "login";
    include "new_navfile.php";
    //include("../config.php");
?>

      <div align = "center">
         <div class="login" align = "left">
            <div style = " text-align: center; padding-top:15px; font-size: 2em">Login</div>
				<hr style="height:3px">
            <div style = "margin:30px;">
               <form action = "" method = "post">
                  <label>Username  </label><input type = "text" name = "username" class = "box"/><br /><br />
                  <label>Password  </label><input type = "password" name = "password" class = "box" /><br/><br />
                   <a href="Add_Account.php" style="font-size: 12px">Don't have an account? Sign up Now!</a>
                   <div style="text-align: center; padding-top: 10px">
                       <input type = "submit" value = " Login "/><br /></div>
               </form>
               <?php
//Displays the invalid login error down at the bottom of the form when an invalid login is entered.
if(isset($_SESSION["error"])){
  $error = $_SESSION["error"];
  echo "<span>$error</span>";
  unset($_SESSION['error']);
}
?>
               <div style = "font-size:11px; color:#cc0000; margin-top:10px"></div>

            </div>

         </div>

      </div>
    <br>
    <br>
    <br>
        <?php include "footer.php"; ?>
   </body>
</html>
