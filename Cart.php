<?php
   include('../session.php');
   if($_SERVER["REQUEST_METHOD"] == "POST") {
       
       $item_quant = mysqli_real_escape_string($db,$_POST['quantity']);
       $item_id = mysqli_real_escape_string($db,$_POST['product_id']);
       $user_id = $_SESSION['userId'];
       
       $sql = "SELECT * FROM Cart WHERE User_Id = '$user_id' AND Product_Id = '$item_id';";     //check to see if item is in cart already
       $result = mysqli_query($db,$sql);
        $count = mysqli_num_rows($result);
        
        if($count == 1) {   //Item is in cart already
            $row = mysqli_fetch_row($result);
            $Iqua = $row[2];    //cart item quant that was already there
            $new_Iqua = $Iqua + $item_quant;    //make new quantity from # was there and # added just now
            
            $maxsql = "Select `Amount_Available` FROM `Products` WHERE Id = '$item_id';";
            $result = mysqli_query($db,$maxsql);
            $rows = mysqli_fetch_row($result);   //$rows = amount total avail of product
            $amtavail = $rows[0];
            
            if ($new_Iqua > $amtavail){  //if amount added to cart > amt avail, set cart quantity to max avail?
                echo '<script>alert("Not enough inventory available, adding maximum items we can for this item")</script>'; 
                $sql = "UPDATE Cart SET Quantity='$amtavail' WHERE User_Id = '$user_id' AND Product_Id = '$item_id';";
                mysqli_query($db,$sql);
            }
            else{   //amount added to cart <= amt avail, just set cart quantity to the amount added in first place
            $sql = "UPDATE Cart SET Quantity='$new_Iqua' WHERE User_Id = '$user_id' AND Product_Id = '$item_id';";
            mysqli_query($db,$sql);
            }
            
        }else { //item doesn't exist in cart yet, insert item into cart
            $sql = "INSERT INTO Cart (`User_Id`, `Product_Id`, `Quantity`) VALUES ('$user_id', '$item_id', '$item_quant');";
             mysqli_query($db,$sql);
        }
       

       
   }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Pharma Cart</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link href="style.css" rel="stylesheet" type="text/css" />
  
  <style>

      h3 {text-align: center;}
      
    table {
    border-collapse: collapse;
    }
    th, td, tr{
    padding: 5px;
    text-align: left;
    }
.bttn_del{
    background-color:#f7612f;
}
.bttn_order{
    background-color:#c2fc03;
}

input[type=text] {
  width: 100%;
  margin-bottom: 3px;
  padding: 5px;
  border: 1px solid #ccc;
  border-radius: 2px;
}

  </style>
</head>
<body>


<?php 
    $page = "cart";
    include "new_navfile.php";
    $user_id = $_SESSION['userId'];
?>
    
    
    <div class="text-block">
        <p style="font-size: 3.5em; padding-top:6%">My Shopping Cart</p>
      </div>
    
  <div class="wrapper2">
      
    <?php
    $sql = "SELECT * FROM Cart WHERE `User_Id`= $user_id;"; //query users cart items
    $result = mysqli_query($db, $sql);
    $cartItems = array();
    $Iquant = array();
    while($row = $result->fetch_array() ) //put cart items in array
    {
        array_push($cartItems,$row);
        array_push($Iquant,$row);
    }
    ?>
    
    <?php if (count($cartItems) == 0): ?>
        <h3>There seems to be nothing here. Add items to cart to get started!</h3>
        
    <?php else: ?>

    <?php 
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
                <table>
                <tr>
                    <th style="width: 75%">Item</th>
                    <th style="width: 10%">Quantity</th>
                    <th style="width: 10%">Price</th>
                    <th>Remove</th>
                </tr>
                
            <!--go through array of Products and display info to user-->
            <?php $r = 0; $total_price = 0; $num_items = 0; $num_price = 0;?>
            <?php foreach ($prod_quant as $row): ?>
                <tr>
                    <td> <div><div style="background-color:#f2f2f2;width:90px;height:126px;text-align:center;float:left"><img src="<?php echo $row[0][3]; ?>" style="width: 50px; height: 86px; margin-top: 20px"></div>&nbsp;&nbsp;&nbsp;&nbsp;
                        <div style="float:left;padding: 50px  10px;"><?php echo $row[0][1]; ?></div></div> </td>        <!--Product name-->
                    <td> <?php echo $row[1][$r][2];?> </td>     <!--[products/quantity array][item row][column] = quantity of each cart item-->
                    <!-- <td> <?php echo $row[0][0]; ?> </td>        Product id?-->
                              <td> <?php echo "$" . $row[0][5];?> </td>   <!--Product price-->
                    <td> 
                        <form action="Delete_Item.php" method="POST"> 
                            <input type="hidden" name="product_id" value="<?php echo $row[0][0]; ?>" >
                            <input type="submit" class="bttn_del" value ="X">
                        </form>
                    </td>
                    
                </tr>
                    <?php 
                $num_price = floatval($row[0][5]);
                $num_items = floatval($row[1][$r][2]);
                $total_price += $num_price * $num_items;
		$total_price = number_format($total_price, 2);
                ?>
            <?php $r = $r + 1;?>
                   <?php endforeach; ?>
      </table>
      <hr>
      <table>
          
                <tr>
                    <th style="width: 80%"></th>
                    <th ></th>
                    <th></th>
                    <th style="width:20%"> </th>
                </tr>
               <tr> 
                   <td></td><td></td><td></td><td style="float: right; font-size: 1.5em">  Total $<?php echo $total_price ?> </td></tr>
                <tr><td></td><td></td><td></td><td style="text-align: right">
                <form action="checkout_new.php" method="post">
                <input type="submit" class="" value ="Checkout">
                </form></td></tr>
                 </table>

  <?php endif; ?>
    </div>
    
    
  <?php include "footer.php"; ?>


</body>
</html>
