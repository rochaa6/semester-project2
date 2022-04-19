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

        p:nth-child(odd){
            background-color: aliceblue;
        }
        p {
            padding: 8px;
        }
    </style>
</head>
<body>

<?php
    $page = "admin";
    include "new_navfile.php";
    $user_id = $_SESSION['userId'];
?>
        <div class="text-block" style="font-size: 3.5em; padding-top:6%">Admin Page</div>
    <br>

    <div style="background-color: aliceblue; padding: 8px">
        <h3><a href="View_Orders.php" style="margin-left: 150px"> Click Here to View Orders</a></h3></div>
        <h3 style="padding: 8px"><a href="View_Users.php" style="margin-left: 150px"> Click Here to View All Users</a></h3>
        <h3 style="padding: 8px; background-color: aliceblue;"><a href="Add_Product.php" style="margin-left: 150px"> Click Here to Add Another Item to the Database</a></h3>
    <div style="padding: 8px"><h3 style="margin-left: 150px;">Click an Existing Item Below to Edit It</h3></div>
    <?php //get products id and name, put into array where we can go through and display all of them to click on and go to another page to edit specific item
        $getproducts = "SELECT ID, Name FROM Products; ";
        $result = mysqli_query($db, $getproducts);
        $products = array();
        while($row = $result->fetch_array() )
        {
            array_push($products,$row);
        }

    ?>

    <?php foreach ($products as $product): ?>
        <p><a href="Edit_Item.php?id=<?php echo $product[0]; ?>" style="margin-left: 150px"><?php echo "Item ID: " . $product[0] . " Name: " . $product[1]?> </a></p>

    <?php endforeach; ?>
  <?php include "footer.php"; ?>
</body>
</html>
