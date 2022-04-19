<?php
   include('../session.php');
        $user_id = $_SESSION['userId'];
        $total_price = $_POST['Total_Price'];
      $name = $_POST['Full_Name'];
      $adrl1 = $_POST['address1'];
      $adrl2 = $_POST['address2'];
      $city = $_POST['city'];
      $state = $_POST['state'];
      $zip = $_POST['zip'];
	$cardname = $_POST['cardname'];
	$cardnum = $_POST['cardnumber'];
	$cardexpM = $_POST['cardexpM'];
	$cardexpY = $_POST['cardexpY'];
	$cardcvv = $_POST['cardcvv'];


    $orders = "INSERT INTO Orders (userid, name, addrl1, addrl2, city, state, zip, total, order_date, card_name, card_num, card_expMonth, card_expYear, card_cvv, status)
                VALUES ('$user_id', '$name', '$adrl1', '$adrl2', '$city', '$state', '$zip', '$total_price', now(), '$cardname', '$cardnum', '$cardexpM', '$cardexpY', '$cardcvv', 'Ready' );";
    $result = mysqli_query($db, $orders);
    //echo $orders; // put order from Cart into Orders table.

    $sql = "SELECT id FROM Orders WHERE userid = '$user_id' ORDER BY order_date DESC LIMIT 1;";
    $result = mysqli_query($db, $sql);
    $row = mysqli_fetch_row($result);
    $order_id = $row[0]; //Get order_id for order just placed
    //echo $order_id;

    //same code from cart.php to get cart items' itemid/price/quantity
    $sql = "SELECT * FROM Cart WHERE `User_Id`= $user_id;"; //query users cart items
    $result = mysqli_query($db, $sql);
    $cartItems = array();
    $Iquant = array();
    while($row = $result->fetch_array() ) //put cart items in array
    {
        array_push($cartItems,$row);
        array_push($Iquant,$row);
    }

    $prod_quant = array();
    foreach ($cartItems as $cart_item){         //for each cart item
        $productid = $cart_item['Product_Id'];
        $sql = "SELECT * FROM Products WHERE ID = '$productid';"; //query each product from Products that was in users cart
            $result = mysqli_query($db, $sql);

            while($cartItems = $result->fetch_array() ) //put into array
            {
               array_push($prod_quant,array($cartItems, $Iquant));
            }
    }
?>
<!-- take items and insert into Order_Items table with order id-->
<?php $r = 0; ?>
 <?php foreach ($prod_quant as $row): ?>

    <?php $itemid = $row[0][0]; ?>
    <?php $itemprice = $row[0][5]; ?>
    <?php $itemquant = $row[1][$r][2]; ?>
    <?php $cartitems = "INSERT INTO Order_Items (itemid, orderid, price, quantity)
                VALUES ('$itemid','$order_id', '$itemprice', '$itemquant');"; ?>
    <?php $CI = mysqli_query($db, $cartitems); ?>

    <!-- update Products table with new max_available number of products after the order is placed (in foreach loop so each item should be done)-->
    <?php
        $getquant = "SELECT Amount_Available FROM Products WHERE ID = '$itemid'; ";
        $result = mysqli_query($db, $getquant);
        $row = mysqli_fetch_row($result);
        $itemMquant = $row[0]; //get max amount available for specific item
        $newamt = $itemMquant - $itemquant;

        $newmax = "UPDATE Products SET Amount_Available = '$newamt' WHERE ID = '$itemid'; ";
        $updatedamt = mysqli_query($db, $newmax);
    ?>


    <?php $r = $r + 1; ?>

<?php endforeach; ?>


<?php //clear cart table when order is placed
    $delcart = "DELETE FROM Cart WHERE User_Id = '$user_id'; ";
    $result = mysqli_query($db, $delcart);
?>


<html>
<title>Pharma Thank You</title>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link href="style.css" rel="stylesheet" type="text/css" />
    <style>
        body {
            background-color: aliceblue;
        }
    </style>
</head>
<body>
          <div class="text-block" style="height: 60px; background-color: white"><a class="" href="Index.php"><img src = "imgs/pharma_logo_prototype_5.jpg" alt="Pharma logo" style="width:100px;height:50px;"></a>
      </div>
<?php


    echo "<br><br><br>";
    echo "<h2><center>Thank You, ".$name."!</center></h2>";
    echo "<br>";
    echo "<h2><center>Your Order Has Been Placed!</center></h2>";

?>
<div style="text-align:center">
    <form action="Index.php" method="POST">
        <br>
        <br>
        <input type="submit" value ="Take Me Home" style="width: 20%">
    </form>
</div>
</body>
</html>
