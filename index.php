<?php
session_start();

include_once('custom/access_settings.php');

if(!($_SESSION['user']))
{
	$newURL = HTTP_SERVER."login.php";
	header('Location: '.$newURL);
	die();
}
else
{
	$newURL = HTTP_SERVER."customers.php";
	header('Location: '.$newURL);
	die();
}

?>