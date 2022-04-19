<?php
   include('../session.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Pharma Home</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  
  <style>
    table, th, td {
    border: 1px solid black;
    border-collapse: collapse;
    }
    
    th, td {
    padding: 5px;
    text-align: center;
    }
    
    .center {
    margin-left: auto;
    margin-right: auto;
    }
  </style>
</head>
<body>
<?php 
    $page = "home";
    include "navfile.php";
?>
  
  <div class="container">
    <h3 style="text-align:center">Welcome to "Pharma"! <br>All your pharmaceutical needs!</h3>
    <p style="text-align:center"> <b>Take a look at some of our items below!</b></p>
    
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
<table class="center">
  <tr>
    <th> <a href="Product.php?id=<?php echo $item_num9?>"> <img src="<?php echo $rows[$item_num][3]; ?>" style="width:228px;height:228px;"/> <br> <?php echo $rows[$item_num][1]; ?></th> </a>
    <th> <a href="Product.php?id=<?php echo $item_num8?>"> <img src="<?php echo $rows[$item_num2][3]; ?>" style="width:228px;height:228px;"/> <br> <?php echo $rows[$item_num2][1]; ?></th> </a>
    <th> <a href="Product.php?id=<?php echo $item_num7?>"> <img src="<?php echo $rows[$item_num3][3]; ?>" style="width:228px;height:228px;"/> <br> <?php echo $rows[$item_num3][1]; ?></th> </a>
    
  </tr>
  </table>
  
</body>
</html>
