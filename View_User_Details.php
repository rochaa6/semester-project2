<?php
   include('../session.php');
   $userid = $_GET['userid'];
   $username = $_GET['username'];

    $user_id = $_SESSION['userId'];

    if (!isset($_SESSION['username'])):
        header("location: Index.php");
    endif;

    $admincheck = "SELECT User_Type FROM users WHERE id = '$user_id'; ";
    $result = mysqli_query($db, $admincheck);
    $row = mysqli_fetch_row($result);
    $user_type = $row[0];

    if($user_type != "Admin"):
         header("location: Index.php");
    endif;
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Pharma Admin</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <link href="style.css" rel="stylesheet" type="text/css" />

  <style>

    p {
      padding: 8px;
    }

table {
    width: 100%;
  border-collapse: collapse;
    table-layout: fixed;
}

td {
  border: 1px solid #dddddd;
  text-align: left;
    font-size:25px;
      padding-top:10px;
      padding-left:10px;
      padding-right:10px;
}

tr:nth-child(even) {
  background-color: aliceblue;
}

  </style>

</head>
<body>

<?php
    $page = "account_information";
    include "new_navfile.php";
    $user_id = $_SESSION['userId'];
?>

<?php
    $getaddress = "SELECT * FROM Address WHERE `UserId`= $userid;"; //Select user address from Address table
    //echo $sql;
    $result = mysqli_query($db, $getaddress);

	$user_addr = array();
    while($row = $result->fetch_array() ) //put Address elements in array
    {
        array_push($user_addr,$row);
    }

?>




<div class="text-block" style="font-size: 3.5em; padding-top:7%"><?php echo $username?> Account Information</div>
<div class="container">
        <br>
    <p> <br> </p>

  </div>

  <div class="container">
    <table>
      <tr>
        <td><p> <?php echo "Full Name: " . $user_addr[0][2] . " " . $user_addr[0][3] . " " . $user_addr[0][4]; ?></p></td>
      </tr>

      <tr>
        <td><p> <?php echo "Phone Number: " . $user_addr[0][5]; ?> </p></td>
      </tr>

      <tr>
        <td><p> <?php echo "Address: " . $user_addr[0][6]?> </p></td>
      </tr>

      <?php if($user_addr[0][7] != "") { ?>
        <tr>
          <td><p> <?php echo "Address 2: " . $user_addr[0][7]?> </p></td>
        </tr>
      <?php }?>

      <tr>
        <td><p> <?php echo "City: " . $user_addr[0][8]; ?> </p></td>
      </tr>

      <tr>
        <td><p> <?php echo "State: " . $user_addr[0][9]; ?> </p></td>
      </tr>

      <tr>
        <td><p> <?php echo "Zip Code: " . $user_addr[0][10]; ?> </p></td>
      </tr>
    </table>
      <br>
      <button onclick="document.location='View_Users.php'" style="background-color: orange; padding: 10px;">Go Back</button><br>
  </div>
</body>
      <?php include "footer.php"; ?>
</html>
