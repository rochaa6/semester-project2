<!DOCTYPE html>
<html>
<head>
    <meta charset = "utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <!--<link href="css/styles.css" rel="stylesheet" type="text/css" /> -->
    <style>
        body {
            margin: 0;
        }
        .logo {
            float: left;
            }
        .topnav {
          list-style-type: none;
          margin: 0;
          padding: 0;
          overflow: hidden;
          background-color: white;
          position: fixed;
          top: 0;
          width: 100%;
          height: 70px;
        z-index: 1;
        }
        
        .topnav a:hover {
          text-decoration: underline;
          color: black;
          height: 70px;
        }

        .topnav a.active {
          background-color: #66b3ff;
          color: white;
          height: 70px;
        }

        .top-nav-2 {
          float: right;
        }

        .top-nav-2 a {
          display: block;
          color: black;
          text-align: center;
          padding: 40px 14px 0px 10px;
          text-decoration: none;
          font-weight: 500;
        } 
        * {
          box-sizing: border-box;
        }

        /* Create three equal columns that floats next to each other */
        .column {
          float: left;
          width: 33%;
          padding: 20px; 
          margin-top: -5px;
          height: 400px; /* needs to be removed. Only for demonstration */
        }
        .column1 {
          float: left;
          width: 40%; 
          height: 400px; /* needs to be removed. Only for demonstration */
          margin-top: 20px;
        }
        .column2 {
          float: left;
          width: 60%; 
          height: 400px; /* needs to be removed. Only for demonstration */
          margin-top: 20px;
        }

        /* Clear floats after the columns */
        .row:after {
          content: "";
          display: table;
          clear: both;
        }
        
        .about-us{
          content: "";
          display: table;
          clear: both;
        }
        .copyright {
            text-align: center;
        }
        .footer-basic {
          padding:40px 0;
          background-color:#ffffff;
          color:#4b4c4d;
        }

        .footer-basic ul {
          padding:0;
          list-style:none;
          text-align:center;
          font-size:18px;
          line-height:1.6;
          margin-bottom:0;
        }

        .footer-basic li {
          padding:0 10px;
        }

        .footer-basic ul a {
          color:inherit;
          text-decoration:none;
          opacity:0.8;
        }

        .footer-basic ul a:hover {
          opacity:1;
        }

        .footer-basic .social {
          text-align:center;
          padding-bottom:25px;
        }

        .footer-basic .social > a {
          font-size:24px;
          width:40px;
          height:40px;
          line-height:40px;
          display:inline-block;
          text-align:center;
          border-radius:50%;
          border:1px solid #ccc;
          margin:0 8px;
          color:inherit;
          opacity:0.75;
        }

        .footer-basic .social > a:hover {
          opacity:0.9;
        }

        .footer-basic .copyright {
          margin-top:15px;
          text-align:center;
          font-size:13px;
          color:#aaa;
          margin-bottom:0;
        }
        .centered {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-size: 2.5em;
}
        button:hover {
            color: #66b3ff ;
        }
        /* Responsive layout - makes the three columns stack on top of each other instead of next to each other */
        @media screen and (max-width: 600px) {
          .column {
            width: 100%;
          }
        }
    </style>
</head>
<body>

       <ul class="topnav">
        <a href= "welcome.php"><img src = "imgs/pharma_logo_prototype_5.jpg" alt="Pharma logo" class="logo" style="width:150px;height:70px; margin-top: -1px"></a>
        <li class="top-nav-2"><a href="">Create Account</a>
        </li>
        <li class="top-nav-2"><a href="">Login</a>
        </li>
        <li class="top-nav-2"><a href="">Decongestant</a>
        </li>
        <li class="top-nav-2"><a href="">Headache</a>
        </li>
        <li class="top-nav-2"><a href="">General</a>
        </li>
        <li class="top-nav-2"><a href="" class="active">Home</a>
        </li>
    </ul> 
    <div>
        <img src="imgs/home_.gif" style="width: 100%">
        <div class="centered" style="">Welcome to Pharma!<br><br>
            <a href="welcome.php"><button style="cursor: pointer; transform: translate(40%, 40%);">Shop Now</button></a></div>
    </div> 
    <div class="row">
          <div class="column" style="background-color:#b3d9ff">
            <h2>Column 1</h2>
            <p>Some text..</p>
          </div>
          <div class="column" style="background-color:#99ccff;">
            <h2>Column 2</h2>
            <p>Some text..</p>
          </div>
          <div class="column" style="background-color:#80bfff;">
            <h2>Column 3</h2>
            <p>Some text..</p>
          </div>
    </div>
    <div class="about-us">
        <div class="column1"><img src="imgs/about-us.png" style="width:80%; border-radius: 50%;height: 300px; position: relative;"></div>
        <div class="column2">dkfjskhfkshdfkjsdhfkjshfjhskjfhksjhfkshfkjhskf<br>hkshfkjshkfhskfhkshfkshdkfhskhfkshfkshkdfhskfhkjshfkhskjfhkjshf<br>kshfkhskjdfhkshdfkjshfkjshdkfjjdkshkfjdkfjskhfkshdfkjsdhfkjshfjhskjfhksjhfkshfkjhskf<br>hkshfkjshkfhskfhkshfkshdkfhskhfkshfkshkdfhskfhkjshfkhskjfhkjshf<br>kshfkhskjdfhkshdfkjshfkjshdkfjjdkshkfjdkfjskhfkshdfkjsdhfkjshfjhskjfhksjhfkshfkjhskf<br>hkshfkjshkfhskfhkshfkshdkfhskhfkshfkshkdfhskfhkjshfkhskjfhkjshf<br>kshfkhskjdfhkshdfkjshfkjshdkfjjdkshkfjdkfjskhfkshdfkjsdhfkjshfjhskjfhksjhfkshfkjhskf<br>hkshfkjshkfhskfhkshfkshdkfhskhfkshfkshkdfhskfhkjshfkhskjfhkjshf<br>kshfkhskjdfhkshdfkjshfkjshdkfjjdkshkfjdkfjskhfkshdfkjsdhfkjshfjhskjfhksjhfkshfkjhskf<br>hkshfkjshkfhskfhkshfkshdkfhskhfkshfkshkdfhskfhkjshfkhskjfhkjshf<br>kshfkhskjdfhkshdfkjshfkjshdkfjjdkshkfjdkfjskhfkshdfkjsdhfkjshfjhskjfhksjhfkshfkjhskf<br>hkshfkjshkfhskfhkshfkshdkfhskhfkshfkshkdfhskfhkjshfkhskjfhkjshf<br>kshfkhskjdfhkshdfkjshfkjshdkfjjdkshkfj</div>
      <!--  <img src="jarofhearts.gif" style="width:20%;border-radius: 50%;height: 200px; margin-top: 100px;"> -->
    </div>
    <div class="footer-basic">
        <footer>
                <hr style="height: 20px">
            <div class="social"><a href="#"><i class="icon ion-social-instagram"></i></a><a href="#"><i class="icon ion-social-snapchat"></i></a><a href="#"><i class="icon ion-social-twitter"></i></a><a href="#"><i class="icon ion-social-facebook"></i></a></div>
            <ul class="list-inline">
                <li class="list-inline-item"><a href="#">Home</a></li>
                <li class="list-inline-item"><a href="#">General</a></li>
                <li class="list-inline-item"><a href="#">Headache</a></li>
                <li class="list-inline-item"><a href="#">Decongestant</a></li>
                <li class="list-inline-item"><a href="#">Create Account</a></li>
            </ul>
            <p class = "copyright"> &copy; <?php echo date("Y"); ?> Pharma, Inc.</p>
        </footer>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/js/bootstrap.bundle.min.js"></script>
    </body>
</html>