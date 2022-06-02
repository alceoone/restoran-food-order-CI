<?php
   session_start();
   if(isset($_SESSION['username'])) {
   header('location:index.php'); }
   include_once("dbconfig/config.php");

?>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Login + Hak Akses (PHP)</title>

    <!-- Load File CSS Bootstrap  -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="bootstrap/assetex/color.css">
    <link rel="stylesheet" href="bootstrap/fontawesome/css/all.min.css">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <style>
    body {
        padding-top: 40px;
        padding-bottom: 40px;
        background-color: #eee;
    }

    .form-signin {
        max-width: 380px;
		padding: 15px 35px 45px;
		margin: 0 auto;
		background-color: #fff;
		border: 1px solid rgba(0,0,0,0.1); 
    }
    .form-signin .form-signin-heading{
        margin-bottom: 60px;
		
    }
    .form-signin .form-control {
        position: relative;
        height: auto;
        -webkit-box-sizing: border-box;
        -moz-box-sizing: border-box;
        box-sizing: border-box;
        padding: 10px;
        font-size: 16px;
    }
    .form-signin .form-control:focus {
        z-index: 2;
    }
    h3{
      margin:0 auto;
    }
    </style>
</head>
<body>
<div class="wrapper">
        <div class="form-signin">
            <center><h3 class="form-signin-heading text-oren">LOGIN</h3></center>
  <form action="proseslogin.php" method="post">
  <div class="form-group">
					<input type="text" class="form-control" name="username" placeholder="Username" >
					</div>
					<div class="form-group">
					<input type="password" class="form-control" name="password" placeholder="Password" >
					</div>
					<button class="btn btn-lg bg-oren text-white btn-block" value="Login" type="submit">Sign in</button>
  </form>
  </div>
    </div>
    </div>
    </div>
</body>
</html>			
			
