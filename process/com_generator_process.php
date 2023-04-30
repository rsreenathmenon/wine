<?php

include_once('../custom/globals.php');

{
	$pdo_addition = array();
	$array_check_type = array();
	if ($_POST['com_generator_ref'] == '')
	{
		$_POST['com_generator_ref'] = random_reference();
		$_POST['com_generator_created'] = date('Y-m-d H:i:s');
		$com_generator_ref = $_POST['com_generator_ref'];
		try
		{
			$query = 	"INSERT INTO
						com_generator
						SET
						com_generator_created 	= :com_generator_created,
						com_generator_ref 		= :com_generator_ref";
			
			$sth = $PDO_WRITE->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));

			$sth->execute(array(':com_generator_ref' => $com_generator_ref,':com_generator_created' =>date('Y-m-d H:i:s')));
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
		if($input_name != 'com_generator_ref' && strpos($input_name,'com_generator')===0)
		{
			$temp_array[] = "\t\t".mysql_real_escape_string_function($input_name)."=:".$input_name."";
			$pdo_addition[":".$input_name] = mysql_real_escape_string_function(strip_tags(trim($input_value), '<p><font><span><div><ul><li><br><table><thead><tbody><th><tr><td>'));
		}
	}

	$query_input = implode(",\n",$temp_array);
	
	{
		$result_array['no_exec']=0;
		
		$pdo_addition[':com_generator_modified'] = date('Y-m-d H:i:s');
		$pdo_addition[':com_generator_ref'] = $_POST['com_generator_ref'];

		// Update Submitted Form Fields
		try
		{
			$query = 	"UPDATE 
						com_generator 
						SET
						com_generator_modified	= :com_generator_modified,
						".$query_input."
						WHERE
						com_generator_ref			= :com_generator_ref";			
			$sth = $PDO_WRITE->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));

			$sth->execute($pdo_addition);
		}
		catch(PDOException $e)
		{
			echo "Error: ".__LINE__. $e->getMessage();
		}	
	}
		
}

$newURL = HTTP_SERVER."com_generator.php";
header('Location: '.$newURL);


?>