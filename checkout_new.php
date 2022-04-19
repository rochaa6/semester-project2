<?php
   include('../session.php');
   if($_SERVER["REQUEST_METHOD"] == "POST") {
       
       $user_id = $_SESSION['userId'];
       
       $sql = "SELECT * FROM Cart WHERE User_Id = '$user_id';";     //check to see if item is in cart already
       $result = mysqli_query($db,$sql);
        $count = mysqli_num_rows($result);
        
        if($count == 1) {   //Item is in cart already
            $row = mysqli_fetch_row($result);
            $Iqua = $row[2];    //cart item quant that was already there
   //make new quantity from # was there and # added just now
            
            $maxsql = "Select `Amount_Available` FROM `Products`;";
            $result = mysqli_query($db,$maxsql);
            $rows = mysqli_fetch_row($result);   //$rows = amount total avail of product
            $amtavail = $rows[0];
            }
       else { //item doesn't exist in cart yet, insert item into cart
            $sql = "INSERT INTO Cart (`User_Id`, `Product_Id`, `Quantity`) VALUES ('$user_id');";
             mysqli_query($db,$sql);
        }
       

       
   }
?>

<?php 
    $page = "checkout_new";
    $user_id = $_SESSION['userId'];
?>
    

      
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
                
            <!--go through array of Products and display info to user-->
            <?php $r = 0; $total_price = 0; $num_items = 0; $num_price = 0;?>
            <?php foreach ($prod_quant as $row): ?>
                    <?php 
                $num_price = floatval($row[0][5]);
                $num_items = floatval($row[1][$r][2]);
                $total_price += $num_price * $num_items;
                $total_price = number_format($total_price, 2);
		?>
            <?php $r = $r + 1;?>
                   <?php endforeach; ?>

  <?php endif; ?>
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
        body{
            background-color: aliceblue;
        }

        input { display: table-cell; }
        
      h3 {text-align: center;}
      
    table {
        border-collapse: collapse;
        }
        th, td, tr{
      padding: 5px;
        }
    .bttn_del{
        background-color:#f7612f;
    }
    .bttn_order{
        background-color:orange;
    }

    input[type=text] {
      width: 100%;
      margin-bottom: 3px;
      padding: 5px;
      border: 1px solid #ccc;
      border-radius: 2px;
        background-color: aliceblue;
    }

    </style>
    </head>
<body>
      <div class="text-block" style="height: 60px; background-color: white"><a class="" href="Index.php"><img src = "imgs/pharma_logo_prototype_5.jpg" alt="Pharma logo" style="width:100px;height:50px;"></a>
      </div>
<div class="row"> 
        <div class="container" >
            <br>
            <br>
        <form action = "Checkout.php" method="POST"> 
            <div class="col-md" style="border: 1px solid black; background-color: white; padding: 10px">
            <h4>Billing Address</h4>
            <p><input type="hidden" id="toal_price" name="Total_Price" value="<?php echo $total_price; ?>" >      
            </p>
            <p><label for="name"> Full Name</label>
            <input type="text" id="name" name="Full_Name" placeholder="Enter First and Last Name" required> 
            </p>
            <p><label for="adrl1"> Address Line 1</label>
            <input type="text" id="adrl1" name="address1" placeholder="Enter Address" required> <br>
            
            <p><label for="adrl2"> Address Line 2</label>
            <input type="text" id="adrl2" name="address2" > <br>
            </p>
            <p><label for="city"> City</label>
            <input type="text" id="city" name="city" placeholder="Enter City" required> <br>
            </p>
            <p><label for="state"> State</label>
            <select id="state" name="state">
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
	<option value="WY">Wyoming</option> </select>  <br>
            </p>
           <p><label for="zip"> Zip</label>
            <input type="text" id="zip" name="zip" pattern="[0-9]*" maxlength="5" placeholder="Enter Zip Code"  required> <br>
            </p>
		<br> <h4> Card Information </h4>
		<p><label for="cname">Name on Card</label>
		<input type="text" id="cname" name="cardname" pattern="[a-zA-Z\s]+" placeholder="John Doe" required> <br>
            </p>
		<p><label for="ccnum">Credit Card Number</label>
		<input type="text" id="ccnum" name="cardnumber" maxlength="19" pattern="[0-9\s]{13,19}" placeholder="#### #### #### ####" required> <br>
            </p>
                <p><label for="cexpM">Expiration Date</label>
                <select id="cexpM" name="cardexpM">
                    <option value="01">January</option>
                    <option value="02">February </option>
                    <option value="03">March</option>
                    <option value="04">April</option>
                    <option value="05">May</option>
                    <option value="06">June</option>
                    <option value="07">July</option>
                    <option value="08">August</option>
                    <option value="09">September</option>
                    <option value="10">October</option>
                    <option value="11">November</option>
                    <option value="12">December</option>
                </select>
                <label for="cexpY"></label>
                <select id="cexpY" name="cardexpY">
                    <option value="21"> 2021</option>
                    <option value="22"> 2022</option>
                    <option value="23"> 2023</option>
                    <option value="24"> 2024</option>
                    <option value="25"> 2025</option>
                    <option value="26"> 2026</option>
                </select> <br>
            </p>
              <p>  <label for="cvv">CVV</label>
                <input type="text" id="cvv" name="cardcvv" maxlength="3" pattern="[0-9]{3}" placeholder="###" required> <br>
            </p>
    </div> 
            
        <div class="col-md-1" style="border: 1px solid black; background-color: white; padding: 10px;">
          <h4>Order Summary</h4>
          <table style="float: right; width: 100%">

		<?php $r = 0; ?>
		 <?php foreach ($prod_quant as $ordersum): ?>
              <tr><td><div><div style="background-color:#f2f2f2;width:75px;height:95px;text-align:center;float: left"><img src="<?php echo $ordersum[0][3]; ?>" style="width: 35px; height: 55px; margin-top: 20px"> </div>
                  <div style="float: left; margin-top:35px; margin-left: 10px"><?php echo $ordersum[0][1]; ?></div></div></td>
                  <td> Qty <?php echo $ordersum[1][$r][2];?> </td>
              <td>$<?php echo $ordersum[0][5]?></td></tr>

		<?php $r = $r + 1; ?>
		<?php endforeach; ?>
		<tr>
		<td>Subtotal</td>
                  <td></td>
                  <td>$<?php echo $total_price ?> </td>
		</tr>

              <tr><td>Shipping</td>
                  <td></td>
                  <td>FREE</td></tr>

              <tr><td><b>Order Total</b></td>
                  <td></td>
                  <td><b>$<?php echo $total_price ?></b> </td>
		</tr>

          </table>
        <button onclick="document.location='Cart.php'" class="bttn_order" style="padding: 10px; width: 49%">Go Back</button>
    <input type="submit" style="width:49%" value ="Place Order">
                
  </div> 
                </form>

	</div>
    </div>

</body>
</html>
