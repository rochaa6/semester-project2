<?php
   include('../session.php');
?>
<?php
  $page = "Order_Cancelled.php";
  //include "navfile.php";
  $user_id = $_SESSION['userId'];
?>

<!DOCTYPE html>
  <html lang="en">
    <head>
      <title>Pharma Order Cancelled</title>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
          <link href="style.css" rel="stylesheet" type="text/css" />
          <style>
              body {
                  background-color: aliceblue;
              }
          </style>
    </head>

    <body>




      <div class="text-block" style="height: 60px; background-color: white"><a class="" href="Index.php"><img src = "imgs/pharma_logo_prototype_5.jpg" alt="Pharma logo" style="width:100px;height:50px;"></a>
  </div>          <br>

        <center><h2>Your order has been successfully cancelled</h2></center>
        <br>
        <div style="text-align:center">
            <form action="Index.php" method="POST">
                <br>
                <br>
                <input type="submit" value ="Take Me Home" style="width: 20%">
            </form>
        </div>
        <br>

    </body>
    </html>
