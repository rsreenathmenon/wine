<?php

include_once('../custom/globals-without-login.php');

$RETURN = array();

$MODE = $_REQUEST['mode'];


if($MODE == "dropdown_country_region")
{
	$additionalFilters = "";
	if($_REQUEST['country_ref']!="")
	{
		$additionalFilters = " AND region_country_ref = '".$_REQUEST['country_ref']."'";
	}
	else
	{
		$additionalFilters = " AND region_country_ref = ''";
	}

	try 
	{
		$query = 	"SELECT 
						region_ref,
						region_name,
						states_name
				 	FROM 
						region
						LEFT JOIN states ON states_ref = region_states_ref
				 	WHERE 
				 		region_status_id = :region_status_id
				 		".$additionalFilters."
					ORDER BY 
						region_name ASC, 
						states_name ASC";
		$sth = $PDO->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		$temp_array = array();
		$pdo_fieldvalue = array(':region_status_id' => '1');

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
			$RETURN['region'] = $temp_array;

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