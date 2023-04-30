<?php
session_start();

include_once('access_settings.php');
include_once('functions.php');

if(!($_SESSION['user']))
{
	$newURL = HTTP_SERVER."index.php";
	header('Location: '.$newURL);
	die();
}
else
{
	$result_array['log_out'] = "0";
}

?>