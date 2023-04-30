<?php

include_once('../custom/globals.php');

{
	$pdo_addition = array();
	$array_check_type = array();
	if ($_POST['pack_ref'] == '')
	{
		$_POST['pack_ref'] = random_reference();
		$_POST['pack_created'] = date('Y-m-d H:i:s');
		$pack_ref = $_POST['pack_ref'];
		try
		{
			$query = 	"INSERT INTO
						pack
						SET
						pack_created 	= :pack_created,
						pack_ref 		= :pack_ref";
			
			$sth = $PDO_WRITE->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));

			$sth->execute(array(':pack_ref' => $pack_ref,':pack_created' =>date('Y-m-d H:i:s')));
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
		if($input_name != 'pack_ref' && strpos($input_name,'pack')===0)
		{
			$temp_array[] = "\t\t".mysql_real_escape_string_function($input_name)."=:".$input_name."";
			$pdo_addition[":".$input_name] = mysql_real_escape_string_function(strip_tags(trim($input_value), '<p><font><span><div><ul><li><br><table><thead><tbody><th><tr><td>'));
		}
	}

	$query_input = implode(",\n",$temp_array);
	
	{
		$result_array['no_exec']=0;
		
		$pdo_addition[':pack_modified'] = date('Y-m-d H:i:s');
		$pdo_addition[':pack_ref'] = $_POST['pack_ref'];

		// Update Submitted Form Fields
		try
		{
			$query = 	"UPDATE 
						pack 
						SET
						pack_modified	= :pack_modified,
						".$query_input."
						WHERE
						pack_ref			= :pack_ref";			
			$sth = $PDO_WRITE->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));

			$sth->execute($pdo_addition);
		}
		catch(PDOException $e)
		{
			echo "Error: ".__LINE__. $e->getMessage();
		}	



		//CREATE addition Array for Insert and Update	
		$pdo_addition_wvm_MASTER = array();
		$pdo_addition_wvm_MASTER[':winepackmap_pack_ref'] = $_POST['pack_ref'];
		// Update Status to inactive to all wines
		try
		{
			$query = 	"UPDATE 
						winepackmap 
						SET
						winepackmap_modified	= '".date('Y-m-d H:i:s')."',
						winepackmap_status_id = '2'
						WHERE
				 		winepackmap_pack_ref = :winepackmap_pack_ref ";			
			$sth = $PDO_WRITE->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));

			$sth->execute($pdo_addition_wvm_MASTER);
		}
		catch(PDOException $e)
		{
			echo "Error: ".__LINE__. $e->getMessage();
		}	



		// Find all wines of the Pack
		$wineList = $_POST['wine_ref'];
		for($ijkl=0; $ijkl<count($wineList); $ijkl++)
		{
			$pdo_addition_wvm = array();
			$pdo_addition_wvm[':winepackmap_pack_ref'] = $_POST['pack_ref'];
			
			$winepackmap_wine_ref = $wineList[$ijkl];
			$winepackmap_slno = $ijkl+1;
			$query = 	"SELECT 
							winepackmap.*
					 	FROM 
							winepackmap
					 	WHERE 
					 		winepackmap_pack_ref = :winepackmap_pack_ref 
					 		AND 
					 		winepackmap_wine_ref  = :winepackmap_wine_ref
					 		AND 
					 		winepackmap_slno  = :winepackmap_slno ";

			$pdo_addition_wvm[':winepackmap_wine_ref'] = $winepackmap_wine_ref;
			$pdo_addition_wvm[':winepackmap_slno'] = $winepackmap_slno;

			$sth = $PDO->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));

			$temp_array = array();

			print_r($pdo_addition_wvm);

			if($sth->execute($pdo_addition_wvm))
			{
				if($row = $sth->fetch(PDO::FETCH_ASSOC))
				{	

					$pdo_addition_wvm[':winepackmap_modified'] = date('Y-m-d H:i:s');
					// Update status to active to all packs found
					try
					{
						$query = 	"UPDATE 
									winepackmap 
									SET
									winepackmap_modified	= :winepackmap_modified,
									winepackmap_status_id 	= '1'
									WHERE
							 		winepackmap_wine_ref 	= :winepackmap_wine_ref 
							 		AND 
							 		winepackmap_pack_ref  	= :winepackmap_pack_ref
							 		AND 
							 		winepackmap_slno  		= :winepackmap_slno ";			
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
					$_POST['winepackmap_ref'] = random_reference();
					$winepackmap_ref = $_POST['winepackmap_ref'];

					$pdo_addition_wvm[':winepackmap_ref'] = $winepackmap_ref;
					$pdo_addition_wvm[':winepackmap_created'] = date('Y-m-d H:i:s');

					// Insert new packs if not found
					try
					{
						$query = 	"INSERT INTO
									winepackmap
									SET
									winepackmap_created 		= :winepackmap_created,
									winepackmap_ref 			= :winepackmap_ref,
									winepackmap_status_id		= '1',
									winepackmap_wine_ref  		= :winepackmap_wine_ref ,
									winepackmap_pack_ref  		= :winepackmap_pack_ref ,
									winepackmap_slno  			= :winepackmap_slno ";
						
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

$newURL = HTTP_SERVER."pack.php";
header('Location: '.$newURL);


?>