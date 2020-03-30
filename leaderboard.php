<?php
session_start();
error_reporting(0);
include('config.php');
if(isset($_GET['contests'])) {
	$contest_code = $_GET['contests'];
	$ranklist = json_decode(make_contest_leaderboard_api_request($contest_code));
	$ranklist = $ranklist->result->data->content;
}
?>

<html>
<head>
  <meta charset="utf-8">
  <title>Leaderboard</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
	<div class = "row">
  <div class = "six columns top box">
      <a href = "./dashboard.php"> Search Another Contest </a>
  </div>
  <div class = "six columns top box">
      <a href = "./index.php"> Logout </a>
  </div>
</div>
</div>
</header>

<div class="container main">
	<h2 class="bio">Contest Ranklist</h2>
	<table style="float:center">
		<tr>
			<th> Rank </th>
			<th> Country </th>
			<th> UserName </th>
			<th> Score </th>
			<th> Total Penalty </th>
		</tr>
		<?php foreach($ranklist as $user) { ?> 
			<tr>
				<td> <?php echo $user->rank; ?> </td>
				<td> <?php echo $user->country; ?> </td>
				<td> <?php echo $user->username; ?> </td>
				<td> <?php echo $user->totalScore; ?>-(<?php echo $user->penalty; ?>) </td>
				<td> <?php echo $user->totalTime; ?> </td>
			</tr>
		<?php } ?>
	</table>
</div>
</body>
</html>