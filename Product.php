<?php
   include('../session.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Pharma Product</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link href="style.css" rel="stylesheet" type="text/css" />
  
  <style>
    table, th, td {
    border-collapse: collapse;
    }

    .Product-Wrapper{
        margin-left: 10%;
    }
    
    th, td {
    padding: 5px;
    margin: 5px;
    text-align: center;
    }
    
    .center {
    margin-left: auto;
    margin-right: auto;
    }
      input[type=submit] {
    background-color: #337ab7;
    color: white;
    width: 80%;
    padding: 10px;
}
  </style>
  
</head>
<body>
  
<?php 
    $page = "Product";
    include "new_navfile.php"; 
?>
      <div class="text-block" style="height: 10%">
        <p style="font-size: 1.5em;">Free Shipping on All Orders! </p>
      </div>
  <div class="container">
    <h3><br></h3>
    <p><br></p>
  </div>
  
  <?php 
    $item_id = $_GET['id'];
    $sql = "SELECT * FROM Products WHERE `ID`= {$item_id}";
    $result = mysqli_query($db, $sql);
    $row = mysqli_fetch_row($result);
    
    //echo $row[0];//id num
    //echo $row[1];//name
    //echo $row[2];//descr
    //echo $row[3];//url link
    //echo $row[4];//category
    //[5] price
    //[6] amt avail
    ?>


<div class="container">
  <div class="row">
      
    <div class="col-sm-6">
        <div style="background-color:#f2f2f2;width:339px;height:428px;text-align:center;">
            <p> <img src="<?php echo $row[3]; ?>" style="max-width:210px;max-height:220px;background-color:#f2f2f2;margin-top: 50px;"/> </p></div>
    </div>
    <div class="col-sm-6">
      <h2> <?php echo $row[1]; ?> </h2>
    </div>
    <div class="col-sm-6">
        <h4> <?php echo $row[2]; ?> </h4>
    </div>
    <div class="col-sm-6">
        <p> $<?php echo $row[5]; ?> each</p>
    </div>
    <div class="col-sm-6">
        <?php if (isset($_SESSION['username']) && $_SESSION['username'] != null):?>
            <form action="Cart.php" method="POST">
                <label for="quantity">Quantity (between 1 and <?php echo $row[6]; ?> ):</label>
                <input type="hidden" name="product_id" value = "<?php echo $row[0]; ?>" >
                <input type="number" step = "1" id="quantity" name="quantity" min="1" max="<?php echo $row[6]; ?>">
                <input type="submit" value="Add To Cart">
            </form>
        <?php else: ?>
            <h4>Login to add product to cart</h4>
        <?php endif; ?>
        
    </div>
    
  </div>
</div>
    
    <br>
    <br>
    <hr>
    <h1>&nbsp;&nbsp;&nbsp;&nbsp;You Might Also Like</h1>
    <br>
    <div class="container">
    
    <?php $sql = "SELECT * FROM Products;";
    $result = mysqli_query($db, $sql);
    //$row = mysqli_fetch_row($result);
    
    //take items from database and insert into array
    $rows = array();
    while($row = $result->fetch_array())
    {
    array_push($rows,$row);
    }

    //get total number of items in Products database
    $max_index = count($rows) - 1;
    //var_dump($max_index);
    
    //get random number from 0 - total number of items, some items may repeat
    $item_num = rand(0, $max_index);
    $item_num2 = rand(0, $max_index);    
    $item_num3 = rand(0, $max_index);    

    //For href link on images need to increment arry index by 1 to get id num in database
    $item_num9 = $item_num + 1;
    $item_num8 = $item_num2 + 1;
    $item_num7 = $item_num3 + 1;
    
    //echo $rows[$item_num][0];
    
    ?>    
  </div>
<table>
  <tr>
      <th style="width: 13%"></th>
      <th> <div style="background-color:#f2f2f2;width:250px;height:315px;text-align:center;"><a href="Product.php?id=<?php echo $item_num9?>"> <img src="<?php echo $rows[$item_num][3]; ?>" style="width:150px;max-height:200px;margin-top:30px"> <br></a></div><?php echo $rows[$item_num][1]; ?></th>
      <th style="width: 14%"></th>
      <th> <div style="background-color:#f2f2f2;width:250px;height:315px;text-align:center;"><a href="Product.php?id=<?php echo $item_num8?>"> <img src="<?php echo $rows[$item_num2][3]; ?>" style="width:150px;max-height:200px;margin-top:30px"/> <br></a></div><?php echo $rows[$item_num2][1]; ?></th>
      <th style="width: 14%"></th>
      <th> <div style="background-color:#f2f2f2;width:250px;height:315px;text-align:center;"><a href="Product.php?id=<?php echo $item_num7?>"> <img src="<?php echo $rows[$item_num3][3]; ?>" style="width:150px;max-height:200px;margin-top:30px"/> <br></a></div><?php echo $rows[$item_num3][1]; ?></th> 
    
  </tr>
  </table>
  <?php include "footer.php"; ?>
</body>
</html>
