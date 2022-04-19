<?php
   include('../session.php');
   date_default_timezone_set('America/New_York');
   $order_number = $_GET['order'];
   $order_status = $_GET['status'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Pharma Order Details</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <link href="style.css" rel="stylesheet" type="text/css" />

  <style>
table {
  border-collapse: collapse;
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: aliceblue;
}
</style>

</head>
<body>

<?php
    $page = "your_order";
    include "new_navfile.php";
    $user_id = $_SESSION['userId'];
?>
    <div class="text-block">
        <p style="font-size: 3.5em; padding-top:6%">Order # <?php echo $order_number?> Details</p>
      </div>
    <p style="font-size: 25px">&nbsp;&nbsp;Item Details </p>
<div class="container">

  </div>

<?php
    $sql = "SELECT * FROM Order_Items WHERE orderid = '$order_number'; "; //get order_items for specific order
    $result = mysqli_query($db, $sql);
    $order_items = array();

    while($row = $result->fetch_array() ) //put order items elements in array
    {
        array_push($order_items,$row);
    }
    $count = mysqli_num_rows($result);

    $i_names = array(); //item names
    for ($x = 0; $x < $count; $x++){
        $orderid = $order_items[$x][0];

        $sql3 = "SELECT Name FROM Products WHERE id = '$orderid;' "; // get specific item name to display
        $i_name = mysqli_query($db, $sql3);

            while($rowz = $i_name->fetch_array() ) //put names in array
           {
              array_push($i_names,$rowz);
           }
    }

    //var_dump($i_names);

    $countinames = count($i_names);
    /*

     */
?>

<table style="width:100%">
    <tr>
        <th>Item </th>
        <th>Item Unit Price </th>
        <th>Quantity Bought </th>
        <th>Total For Each Item</th>
    </tr>

    <?php $name_counter = 0; ?>

<?php foreach ($order_items as $items): ?>

    <tr>
        <td>
            <?php

                echo $i_names[$name_counter][0] . "<br>";
            ?>
        </td> <!-- display names of products that the person ordered for that order <?php echo $i_names[0][0] . "<br>"; ?> -->


        <td> <?php echo $items[2] . "<br>"; ?> </td> <!--item $-->
        <td> <?php echo $items[3] . "<br>"; ?> </td> <!--item qty's-->
        <td> <?php $price = $items[2] * $items[3]; echo "$" . $price; ?> </td>

    </tr>
        <?php $name_counter++; ?>
<?php endforeach; ?>
    <tr>
        <td> </td>
        <td> </td>
        <td> </td>
        <?php $ordertot = "SELECT total FROM Orders WHERE id = '$order_number' AND userid = '$user_id';" ;
            $result = mysqli_query($db, $ordertot);
            $Ototal = mysqli_fetch_row($result);
        ?>
        <td>Order Total: <?php echo "$" . $Ototal[0]; ?></td>
    </tr>

</table>

<?php
    $sql2 = "SELECT * FROM Orders WHERE id = '$order_number' AND userid = '$user_id'; "; //get order address + total for specific order
    $result2 = mysqli_query($db, $sql2);
    $order_addr = array();
    while($row2 = $result2->fetch_array() ) //put elements in array
    {
        array_push($order_addr,$row2);
    }
?>

<?php

//"Cancel Order" allows the user to cancel the order if it hasn't been shipped or delivered yet. Changes status to cancelled.
if (isset($_POST['cancel_order'])){

  $timenow = date("Y-m-d H:i:s");


  $origtimesql = "SELECT order_date FROM Orders WHERE ID = '$order_number'; ";
  $origtime = mysqli_query($db, $origtimesql);
  $timeold = mysqli_fetch_row($origtime);


  $difftime = "SELECT TIMESTAMPDIFF(HOUR,'$timeold[0]','$timenow'); ";
  $runtime = mysqli_query($db, $difftime);
  $hoursdiff = mysqli_fetch_row($runtime);

 $error = '<h3 style = "color:red">1 hour time period has passed. Order cannot be cancelled.</h3>';

  if ($hoursdiff[0] < 1) {

    $sql = "UPDATE Orders SET status='Cancelled' WHERE id = $order_number";

    if($order_status == 'Ready') {
      if($db->query($sql)==TRUE) {
        header("Location: Order_Cancelled.php");
      }
      else {
        echo $dv->error;
        echo "An error has occured. The order was not cancelled";
      }
    }
      }
  else {
            $_SESSION['error'] = $error;
  }
}

?>

    <br>
    <br>

<p style="font-size: 25px">&nbsp;&nbsp;Order Address </p>
<table style="width:100%"> <!-- display order address (name/line1/line2/city/state/zip/date)-->
  <table style="width:25%"> <!-- display order address (name/line1/line2/city/state/zip/date)-->
    <tr>
      <td><?php echo "Full Name: " . $order_addr[0][2]?></td>
    </tr>
    <tr>
      <td><?php echo "Address Line1: " . $order_addr[0][3]?></td>
    </tr>
    <tr>
      <td><?php echo "Address Line2: " . $order_addr[0][4]?></td>
    </tr>
    <tr>
      <td><?php echo "City: " . $order_addr[0][5]?></td>
    </tr>
    <tr>
      <td><?php echo "State: " . $order_addr[0][6]?></td>
    </tr>
    <tr>
      <td><?php echo "Zip: " . $order_addr[0][7]?></td>
    </tr>
    <tr>
      <td><?php echo "Order Date: " . $order_addr[0][9]?></td>
    </tr>
    <tr>
      <td><?php echo "Status: " . $order_addr[0][15]?></td>
    </tr>
  </table>
</table>
<?php
  //Displays the error when the user tries to register with empty input fields.
  if(isset($_SESSION["error"])){
        $error = $_SESSION["error"];
        echo "<span>$error</span>";
        unset($_SESSION['error']);
  }
  ?>
    <br>
    <?php if($order_status == 'Ready') { ?>
    <form method="POST" onsubmit="return confirm('Are you sure you want to cancel this order?');">
    <button class = "accbtn" type="submit" name="cancel_order" value="cancel_order">Cancel Order</button>
    </form>
    <?php }?>
<button onclick="document.location='Account.php'" class="accbtn">Go Back to Account Page</button>
</body>
</html>
