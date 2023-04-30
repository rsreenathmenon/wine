<?php

include_once('../custom/globals-without-login.php');


$result_array 	= array();
#$result_array['server'] 	 		= $_SERVER;
// $result_array['server_extension'] 	= "_________________________________________________________________________________________";
// $result_array['request']  	 		= $_REQUEST;
// $result_array['request_extension'] 	= "_________________________________________________________________________________________";
$result_array['post']  	 	 		= $_POST;
$result_array['post_extension'] 	= "_________________________________________________________________________________________";
$result_array['get']  	 	 		= $_GET;
$result_array['pos_extension'] 	= "_________________________________________________________________________________________";



if($json = json_decode(file_get_contents("php://input"), true)) {
      print_r($json);
      $data = $json;
      $returnString = "json";
  } else {
      print_r($_POST);
      $data = $_POST;
      $returnString = "array";
  }


$result_array['post_val']  = $data['eventname'];

if($data['eventname'] == "\\core\\event\\user_enrolment_created")
{
    $result_array['post_val_added']  =  "Yes";
}
else
{
    $result_array['post_val_added']  =  "No";
}

if($data['eventname'] == "\\core\\event\\user_enrolment_updated")
{
    $result_array['post_val_updated']  =  "Yes";
}
else
{
    $result_array['post_val_updated']  =  "No";
}

if($data['eventname'] == "\\core\\event\\user_enrolment_deleted")
{
    $result_array['post_val_deleted']  =  "Yes";
}
else
{
    $result_array['post_val_deleted']  =  "No";
}
//$result_array['post_val']  = $json_details_check;


$strTo = "avron@rubaywines.com";
$strTo = "rsreenathmenon@gmail.com";
$strSubject = "Call to API";
$message = json_encode($result_array);

SendGridSentEmail($strTo,$strSubject,$message);


function isJson($string) {
   json_decode($string);
   return json_last_error() === JSON_ERROR_NONE;
}
			
?>