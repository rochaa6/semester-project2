<style>
    body {
        margin: 0 ;
    }
</style>

  <nav class="navbar" style="margin-bottom: 0px;">
    <div class="container-fluid" style="background-color: white">
      <div class="navbar-header">
        <a class="" href="Index.php"><img src = "imgs/pharma_logo_prototype_5.jpg" alt="Pharma logo" style="width:100px;height:50px;"></a>
      </div>
      <ul class="nav navbar-nav">
        <li <?php if ($page=="home") { echo 'class="active"';} ?> ><a href="Index.php">Home</a></li>
        <li <?php if ($page=="decongestant") { echo 'class="active"';} ?>><a href="Decongestant.php">Decongestant</a></li>
        <li <?php if ($page=="headache") { echo 'class="active"';} ?>><a href="Headache.php">Headache</a></li>
        <li <?php if ($page=="general") { echo 'class="active"';} ?>><a href="General.php">General</a></li>
      </ul>


      <ul class="nav navbar-nav navbar-right">
          <li>
    		<form class="navbar-form" role="search" action="Search.php" method="GET">
    		<div class="input-group">
    			<input type="text" class="form-control" placeholder="Search" name="search" id="search">
    			<div class="input-group-btn">
    				<button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
    			</div>
    		</div>
    		</form>
           </li> 
          <?php
                
        //if User_Type is Admin, show special link to admin page
        $user_id = $_SESSION['userId'];
        $usertype = "SELECT User_Type FROM users WHERE id = '$user_id'; ";        
        $result = mysqli_query($db, $usertype);
        $row = mysqli_fetch_row($result);
    
        $user_type = $row[0]; //user type Admin/Customer
          ?>
          
          <!-- If logged in = show logout button in place. Show cart and acount button only if logged in also-->
          <?php if (isset($_SESSION['username']) && $_SESSION['username'] != null):?>
            
            <?php if($user_type == "Admin"): ?>
                <li <?php if ($page=="admin") { echo 'class="active"';} ?>> <a href="Admin.php"><span class="glyphicon glyphicon-gift"></span> Admin</a></li>
            <?php endif; ?>
            
            <li <?php if ($page=="account") { echo 'class="active"';} ?>><a href="Account.php"><span class="glyphicon glyphicon-user"></span> Account</a></li>
            <li <?php if ($page=="login") { echo 'class="active"';} ?>><a href="Logout.php"><span class="glyphicon glyphicon-remove"></span> Logout</a></li>
            <li <?php if ($page=="cart") { echo 'class="active"';} ?>><a href="Cart.php"><span class="glyphicon glyphicon-shopping-cart"></span> Cart</a></li>
            
            
          <?php else: ?> <!-- nav shows login button and create account if not logged in--> 
            <li <?php if ($page=="login") { echo 'class="active"';} ?>><a href="Login.php"><span class="glyphicon glyphicon-ok"></span> Login</a></li>
            <li <?php if ($page=="add_account") { echo 'class="active"';} ?>><a href="Add_Account.php"><span class="glyphicon glyphicon-plus"></span> Create Account</a></li>
          <?php endif; ?>

      </ul>
      
    </div>
  </nav>