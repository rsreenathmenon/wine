<?php

include_once('../custom/globals-without-login.php');


$arrayGender = array(1 => 'Male', 2 => 'Female', 3 => 'Other');
$arrayMaritalStatus = array(1 => 'Single',  2 => 'Married',  3 => 'Widowed', 4 => 'Divorced', 5 => 'Seperated' );
$arrayEducationLevel = array(1 => 'High School',  2 => 'Diploma / Certificate',  3 => 'Degree', 4 => 'Post Graduate' );

$result_array 	= array();


$result_array['customers_dob'] = $_REQUEST["date-of-birth"];
$result_array['customers_firstname'] = $_REQUEST["first-name"];
$result_array['customers_lastname'] = $_REQUEST["last-name"];
$result_array['customers_email'] = $_REQUEST["email"];
$result_array['customers_phone'] = $_REQUEST["mobile"];
$result_array['customers_address1'] = $_REQUEST["shipping-line-1-street"];
$result_array['customers_address2'] = $_REQUEST["shipping-line-2"];
$result_array['customers_suburb'] = $_REQUEST["shipping-suburb"];
$result_array['customers_postcode'] = $_REQUEST["shipping-postcode"];

$country_ref = getCountryRef($_REQUEST["shipping-country"]);
//$state_ref = getStateRef($state_name,$country_ref);
$state_ref = getStateRef($_REQUEST["shipping-state"],$country_ref);

$key = array_search($_REQUEST["gender"], $arrayGender);
if (false !== $key)
{
	$customers_sex = $key;
}
else
{
	$customers_sex = "0";
}

$key = array_search($_REQUEST["edu-level"], $arrayEducationLevel);
if (false !== $key)
{
	$customers_educationlevel = $key;
}
else
{
	$customers_educationlevel = "0";
}

$key = array_search($_REQUEST["martial-state"], $arrayMaritalStatus);
if (false !== $key)
{
	$customers_maritalstatus = $key;
}
else
{
	$customers_maritalstatus = "0";
}

$result_array['customers_states_ref'] = $state_ref;
$result_array['customers_country_ref'] = $country_ref;
$result_array['customers_sex'] = $customers_sex;
$result_array['customers_educationlevel'] = $customers_educationlevel;
$result_array['customers_maritalstatus'] = $customers_maritalstatus;

$result_array['customers_over_18'] = $_REQUEST["over-18"];
$result_array['customers_confirm_give_feedback'] = $_REQUEST["confirm-give-feedback"];
$result_array['customers_fav_wine_1'] = $_REQUEST["fav-wine-1"];
$result_array['customers_fav_wine_2'] = $_REQUEST["fav-wine-2"];
$result_array['customers_least_fav_wine'] = $_REQUEST["least-fav-wine"];
$result_array['customers_avg_sp_per_bot_wine'] = $_REQUEST["avg-spend-per-bottle-wine"];
$result_array['customers_fav_wine_region'] = $_REQUEST["fav-wine-region"];
$result_array['customers_normally_buy_wine'] = $_REQUEST["normally-buy-wine"];
$result_array['customers_member_wine_club'] = $_REQUEST["member-wine-club"];
$result_array['customers_last_winery_visit'] = $_REQUEST["last-winery-visit"];
$result_array['customers_occas_drink_before_wine'] = $_REQUEST["occasionally-drink-before-wine"];

$result_array['customers_glasses_a_week'] = $_REQUEST["glasses-a-week"];


$result_array['customers_ethnicity'] = $_REQUEST["ethnicity"];
$result_array['customers_wine_varietal'] = $_REQUEST["wine-varietal"];

$result_array['customers_product'] = $_REQUEST["product"];
$result_array['customers_company'] = $_REQUEST["company"];
$result_array['customers_cohort'] = $_REQUEST["cohort"];
$result_array['customers_enrollment'] = $_REQUEST["enrollment"];


$result_array['customers_ref'] = getCustomersRef($result_array['customers_email']);

{


	// Handle form fields which have been serialized
	$temp_array = array();

	foreach($result_array as $input_name=>$input_value)
	{
		if($input_name != 'customers_ref' && strpos($input_name,'customers')===0)
		{
			$temp_array[] = "\t\t".mysql_real_escape_string_function($input_name)."=:".$input_name."";
			$pdo_addition[":".$input_name] = mysql_real_escape_string_function(strip_tags(trim($input_value), '<p><font><span><div><ul><li><br><table><thead><tbody><th><tr><td>'));
		}
	}

	$query_input = implode(",\n",$temp_array);
	
	{
		
		$pdo_addition[':customers_modified'] = date('Y-m-d H:i:s');
		$pdo_addition[':customers_ref'] = $result_array['customers_ref'];

		// Update Submitted Form Fields
		try
		{
			$query = 	"UPDATE 
						customers 
						SET
						customers_modified	= :customers_modified,
						".$query_input."
						WHERE
						customers_ref			= :customers_ref";			
			$sth = $PDO_WRITE->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));

			$sth->execute($pdo_addition);
		}
		catch(PDOException $e)
		{
			echo "Error: ".__LINE__. $e->getMessage();
		}	
	}

	echo $result_array['customers_ref'];
		
}
			
?>