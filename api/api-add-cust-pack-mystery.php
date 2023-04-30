<?php

include_once('../custom/globals-without-login.php');


$arrayGender = array(1 => 'Male', 2 => 'Female', 3 => 'Other');
$arrayMaritalStatus = array(1 => 'Single',  2 => 'Married',  3 => 'Widowed', 4 => 'Divorced', 5 => 'Seperated' );
$arrayEducationLevel = array(1 => 'High School',  2 => 'Diploma / Certificate',  3 => 'Degree', 4 => 'Post Graduate' );

$result_array 	= array();


$result_array['custpackmystery_name'] = $_REQUEST["Pack"];
$result_array['customers_email'] = $_REQUEST["Email"];

$result_array['custpackmystery_variety'] = $_REQUEST["Variety"];
$result_array['custpackmystery_country'] = $_REQUEST["Country"];
$result_array['custpackmystery_region'] = $_REQUEST["Region"];
$result_array['custpackmystery_vintage'] = $_REQUEST["Vintage"];
$result_array['custpackmystery_price_point'] = $_REQUEST["price-point"];



$result_array['custpackmystery_customer_ref'] = getCustomersRefOnly($result_array['customers_email']);
$result_array['custpackmystery_pack_ref'] = getPacksRefOnly($result_array['custpackmystery_name']);

if($result_array['custpackmystery_customer_ref']!="")
{
	$result_array['custpackmystery_ref'] = random_reference();
	$custpackmystery_ref = $result_array['custpackmystery_ref'];
	try
	{
		$query = 	"INSERT INTO
					custpackmystery
					SET
					custpackmystery_created 	= :custpackmystery_created,
					custpackmystery_ref 		= :custpackmystery_ref";
		
		$sth = $PDO_WRITE->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));

		$sth->execute(array(':custpackmystery_ref' => $custpackmystery_ref,':custpackmystery_created' =>date('Y-m-d H:i:s')));
	}
	catch(PDOException $e)
	{
		echo "Error: " . __LINE__. $e->getMessage();
	}

	// Handle form fields which have been serialized
	$temp_array = array();

	foreach($result_array as $input_name=>$input_value)
	{
		if($input_name != 'custpackmystery_ref' && strpos($input_name,'custpackmystery')===0)
		{
			$temp_array[] = "\t\t".mysql_real_escape_string_function($input_name)."=:".$input_name."";
			$pdo_addition[":".$input_name] = mysql_real_escape_string_function(strip_tags(trim($input_value), '<p><font><span><div><ul><li><br><table><thead><tbody><th><tr><td>'));
		}
	}

	$query_input = implode(",\n",$temp_array);
	
	{
		
		$pdo_addition[':custpackmystery_modified'] = date('Y-m-d H:i:s');
		$pdo_addition[':custpackmystery_ref'] = $result_array['custpackmystery_ref'];

		// Update Submitted Form Fields
		try
		{
			$query = 	"UPDATE 
						custpackmystery 
						SET
						custpackmystery_modified	= :custpackmystery_modified,
						".$query_input."
						WHERE
						custpackmystery_ref			= :custpackmystery_ref";			
			$sth = $PDO_WRITE->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));

			$sth->execute($pdo_addition);
		}
		catch(PDOException $e)
		{
			echo "Error: ".__LINE__. $e->getMessage();
		}	
	}

	echo $result_array['custpackmystery_customer_ref'];
		
}
			
?>