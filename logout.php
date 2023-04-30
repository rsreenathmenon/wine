<?php
session_start();

include_once('custom/access_settings.php');

// remove all session variables
session_unset();

// destroy the session
session_destroy();

$newURL = HTTP_SERVER."index.php";
	header('Location: '.$newURL);
	die();
?>