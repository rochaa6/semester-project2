<?php
include('../session.php');


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
    table {
      width:100%;
    }

      td {
        font-size:16px;
        padding-left:10px;
        padding-right:10px;
        border: solid black 1px;

      }
      </style>
</head>
<body>

<?php
    $page = "admin";
    include "new_navfile.php";
    $user_id = $_SESSION['userId'];
?>
    <div class="text-block">
        <p style="font-size: 3.5em; padding-top:6%">Admin View Orders</p>
      </div>
<div class="container">
    <br>

    <?php //get all orders from Order table$
        $getorders = "SELECT id, userid, name, order_date, status FROM Orders; ";
        $result = mysqli_query($db, $getorders);
        $orders = array();
        while($row = $result->fetch_array() )
        {
            array_push($orders,$row);
        }

    ?>

    <?php foreach ($orders as $order): ?>
      <table>
        <tr>
          <td><?php echo "Order ID: ". $order[0];?></td>
          <td><?php echo "User ID: " . $order[1]; ?></td>
          <td><?php echo "Name: " . $order[2]; ?></td>
          <td><?php echo "Order Date: " . $order[3]; ?></td>
          <td><?php echo "Status: " . $order[4]; ?></td>
          <td><a href="Process_Order.php?id=<?php echo $order[0];?>"><?php echo "Order Details"; ?> </a></td>
          <br>
        </tr>
      </table>
        <?php endforeach; ?>


</div>

</body>
</html>
