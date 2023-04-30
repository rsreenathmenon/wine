<?php

include_once('../custom/globals.php');

{
	$pdo_addition = array();
	$array_check_type = array();
	if ($_POST['communication_ref'] == '')
	{
		$_POST['communication_ref'] = random_reference();
		$_POST['communication_created'] = date('Y-m-d H:i:s');
		$communication_ref = $_POST['communication_ref'];
		try
		{
			$query = 	"INSERT INTO
						communication
						SET
						communication_created 	= :communication_created,
						communication_ref 		= :communication_ref";
			
			$sth = $PDO_WRITE->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));

			$sth->execute(array(':communication_ref' => $communication_ref,':communication_created' =>date('Y-m-d H:i:s')));
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
		if($input_name != 'communication_ref' && strpos($input_name,'communication')===0)
		{
			$temp_array[] = "\t\t".mysql_real_escape_string_function($input_name)."=:".$input_name."";
			$pdo_addition[":".$input_name] = mysql_real_escape_string_function(strip_tags(trim($input_value), '<p><font><span><div><ul><li><br><table><thead><tbody><th><tr><td>'));
		}
	}

	$query_input = implode(",\n",$temp_array);
	
	{
		$result_array['no_exec']=0;
		
		$pdo_addition[':communication_modified'] = date('Y-m-d H:i:s');
		$pdo_addition[':communication_ref'] = $_POST['communication_ref'];

		// Update Submitted Form Fields
		try
		{
			$query = 	"UPDATE 
						communication 
						SET
						communication_modified	= :communication_modified,
						".$query_input."
						WHERE
						communication_ref			= :communication_ref";			
			$sth = $PDO_WRITE->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));

			$sth->execute($pdo_addition);
		}
		catch(PDOException $e)
		{
			echo "Error: ".__LINE__. $e->getMessage();
		}	
	}
		
}

$newURL = HTTP_SERVER."communication.php";
header('Location: '.$newURL);


?>