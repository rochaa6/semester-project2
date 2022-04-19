<?php
   include('../session.php');
  date_default_timezone_set('America/New_York');
   $id = $_GET['id'];
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

   //get old data of Order(ID)
   $getdata = "SELECT * FROM Orders WHERE ID = '$id'; ";
   $result = mysqli_query($db, $getdata);
    $data = mysqli_fetch_row($result);
    $orderid = $data[0];
    $orderuserid = $data[1];
    $ordername = $data[2];
    $orderaddr1 = $data[3];
    $orderaddr2 = $data[4];
    $ordercity = $data[5];
    $orderstate = $data[6];
    $orderzip = $data[7];
    $ordertotal = $data[8];
    $orderdate = $data[9];
    $ordercrdname = $data[10];
    $ordercrdnum = $data[11];
    $ordercrdexpM = $data[12];
    $ordercrdexpY = $data[13];
    $ordercrdcvv = $data[14];
    $orderstatus = $data[15];


    //update Product table with new data if it "is set" and is not *blank*
/*    if(isset($_POST['name']) && $_POST['name'] != "")
    {
        $updatename = "UPDATE Products SET Name = '$newname' WHERE ID = '$id'; ";
        $result = mysqli_query($db, $updatename);
        echo "<meta http-equiv='refresh' content='0'>";
    }

*/
if(isset($_POST['submit']) )
{
    $timenow = date("Y-m-d H:i:s");


    $origtimesql = "SELECT order_date FROM Orders WHERE ID = '$id'; ";
    $origtime = mysqli_query($db, $origtimesql);
    $timeold = mysqli_fetch_row($origtime);


    $difftime = "SELECT TIMESTAMPDIFF(HOUR,'$timeold[0]','$timenow'); ";
    $runtime = mysqli_query($db, $difftime);
    $hoursdiff = mysqli_fetch_row($runtime);


    if ($hoursdiff[0] < 1) {
        $error = "nothour";
    }
    else {
        $orderstatus = $_POST['status'];
        $updatestatus = "UPDATE Orders SET status = '$orderstatus' WHERE ID = '$id'; ";
        $result = mysqli_query($db, $updatestatus);
        // echo "<meta http-equiv='refresh' content='0'>";
    }

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Pharma Edit Item</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
      <link href="style.css" rel="stylesheet" type="text/css" />

      <style>

        .sub_button {
          width:300px;
          height:200px;
        }

        table {
          border: black solid 1px;
          margin-left:auto;
          margin-right:auto;
          margin-top:50px;
        }

        td {
          font-size:20px;
          border: black solid 1px;
        }

      </style>
</head>
<body>

<?php
    $page = "edit";
    include "new_navfile.php";
    $user_id = $_SESSION['userId'];
?>


        <div class="text-block" style="font-size: 3.5em; padding-top:7%">Edit Order</div>
        <?php if(isset($error)): ?>
                <?php if($error == "nothour"): ?>
                        <center><h3 style="color:red">Order has not been modified. Please allow the user 1 hour before modifying the order.</h3></center>
                <?php endif; ?>
        <?php endif; ?>
<div class="container">
        <div class="row">
          <table>
            <tr>
              <td><?php echo "Order ID: " . $orderid?> </td>
            </tr>
            <tr>
              <td><?php echo "User ID: " . $orderuserid?> </td>
            </tr>
            <tr>
              <td><?php echo "Order Shipped Name: " . $ordername?> </td>
            </tr>
            <tr>
              <td><?php echo "Order Shipped Address Line 1: " . $orderaddr1?> </td>
            </tr>
            <tr>
              <td><?php echo "Order Shipped Address Line 2: " . $orderaddr2?> </td>
            </tr>
            <tr>
              <td><?php echo "Order Shipped City: " . $ordercity?> </td>
            </tr>
            <tr>
              <td><?php echo "Order Shipped State: " . $orderstate?> </td>
            </tr>
            <tr>
              <td><?php echo "Order Shipped Total: " . $ordertotal?> </td>
            </tr>
            <tr>
              <td><?php echo "Order Date: " . $orderdate?> </td>
            </tr>
            <tr>
              <td><?php echo "Order Card Name: " . $ordercrdname?> </td>
            </tr>
            <tr>
              <td><?php echo "Order Card Expiry Date: " . $ordercrdexpM. " " . $ordercrdexpY?> </td>
            </tr>
            <tr>
              <td><?php echo "Order Card CVV: " . $ordercrdcvv?> </td>
            </tr>
            <tr>
              <td><?php echo "Order Status: " . $orderstatus?> </td>
            </tr>


        <form action = "" method="POST">
          <tr><td>
		<label> Edit Order Status</label>
		<select name= "status">
		    <option value="Ready">Ready</option>
		    <option value="Shipped">Shipped</option>
		    <option value="Delivered">Delivered</option>
		    <option value="Cancelled">Cancelled</option>
		</select>
  </td></tr>
  </table>
            <div style ="margin-left:auto; margin-right:auto; margin-top:30px;"class ="sub_button"><input  type="submit" name="submit" value ="Submit Status Change"></div>
	</form>
</div>
</div>
</body>
</html>
