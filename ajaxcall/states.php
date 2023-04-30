<?php

include_once('../custom/globals-without-login.php');

$RETURN = array();

$MODE = $_REQUEST['mode'];


if($MODE == "dropdown_state")
{
	$additionalFilters = "";
	if($_REQUEST['country_ref']!="")
	{
		$additionalFilters = " AND states_country_ref = '".$_REQUEST['country_ref']."'";
	}
	else
	{
		$additionalFilters = " AND states_country_ref = ''";
	}

	try 
	{
		$query = 	"SELECT 
						states_ref,
						states_name
				 	FROM 
						states
				 	WHERE 
				 		states_status_id = :states_status_id
				 		".$additionalFilters."
					ORDER BY 
						states_name ASC";
		$sth = $PDO->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		$temp_array = array();
		$pdo_fieldvalue = array(':states_status_id' => '1');

		if($sth->execute($pdo_fieldvalue))
		{
			while($row = $sth->fetch(PDO::FETCH_ASSOC))
			{
				foreach ($row as $key => $value) 
				{
					$row[$key] =  stripslashes($value);
				}
				foreach ($row as $key => $value) 
				{
					$row[$key] = strip_tags($value, '<p><font><span><div><ul><li><br><table><thead><tbody><th><tr><td>');
				}
				$temp_array[] = $row;
			}
			$RETURN['states'] = $temp_array;

		}
	}
	catch(PDOException $e)
	{
		//echo "Error: " . __LINE__. $e->getMessage();
		$RETURN['error'] = "Error: " . __LINE__. $e->getMessage();
	}
	

}


echo json_encode($RETURN);


?>