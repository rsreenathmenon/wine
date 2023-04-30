<?php

include_once('../custom/globals.php');

{
	$pdo_addition = array();
	$array_check_type = array();
	if ($_POST['custcom_ref'] == '')
	{
		$_POST['custcom_ref'] = random_reference();
		$custcom_ref = $_POST['custcom_ref'];

		$_POST['custcom_created'] = date('Y-m-d H:i:s');
		$_POST['custcom_autosent'] = '0';
		$_POST['custcom_manualsent'] = '1';
		$_POST['custcom_feedback'] = '0';

		try
		{
			$query = 	"INSERT INTO
						custcom
						SET
						custcom_created 	= :custcom_created,
						custcom_ref 		= :custcom_ref,
						custcom_manualsent	= '1',
						custcom_autosent	= '0',
						custcom_feedback	= '0'";
			
			$sth = $PDO_WRITE->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));

			$sth->execute(array(':custcom_ref' => $custcom_ref,':custcom_created' =>$_POST['custcom_created']));
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
		if($input_name != 'custcom_ref' && strpos($input_name,'custcom')===0)
		{
			$temp_array[] = "\t\t".mysql_real_escape_string_function($input_name)."=:".$input_name."";
			$pdo_addition[":".$input_name] = mysql_real_escape_string_function(strip_tags(trim($input_value), '<p><font><span><div><ul><li><br><table><thead><tbody><th><tr><td>'));
		}
	}

	$query_input = implode(",\n",$temp_array);
	
	{
		$result_array['no_exec']=0;
		
		$pdo_addition[':custcom_modified'] = date('Y-m-d H:i:s');
		$pdo_addition[':custcom_ref'] = $_POST['custcom_ref'];

		// Update Submitted Form Fields
		try
		{
			$query = 	"UPDATE 
						custcom 
						SET
						custcom_modified	= :custcom_modified,
						".$query_input."
						WHERE
						custcom_ref			= :custcom_ref";			
			$sth = $PDO_WRITE->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));

			$sth->execute($pdo_addition);
		}
		catch(PDOException $e)
		{
			echo "Error: ".__LINE__. $e->getMessage();
		}	
	}
		
}

$newURL = HTTP_SERVER."custcom.php?cus=".$_POST['custcom_customer_ref'];
header('Location: '.$newURL);


?>