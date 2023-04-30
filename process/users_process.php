<?php

include_once('../custom/globals.php');

{
	$pdo_addition = array();
	$array_check_type = array();
	if ($_POST['users_ref'] == '')
	{
		$_POST['users_ref'] = random_reference();
		$_POST['users_created'] = date('Y-m-d H:i:s');
		$users_ref = $_POST['users_ref'];
		try
		{
			$query = 	"INSERT INTO
						users
						SET
						users_created 	= :users_created,
						users_ref 		= :users_ref";
			
			$sth = $PDO_WRITE->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));

			$sth->execute(array(':users_ref' => $users_ref,':users_created' =>date('Y-m-d H:i:s')));
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
		if($input_name != 'users_ref' && $input_name != 'users_password' && strpos($input_name,'users')===0)
		{
			$temp_array[] = "\t\t".mysql_real_escape_string_function($input_name)."=:".$input_name."";
			$pdo_addition[":".$input_name] = mysql_real_escape_string_function(strip_tags(trim($input_value), '<p><font><span><div><ul><li><br><table><thead><tbody><th><tr><td>'));
		}
		elseif($input_name == 'users_password' && strpos($input_name,'users')===0)
		{
			$temp_array[] = "\t\t".mysql_real_escape_string_function($input_name)."=:".$input_name."";
			$pdo_addition[":".$input_name] = mysql_real_escape_string_function(strip_tags(base64_encode(trim($input_value)), '<p><font><span><div><ul><li><br><table><thead><tbody><th><tr><td>'));
		}
	}

	$query_input = implode(",\n",$temp_array);
	
	{
		$result_array['no_exec']=0;
		
		$pdo_addition[':users_modified'] = date('Y-m-d H:i:s');
		$pdo_addition[':users_ref'] = $_POST['users_ref'];

		// Update Submitted Form Fields
		try
		{
			$query = 	"UPDATE 
						users 
						SET
						users_modified	= :users_modified,
						".$query_input."
						WHERE
						users_ref			= :users_ref";			
			$sth = $PDO_WRITE->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));

			$sth->execute($pdo_addition);
		}
		catch(PDOException $e)
		{
			echo "Error: ".__LINE__. $e->getMessage();
		}	
	}
		
}

$newURL = HTTP_SERVER."users.php";
header('Location: '.$newURL);


?>