<?php
session_start();
error_reporting(0);
include('config.php');
if(isset($_GET['contests']) && isset($_GET['problems'])) {
	$contest_code = $_GET['contests'];
	$problem_code = $_GET['problems'];
	$url = "result=AC&contestCode=".$contest_code."&problemCode=".$problem_code;
	$submit = json_decode(make_recent_submissions_api_request($url));
	$submit = $submit->result->data->content;
	$response = json_decode(make_contest_problem_api_request($contest_code, $problem_code));
	$info = $response->result->data->content;
} 
?>
<html>
<head>
  <meta charset="utf-8">
  <title>Problem</title>
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
	<div class="eight columns">
		<h2 style="text-align: center;"><?php echo $info->problemName;?></h2>
		<h2 style="text-align: center;"><?php echo $info->problemCode;?></h2>
		<p><?php echo $info->body;?></p>
	<div class="box">
		<p>Date Added --> <?php echo $info->dateAdded;?></p>
		<p>Source Size Limit --> <?php echo $info->sourceSizeLimit;?></p>
		<p>Max Time Limit --> <?php echo $info->maxTimeLimit;?></p>
		<p>Author --> <?php echo $info->author;?></p>
	</div>
	</div>
	<div class="four columns">
		<h2 style="text-align: center;">IDE</h2>
		<div class="box">
		<form action = "./run_result.php", method= "post">
        <input type = "text" placeholder = "Source Code" name = "sourceCode">
        <select name = "language">
        	<option value = ""> Choose a language </option>
        	<?php
        	$languages = make_languages_api_request();
        	$languages = json_decode($languages);
        	$languages = $languages->result->data->content;
        	foreach($languages as $language) {
        		?> <option value = "<?php echo $language->shortName; ?>"> <?php echo $language->shortName; ?> 
        		   </option>
        		<?php
        	} ?>
        </select>
        <input type = "text" placeholder = "Input" name = "input">
        <input type = "submit" value = "Run" name = "run">
	</form>
	<button>SUBMIT</button>
</div>
<h2 style="text-align: center;">Successful Submisions</h2>
		<table>
	<tr>
		<th> ID </th>
		<th> Date/Time </th>
		<th> UserName </th>
		<th> Time </th>
		<th> Memory </th>
		<th> Language </th>
	</tr>
	<?php foreach($submit as $user) { ?> 
		<tr>
			<td> <?php echo $user->id; ?> </td>
			<td> <?php echo $user->date; ?> </td>
			<td> <?php echo $user->username; ?> </td>
			<td> <?php echo $user->time; ?> </td>
			<td> <?php echo $user->memory; ?> </td>
			<td> <?php echo $user->language; ?> </td>
		</tr>
	<?php } ?>
	</table>
	</div>
</div>

<footer>
  <div class="container">
      <ul class="social">
      <li class="facebook"><a href="#"><i class="fa fa-facebook-square fa-lg"></i></a></li>
      <li class="twitter"><a href="#"><i class="fa fa-twitter-square fa-lg"></i></a></li>
      <li class="instagram"><a href="#"><i class="fa fa-instagram fa-lg"></i></a></li>
      <li class="linkedin"><a href="#"><i class="fa fa-linkedin-square fa-lg"></i></a></li>
      </ul>
      <p class="copyright">&copy; 2020 Chirag Jindal. All Rights Reserved.</p>
    </div>
</footer>
</body>
</html>
