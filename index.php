<?php
session_start();
session_unset();
session_destroy();
?>

<!DOCTYPE html>
<html lang="en">
<head>

  <!-- Basic Page Needs
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
  <meta charset="utf-8">
  <title>Contest Arena</title>
  <meta name="description" content="Contest Arena for participating in contest">
  <meta name="author" content="Chirag Jindal">

  <!-- Mobile Specific Metas
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  <!-- FONT
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
  <link href='http://fonts.googleapis.com/css?family=Abel' rel='stylesheet' type='text/css'>
  <link href='http://fonts.googleapis.com/css?family=Satisfy' rel='stylesheet' type='text/css'>
  
   <!-- CSS
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" href="assets/css/skeleton.css">
  <link rel="stylesheet" href="assets/fonts/font-awesome/css/font-awesome.min.css">

   <!-- Scripts
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->  
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    
  <!-- Favicon
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
  <link rel="icon" type="image/png" href="assets/images/favicon.png">

</head>
<body>
<header class="main_nav green">
  <div class="container">
    <div class="twelve columns">
      <div class = "logo"><a href="#">Corona Se Darona</a></div>
    </div>
  </div>
</header>

<div class="container main">
  <div class = "row twelve columns">
    <h2 class="bio">Login into the Contest Arena</h2>
    <p class="bio"><a href = "login.php"> Login With CodeChef </a></p>
  </div>
</div>

<footer>
  <div class="container">
    <div class="row twelve columns">
      <ul class="social">
      <li class="facebook"><a href="#"><i class="fa fa-facebook-square fa-lg"></i></a></li>
      <li class="twitter"><a href="#"><i class="fa fa-twitter-square fa-lg"></i></a></li>
      <li class="instagram"><a href="#"><i class="fa fa-instagram fa-lg"></i></a></li>
      <li class="linkedin"><a href="#"><i class="fa fa-linkedin-square fa-lg"></i></a></li>
      </ul>
      <p class="copyright">&copy; 2020 Chirag Jindal. All Rights Reserved.</p>
    </div>
  </div>
</footer>

</body>
</html>