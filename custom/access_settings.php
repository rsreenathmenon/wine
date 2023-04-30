<?php

// echo $_SERVER["DOCUMENT_ROOT"];

include_once($_SERVER["DOCUMENT_ROOT"].'/../access_settings_rubay.php');

function mysql_real_escape_string_function($checkCondition)
{
	global $mysqli;
	
	$checkCondition = $mysqli->real_escape_string($checkCondition);
	
	return $checkCondition;
}

?>
