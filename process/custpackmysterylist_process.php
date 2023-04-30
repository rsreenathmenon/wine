<?php

include_once('../custom/globals.php');

{
	$pdo_addition = array();
	$array_check_type = array();
	if ($_POST['custpackmystery_ref'] == '')
	{
		$_POST['custpackmystery_ref'] = random_reference();
		$_POST['custpackmystery_created'] = date('Y-m-d H:i:s');
		$custpackmystery_ref = $_POST['custpackmystery_ref'];
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
		
	}

	// Handle form fields which have been serialized
	$temp_array = array();

	foreach($_POST as $input_name=>$input_value)
	{
		if($input_name != 'custpackmystery_ref' && strpos($input_name,'custpackmystery')===0)
		{
			$temp_array[] = "\t\t".mysql_real_escape_string_function($input_name)."=:".$input_name."";
			$pdo_addition[":".$input_name] = mysql_real_escape_string_function(strip_tags(trim($input_value), '<p><font><span><div><ul><li><br><table><thead><tbody><th><tr><td>'));
		}
	}

	$query_input = implode(",\n",$temp_array);
	
	{
		$result_array['no_exec']=0;
		
		$pdo_addition[':custpackmystery_modified'] = date('Y-m-d H:i:s');
		$pdo_addition[':custpackmystery_ref'] = $_POST['custpackmystery_ref'];

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
		
}

$newURL = HTTP_SERVER."custpackmysterylist.php";
header('Location: '.$newURL);


?>