<?php

include_once('../custom/globals.php');

{
	$pdo_addition = array();
	$array_check_type = array();
	if ($_POST['winery_ref'] == '')
	{
		$_POST['winery_ref'] = random_reference();
		$_POST['winery_created'] = date('Y-m-d H:i:s');
		$winery_ref = $_POST['winery_ref'];
		try
		{
			$query = 	"INSERT INTO
						winery
						SET
						winery_created 	= :winery_created,
						winery_ref 		= :winery_ref";
			
			$sth = $PDO_WRITE->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));

			$sth->execute(array(':winery_ref' => $winery_ref,':winery_created' =>date('Y-m-d H:i:s')));
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
		if($input_name != 'winery_ref' && strpos($input_name,'winery')===0)
		{
			$temp_array[] = "\t\t".mysql_real_escape_string_function($input_name)."=:".$input_name."";
			$pdo_addition[":".$input_name] = mysql_real_escape_string_function(strip_tags(trim($input_value), '<p><font><span><div><ul><li><br><table><thead><tbody><th><tr><td>'));
		}
	}

	$query_input = implode(",\n",$temp_array);
	
	{
		$result_array['no_exec']=0;
		
		$pdo_addition[':winery_modified'] = date('Y-m-d H:i:s');
		$pdo_addition[':winery_ref'] = $_POST['winery_ref'];

		// Update Submitted Form Fields
		try
		{
			$query = 	"UPDATE 
						winery 
						SET
						winery_modified	= :winery_modified,
						".$query_input."
						WHERE
						winery_ref			= :winery_ref";			
			$sth = $PDO_WRITE->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));

			$sth->execute($pdo_addition);
		}
		catch(PDOException $e)
		{
			echo "Error: ".__LINE__. $e->getMessage();
		}	
	}
		
}

$newURL = HTTP_SERVER."winery.php";
header('Location: '.$newURL);


?>