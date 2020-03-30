<?php
session_start();
error_reporting(0);
include('config.php');
if(isset($_POST['run'])) {
	$code = array('sourceCode' => $_POST['sourceCode'],
				  'language' => $_POST['language'],
				  'input' => $_POST['input']);
	$submit_code = json_decode(make_ide_run_api_request($code));

	$link = $submit_code->result->data->link;
	$code_status = json_decode(make_ide_status_api_request($link));

	$info = $code_status->result->data;
	echo "<br>Input --> ".$info->input;
    echo "<br>Output --> ".$info->output;
    echo "<br>Cmpinfo --> ".$info->cmpinfo;
    echo "<br>Stderr --> ".$info->stderr;
    echo "<br>Time --> ".$info->time;
    echo "<br>Memory --> ".$info->memory;
}
?>