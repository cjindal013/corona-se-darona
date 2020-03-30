<?php
session_start();
error_reporting(0);
include('config.php');
if(isset($_GET['contest'])) {
    $contest_code = $_GET['contest'];
    $response = make_contest_api_request($contest_code);
    $result = json_decode($response);
    $info = $result->result->data->content;
    $problems = $result->result->data->content->problemsList;
    $url = "contestCode=".$contest_code;
    $submit = json_decode(make_recent_submissions_api_request($url));
    $submit = $submit->result->data->content;
}
?>

<html>
<head>
  <meta charset="utf-8">
  <title>Contest</title>
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
  <div class="row twelve columns">
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
  <div class = "eight columns">
    <div class = "row twelve columns">
      <h2 style="text-align: center;"><?php echo $info->code;?></h2>
      <h2 style="text-align: center;"><?php echo $info->name;?></h2>
    </div>
    <div class = "row twelve columns">
      <table>

        <tr>
          <th> Problem Code </th>
          <th> Successful Submissions </th>
          <th> Accuracy </th>
          <th> Link To The Problem </th>
        </tr>
        <?php foreach($problems as $problem) { ?> 
          <tr>
            <td> <?php echo $problem->problemCode; ?> </td>
            <td> <?php echo $problem->successfulSubmissions; ?> </td>
            <td> <?php echo $problem->accuracy; ?> </td>
            <td> <a href = "./problems.php?contests=<?php echo $contest_code; ?>&problems=<?php echo $problem->problemCode; ?>">Click Here</a> </td>
          </tr>
        <?php } ?>
      </table>
    </div>
    <div class = "row twelve columns">
      <?php echo "Announcements -->" . $info->announcements; ?>
    </div>
  </div>

  <div class = "four columns">
    <div class = "row twelve columns">
      <p id="demo"></p>
    </div>
    <div class = "row" style="text-align: center;">
      <a href = "./leaderboard.php?contests=<?php echo $contest_code; ?>">Go To Contest Ranklist</a>
    </div>
    <div class = "row" style="text-align: center;">
      <h2>Recent Submisions</h2>
      <table>
        <tr>
          <th> ID </th>
          <th> Date/Time </th>
          <th> UserName </th>
          <th> Problem </th>
          <th> Result </th>
          <th> Time </th>
          <th> Memory </th>
          <th> Language </th>
        </tr>
        <?php foreach($submit as $user) { ?> 
          <tr>
            <td> <?php echo $user->id; ?> </td>
            <td> <?php echo $user->date; ?> </td>
            <td> <?php echo $user->username; ?> </td>
            <td> <?php echo $user->problemCode; ?> </td>
            <td> <?php echo $user->result; ?> </td>
            <td> <?php echo $user->time; ?> </td>
            <td> <?php echo $user->memory; ?> </td>
            <td> <?php echo $user->language; ?> </td>
          </tr>
        <?php } ?>
    </table>
    </div>
  </div>

  <script>
  // Set the date we're counting down to
  var startDate = new Date(<?php echo json_encode($info->startDate); ?>).getTime();
  var endDate = new Date(<?php echo json_encode($info->endDate); ?>).getTime();

  // Update the count down every 1 second
  var x = setInterval(function() {

    // Get today's date and time
    var now = new Date().getTime();
      
    // Find the distance between now and the count down date
    var distance = startDate - now;
    var distance2 = endDate - now;
      
    // If the count down is over, write some text 
    if (distance < 0 && distance2 < 0) {
      clearInterval(x);
      document.getElementById("demo").innerHTML = "Contest Ended";
    } else if (distance < 0 && distance2 >= 0) {
      // Time calculations for days, hours, minutes and seconds
      var days = Math.floor(distance2 / (1000 * 60 * 60 * 24));
      var hours = Math.floor((distance2 % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
      var minutes = Math.floor((distance2 % (1000 * 60 * 60)) / (1000 * 60));
      var seconds = Math.floor((distance2 % (1000 * 60)) / 1000);
        
      // Output the result in an element with id="demo"
      document.getElementById("demo").innerHTML = "Contest Ends in <br>" + days + "d " + hours + "h "
      + minutes + "m " + seconds + "s ";
    } else if (distance >= 0) {
      // Time calculations for days, hours, minutes and seconds
      var days = Math.floor(distance / (1000 * 60 * 60 * 24));
      var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
      var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
      var seconds = Math.floor((distance % (1000 * 60)) / 1000);
        
      // Output the result in an element with id="demo"
      document.getElementById("demo").innerHTML = "Contest Starts in <br>" + days + "d " + hours + "h "
      + minutes + "m " + seconds + "s ";
    }
  }, 1000);
  </script>
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