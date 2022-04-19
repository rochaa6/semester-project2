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
  <link href="style.css" rel="stylesheet" type="text/css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <style>
        body {
            background-color: aliceblue;
        }
    </style>
</head>
<body>
<?php 
    $page = "home";
    include "new_navfile.php";
?>
  
    <div class="container-img">
        <div class="centered" style="">Welcome to Pharma!<br><br>
            <a href="Decongestant.php"><button class="btn-home">Shop Now</button></a></div>
        <img src="imgs/home_.gif" style="width:100%">
    </div> 

    <div class="row" style="margin:0">
          <div class="column" style="background-color:#b3d9ff">
            <h2 style="background-color: white">Shop From Home!</h2>
            <p>Placing an order is simple!</p> 
		<p>1: Make an account</p>
		<p>2: Add some items to buy</p>
		<p>3: Enter your billing information</p>
		<p>4: Then place your order!</p>
          </div>
          <div class="column" style="background-color:#99ccff;">
            <h2 style="background-color: white">COVID-19</h2>
            <p>Hello! The Pharma store is open for business, 
		but to be safe and adhere to social distancing guidelines, 
		we are currently limiting the number of warehouse employees. 
		This means your order will ship slower than normal. 
		Thank you for understanding.</p>
	<a href="https://www.cdc.gov/coronavirus/2019-ncov/index.html">Visit the Centers for Disease Control and Prevention to keep updated about Covid-19</a>

          </div>
          <div class="column" style="background-color:#80bfff;">
            <h2 style="background-color: white">Contact Us</h2>
            <p>Feel free to email us about your concerns or any issues you have!</p>
		<p><a href="mailto:fakeemail@gmail.com">Pharma Email Contact</a></p>
          </div>
    </div>
    <div class="about-us">
        <div class="column1"><img src="imgs/about-us.png" style="width:100%; border-radius: 50%;height: 300px; position: relative;"></div>
        <div class="column2" style="padding-left: 50px">
            <h2 style="background-color: white">The Team</h2>
            <b>Teresa Luz Miller</b> - Amateur monopoly finesser <br><br>
            <b>Samantha Schiff</b> - Loves painting in her free time as well as discovering new and interesting music. <br><br>
            <b>Jesse Castro</b> - "Tell me and I forget. Teach me and I remember. Involve me and I learn." <br><br>
            <b>Marinald Haxhillari</b> - "If you can take it, You can make it..." <br><br>
            <b>Antimo Di Roberto</b> - Enjoys watching soccer and playing video games. <br><br>
            <b>Anthony Rocha</b> - "What a long strange trip it’s been" <br><br>
            <b>Ihanny Frias</b> - Enjoys playing video games and watching Anime <br><br>
            <b>Lauren Walter</b> - Likes playing video games and doing Sudoku puzzles</div>
</div>
</body>
    <?php include "footer.php"; ?>
</html>
