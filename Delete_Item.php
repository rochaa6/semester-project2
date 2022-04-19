<?php
    include('../session.php');
    $userId = $_SESSION['userId'];
    $Prod_Id = mysqli_real_escape_string($db,$_POST['product_id']);
    
    $sql = "DELETE FROM Cart WHERE Product_Id = '$Prod_Id' AND User_Id = '$userId'; ";
    $result = mysqli_query($db, $sql);
    
    //echo $sql;
    header("location: Cart.php"); 
?>