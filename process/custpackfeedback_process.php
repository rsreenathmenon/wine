<?php

include_once('../custom/globals.php');

{
	$pdo_addition = array();
	$array_check_type = array();
	if ($_POST['custpackfeedback_ref'] == '')
	{
		$_POST['custpackfeedback_ref'] = random_reference();
		$_POST['custpackfeedback_created'] = date('Y-m-d H:i:s');
		$custpackfeedback_ref = $_POST['custpackfeedback_ref'];
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
		
	}

	// Handle form fields which have been serialized
	$temp_array = array();

	foreach($_POST as $input_name=>$input_value)
	{
		if($input_name != 'custpackfeedback_ref' && strpos($input_name,'custpackfeedback')===0)
		{
			$temp_array[] = "\t\t".mysql_real_escape_string_function($input_name)."=:".$input_name."";
			$pdo_addition[":".$input_name] = mysql_real_escape_string_function(strip_tags(trim($input_value), '<p><font><span><div><ul><li><br><table><thead><tbody><th><tr><td>'));
		}
	}

	$query_input = implode(",\n",$temp_array);
	
	{
		$result_array['no_exec']=0;
		
		$pdo_addition[':custpackfeedback_modified'] = date('Y-m-d H:i:s');
		$pdo_addition[':custpackfeedback_ref'] = $_POST['custpackfeedback_ref'];

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
		
}

$newURL = HTTP_SERVER."custpackfeedback.php?cus=".$_POST['custpackfeedback_customer_ref'];
header('Location: '.$newURL);


?>