<?php

include_once('../custom/globals-without-login.php');

$RETURN = array();

$MODE = $_REQUEST['mode'];


if($MODE == "dropdown_wine_filter")
{
	$additionalFilters = "";
	if($_REQUEST['wine_branch_ref']!="")
	{
		$additionalFilters .= " AND wine_branch_ref = '".$_REQUEST['wine_branch_ref']."'";
	}
	
	if($_REQUEST['wine_country_ref']!="")
	{
		$additionalFilters .= " AND wine_country_ref = '".$_REQUEST['wine_country_ref']."'";
	}
	
	if($_REQUEST['wine_region_ref']!="")
	{
		$additionalFilters .= " AND wine_region_ref = '".$_REQUEST['wine_region_ref']."'";
	}
	
	if($_REQUEST['wine_winery_ref']!="")
	{
		$additionalFilters .= " AND wine_winery_ref = '".$_REQUEST['wine_winery_ref']."'";
	}
	
	if($_REQUEST['wine_vintage']!="")
	{
		$additionalFilters .= " AND wine_vintage = '".$_REQUEST['wine_vintage']."'";
	}

	try 
	{
		$query = 	"SELECT 
						wine_ref,
						wine_name
				 	FROM 
						wine
				 	WHERE 
				 		wine_status_id = :wine_status_id
				 		".$additionalFilters."
					ORDER BY 
						wine_name ASC";
		$sth = $PDO->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		$temp_array = array();
		$pdo_fieldvalue = array(':wine_status_id' => '1');

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
			$RETURN['wine'] = $temp_array;

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