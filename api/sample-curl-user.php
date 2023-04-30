
<code>
<pre>

$USER_ID = '32';
$API_KEY = 'Ke42zHuNjxzo9DiJiJhhFLemrsLBXvdeYdhkiDtB4vxxuEQzqNMyKy9MR6';

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://www.sip-and-learn.com/wp-json/rubay-platform/v1/user/'.$USER_ID.'?api_key='.$API_KEY,
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_SSL_VERIFYPEER => false,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
  CURLOPT_HTTPHEADER => array(
    'Cookie: PHPSESSID=hf83h2bfjob2h6p1u9bau0ce2k'
  ),
));

$response = curl_exec($curl);

curl_close($curl);
$result = json_decode($response);

echo "&lt;PRE&gt;";
print_r($result);
</pre>
</code>

***********************************************************************************************************************************************************************

<?php

$USER_ID = '32';
$API_KEY = 'Ke42zHuNjxzo9DiJiJhhFLemrsLBXvdeYdhkiDtB4vxxuEQzqNMyKy9MR6';

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://www.sip-and-learn.com/wp-json/rubay-platform/v1/user/'.$USER_ID.'?api_key='.$API_KEY,
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_SSL_VERIFYPEER => false,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
  
));

$response = curl_exec($curl);
$result = json_decode($response);

curl_close($curl);

if($result->user_email)
{
  $user_email = $result->user_email;
}
else
{
  $user_email = "";
}

echo $user_email;
die();


echo "<PRE>";
print_r($result);

?>