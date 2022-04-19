<?php
   include('../session.php');
   $searchterm = $_GET['search'];

   //search Products table for 'searchterm'
   $search = "SELECT * FROM Products WHERE Name LIKE '%$searchterm%' OR Description LIKE '%$searchterm%' OR Category LIKE '%$searchterm%'; ";
   $result = mysqli_query($db, $search);
    $products = array(); //put data into array
    while($row = $result->fetch_array() )
    {
        array_push($products,$row);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Pharma Search Results</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
      <link href="style.css" rel="stylesheet" type="text/css" />
      <style>

      p {
          text-align:left;
          font-size:20px;
      }

      </style>
</head>
<body>

<?php
    $page = "search";
    include "new_navfile.php";
?>


          <div class="text-block" style="font-size: 3.5em; padding-top:6%">This is what we found for "<?php echo $searchterm; ?>"*</div>
          <br>
          <br>
<div class="container">
    <!-- display Name and description for each product found. Links to Product page by id-->
    <?php foreach ($products as $results): ?>
            <p><a href="Product.php?id=<?php echo $results['ID']; ?>"> <?php echo $results['Name'] . ": " . $results['Description']; ?> </a></p>
    <?php endforeach; ?>
<br>
<br>
<br>
    <?php echo "*Not a perfect search system";?>

</div>

</body>
</html>
