<?php
session_start();
error_reporting(0);
include('config.php');

$_SESSION['config'] = array();
$_SESSION['config']['client_id'] = '1353d8ce04ac234b13ea17769058a6b7';
$_SESSION['config']['client_secret'] = 'f749144deeb15f23974fc28f1efa878c';
$_SESSION['config']['api_endpoint'] = 'https://api.codechef.com/';
$_SESSION['config']['authorization_code_endpoint'] = 'https://api.codechef.com/oauth/authorize';
$_SESSION['config']['access_token_endpoint'] = 'https://api.codechef.com/oauth/token';
$_SESSION['config']['redirect_uri'] = 'https://corona-se-darona.herokuapp.com/dashboard.php';
$_SESSION['config']['website_base_url'] = 'https://corona-se-darona.herokuapp.com/index.html';

$_SESSION['oauth_details'] = array();
$_SESSION['oauth_details']['authorization_code'] = '';
$_SESSION['oauth_details']['access_token'] = '';
$_SESSION['oauth_details']['refresh_token'] = '';
$_SESSION['oauth_details']['scope'] = '';

take_user_to_codechef_permissions_page();

?>
