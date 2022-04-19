<?php
   include('../session.php');

    if($_SERVER["REQUEST_METHOD"] == "POST") {
      // Form info to create account sent here



      $email = mysqli_real_escape_string($db,$_POST['email']);
      $username = mysqli_real_escape_string($db,$_POST['username']);
      $password = mysqli_real_escape_string($db,$_POST['pass']);
      $first = mysqli_real_escape_string($db,$_POST['fname']);
      $mid = mysqli_real_escape_string($db,$_POST['minitial']);
      $last = mysqli_real_escape_string($db,$_POST['lname']);
      $phone = mysqli_real_escape_string($db,$_POST['phone']);
      $ad1 = mysqli_real_escape_string($db,$_POST['add1']);
      $ad2 = mysqli_real_escape_string($db,$_POST['add2']);
      $city = mysqli_real_escape_string($db,$_POST['city']);
      $state = mysqli_real_escape_string($db,$_POST['state']);
      $zip = mysqli_real_escape_string($db,$_POST['zip']);
      $error = '<h5>Email already exists. Please try again with a different email.</h5>';
      $error2 = '<h5>Username already exists. Please try again with a different username.</h5>';
      $hashed_password = password_hash($password, PASSWORD_DEFAULT);



      $sql = "SELECT * from users WHERE(username = '$username' or email='$email');";
      $results=mysqli_query($db, $sql);
      if(mysqli_num_rows($results) > 0) {
        $row = mysqli_fetch_assoc($results);
        if ($username==$row['username'])
        {
          $_SESSION['error'] = $error2;
        }
        elseif($email==$row['email'])
        {
          $_SESSION['error'] = $error;
        }
      }else { //here you need to add else condition
        $insert_users = "INSERT INTO users (username, password, email, created_at, User_Type)
                          VALUES ('$username', '$hashed_password', '$email', now(), 'Customer'); ";
          $result = mysqli_query($db,$insert_users);

          $getuserid = "SELECT id FROM users WHERE username = '$username' AND email = '$email'; ";
          $result = mysqli_query($db,$getuserid);
          $row = mysqli_fetch_row($result);
          $newid = $row[0]; //id of inserted user

          //now insert data into Address table about the user just added
          $insert_addr = "INSERT INTO Address (UserId, Fname, Minitial, Lname, Phone, AddrL1, AddrL2, City, State, Zip)
                              VALUES ('$newid', '$first', '$mid', '$last', '$phone', '$ad1', '$ad2', '$city', '$state', '$zip'); ";
        $newaddr = mysqli_query($db, $insert_addr);

      //send user to login page when data inserting is done
      header("location: Login.php");
     }
      }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Pharma Register</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link href="style.css" rel="stylesheet" type="text/css" />

<style>
body {
  font-family: Arial, Helvetica, sans-serif;
  background-color: aliceblue;
}

* {
  box-sizing: border-box;
}

/* Add padding to containers */
.container {
  padding: 16px;
  background-color: white;
  box-shadow:0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
  margin-top: 4%;
}

/* Full-width input fields */
input[type=text], input[type=password], input[type=email] {
  width: 100%;
  padding: 15px;
  margin: 5px 0 22px 0;
  display: inline-block;
  border: none;
  background: #f1f1f1;
}

input[type=text]:focus, input[type=password]:focus {
  background-color: #ddd;
  outline: none;
}

/* Overwrite default styles of hr */
hr {
  border: 1px solid #f1f1f1;
  margin-bottom: 25px;
}

/* Set a style for the submit button */
.registerbtn {
  background-color: #337ab7;
  color: white;
  padding: 16px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  width: 100%;
  opacity: 0.9;
}

.registerbtn:hover {
  background-color: lightblue;
    color: white;
}

select{
  width: 100%;
  padding: 15px;
  margin: 5px 0 22px 0;
  display: inline-block;
  border: none;
  background: #f1f1f1;
}

/* Add a blue text color to links */
a {
  color: dodgerblue;
}


h5 {
  color:red;
}
</style>
</head>
<body>

<?php
    $page = "add_account";
    include "new_navfile.php";
?>

<form action="" method = "post">
  <div class="container">
    <h1>Register An Account</h1>
    <p>Please fill in this form to create an account.</p>
    <?php
      //Displays the error when the user tries to register with empty input fields.
      if(isset($_SESSION["error"])){
            $error = $_SESSION["error"];
            echo "<span>$error</span>";
            unset($_SESSION['error']);
      }

    //Displays the error that the email already exists in the database.
      if(isset($_SESSION["error"])){
            $error2 = $_SESSION["error"];
            echo "<span>$error2</span>";
            unset($_SESSION['error']);
      }
      ?>
    <hr>

    <label for="email"><b>Email</b></label>
    <input type="email" placeholder="Enter Email Ex:name@mail.net" name="email" id="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" required>

    <label for="username"><b>Username</b></label>
    <input type="text" placeholder="Enter Username" name="username" id="username" required>

    <label for="fname"><b>First Name</b></label>
    <input type="text" placeholder="Enter First Name" name="fname" id="fname" required>

    <label for="minit"><b>Middle Initial</b></label>
    <input type="text" placeholder="Enter Middle Initial" name="minitial" maxlength="1" id="minitial">

    <label for="lname"><b>Last Name</b></label>
    <input type="text" placeholder="Enter Last Name" name="lname" id="lname" required>

    <label for="phone"><b>Phone Number</b></label>
    <input type="text" maxlength="10" placeholder="Enter Phone Number Ex:1234567890" name="phone" id="phone" required>

    <label for="add1"><b>Address Line 1</b></label>
    <input type="text" placeholder="Enter Address Line 1" name="add1" id="add1" required>

    <label for="add2"><b>Address Line 2</b></label>
    <input type="text" placeholder="Enter Address Line 2" name="add2" id="add2">

    <label for="city"><b>City</b></label>
    <input type="text" placeholder="Enter City" name="city" id="city" required>

    <label for="state"><b>State</b></label>
    <select name="state" id="state">
	<option value="AL">Alabama</option>
	<option value="AK">Alaska</option>
	<option value="AZ">Arizona</option>
	<option value="AR">Arkansas</option>
	<option value="CA">California</option>
	<option value="CO">Colorado</option>
	<option value="CT">Connecticut</option>
	<option value="DE">Delaware</option>
	<option value="DC">District Of Columbia</option>
	<option value="FL">Florida</option>
	<option value="GA">Georgia</option>
	<option value="HI">Hawaii</option>
	<option value="ID">Idaho</option>
	<option value="IL">Illinois</option>
	<option value="IN">Indiana</option>
	<option value="IA">Iowa</option>
	<option value="KS">Kansas</option>
	<option value="KY">Kentucky</option>
	<option value="LA">Louisiana</option>
	<option value="ME">Maine</option>
	<option value="MD">Maryland</option>
	<option value="MA">Massachusetts</option>
	<option value="MI">Michigan</option>
	<option value="MN">Minnesota</option>
	<option value="MS">Mississippi</option>
	<option value="MO">Missouri</option>
	<option value="MT">Montana</option>
	<option value="NE">Nebraska</option>
	<option value="NV">Nevada</option>
	<option value="NH">New Hampshire</option>
	<option value="NJ">New Jersey</option>
	<option value="NM">New Mexico</option>
	<option value="NY">New York</option>
	<option value="NC">North Carolina</option>
	<option value="ND">North Dakota</option>
	<option value="OH">Ohio</option>
	<option value="OK">Oklahoma</option>
	<option value="OR">Oregon</option>
	<option value="PA">Pennsylvania</option>
	<option value="RI">Rhode Island</option>
	<option value="SC">South Carolina</option>
	<option value="SD">South Dakota</option>
	<option value="TN">Tennessee</option>
	<option value="TX">Texas</option>
	<option value="UT">Utah</option>
	<option value="VT">Vermont</option>
	<option value="VA">Virginia</option>
	<option value="WA">Washington</option>
	<option value="WV">West Virginia</option>
	<option value="WI">Wisconsin</option>
	<option value="WY">Wyoming</option>
</select>

    <label for="zip"><b>Zip Code</b></label>
    <input type="text" maxlength="5" placeholder="Enter Zip" pattern="[0-9]*" name="zip" id="zip" required>

    <label for="pass"><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="pass" id="pass" required>

    <hr>
    <button type="submit" class="registerbtn">Register</button>
  </div>

</form>

<?php include "footer.php"; ?>
</body>
</html>
