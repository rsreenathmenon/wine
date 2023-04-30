<?php

include_once('../custom/globals-without-login.php');


$arrayGender = array(1 => 'Male', 2 => 'Female', 3 => 'Other');
$arrayMaritalStatus = array(1 => 'Single',  2 => 'Married',  3 => 'Widowed', 4 => 'Divorced', 5 => 'Seperated' );
$arrayEducationLevel = array(1 => 'High School',  2 => 'Diploma / Certificate',  3 => 'Degree', 4 => 'Post Graduate' );

$result_array 	= array();


$result_array['custpackfeedback_name'] = $_REQUEST["pack-code"];
$result_array['customers_email'] = $_REQUEST["email"];

$result_array['custpackfeedback_wine_1_smell'] = $_REQUEST["wine-1-smell-rating"];
$result_array['custpackfeedback_wine_1_taste'] = $_REQUEST["wine-1-taste-rating"];
$result_array['custpackfeedback_wine_1_overall'] = $_REQUEST["wine-1-overall-rating"];
$result_array['custpackfeedback_wine_1_drink_again'] = $_REQUEST["wine-1-drink-again"];
$result_array['custpackfeedback_wine_1_eat_with'] = $_REQUEST["wine-1-eat-with"];
$result_array['custpackfeedback_wine_1_comments'] = $_REQUEST["wine-1-other-comments"];

$result_array['custpackfeedback_wine_2_smell'] = $_REQUEST["wine-2-smell-rating"];
$result_array['custpackfeedback_wine_2_taste'] = $_REQUEST["wine-2-taste-rating"];
$result_array['custpackfeedback_wine_2_overall'] = $_REQUEST["wine-2-overall-rating"];
$result_array['custpackfeedback_wine_2_drink_again'] = $_REQUEST["wine-2-drink-again"];
$result_array['custpackfeedback_wine_2_eat_with'] = $_REQUEST["wine-2-eat-with"];
$result_array['custpackfeedback_wine_2_comments'] = $_REQUEST["wine-2-other-comments"];

$result_array['custpackfeedback_wine_3_smell'] = $_REQUEST["wine-3-smell-rating"];
$result_array['custpackfeedback_wine_3_taste'] = $_REQUEST["wine-3-taste-rating"];
$result_array['custpackfeedback_wine_3_overall'] = $_REQUEST["wine-3-overall-rating"];
$result_array['custpackfeedback_wine_3_drink_again'] = $_REQUEST["wine-3-drink-again"];
$result_array['custpackfeedback_wine_3_eat_with'] = $_REQUEST["wine-3-eat-with"];
$result_array['custpackfeedback_wine_3_comments'] = $_REQUEST["wine-3-other-comments"];

$result_array['custpackfeedback_wine_4_smell'] = $_REQUEST["wine-4-smell-rating"];
$result_array['custpackfeedback_wine_4_taste'] = $_REQUEST["wine-4-taste-rating"];
$result_array['custpackfeedback_wine_4_overall'] = $_REQUEST["wine-4-overall-rating"];
$result_array['custpackfeedback_wine_4_drink_again'] = $_REQUEST["wine-4-drink-again"];
$result_array['custpackfeedback_wine_4_eat_with'] = $_REQUEST["wine-4-eat-with"];
$result_array['custpackfeedback_wine_4_comments'] = $_REQUEST["wine-4-other-comments"];

$result_array['custpackfeedback_first_in_pack'] = $_REQUEST["first-in-pack"];
$result_array['custpackfeedback_second_in_pack'] = $_REQUEST["second-in-pack"];
$result_array['custpackfeedback_most_expensive'] = $_REQUEST["think-most-expensive"];
$result_array['custpackfeedback_cheapest'] = $_REQUEST["think-cheapest"];



$result_array['custpackfeedback_customer_ref'] = getCustomersRefOnly($result_array['customers_email']);
$result_array['custpackfeedback_pack_ref'] = getPacksRefOnly($result_array['custpackfeedback_name']);

if($result_array['custpackfeedback_customer_ref']!="")
{
	$result_array['custpackfeedback_ref'] = random_reference();
	$custpackfeedback_ref = $result_array['custpackfeedback_ref'];
	try
	{
		$query = 	"INSERT INTO
					custpackfeedback
					SET
					custpackfeedback_created 	= :custpackfeedback_created,
					custpackfeedback_ref 		= :custpackfeedback_ref";
		
		$sth = $PDO_WRITE->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));

		$sth->execute(array(':custpackfeedback_ref' => $custpackfeedback_ref,':custpackfeedback_created' =>date('Y-m-d H:i:s')));
	}
	catch(PDOException $e)
	{
		echo "Error: " . __LINE__. $e->getMessage();
	}

	// Handle form fields which have been serialized
	$temp_array = array();

	foreach($result_array as $input_name=>$input_value)
	{
		if($input_name != 'custpackfeedback_ref' && strpos($input_name,'custpackfeedback')===0)
		{
			$temp_array[] = "\t\t".mysql_real_escape_string_function($input_name)."=:".$input_name."";
			$pdo_addition[":".$input_name] = mysql_real_escape_string_function(strip_tags(trim($input_value), '<p><font><span><div><ul><li><br><table><thead><tbody><th><tr><td>'));
		}
	}

	$query_input = implode(",\n",$temp_array);
	
	{
		
		$pdo_addition[':custpackfeedback_modified'] = date('Y-m-d H:i:s');
		$pdo_addition[':custpackfeedback_ref'] = $result_array['custpackfeedback_ref'];

		// Update Submitted Form Fields
		try
		{
			$query = 	"UPDATE 
						custpackfeedback 
						SET
						custpackfeedback_modified	= :custpackfeedback_modified,
						".$query_input."
						WHERE
						custpackfeedback_ref			= :custpackfeedback_ref";			
			$sth = $PDO_WRITE->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));

			$sth->execute($pdo_addition);
		}
		catch(PDOException $e)
		{
			echo "Error: ".__LINE__. $e->getMessage();
		}	
	}
	
	{
		$pack_code_to_update = "";

		$query = 	"SELECT
						custpack_ref 
				 	FROM 
						custpack
				 	WHERE 
					 	MD5(custpack_pack_ref) = :custpack_pack_ref
					 	AND
					 	MD5(custpack_customer_ref) = :custpack_customer_ref
					 	AND
					 	custpack_feedback = 0
					 	AND
					 	custpack_status_id = 1";

		$sth = $PDO->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		$sth->execute(array(':custpack_pack_ref' => md5($result_array['custpackfeedback_pack_ref']),':custpack_customer_ref' => md5($result_array['custpackfeedback_customer_ref'])));
		if($row = $sth->fetch(PDO::FETCH_ASSOC))
		{
			$pack_code_to_update = $row['custpack_ref'];
		}

		if($pack_code_to_update!="")
		{

		
			$pdo_addition_pack[':custpack_modified'] = date('Y-m-d H:i:s');
			$pdo_addition_pack[':custpack_feedback_on'] = date('Y-m-d H:i:s');
			$pdo_addition_pack[':custpack_feedback'] = '1';
			$pdo_addition_pack[':custpack_custpackfeedback_ref'] = $result_array['custpackfeedback_ref'];
			$pdo_addition_pack[':custpack_ref'] = $pack_code_to_update;

			// Update Submitted Form Fields
			try
			{
				$query = 	"UPDATE 
							custpack 
							SET
							custpack_modified						= :custpack_modified,
							custpack_feedback_on					= :custpack_feedback_on,
							custpack_feedback						= :custpack_feedback,
							custpack_custpackfeedback_ref			= :custpack_custpackfeedback_ref
							WHERE
							custpack_ref							= :custpack_ref";			
				$sth = $PDO_WRITE->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));

				$sth->execute($pdo_addition_pack);
			}
			catch(PDOException $e)
			{
				echo "Error: ".__LINE__. $e->getMessage();
			}	
		}
		else
		{
		
			$pdo_addition_pack[':custpack_created'] = date('Y-m-d H:i:s');
			$pdo_addition_pack[':custpack_modified'] = date('Y-m-d H:i:s');
			$pdo_addition_pack[':custpack_feedback_on'] = date('Y-m-d H:i:s');
			$pdo_addition_pack[':custpack_status_id'] = '1';
			$pdo_addition_pack[':custpack_ref'] = random_reference();

			$pdo_addition_pack[':custpack_name'] = $result_array['custpackfeedback_name'];
			$pdo_addition_pack[':custpack_customer_ref'] = $result_array['custpackfeedback_customer_ref'];
			$pdo_addition_pack[':custpack_pack_ref'] = $result_array['custpackfeedback_pack_ref'];

			$pdo_addition_pack[':custpack_custpackfeedback_ref'] = $result_array['custpackfeedback_ref'];
			$pdo_addition_pack[':custpack_feedback'] = '1';
			$pdo_addition_pack[':custpack_autosent'] = '1';

			try
			{
				$query = 	"INSERT INTO
							custpack
							SET
							custpack_created 				= :custpack_created,
							custpack_modified 				= :custpack_modified,
							custpack_feedback_on 			= :custpack_feedback_on,
							custpack_status_id 				= :custpack_status_id,
							custpack_ref 					= :custpack_ref,
							custpack_name 					= :custpack_name,
							custpack_customer_ref 			= :custpack_customer_ref,
							custpack_pack_ref 				= :custpack_pack_ref,
							custpack_custpackfeedback_ref 	= :custpack_custpackfeedback_ref,
							custpack_feedback				= :custpack_feedback,
							custpack_autosent				= :custpack_autosent";
				
				$sth = $PDO_WRITE->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));

				$sth->execute($pdo_addition_pack);
			}
			catch(PDOException $e)
			{
				echo "Error: " . __LINE__. $e->getMessage();
			}
		}


	}

	echo $result_array['custpackfeedback_customer_ref'];
		
}
			
?>