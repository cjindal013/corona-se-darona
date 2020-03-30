<?php
session_start();
error_reporting(0);
include('config.php');

if(isset($_SESSION['username']) || isset($_GET['code'])) {
  if($_SESSION['oauth_details']['authorization_code'] == '') {
    $_SESSION['oauth_details']['authorization_code'] = $_GET['code'];
    generate_access_token_first_time();
    generate_access_token_from_refresh_token();
    $details = json_decode(make_loggedin_user_details_api_request());
    $details = $details->result->data->content;
    $_SESSION['username'] = $details->username;
  }
    $contest_lists = json_decode(make_contests_list__api_request());
    $contest_lists = $contest_lists->result->data->content->contestList;
    $final_list = array();
    foreach($contest_lists as $contest_list) {
        array_push($final_list, $contest_list->code);
    }
?>

<html>
<head>
  <meta charset="utf-8">
  <title>Dashboard</title>
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
  <!-- <form autocomplete="off" action = "./contests.php", method= "post"> -->
    <div class = "row">
      <div class = "four columns">
      <div class="autocomplete" style="width:300px;">
        <input id="myInput" type="text" name="contest" placeholder="Search Contest By Code">
      </div>
    </div>
    <div class = "four columns">
      <button type ="button" onclick="myButton()"> Fetch Contest Details </button>
      <script>
        function myButton() {
          var inputVal = document.getElementById("myInput").value;
          var url = "./contests.php?contest=";
          var res = url.concat(inputVal);
          window.open(res, '_blank')
        // location.replace(res)
}
      </script>
      <!-- <input type = "submit" name = "submit"> -->
    </div>
    </div>
  <!-- </form> -->
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

  <script>
  function autocomplete(inp, arr) {
    /*the autocomplete function takes two arguments,
    the text field element and an array of possible autocompleted values:*/
    var currentFocus;
    /*execute a function when someone writes in the text field:*/
    inp.addEventListener("input", function(e) {
        var a, b, i, val = this.value;
        /*close any already open lists of autocompleted values*/
        closeAllLists();
        if (!val) { return false;}
        currentFocus = -1;
        /*create a DIV element that will contain the items (values):*/
        a = document.createElement("DIV");
        a.setAttribute("id", this.id + "autocomplete-list");
        a.setAttribute("class", "autocomplete-items");
        /*append the DIV element as a child of the autocomplete container:*/
        this.parentNode.appendChild(a);
        /*for each item in the array...*/
        for (i = 0; i < arr.length; i++) {
          /*check if the item starts with the same letters as the text field value:*/
          if (arr[i].substr(0, val.length).toUpperCase() == val.toUpperCase()) {
            /*create a DIV element for each matching element:*/
            b = document.createElement("DIV");
            /*make the matching letters bold:*/
            b.innerHTML = "<strong>" + arr[i].substr(0, val.length) + "</strong>";
            b.innerHTML += arr[i].substr(val.length);
            /*insert a input field that will hold the current array item's value:*/
            b.innerHTML += "<input type='hidden' value='" + arr[i] + "'>";
            /*execute a function when someone clicks on the item value (DIV element):*/
            b.addEventListener("click", function(e) {
                /*insert the value for the autocomplete text field:*/
                inp.value = this.getElementsByTagName("input")[0].value;
                /*close the list of autocompleted values,
                (or any other open lists of autocompleted values:*/
                closeAllLists();
            });
            a.appendChild(b);
          }
        }
    });
    /*execute a function presses a key on the keyboard:*/
    inp.addEventListener("keydown", function(e) {
        var x = document.getElementById(this.id + "autocomplete-list");
        if (x) x = x.getElementsByTagName("div");
        if (e.keyCode == 40) {
          /*If the arrow DOWN key is pressed,
          increase the currentFocus variable:*/
          currentFocus++;
          /*and and make the current item more visible:*/
          addActive(x);
        } else if (e.keyCode == 38) { //up
          /*If the arrow UP key is pressed,
          decrease the currentFocus variable:*/
          currentFocus--;
          /*and and make the current item more visible:*/
          addActive(x);
        } else if (e.keyCode == 13) {
          /*If the ENTER key is pressed, prevent the form from being submitted,*/
          e.preventDefault();
          if (currentFocus > -1) {
            /*and simulate a click on the "active" item:*/
            if (x) x[currentFocus].click();
          }
        }
    });
    function addActive(x) {
      /*a function to classify an item as "active":*/
      if (!x) return false;
      /*start by removing the "active" class on all items:*/
      removeActive(x);
      if (currentFocus >= x.length) currentFocus = 0;
      if (currentFocus < 0) currentFocus = (x.length - 1);
      /*add class "autocomplete-active":*/
      x[currentFocus].classList.add("autocomplete-active");
    }
    function removeActive(x) {
      /*a function to remove the "active" class from all autocomplete items:*/
      for (var i = 0; i < x.length; i++) {
        x[i].classList.remove("autocomplete-active");
      }
    }
    function closeAllLists(elmnt) {
      /*close all autocomplete lists in the document,
      except the one passed as an argument:*/
      var x = document.getElementsByClassName("autocomplete-items");
      for (var i = 0; i < x.length; i++) {
        if (elmnt != x[i] && elmnt != inp) {
          x[i].parentNode.removeChild(x[i]);
        }
      }
    }
    /*execute a function when someone clicks in the document:*/
    document.addEventListener("click", function (e) {
        closeAllLists(e.target);
    });
  }

  var contest_codes = <?php echo json_encode($final_list)?>;

  /*initiate the autocomplete function on the "myInput" element, and pass along the countries array as possible autocomplete values:*/
  autocomplete(document.getElementById("myInput"), contest_codes);
  </script>
</body>
</html>

<?php
} else {
    header('Location: ./index.php');
}

?>