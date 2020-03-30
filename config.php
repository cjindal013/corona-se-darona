<?php
session_start();
error_reporting(0);

function take_user_to_codechef_permissions_page() {
$params = array('response_type'=>'code', 
                'client_id'=> $_SESSION['config']['client_id'], 
                'redirect_uri'=> $_SESSION['config']['redirect_uri'], 
                'state'=> 'xyz');
    header('Location: ' . $_SESSION['config']['authorization_code_endpoint'] . '?' . 
        http_build_query($params));
    die();
}

function generate_access_token_first_time() {
    $oauth_config = array('grant_type' => 'authorization_code', 
                          'code'=> $_SESSION['oauth_details']['authorization_code'], 
                          'client_id' => $_SESSION['config']['client_id'],
                          'client_secret' => $_SESSION['config']['client_secret'], 
                          'redirect_uri'=> $_SESSION['config']['redirect_uri']);

    $response = json_decode(make_curl_request($_SESSION['config']['access_token_endpoint'], 
        $oauth_config), true);
    $result = $response['result']['data'];

    $_SESSION['oauth_details']['access_token'] = $result['access_token'];
    $_SESSION['oauth_details']['refresh_token'] = $result['refresh_token'];
    $_SESSION['oauth_details']['scope'] = $result['scope'];
}

function generate_access_token_from_refresh_token() {
    $oauth_config = array('grant_type' => 'refresh_token', 
        'refresh_token'=> $_SESSION['oauth_details']['refresh_token'], 
        'client_id' => $_SESSION['config']['client_id'],
        'client_secret' => $_SESSION['config']['client_secret']);
    $response = json_decode(make_curl_request($_SESSION['config']['access_token_endpoint'], 
        $oauth_config), true);
    $result = $response['result']['data'];

    $_SESSION['oauth_details']['access_token'] = $result['access_token'];
    $_SESSION['oauth_details']['refresh_token'] = $result['refresh_token'];
    $_SESSION['oauth_details']['scope'] = $result['scope'];
}

function make_curl_request($url, $post = FALSE, $headers = array()) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $headers[] = 'content-Type: application/json';
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    if ($post) {
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($post));
    }
    $response = curl_exec($ch);
    return $response;
}

function make_api_request($path, $post = FALSE) {
    $headers[] = 'Authorization: Bearer ' . $_SESSION['oauth_details']['access_token'];
    if($post)
    return make_curl_request($path, $post, $headers);
    else
    return make_curl_request($path, false, $headers);
}

function make_contests_list__api_request() {
    $path = $_SESSION['config']['api_endpoint']."contests";
    $response = make_api_request($path, false);
    return $response;
}

function make_contest_api_request($contest_code) {
    $path = $_SESSION['config']['api_endpoint']."contests/".$contest_code;
    $response = make_api_request($path, false);
    return $response;
}

function make_contest_problem_api_request($contest_code, $problem_code) {
    $path = $_SESSION['config']['api_endpoint']."contests/".$contest_code."/problems/".$problem_code;
    $response = make_api_request($path, false);
    return $response;
}

function make_contest_leaderboard_api_request($contest_code) {
    $path = $_SESSION['config']['api_endpoint']."rankings/".$contest_code;
    $response = make_api_request($path, false);
    return $response;
}

function make_recent_submissions_api_request($url) {
    $path = $_SESSION['config']['api_endpoint']."submissions/?".$url;
    $response = make_api_request($path, false);
    return $response;
}

function make_loggedin_user_details_api_request() {
    $path = $_SESSION['config']['api_endpoint']."users/me";
    $response = make_api_request($path, false);
    return $response;
}

function make_ide_run_api_request($code) {
    $path = $_SESSION['config']['api_endpoint']."ide/run/";
    $response = make_api_request($path, $code);
    return $response;
}

function make_ide_status_api_request($link) {
    $path = $_SESSION['config']['api_endpoint']."ide/status?link=".$link;
    $response = make_api_request($path, false);
    return $response;
}

function make_languages_api_request() {
    $path = $_SESSION['config']['api_endpoint']."language?limit=100";
    $response = make_api_request($path, $code);
    return $response;
}

?>