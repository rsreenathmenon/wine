<?php

include_once('../custom/globals-without-login.php');


$result_array 	= array();
#$result_array['server'] 	 			= $_SERVER;
$result_array['server_extension'] 	 	= "_________________________________________________________________________________________";
$result_array['request']  	 = $_REQUEST;
$result_array['request_extension'] 	 	= "_________________________________________________________________________________________";
$result_array['post']  	 	 = $_POST;
$result_array['post_extension'] 	 	= "_________________________________________________________________________________________";
$result_array['get']  	 	 = $_GET;


$strTo = "avron@rubaywines.com";
$strSubject = "Call to API of RubayWines";
$message = json_encode($result_array);

SendGridSentEmail($strTo,$strSubject,$message);
			
?>