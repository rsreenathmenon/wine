<?php

include_once('../custom/globals.php');






function array2csv(array &$array)
{
   if (count($array) == 0) {
     return null;
   }
   ob_start();
   $df = fopen("php://output", 'w');

   //fputcsv($df, array_keys(reset($array)));

   fputs($df, implode(',', array_keys(reset($array)))."\n");


   foreach ($array as $row) {
      fputcsv($df, $row);
   }
   fclose($df);
   return ob_get_clean();
}

function download_send_headers($filename) {
    // disable caching
    $now = gmdate("D, d M Y H:i:s");
    header("Expires: Tue, 03 Jul 2001 06:00:00 GMT");
    header("Cache-Control: max-age=0, no-cache, must-revalidate, proxy-revalidate");
    header("Last-Modified: {$now} GMT");

    // force download  
    header("Content-Type: application/force-download");
    header("Content-Type: application/octet-stream");
    header("Content-Type: application/download");

    // disposition / encoding on response body
    header("Content-Disposition: attachment;filename={$filename}");
    header("Content-Transfer-Encoding: binary");
}



{
	{
		$arrayToPrint = array();

		$com_generator_ref =  "";
		$com_generator_total =  "";
		$com_generator_customers_id =  "";
		$com_generator_jsondata =  "";
		$communication_code =  "";

		try
		{

			$query = 	"SELECT 
							com_generator_ref,
							com_generator_total,
							com_generator_jsondata,
							com_generator_customers_id,
							communication_code
					 	FROM 
							com_generator
							LEFT JOIN communication ON (com_generator_communication_ref = communication_ref)
					 	WHERE 
					 		com_generator_ref = :com_generator_ref  
						LIMIT 
							0 , 1";

			$sth = $PDO->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));

			$temp_array = array();

			if($sth->execute(array(':com_generator_ref' => trim($_REQUEST['com_generator_ref']))))
			{
				while($row = $sth->fetch(PDO::FETCH_ASSOC))
				{

					$com_generator_ref =  $row['com_generator_ref'];
					$com_generator_total =  $row['com_generator_total'];
					$com_generator_customers_id =  $row['com_generator_customers_id'];
					$com_generator_jsondata =  $row['com_generator_jsondata'];
					$communication_code =  $row['communication_code'];


					//echo "<PRE>";print_r($row);die();
				}
			}
		}
		catch(PDOException $e)
		{
			$RETURN['error'] = "Error: " . __LINE__. $e->getMessage();
		}



		try
		{

			$query = 	"SELECT 
							'S' AS 'Row type'
							#, SUBSTRING(CONCAT(`customers_firstname`, ' ', `customers_lastname`),1,40) AS 'Recipient contact name'
							, `customers_firstname` as 'Customer Firstname'
							, `customers_lastname` as 'Customer Lastname'
							, SUBSTRING(customers_company,1,40) AS 'Recipient business name'
							, customers_address1 AS 'Recipient address line 1'
							, customers_address2 AS 'Recipient address line 2'
							, '' AS 'Recipient address line 3'
							, customers_suburb AS 'Recipient suburb'
							, states_name AS 'Recipient state'
							, customers_postcode AS 'Recipient postcode'
							, 'No' AS 'Send tracking email to recipient'
							, customers_email AS 'Recipient email address'
							, customers_phone AS 'Recipient phone number'
							, customers_sp_instruct AS 'Delivery/special instruction 1'
							, '' AS 'Special instruction 2'
							, '' AS 'Special instruction 3'
							, 'Pack".$communication_code."' AS 'Sender reference 1 '
							, '' AS 'Sender reference 2'
							, '3P85' AS 'Product id'
							, 'YES' AS 'Authority to leave'
							, 'YES' AS 'Safe drop '
							, '1' AS 'Quantity'
							, '' AS 'Packaging type'
							, '' AS 'Weight'
							, '' AS 'Length'
							, '' AS 'Width'
							, '' AS 'Height'
							, '' AS 'Parcel contents'
							, '' AS 'Transit cover value'
							# , customers_email AS 'Email'
							#, customers_phone AS 'Phone'
							#, customers_dob AS 'DOB'
							#, customers_sex AS 'Sex'
							#, CASE
								    # WHEN customers_sex = 1 THEN 'Male'
								    # WHEN customers_sex = 2 THEN 'Female'
								    # WHEN customers_sex = 3 THEN 'Other'
								    # ELSE NULL
								# END AS 'Sex'
							#, customers_maritalstatus AS 'Marital Status'
							#, CASE
								    # WHEN customers_maritalstatus = 1 THEN 'Single'
								    # WHEN customers_maritalstatus = 2 THEN 'Married'
								    # WHEN customers_maritalstatus = 3 THEN 'Widowed'
								    # WHEN customers_maritalstatus = 4 THEN 'Divorced'
								    # WHEN customers_maritalstatus = 5 THEN 'Seperated'
								    # ELSE NULL
								# END AS 'Marital Status'
							#, customers_educationlevel AS 'Education Level'
							#, CASE
								    # WHEN customers_educationlevel = 1 THEN 'High School'
								    # WHEN customers_educationlevel = 2 THEN 'Diploma / Certificate'
								    # WHEN customers_educationlevel = 3 THEN 'Degree'
								    # WHEN customers_educationlevel = 4 THEN 'Post Graduate'
								    # ELSE NULL
								# END AS 'Education Level'
							#, branch_name AS 'Branch'
							#, source_name AS 'Source'
							#, customers_address1 AS 'Address 1'
							#, customers_address2 AS 'Address 2'
							#, customers_suburb AS 'Suburb'
							#, states_name AS 'State'
							#, customers_postcode AS 'Postcode'
							#, country_name AS 'Country'
							#, customers_over_18 AS 'Over 18'
							#, customers_confirm_give_feedback AS 'Confirm Give Feedback'
							#, customers_fav_wine_1 AS 'Fav Wine 1'
							#, customers_fav_wine_2 AS 'Fav Wine 2'
							#, customers_least_fav_wine AS 'Least Fav Wine'
							#, customers_avg_sp_per_bot_wine AS 'Avg Spend Per Bottle Wine'
							#, customers_fav_wine_region AS 'Fav Wine Region'
							#, customers_normally_buy_wine AS 'Normally Buy Wine'
							#, customers_member_wine_club AS 'Member Wine Club'
							#, customers_last_winery_visit AS 'Last Winery Visit'
							#, customers_occas_drink_before_wine AS 'Occasionally Drink Before Wine'
							#, customers_glasses_a_week AS 'Glasses A Week'
							#, CASE
								   # WHEN customers_status_id = 1 THEN 'Active'
								   # WHEN customers_status_id = 2 THEN 'Inactive'
								   # WHEN customers_status_id = 3 THEN 'Deleted'
								   # ELSE NULL
							#	END AS 'Status'
					 	FROM 
							customers
							LEFT JOIN states ON (customers_states_ref = states_ref)
							# LEFT JOIN branch ON (customers_branch_ref = branch_ref)
							# LEFT JOIN source ON (customers_source_ref = source_ref)
							# LEFT JOIN country ON (customers_country_ref = country_ref)
					 	WHERE 
					 		customers_id IN (".$com_generator_customers_id.")  ";

			$sth = $PDO->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));

			$temp_array = array();

			if($sth->execute())
			{
				while($row = $sth->fetch(PDO::FETCH_ASSOC))
				{
					$arrayToPrint[] = $row;

					//echo "<PRE>";print_r($row);die();
				}
			}
		}
		catch(PDOException $e)
		{
			$RETURN['error'] = "Error: " . __LINE__. $e->getMessage();
		}

	}
}

// echo "<PRE>";
// print_r($arrayToPrint);
// die();


download_send_headers("data-export-" . date("Y-m-d") . ".csv");
echo array2csv($arrayToPrint);
die();



?>