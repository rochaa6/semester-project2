<?php
   include('../session.php');

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Pharma Account</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link href="style.css" rel="stylesheet" type="text/css" />
</head>
  <body>
<?php
    $page = "account";
    include "new_navfile.php";
    $user_id = $_SESSION['userId'];
?>

    <div class="text-block">
        <p style="font-size: 3.5em; padding-top:6%">Welcome to your Account Page</p>
      </div>
<br>
<br>
<?php

    $sql = "SELECT * FROM Address WHERE `UserId`= $user_id;"; //Select user address from Address table
    //echo $sql;
    $result = mysqli_query($db, $sql);
    $user_addr = array();
    while($row = $result->fetch_array() ) //put Address elements in array
    {
        array_push($user_addr,$row);
    }

    $ord = "SELECT * FROM Orders WHERE userid = '$user_id'; ";
    $resul = mysqli_query($db, $ord);
    $ids = array();
    while($row = $resul->fetch_array() ) //put order ids in array
    {
        array_push($ids,$row);
    }

?>

  <div class="wrapper">
    <div>
        <p style="font-size: 25px">Your Info</p>
        <div style="margin-left: 30px">
        <p> <?php echo "<b>Full Name: </b>" . $user_addr[0][2] . " " . $user_addr[0][3] . " " . $user_addr[0][4]; ?></p>
      <p> <?php echo "<b>Phone Number: </b>" . $user_addr[0][5]; ?> </p>
        </div></div>
        <hr style="height: 1px; background-color: lightgray">
    <div>
        <p style="font-size: 25px">Address</p>
        <div style="margin-left: 30px">
        <p> <?php echo "<b>Street Address: </b>".$user_addr[0][6] . "<br><b>Apartment No: </b>" . $user_addr[0][7] . "<br><b>City: </b>" . $user_addr[0][8] . "<br><b>State: </b>" . $user_addr[0][9] . "<br><b>Zip Code: </b>" . $user_addr[0][10]; ?> </p>
        </div></div>
    <hr style="height: 1px; background-color: lightgray">
    <div>
        <p style="font-size: 25px">Your Orders</p>
        <div style="margin-left: 30px">
        <?php foreach ($ids as $row): ?>
              <p><a href="Your_Order.php?order=<?php echo $row[0];?>&amp; status=<?php echo $row[15]; ?>"><?php echo "Order #: ". $row[0] . "<br>Placed On: " . $row[9]; ?> </a></p>

        <?php endforeach; ?>
        </div>
    </div>
</div>



  <?php include "footer.php"; ?>

</body>
</html>
