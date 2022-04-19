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

    $picture_uploaded = '<h5 style="color:green;">The image was successfully uploaded and added to the database!</h5>';
    $item_inserted = '<h5 style="color:green;">The product was successfully added to the database!</h5>';
    $error_upload = '<h5 style="color:red;">There was an error uploading the file, please try again!</h5>';
    $error_item_not_added = '<h5 style="color:red;">An error has occurred.  The item was not added.';

    if($user_type != "Admin"):
         header("location: Index.php");
    endif;


if (isset($_POST['FORM_SUBMIT']))  {
	if(!empty($_FILES['ImgUrl']))
  	{
    		$path = "../Images/";
    		$path = $path . basename( $_FILES['ImgUrl']['name']);
	}

    	if(move_uploaded_file($_FILES['ImgUrl']['tmp_name'], $path)) {
          $_SESSION['picture_uploaded'] = $picture_uploaded;
    	} else{
          $_SESSION['error_upload'] = $error_upload;
    	}

    if(!empty($_POST['Name']) && !empty($_POST['Price']) && !empty($_POST['Description'])&& !empty($_POST['Category']) && !empty($_POST['Amount_Available'])) {

        $NAME=$_POST['Name'];
        $PRICE=$_POST['Price'];
        $DESCRIPTION=$_POST['Description'];
        $DEPARTMENT=$_POST['Category'];
        $STOCK=$_POST['Amount_Available'];
        $ITEMURL = $path;

	//echo $ITEMURL . "hello";
         $query = "insert into Products(Name,Price,Description,ImageUrl,Category,Amount_Available)VALUES('".$NAME."', '".$PRICE."',
                '".$DESCRIPTION."', '".$ITEMURL."', '".$DEPARTMENT."', '".$STOCK."')";
                //echo $query;

        $result = $db->query($query);
                if ($result) {
                    $_SESSION['item_inserted'] = $item_inserted;
                } else {
                      echo $db->error;
                    $_SESSION['error_item_not_added'] = $error_item_not_added;
                }

    } else {
        echo "You have not entered all the required details!<br />"
        . "Please try again.";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Pharma Admin Add New Item</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link href="style.css" rel="stylesheet" type="text/css" />

    <style>
    table {
        width: 50%;
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
    input[type=text],[type=number] {
  width: 100%;
}

h5 {
  font-size:20px;
  font-weight:bold;
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
        <p style="font-size: 3.5em; padding-top:6%">Admin Backend</p>
      </div>
<div class="container">

 <form enctype="multipart/form-data" action="Add_Product.php" method="post">
        <p style="font-size: 25px">Add products to system:</p>
        <table border="0">
          <tr>
            <td>Name</td>
            <td> <input type="text" name="Name" maxlength="30" size="20"></td>
          </tr>
          <tr>
            <td>Price</td>
            <td> <input type="number" name="Price" step=".01" min="00.01" max="999.99"></td>
          </tr>

          <tr>
            <td>Description</td>
             <td><input type="text" name="Description" maxlength="70" size="20"></td>
          </tr>
          <tr>
            <td>Department</td>
             <td><input type="text" name="Category" maxlength="70" min="1" size="20"></td>
          </tr>
          <tr>
            <td>Stock</td>
             <td><input type="number" name="Amount_Available" min="1"></td>
          </tr>

	<tr>
            <td>Image Url</td>
             <td><input type="file" name="ImgUrl"></td>
          </tr>
<!--
/*          <tr>
            <td>Image Url</td>
             <td><input type="text" name="ImgUrl" maxlength="70" min="1" size="20"></td>
          </tr>
*/-->
        </table>
        <input type="hidden" name="FORM_SUBMIT" value="true">
     <br>
        <input type="submit" value="Submit" style="width:15%">

      </form>
      <?php

        if(isset($_SESSION["item_inserted"])){
              $item_inserted = $_SESSION["item_inserted"];
              echo "<span>$item_inserted</span>";
              unset($_SESSION['item_inserted']);
        }

        if(isset($_SESSION["picture_uploaded"])){
              $picture_uploaded = $_SESSION["picture_uploaded"];
              echo "<span>$picture_uploaded</span>";
              unset($_SESSION['picture_uploaded']);
        }

        if(isset($_SESSION["error_upload"])){
              $error_upload = $_SESSION["error_upload"];
              echo "<span>$error_upload</span>";
              unset($_SESSION['error_upload']);
        }

        if(isset($_SESSION["error_item_not_added"])){
              $error_item_not_added = $_SESSION["error_item_not_added"];
              echo "<span>$error_item_not_added</span>";
              unset($_SESSION['error_item_not_added']);
        }
        ?>
<button onclick="document.location='Admin.php'" style="background-color: orange; padding: 10px;">Go Back</button>

</div>
  <?php include "footer.php"; ?>
</body>
</html>
