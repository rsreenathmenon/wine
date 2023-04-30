<?php

include_once('../custom/globals.php');

{
	$pdo_addition = array();
	$array_check_type = array();
	if ($_POST['custpack_ref'] == '')
	{
		$_POST['custpack_ref'] = random_reference();
		$custpack_ref = $_POST['custpack_ref'];

		$_POST['custpack_created'] = date('Y-m-d H:i:s');
		$_POST['custpack_autosent'] = '0';
		$_POST['custpack_manualsent'] = '1';
		$_POST['custpack_feedback'] = '0';

		try
		{
			$query = 	"INSERT INTO
						custpack
						SET
						custpack_created 	= :custpack_created,
						custpack_ref 		= :custpack_ref,
						custpack_manualsent	= '1',
						custpack_autosent	= '0',
						custpack_feedback	= '0'";
			
			$sth = $PDO_WRITE->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));

			$sth->execute(array(':custpack_ref' => $custpack_ref,':custpack_created' =>$_POST['custpack_created']));
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
		if($input_name != 'custpack_ref' && strpos($input_name,'custpack')===0)
		{
			$temp_array[] = "\t\t".mysql_real_escape_string_function($input_name)."=:".$input_name."";
			$pdo_addition[":".$input_name] = mysql_real_escape_string_function(strip_tags(trim($input_value), '<p><font><span><div><ul><li><br><table><thead><tbody><th><tr><td>'));
		}
	}

	$query_input = implode(",\n",$temp_array);
	
	{
		$result_array['no_exec']=0;
		
		$pdo_addition[':custpack_modified'] = date('Y-m-d H:i:s');
		$pdo_addition[':custpack_ref'] = $_POST['custpack_ref'];

		// Update Submitted Form Fields
		try
		{
			$query = 	"UPDATE 
						custpack 
						SET
						custpack_modified	= :custpack_modified,
						".$query_input."
						WHERE
						custpack_ref			= :custpack_ref";			
			$sth = $PDO_WRITE->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));

			$sth->execute($pdo_addition);
		}
		catch(PDOException $e)
		{
			echo "Error: ".__LINE__. $e->getMessage();
		}	
	}
		
}

$newURL = HTTP_SERVER."custpack.php?cus=".$_POST['custpack_customer_ref'];
header('Location: '.$newURL);


?>