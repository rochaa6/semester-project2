<?php
   include('../session.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Pharma Headache</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link href="style.css" rel="stylesheet" type="text/css" />
</head>
<body>
  
<?php 
    $page = "headache";
    include "new_navfile.php";
?>
        <div class="text-block">
        <p style="font-size: 3.5em; padding-top:6%">Headache Relief</p>
      </div>
    
<div class="container">
    <br>
    <br>
    <!-- <p>HOME PAGE HERE</p> -->
    
    <?php $sql = "SELECT * FROM Products WHERE Category = 'Headache';";
    $result = mysqli_query($db, $sql);
    //$row = mysqli_fetch_row($result);
    
    //take items from database and insert into array
    $rows = array();
    while($row = $result->fetch_array() )
    {
        array_push($rows,$row);
    }
    ?>
    
    <div class="">
    <!-- go through array display image and name. Link to Product.php given ID of product shown -->
    <?php
        for ($i = 0; $i < count($rows); $i++) {
            echo "<div class=\"col-sm\" style=\"margin-bottom:100px;\"><div style=\"background-color:#f2f2f2;width:250px;height:315px;text-align:center;\">
            <a href=Product.php?id=". $rows[$i]['ID'] . "> 
            <img src=" . $rows[$i]['ImageUrl'] . " style=max-width:210px;max-height:200px;margin-top:30px;/><br></div>" .$rows[$i]['Name']."<br>$".$rows[$i]['Price']."</a><br></div>";
        }
    ?>
    
    </div>
  </div>
  <p> <br> </p>
  <?php include "footer.php"; ?>
</body>
</html>
