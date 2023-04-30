
<code>
<pre>
$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'http://platform.rubaywines.com/api/api-get-customers-details.php?email=lubos@dorefresh.com.au&selection=mydetails,myscore,mymysteryscore,mycourses',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
  CURLOPT_HTTPHEADER => array(
    'Authorization: Basic cnViYXl3aW5lczpHUGpzT2YhT1BqaipobF5ySkU1MWohMUM=',
    'Cookie: PHPSESSID=e82chrpddgm5ln3o44mvnd9iqp'
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

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'http://platform.rubaywines.com/api/api-get-customers-details.php?email=lubos@dorefresh.com.au&selection=mydetails,myscore,mymysteryscore,mycourses',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
  CURLOPT_HTTPHEADER => array(
    'Authorization: Basic cnViYXl3aW5lczpHUGpzT2YhT1BqaipobF5ySkU1MWohMUM=',
    'Cookie: PHPSESSID=e82chrpddgm5ln3o44mvnd9iqp'
  ),
));

$response = curl_exec($curl);

curl_close($curl);
$result = json_decode($response);

echo "<PRE>";
print_r($result);


?>