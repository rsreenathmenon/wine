<?php

include_once('../custom/globals.php');

{
	$pdo_addition = array();
	$array_check_type = array();
	if ($_POST['wine_ref'] == '')
	{
		$_POST['wine_ref'] = random_reference();
		$_POST['wine_created'] = date('Y-m-d H:i:s');
		$wine_ref = $_POST['wine_ref'];
		try
		{
			$query = 	"INSERT INTO
						wine
						SET
						wine_created 	= :wine_created,
						wine_ref 		= :wine_ref";
			
			$sth = $PDO_WRITE->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));

			$sth->execute(array(':wine_ref' => $wine_ref,':wine_created' =>date('Y-m-d H:i:s')));
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
		if($input_name != 'wine_ref' && $input_name != 'wine_varietal' && strpos($input_name,'wine')===0)
		{
			$temp_array[] = "\t\t".mysql_real_escape_string_function($input_name)."=:".$input_name."";
			$pdo_addition[":".$input_name] = mysql_real_escape_string_function(strip_tags(trim($input_value), '<p><font><span><div><ul><li><br><table><thead><tbody><th><tr><td>'));
		}
	}

	$query_input = implode(",\n",$temp_array);
	
	{
		$result_array['no_exec']=0;
		
		$pdo_addition[':wine_modified'] = date('Y-m-d H:i:s');
		$pdo_addition[':wine_ref'] = $_POST['wine_ref'];

		// Update Submitted Form Fields
		try
		{
			$query = 	"UPDATE 
						wine 
						SET
						wine_modified	= :wine_modified,
						".$query_input."
						WHERE
						wine_ref			= :wine_ref";			
			$sth = $PDO_WRITE->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));

			$sth->execute($pdo_addition);
		}
		catch(PDOException $e)
		{
			echo "Error: ".__LINE__. $e->getMessage();
		}	


		//CREATE addition Array for Insert and Update	
		$pdo_addition_wvm_MASTER = array();
		$pdo_addition_wvm_MASTER[':winevarientalmap_wine_ref'] = $_POST['wine_ref'];
		// Update Status to inactive to all vaientals
		try
		{
			$query = 	"UPDATE 
						winevarientalmap 
						SET
						winevarientalmap_modified	= '".date('Y-m-d H:i:s')."',
						winevarientalmap_status_id = '2'
						WHERE
				 		winevarientalmap_wine_ref = :winevarientalmap_wine_ref ";			
			$sth = $PDO_WRITE->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));

			$sth->execute($pdo_addition_wvm_MASTER);
		}
		catch(PDOException $e)
		{
			echo "Error: ".__LINE__. $e->getMessage();
		}	



		// Find all vaientals of the Wine
		$verientalList = $_POST['wine_varietal'];
		for($ijkl=0; $ijkl<count($verientalList); $ijkl++)
		{
			$pdo_addition_wvm = array();
			$pdo_addition_wvm[':winevarientalmap_wine_ref'] = $_POST['wine_ref'];
			
			$winevarientalmap_variental_ref = $verientalList[$ijkl];
			$query = 	"SELECT 
							winevarientalmap.*
					 	FROM 
							winevarientalmap
					 	WHERE 
					 		winevarientalmap_wine_ref = :winevarientalmap_wine_ref 
					 		AND 
					 		winevarientalmap_variental_ref  = :winevarientalmap_variental_ref ";

			$pdo_addition_wvm[':winevarientalmap_variental_ref'] = $winevarientalmap_variental_ref;

			$sth = $PDO->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));

			$temp_array = array();

			print_r($pdo_addition_wvm);

			if($sth->execute($pdo_addition_wvm))
			{
				if($row = $sth->fetch(PDO::FETCH_ASSOC))
				{	

					$pdo_addition_wvm[':winevarientalmap_modified'] = date('Y-m-d H:i:s');
					// Update status to active to all varientals found
					try
					{
						$query = 	"UPDATE 
									winevarientalmap 
									SET
									winevarientalmap_modified	= :winevarientalmap_modified,
									winevarientalmap_status_id = '1'
									WHERE
							 		winevarientalmap_wine_ref = :winevarientalmap_wine_ref 
							 		AND 
							 		winevarientalmap_variental_ref  = :winevarientalmap_variental_ref ";			
						$sth = $PDO_WRITE->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));

						$sth->execute($pdo_addition_wvm);
					}
					catch(PDOException $e)
					{
						echo "Error: ".__LINE__. $e->getMessage();
					}				
				}
				else
				{	
					$_POST['winevarientalmap_ref'] = random_reference();
					$winevarientalmap_ref = $_POST['winevarientalmap_ref'];

					$pdo_addition_wvm[':winevarientalmap_ref'] = $winevarientalmap_ref;
					$pdo_addition_wvm[':winevarientalmap_created'] = date('Y-m-d H:i:s');

					// Insert new varientals if not found
					try
					{
						$query = 	"INSERT INTO
									winevarientalmap
									SET
									winevarientalmap_created 		= :winevarientalmap_created,
									winevarientalmap_ref 			= :winevarientalmap_ref,
									winevarientalmap_status_id		= '1',
									winevarientalmap_wine_ref  		= :winevarientalmap_wine_ref ,
									winevarientalmap_variental_ref  = :winevarientalmap_variental_ref ";
						
						$sth = $PDO_WRITE->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));

						$sth->execute($pdo_addition_wvm);
					}
					catch(PDOException $e)
					{
						echo "Error: " . __LINE__. $e->getMessage();
					}	
					
				}
			}
		}
	}
		
}

$newURL = HTTP_SERVER."wine.php";
header('Location: '.$newURL);


?>