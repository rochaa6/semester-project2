<?php
   include('../session.php');
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
   
   //get old data of Product (ID)
   $getdata = "SELECT * FROM Products WHERE ID = '$id'; ";
   $result = mysqli_query($db, $getdata);
    $data = mysqli_fetch_row($result);
    $itemname = $data[1];
    $itemdesc = $data[2];    
    $itemurl = $data[3];    
    $itemcateg = $data[4];    
    $itemprice = $data[5];
    $itemamtavail = $data[6];
    
    //new data from forum 
    $newname = trim($_POST['name']);
    $newdesc = trim( $_POST['desc']); 
    $newurl = trim($_POST['url']); 
    $newcateg = trim($_POST['categ']); 
    $newprice = trim($_POST['price']); 
    $newamtavail = trim($_POST['amtavail']); 
    
    //update Product table with new data if it "is set" and is not *blank*
    if(isset($_POST['name']) && $_POST['name'] != "") 
    {
        $updatename = "UPDATE Products SET Name = '$newname' WHERE ID = '$id'; ";
        $result = mysqli_query($db, $updatename);
        echo "<meta http-equiv='refresh' content='0'>";
    }
    
    if(isset($_POST['desc']) && $_POST['desc'] != "") 
    {
        $updatedesc = "UPDATE Products SET Description = '$newdesc' WHERE ID = '$id'; ";
        $result = mysqli_query($db, $updatedesc);
        echo "<meta http-equiv='refresh' content='0'>";
    }    
    
    if(isset($_POST['url']) && $_POST['url'] != "") 
    {
        $updateurl = "UPDATE Products SET ImageUrl = '$newurl' WHERE ID = '$id'; ";
        $result = mysqli_query($db, $updateurl);
        echo "<meta http-equiv='refresh' content='0'>";
    }

    if(isset($_POST['categ']) && $_POST['categ'] != "") 
    {
        $updatecateg = "UPDATE Products SET Category = '$newcateg' WHERE ID = '$id'; ";
        $result = mysqli_query($db, $updatecateg);
        echo "<meta http-equiv='refresh' content='0'>";
    }

    if(isset($_POST['price']) && $_POST['price'] != "") 
    {
        $updateprice = "UPDATE Products SET Price = '$newprice' WHERE ID = '$id'; ";
        $result = mysqli_query($db, $updateprice);
        echo "<meta http-equiv='refresh' content='0'>";
    }

    if(isset($_POST['amtavail']) && $_POST['amtavail'] != "") 
    {
        $updateamt = "UPDATE Products SET Amount_Available = '$newamtavail' WHERE ID = '$id'; ";
        $result = mysqli_query($db, $updateamt);
        echo "<meta http-equiv='refresh' content='0'>";
    }
    
//Delete item button stuff
if (isset($_POST['DELETE'])){

            $sql = "DELETE FROM Products WHERE ID=$id"; 
            //echo $sql;

            if ($db->query($sql)==TRUE) {
	header("Location: Admin.php");
            echo  "The Item Has Been Deleted.";
            }

	    else {
                echo $db->error;
                echo "An error has occurred.  The item was not deleted.";
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
        p:nth-child(even){
            background-color: aliceblue;
        }
        p {
            padding: 8px;
        }
        label { display: table-cell;
                padding: 5px;
                }
        input { display: table-cell; }
        form {
        width: 100%;
        }

            input[type=text],[type=number] {
          width: 100%;
        }
    </style>
</head>
<body>
  
<?php 
    $page = "edit";
    include "new_navfile.php";
    $user_id = $_SESSION['userId'];
?>
    <div class="text-block">
        <p style="font-size: 3.5em; padding-top:6%">Edit Item Details Here</p>
      </div>
<div class="container">
        <div class="row"> 
        <div class="col-md" style="margin-left: 50px">
        <form action = "" method="POST"> 
                <h1>Edit Item</h1>
            <hr>
            <p style="font-size: 18px"><?php echo "<b>Id:</b> #" . $id . "<br><b>Current Name:</b> " . $itemname . "<br><b>Current Description: </b>" . $itemdesc . 
                "<br><b>Current Image Url: </b>" . $itemurl . "<br><b>Current Category: </b>" . $itemcateg . "<br><b>Current Price: </b>" . $itemprice . "<br><b>Current Amount Available: </b>" . $itemamtavail; ?></p>
            
            <p><label for="name"> New Name</label>
                <input type="text" id="name" name="name"> </p>
            
            <p><label for="desc"> New Description</label>
                <input type="text" id="desc" name="desc"> <br></p>
                
            <p><label for="url"> New Image Url Location</label>
                <input type="text" id="url" name="url"> <br></p>

            <p><label for="categ"> New Category</label>
                <input type="text" id="categ" name="categ"> <br></p>

            <p><label for="price"> New Price</label>
                <input type="number" id="price" name="price" step=".01" min="00.01" max="999.99"> <br></p>

            <p><label for="amtavail"> New Amount Available</label>
                <input type="number" id="amtavail" name="amtavail" min="1"> <br></p>
            <p> *If left blank, data will stay the same</p>
            <input type="submit" class="bttn_order" value ="Submit Change" style="width:35%">
        </form>
            <button onclick="document.location='Admin.php'" style="background-color: orange; padding: 10px;float: left">Go Back</button>
            <br>
            <br>
            </div>
            <div class="col-sm1"><div class="vl"></div></div>
    <div class="col-md" style="margin-left:71px">
    <h1>Delete Item</h1>
            <hr>
                    <p style="font-size: 18px"><?php echo "<b>Id:</b> #" . $id . "<br><b>Current Name:</b> " . $itemname . "<br><b>Current Description: </b>" . $itemdesc . 
                "<br><b>Current Image Url: </b>" . $itemurl . "<br><b>Current Category: </b>" . $itemcateg . "<br><b>Current Price: </b>" . $itemprice . "<br><b>Current Amount Available: </b>" . $itemamtavail; ?></p>
            <br>
	<form method="POST" onsubmit="return confirm('Are you sure you want to delete this item?');">
   	 <button type="submit" style="background-color: #337ab7; color: white; width: 35%; padding: 8px" name="DELETE" value="DELETE">Delete Item</button>
	</form>
        <button onclick="document.location='Admin.php'" style="background-color: orange; padding: 10px;float: left">Go Back</button>
            </div>
	</div>
    </div>

<?php include "footer.php"; ?>
</body>
</html>
