<?php

include_once('../custom/globals.php');

{
	$pdo_addition = array();
	$array_check_type = array();
	if ($_POST['winearoma_ref'] == '')
	{
		$_POST['winearoma_ref'] = random_reference();
		$_POST['winearoma_created'] = date('Y-m-d H:i:s');
		$winearoma_ref = $_POST['winearoma_ref'];
		try
		{
			$query = 	"INSERT INTO
						winearoma
						SET
						winearoma_created 	= :winearoma_created,
						winearoma_ref 		= :winearoma_ref";
			
			$sth = $PDO_WRITE->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));

			$sth->execute(array(':winearoma_ref' => $winearoma_ref,':winearoma_created' =>date('Y-m-d H:i:s')));
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
		if($input_name != 'winearoma_ref' && strpos($input_name,'winearoma')===0)
		{
			$temp_array[] = "\t\t".mysql_real_escape_string_function($input_name)."=:".$input_name."";
			$pdo_addition[":".$input_name] = mysql_real_escape_string_function(strip_tags(trim($input_value), '<p><font><span><div><ul><li><br><table><thead><tbody><th><tr><td>'));
		}
	}

	$query_input = implode(",\n",$temp_array);
	
	{
		$result_array['no_exec']=0;
		
		$pdo_addition[':winearoma_modified'] = date('Y-m-d H:i:s');
		$pdo_addition[':winearoma_ref'] = $_POST['winearoma_ref'];

		// Update Submitted Form Fields
		try
		{
			$query = 	"UPDATE 
						winearoma 
						SET
						winearoma_modified	= :winearoma_modified,
						".$query_input."
						WHERE
						winearoma_ref			= :winearoma_ref";			
			$sth = $PDO_WRITE->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));

			$sth->execute($pdo_addition);
		}
		catch(PDOException $e)
		{
			echo "Error: ".__LINE__. $e->getMessage();
		}	
	}
		
}

$newURL = HTTP_SERVER."winearoma.php";
header('Location: '.$newURL);


?>