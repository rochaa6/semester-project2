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
  h3 {
    font-size:40px;
    text-align:center;
  }

table {
    width: 100%;
  border-collapse: collapse;
    table-layout: fixed;
}

td {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: aliceblue;
}
</style>

</head>
<body>

<?php
    $page = "admin";
    include "new_navfile.php";
    $user_id = $_SESSION['userId'];
?>


        <div class="text-block" style="font-size: 3.5em; padding-top:7%">Admin - View Users Page</div>

    <br>

    <?php
        $getusers = "SELECT id, username, email, created_at, User_Type FROM users; ";
        $result = mysqli_query($db, $getusers);
        $users = array();
        while($row = $result->fetch_array() )
        {
            array_push($users,$row);
        }

    ?>
<div class="container">
    <?php foreach ($users as $user): ?>
      <table>
        <tr>
          <td>ID#</td>
          <td>Username</td>
          <td>Email</td>
          <td>Date Created</td>
          <td>User Type</td>
          <td></td>
          <br>
        </tr>
          <tr>
        <td><?php echo $user[0];?></td>
          <td><?php echo $user[1]; ?></td>
          <td><?php echo $user[2]; ?></td>
          <td><?php echo $user[3]; ?></td>
          <td><?php echo $user[4]; ?></td>
          <td><a href="View_User_Details.php?userid=<?php echo $user[0];?>&amp; username=<?php echo $user[1]; ?>&amp; type=<?php echo $user[4];?>"><?php echo "User Details"; ?> </a></td>
          </tr>
      </table>
    <?php endforeach; ?>
    <br>
    <button onclick="document.location='Admin.php'" style="background-color: orange; padding: 10px;">Go Back</button><br>
  </div>




</body>
    <?php include "footer.php"; ?>
</html>
