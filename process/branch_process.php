<?php

include_once('../custom/globals.php');

{
	$pdo_addition = array();
	$array_check_type = array();
	if ($_POST['branch_ref'] == '')
	{
		$_POST['branch_ref'] = random_reference();
		$_POST['branch_created'] = date('Y-m-d H:i:s');
		$branch_ref = $_POST['branch_ref'];
		try
		{
			$query = 	"INSERT INTO
						branch
						SET
						branch_created 	= :branch_created,
						branch_ref 		= :branch_ref";
			
			$sth = $PDO_WRITE->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));

			$sth->execute(array(':branch_ref' => $branch_ref,':branch_created' =>date('Y-m-d H:i:s')));
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
		if($input_name != 'branch_ref' && strpos($input_name,'branch')===0)
		{
			$temp_array[] = "\t\t".mysql_real_escape_string_function($input_name)."=:".$input_name."";
			$pdo_addition[":".$input_name] = mysql_real_escape_string_function(strip_tags(trim($input_value), '<p><font><span><div><ul><li><br><table><thead><tbody><th><tr><td>'));
		}
	}

	$query_input = implode(",\n",$temp_array);
	
	{
		$result_array['no_exec']=0;
		
		$pdo_addition[':branch_modified'] = date('Y-m-d H:i:s');
		$pdo_addition[':branch_ref'] = $_POST['branch_ref'];

		// Update Submitted Form Fields
		try
		{
			$query = 	"UPDATE 
						branch 
						SET
						branch_modified	= :branch_modified,
						".$query_input."
						WHERE
						branch_ref			= :branch_ref";			
			$sth = $PDO_WRITE->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));

			$sth->execute($pdo_addition);
		}
		catch(PDOException $e)
		{
			echo "Error: ".__LINE__. $e->getMessage();
		}	
	}
		
}

$newURL = HTTP_SERVER."branch.php";
header('Location: '.$newURL);


?>