<?php

include_once('../custom/globals-without-login.php');


$SHOW_LEVEL = "1";



function com_generator_fetch_getdata()
{
	/* //////////////////////////////// */
	/*  PAGINATION CALCULATION START    */
	/* //////////////////////////////// */

	global $PDO,$PDO_WRITE;
	global $SHOW_LEVEL;

	/* //////////////////////////////// */
	/*  PAGINATION CALCULATION END      */
	/* //////////////////////////////// */

	$RETURN = array();

	if(isset($_POST['show_level']))
	{
		$SHOW_LEVEL = $_POST['show_level'];
	}

	
	$RETURN['communication'] = getAllActiveCommunicationWithCommunicationCode();

	$RETURN['country'] = getAllActiveCountry();
	$RETURN['states'] = getAllActiveStates();
	$RETURN['source'] = getAllActiveSource();


	$RETURN['customers_fav_wine_1'] = getAllActive_customers_fav_wine_1();
	$RETURN['customers_fav_wine_2'] = getAllActive_customers_fav_wine_2();
	$RETURN['customers_least_fav_wine'] = getAllActive_customers_least_fav_wine();
	$RETURN['customers_avg_sp_per_bot_wine'] = getAllActive_customers_avg_sp_per_bot_wine();
	$RETURN['customers_fav_wine_region'] = getAllActive_customers_fav_wine_region();
	$RETURN['customers_normally_buy_wine'] = getAllActive_customers_normally_buy_wine();
	$RETURN['customers_occas_drink_before_wine'] = getAllActive_customers_occas_drink_before_wine();
	$RETURN['customers_last_winery_visit'] = getAllActive_customers_last_winery_visit();
	$RETURN['customers_member_wine_club'] = getAllActive_customers_member_wine_club();
	$RETURN['customers_glasses_a_week'] = getAllActive_customers_glasses_a_week();
	
	$RETURN['customers_ethnicity'] = getAllActive_customers_ethnicity();
	$RETURN['customers_wine_varietal'] = getAllActive_customers_wine_varietal();
	
	$RETURN['customers_product'] = getAllActive_customers_product();
	$RETURN['customers_company'] = getAllActive_customers_company();
	$RETURN['customers_cohort'] = getAllActive_customers_cohort();
	$RETURN['customers_enrollment'] = getAllActive_customers_enrollment();





	$com_generator_ref =  "";
	$com_generator_total =  "0";
	$com_generator_customers_id =  "";
	$com_generator_jsondata =  "";


	if(isset($_POST['show_level']) && isset($_POST['com_generator_name']) && trim($_POST['com_generator_name'])!="" && ($_POST['show_level']=='2' || $_POST['show_level']=='5' || $_POST['show_level']=='6'))
	{
		

		////////////////////////////////
		// Get Filters For Code
		////////////////////////////////

		try
		{

			$query = 	"SELECT 
							com_generator_ref,
							com_generator_total,
							com_generator_jsondata,
							com_generator_customers_id
					 	FROM 
							com_generator
					 	WHERE 
					 		com_generator_communication_ref = :com_generator_communication_ref  
						ORDER BY 
							com_generator_id DESC
						LIMIT 
							0 , 1";

			$sth = $PDO->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));

			$temp_array = array();

			if($sth->execute(array(':com_generator_communication_ref' => trim($_POST['com_generator_name']))))
			{
				while($row = $sth->fetch(PDO::FETCH_ASSOC))
				{

					$com_generator_ref =  $row['com_generator_ref'];
					$com_generator_total =  $row['com_generator_total'];
					$com_generator_customers_id =  $row['com_generator_customers_id'];
					$com_generator_jsondata =  $row['com_generator_jsondata'];

					$fetchedValue = json_decode($row['com_generator_jsondata']);

					foreach ($fetchedValue as $key => $value) {
						$_POST[$key] = $value;
					}

					//echo "<PRE>";print_r($row);die();
				}
			}
		}
		catch(PDOException $e)
		{
			$RETURN['error'] = "Error: " . __LINE__. $e->getMessage();
		}
	}

	$RETURN['com_generator_ref'] = $com_generator_ref;


	$requestThroughPost = $_POST;

	unset($requestThroughPost['show_level']);
	unset($requestThroughPost['customers_add_to_custpack']);

	$requestThroughPostToSave = json_encode($requestThroughPost);

	$requestThroughPostShow = json_decode($requestThroughPostToSave);



	
	// if(isset($_POST['show_level']) && isset($_POST['com_generator_name']) && trim($_POST['com_generator_name'])!="" && ($_POST['show_level']=='2' || $_POST['show_level']=='5' || $_POST['show_level']=='3'))
	// {
	// 	echo "<PRE>";
	// 	print_r($_POST);
	// 	print_r($requestThroughPost);
	// 	echo $requestThroughPostToSave;
	// 	print_r($requestThroughPostShow);
	// 	die();
	// }

	
	try 
	{

		$pdo_fieldname = array();
		$pdo_fieldvalue = array();

		$arrayJoinTable = array(' customers ');

		foreach($_POST as $input_name=>$input_value)
		{
			//if(trim($input_value)!="")
			{
				if($input_name=="customerTest" && trim($input_value)!="")
				{
					$fieldName = "";
					$fieldValue = "";

					$arrayJoinTable[] = ' customers';

					$pdo_fieldname[] = " ".$fieldName." LIKE ".$fieldValue."";
					// $pdo_fieldvalue[":".$input_name] = $fieldValue;
				}

				if($input_name=="customers_age_start" && trim($input_value)!="")
				{
					$fieldName = "customers_dob";
					$fieldValue = date("Y-m-d");
					$fieldValue = '"'.$fieldValue.'"';
					if($input_value > 0)
					{
						$fieldValue = date("Y-m-d", strtotime("-".$input_value." years"));
						$fieldValue = '"'.$fieldValue.'"';
					}
					

					$arrayJoinTable[] = ' customers ';

					$pdo_fieldname[] = " ".$fieldName." <= ".$fieldValue."";
					// $pdo_fieldvalue[":".$input_name] = $fieldValue;
				}
				elseif($input_name=="customers_age_end" && trim($input_value)!="")
				{
					$fieldName = "customers_dob";
					$fieldValue = date("Y-m-d");
					$fieldValue = '"'.$fieldValue.'"';
					if($input_value > 0)
					{
						$fieldValue = date("Y-m-d", strtotime("-".$input_value." years"));
						$fieldValue = '"'.$fieldValue.'"';
					}
					

					$arrayJoinTable[] = ' customers ';

					$pdo_fieldname[] = " ".$fieldName." >= ".$fieldValue."";
					// $pdo_fieldvalue[":".$input_name] = $fieldValue;
				}
				elseif($input_name=="customers_educationlevel" && count($input_value) > 0)
				{
					$fieldName = "customers_educationlevel";
					$fieldValue = implode('" , "',$input_value);
					if($fieldValue != "")
					{
						$fieldValue = '"'.$fieldValue.'"';
					}
					

					$arrayJoinTable[] = ' customers ';

					$pdo_fieldname[] = " ".$fieldName." IN ( ".$fieldValue." )";
					// $pdo_fieldvalue[":".$input_name] = $fieldValue;
				}
				elseif($input_name=="customers_sex" && count($input_value) > 0)
				{
					$fieldName = "customers_sex";
					$fieldValue = implode('" , "',$input_value);
					if($fieldValue != "")
					{
						$fieldValue = '"'.$fieldValue.'"';
					}
					

					$arrayJoinTable[] = ' customers ';

					// $pdo_fieldname[] = " ".$fieldName." IN ( ".$fieldValue." )";
					// // $pdo_fieldvalue[":".$input_name] = $fieldValue;

					$pdo_fieldname[] = " ".$fieldName." IN ( ".$fieldValue." )";
					// $pdo_fieldvalue[":".$input_name] = $fieldValue;
				}			
				elseif($input_name=="customers_maritalstatus" && count($input_value) > 0)
				{
					$fieldName = "customers_maritalstatus";
					$fieldValue = implode('" , "',$input_value);
					if($fieldValue != "")
					{
						$fieldValue = '"'.$fieldValue.'"';
					}
					

					$arrayJoinTable[] = ' customers ';

					$pdo_fieldname[] = " ".$fieldName." IN ( ".$fieldValue." )";
					// $pdo_fieldvalue[":".$input_name] = $fieldValue;
				}			
				elseif($input_name=="customers_source_ref" && count($input_value) > 0)
				{
					$fieldName = "customers_source_ref";
					$fieldValue = implode('" , "',$input_value);
					if($fieldValue != "")
					{
						$fieldValue = '"'.$fieldValue.'"';
					}
					

					$arrayJoinTable[] = ' customers ';

					$pdo_fieldname[] = " ".$fieldName." IN ( ".$fieldValue." )";
					// $pdo_fieldvalue[":".$input_name] = $fieldValue;
				}			
				elseif($input_name=="customers_regtype" && count($input_value) > 0)
				{
					$fieldName = "customers_regtype";
					$fieldValue = implode('" , "',$input_value);
					if($fieldValue != "")
					{
						$fieldValue = '"'.$fieldValue.'"';
					}
					

					$arrayJoinTable[] = ' customers ';

					$pdo_fieldname[] = " ".$fieldName." IN ( ".$fieldValue." )";
					// $pdo_fieldvalue[":".$input_name] = $fieldValue;
				}			
				elseif($input_name=="customers_memlvl" && count($input_value) > 0)
				{
					$fieldName = "customers_memlvl";
					$fieldValue = implode('" , "',$input_value);
					if($fieldValue != "")
					{
						$fieldValue = '"'.$fieldValue.'"';
					}
					

					$arrayJoinTable[] = ' customers ';

					$pdo_fieldname[] = " ".$fieldName." IN ( ".$fieldValue." )";
					// $pdo_fieldvalue[":".$input_name] = $fieldValue;
				}			
				elseif($input_name=="customers_loyaltylvl" && count($input_value) > 0)
				{
					$fieldName = "customers_loyaltylvl";
					$fieldValue = implode('" , "',$input_value);
					if($fieldValue != "")
					{
						$fieldValue = '"'.$fieldValue.'"';
					}
					

					$arrayJoinTable[] = ' customers ';

					$pdo_fieldname[] = " ".$fieldName." IN ( ".$fieldValue." )";
					// $pdo_fieldvalue[":".$input_name] = $fieldValue;
				}
				elseif($input_name=="customers_classification" && count($input_value) > 0)
				{
					$fieldName = "customers_classification";
					$fieldValue = implode('" , "',$input_value);
					if($fieldValue != "")
					{
						$fieldValue = '"'.$fieldValue.'"';
					}
					

					$arrayJoinTable[] = ' customers ';

					$pdo_fieldname[] = " ".$fieldName." IN ( ".$fieldValue." )";
					// $pdo_fieldvalue[":".$input_name] = $fieldValue;
				}		
				elseif($input_name=="customers_optout" && count($input_value) > 0 && $input_value == "No")
				{
					$fieldName = "customers_optout";
					// $fieldValue = implode('" , "',$input_value);
					// if($fieldValue != "")
					// {
					// 	$fieldValue = '"'.$fieldValue.'"';
					// }

					$fieldValue = '"'.$input_value.'"';

					$arrayJoinTable[] = ' customers ';

					$pdo_fieldname[] = " ".$fieldName." IN ( ".$fieldValue." )";
					// $pdo_fieldvalue[":".$input_name] = $fieldValue;
				}
				elseif($input_name=="customers_country_ref" && count($input_value) > 0)
				{
					$fieldName = "customers_country_ref";
					$fieldValue = implode('" , "',$input_value);
					if($fieldValue != "")
					{
						$fieldValue = '"'.$fieldValue.'"';
					}
					

					$arrayJoinTable[] = ' customers ';

					$pdo_fieldname[] = " ".$fieldName." IN ( ".$fieldValue." )";
					// $pdo_fieldvalue[":".$input_name] = $fieldValue;
				}
				elseif($input_name=="customers_states_ref" && count($input_value) > 0)
				{
					$fieldName = "customers_states_ref";
					$fieldValue = implode('" , "',$input_value);
					if($fieldValue != "")
					{
						$fieldValue = '"'.$fieldValue.'"';
					}
					

					$arrayJoinTable[] = ' customers ';

					$pdo_fieldname[] = " ".$fieldName." IN ( ".$fieldValue." )";
					// $pdo_fieldvalue[":".$input_name] = $fieldValue;
				}

				elseif($input_name=="customers_fav_wine_1" && count($input_value) > 0)
				{
					$fieldName = "customers_fav_wine_1";
					$fieldValue = implode('" , "',$input_value);
					if($fieldValue != "")
					{
						$fieldValue = '"'.$fieldValue.'"';
					}
					

					$arrayJoinTable[] = ' customers ';

					$pdo_fieldname[] = " ".$fieldName." IN ( ".$fieldValue." )";
					// $pdo_fieldvalue[":".$input_name] = $fieldValue;
				}
				elseif($input_name=="customers_fav_wine_2" && count($input_value) > 0)
				{
					$fieldName = "customers_fav_wine_2";
					$fieldValue = implode('" , "',$input_value);
					if($fieldValue != "")
					{
						$fieldValue = '"'.$fieldValue.'"';
					}
					

					$arrayJoinTable[] = ' customers ';

					$pdo_fieldname[] = " ".$fieldName." IN ( ".$fieldValue." )";
					// $pdo_fieldvalue[":".$input_name] = $fieldValue;
				}
				elseif($input_name=="customers_states_ref" && count($input_value) > 0)
				{
					$fieldName = "customers_states_ref";
					$fieldValue = implode('" , "',$input_value);
					if($fieldValue != "")
					{
						$fieldValue = '"'.$fieldValue.'"';
					}
					

					$arrayJoinTable[] = ' customers ';

					$pdo_fieldname[] = " ".$fieldName." IN ( ".$fieldValue." )";
					// $pdo_fieldvalue[":".$input_name] = $fieldValue;
				}
				elseif($input_name=="customers_least_fav_wine" && count($input_value) > 0)
				{
					$fieldName = "customers_least_fav_wine";
					$fieldValue = implode('" , "',$input_value);
					if($fieldValue != "")
					{
						$fieldValue = '"'.$fieldValue.'"';
					}
					

					$arrayJoinTable[] = ' customers ';

					$pdo_fieldname[] = " ".$fieldName." IN ( ".$fieldValue." )";
					// $pdo_fieldvalue[":".$input_name] = $fieldValue;
				}
				elseif($input_name=="customers_avg_sp_per_bot_wine" && count($input_value) > 0)
				{
					$fieldName = "customers_avg_sp_per_bot_wine";
					$fieldValue = implode('" , "',$input_value);
					if($fieldValue != "")
					{
						$fieldValue = '"'.$fieldValue.'"';
					}
					

					$arrayJoinTable[] = ' customers ';

					$pdo_fieldname[] = " ".$fieldName." IN ( ".$fieldValue." )";
					// $pdo_fieldvalue[":".$input_name] = $fieldValue;
				}
				elseif($input_name=="customers_glasses_a_week" && count($input_value) > 0)
				{
					$fieldName = "customers_glasses_a_week";
					$fieldValue = implode('" , "',$input_value);
					if($fieldValue != "")
					{
						$fieldValue = '"'.$fieldValue.'"';
					}
					

					$arrayJoinTable[] = ' customers ';

					$pdo_fieldname[] = " ".$fieldName." IN ( ".$fieldValue." )";
					// $pdo_fieldvalue[":".$input_name] = $fieldValue;
				}
				elseif($input_name=="customers_ethnicity" && count($input_value) > 0)
				{
					$fieldName = "customers_ethnicity";
					$fieldValue = implode('" , "',$input_value);
					if($fieldValue != "")
					{
						$fieldValue = '"'.$fieldValue.'"';
					}
					

					$arrayJoinTable[] = ' customers ';

					$pdo_fieldname[] = " ".$fieldName." IN ( ".$fieldValue." )";
					// $pdo_fieldvalue[":".$input_name] = $fieldValue;
				}
				elseif($input_name=="customers_wine_varietal" && count($input_value) > 0)
				{
					$fieldName = "customers_wine_varietal";
					$fieldValue = implode('" , "',$input_value);
					if($fieldValue != "")
					{
						$fieldValue = '"'.$fieldValue.'"';
					}
					

					$arrayJoinTable[] = ' customers ';

					$pdo_fieldname[] = " ".$fieldName." IN ( ".$fieldValue." )";
					// $pdo_fieldvalue[":".$input_name] = $fieldValue;
				}
				elseif($input_name=="customers_fav_wine_region" && count($input_value) > 0)
				{
					$fieldName = "customers_fav_wine_region";
					$fieldValue = implode('" , "',$input_value);
					if($fieldValue != "")
					{
						$fieldValue = '"'.$fieldValue.'"';
					}
					

					$arrayJoinTable[] = ' customers ';

					$pdo_fieldname[] = " ".$fieldName." IN ( ".$fieldValue." )";
					// $pdo_fieldvalue[":".$input_name] = $fieldValue;
				}
				elseif($input_name=="customers_normally_buy_wine" && count($input_value) > 0)
				{
					$fieldName = "customers_normally_buy_wine";
					$fieldValue = implode('" , "',$input_value);
					if($fieldValue != "")
					{
						$fieldValue = '"'.$fieldValue.'"';
					}
					

					$arrayJoinTable[] = ' customers ';

					$pdo_fieldname[] = " ".$fieldName." IN ( ".$fieldValue." )";
					// $pdo_fieldvalue[":".$input_name] = $fieldValue;
				}
				elseif($input_name=="customers_occas_drink_before_wine" && count($input_value) > 0)
				{
					$fieldName = "customers_occas_drink_before_wine";
					$fieldValue = implode('" , "',$input_value);
					if($fieldValue != "")
					{
						$fieldValue = '"'.$fieldValue.'"';
					}
					

					$arrayJoinTable[] = ' customers ';

					$pdo_fieldname[] = " ".$fieldName." IN ( ".$fieldValue." )";
					// $pdo_fieldvalue[":".$input_name] = $fieldValue;
				}
				elseif($input_name=="customers_last_winery_visit" && count($input_value) > 0)
				{
					$fieldName = "customers_last_winery_visit";
					$fieldValue = implode('" , "',$input_value);
					if($fieldValue != "")
					{
						$fieldValue = '"'.$fieldValue.'"';
					}
					

					$arrayJoinTable[] = ' customers ';

					$pdo_fieldname[] = " ".$fieldName." IN ( ".$fieldValue." )";
					// $pdo_fieldvalue[":".$input_name] = $fieldValue;
				}
				elseif($input_name=="customers_member_wine_club" && count($input_value) > 0)
				{
					$fieldName = "customers_member_wine_club";
					$fieldValue = implode('" , "',$input_value);
					if($fieldValue != "")
					{
						$fieldValue = '"'.$fieldValue.'"';
					}
					

					$arrayJoinTable[] = ' customers ';

					$pdo_fieldname[] = " ".$fieldName." IN ( ".$fieldValue." )";
					// $pdo_fieldvalue[":".$input_name] = $fieldValue;
				}
				elseif($input_name=="customers_created_start" && trim($input_value)!="")
				{
					$fieldName = "customers_created";
					$fieldValue = '"'.$input_value.'"';
					

					$arrayJoinTable[] = ' customers ';

					$pdo_fieldname[] = " ".$fieldName." >= ".$fieldValue."";
					// $pdo_fieldvalue[":".$input_name] = $fieldValue;
				}
				elseif($input_name=="customers_created_end" && trim($input_value)!="")
				{
					$fieldName = "customers_created";
					$fieldValue = '"'.$input_value.'"';
					

					$arrayJoinTable[] = ' customers ';

					$pdo_fieldname[] = " ".$fieldName." <= ".$fieldValue."";
					// $pdo_fieldvalue[":".$input_name] = $fieldValue;
				}
				elseif($input_name=="customers_status_id" && count($input_value) > 0)
				{
					$fieldName = "customers_status_id";
					$fieldValue = implode('" , "',$input_value);
					if($fieldValue != "")
					{
						$fieldValue = '"'.$fieldValue.'"';
					}
					

					$arrayJoinTable[] = ' customers ';

					// $pdo_fieldname[] = " ".$fieldName." IN ( ".$fieldValue." )";
					// // $pdo_fieldvalue[":".$input_name] = $fieldValue;

					$pdo_fieldname[] = " ".$fieldName." IN ( ".$fieldValue." )";
					// $pdo_fieldvalue[":".$input_name] = $fieldValue;
				}	
				elseif($input_name=="customers_product" && count($input_value) > 0)
				{
					$fieldName = "customers_product";
					$fieldValue = implode('" , "',$input_value);
					if($fieldValue != "")
					{
						$fieldValue = '"'.$fieldValue.'"';
					}
					

					$arrayJoinTable[] = ' customers ';

					$pdo_fieldname[] = " ".$fieldName." IN ( ".$fieldValue." )";
					// $pdo_fieldvalue[":".$input_name] = $fieldValue;
				}
				elseif($input_name=="customers_company" && count($input_value) > 0)
				{
					$fieldName = "customers_company";
					$fieldValue = implode('" , "',$input_value);
					if($fieldValue != "")
					{
						$fieldValue = '"'.$fieldValue.'"';
					}
					

					$arrayJoinTable[] = ' customers ';

					$pdo_fieldname[] = " ".$fieldName." IN ( ".$fieldValue." )";
					// $pdo_fieldvalue[":".$input_name] = $fieldValue;
				}
				elseif($input_name=="customers_cohort" && count($input_value) > 0)
				{
					$fieldName = "customers_cohort";
					$fieldValue = implode('" , "',$input_value);
					if($fieldValue != "")
					{
						$fieldValue = '"'.$fieldValue.'"';
					}
					

					$arrayJoinTable[] = ' customers ';

					$pdo_fieldname[] = " ".$fieldName." IN ( ".$fieldValue." )";
					// $pdo_fieldvalue[":".$input_name] = $fieldValue;
				}
				elseif($input_name=="customers_enrollment" && count($input_value) > 0)
				{
					$fieldName = "customers_enrollment";
					$fieldValue = implode('" , "',$input_value);
					if($fieldValue != "")
					{
						$fieldValue = '"'.$fieldValue.'"';
					}
					

					$arrayJoinTable[] = ' customers ';

					$pdo_fieldname[] = " ".$fieldName." IN ( ".$fieldValue." )";
					// $pdo_fieldvalue[":".$input_name] = $fieldValue;
				}

				elseif($input_name=="custpack_sent_start" && trim($input_value)!="")
				{
					$fieldName = "customers_ref";
					$fieldValue = $input_value;
					

					$arrayJoinTable[] = ' customers ';

					$pdo_fieldname[] = " ".$fieldName." IN (SELECT `custpack_customer_ref` FROM `custpack` WHERE `custpack_status_id` = 1 GROUP BY `custpack_customer_ref` HAVING count(1) >=  ".$fieldValue.") ";
					// $pdo_fieldvalue[":".$input_name] = $fieldValue;
				}
				elseif($input_name=="custpack_sent_end" && trim($input_value)!="")
				{
					$fieldName = "customers_ref";
					$fieldValue = $input_value;
					

					$arrayJoinTable[] = ' customers ';

					$pdo_fieldname[] = " ".$fieldName." IN (SELECT `custpack_customer_ref` FROM `custpack` WHERE `custpack_status_id` = 1 GROUP BY `custpack_customer_ref` HAVING count(1) <=  ".$fieldValue.") ";
					// $pdo_fieldvalue[":".$input_name] = $fieldValue;
				}
				elseif($input_name=="custpack_response_received_start" && trim($input_value)!="")
				{
					$fieldName = "customers_ref";
					$fieldValue = $input_value;
					

					$arrayJoinTable[] = ' customers ';

					$pdo_fieldname[] = " ".$fieldName." IN (SELECT `custpack_customer_ref` FROM `custpack` WHERE `custpack_status_id` = 1 AND custpack_feedback = 1 GROUP BY `custpack_customer_ref` HAVING count(1) >=  ".$fieldValue.") ";
					// $pdo_fieldvalue[":".$input_name] = $fieldValue;
				}
				elseif($input_name=="custpack_response_received_end" && trim($input_value)!="")
				{
					$fieldName = "customers_ref";
					$fieldValue = $input_value;
					

					$arrayJoinTable[] = ' customers ';

					$pdo_fieldname[] = " ".$fieldName." IN (SELECT `custpack_customer_ref` FROM `custpack` WHERE `custpack_status_id` = 1 AND custpack_feedback = 1 GROUP BY `custpack_customer_ref` HAVING count(1) <=  ".$fieldValue.") ";
					// $pdo_fieldvalue[":".$input_name] = $fieldValue;
				}
				elseif($input_name=="packresponse_received_start" && trim($input_value)!="")
				{
					$fieldName = "customers_ref";
					$fieldValue = date("Y-m-d");
					$fieldValue = '"'.$fieldValue.'"';
					if($input_value > 0)
					{
						$fieldValue = date("Y-m-d", strtotime("-".$input_value." days"));
						$fieldValue = '"'.$fieldValue.'"';
					}
					

					$arrayJoinTable[] = ' customers ';

					$pdo_fieldname[] = " ".$fieldName." IN (SELECT `custpack_customer_ref` FROM `custpack` WHERE `custpack_status_id` = 1 AND custpack_feedback = 1 AND custpack_created <=  ".$fieldValue."  GROUP BY `custpack_customer_ref` HAVING count(1) >= 0 )";
					// $pdo_fieldvalue[":".$input_name] = $fieldValue;
				}
				elseif($input_name=="packresponse_received_end" && trim($input_value)!="")
				{
					$fieldName = "customers_ref";
					$fieldValue = date("Y-m-d");
					$fieldValue = '"'.$fieldValue.'"';
					if($input_value > 0)
					{
						$fieldValue = date("Y-m-d", strtotime("-".$input_value." days"));
						$fieldValue = '"'.$fieldValue.'"';
					}
					

					$arrayJoinTable[] = ' customers ';

					$pdo_fieldname[] = " ".$fieldName." IN (SELECT `custpack_customer_ref` FROM `custpack` WHERE `custpack_status_id` = 1 AND custpack_feedback = 1 AND  custpack_created >=  ".$fieldValue." GROUP BY `custpack_customer_ref` HAVING count(1) >= 0 )";
					// $pdo_fieldvalue[":".$input_name] = $fieldValue;
				}

				elseif($input_name=="custpack_avg_days_response_start" && trim($input_value)!="")
				{
					$fieldName = "customers_ref";
					$fieldValue = $input_value;
					

					$arrayJoinTable[] = ' customers ';

					$pdo_fieldname[] = " ".$fieldName." IN ( SELECT `custpack_customer_ref` FROM (SELECT `custpack_customer_ref`,count(1), ROUND(AVG(DATEDIFF(`custpack_feedback_on`, `custpack_created`)),0) as fetchedValue, ROUND(".$fieldValue.",0) as roundVal FROM `custpack` WHERE `custpack_status_id` = 1 AND custpack_feedback = 1 GROUP BY custpack_customer_ref HAVING COUNT(1) >= 0 ) as temp_".$input_name." WHERE fetchedValue >= roundVal ) ";

					// $pdo_fieldvalue[":".$input_name] = $fieldValue;
				}
				elseif($input_name=="custpack_avg_days_response_end" && trim($input_value)!="")
				{
					$fieldName = "customers_ref";
					$fieldValue = $input_value;
					

					$arrayJoinTable[] = ' customers ';

					$pdo_fieldname[] = " ".$fieldName." IN ( SELECT `custpack_customer_ref` FROM (SELECT `custpack_customer_ref`,count(1), ROUND(AVG(DATEDIFF(`custpack_feedback_on`, `custpack_created`)),0) as fetchedValue, ROUND(".$fieldValue.",0) as roundVal FROM `custpack` WHERE `custpack_status_id` = 1 AND custpack_feedback = 1 GROUP BY custpack_customer_ref HAVING COUNT(1) >= 0 ) as temp_".$input_name." WHERE fetchedValue <= roundVal ) ";
					// $pdo_fieldvalue[":".$input_name] = $fieldValue;
				}
				elseif($input_name=="packresponse_avg_date_start" && trim($input_value)!="")
				{
					$fieldName = "customers_ref";
					$fieldValue = date("Y-m-d");
					$fieldValue = '"'.$fieldValue.'"';
					if($input_value > 0)
					{
						$fieldValue = date("Y-m-d", strtotime("-".$input_value." days"));
						$fieldValue = '"'.$fieldValue.'"';
					}
					

					$arrayJoinTable[] = ' customers ';

					$pdo_fieldname[] = " ".$fieldName." IN (SELECT `custpack_customer_ref` FROM `custpack` WHERE `custpack_status_id` = 1 AND custpack_feedback = 1 AND custpack_feedback_on <=  ".$fieldValue."  GROUP BY `custpack_customer_ref` HAVING count(1) >= 0 )";
					// $pdo_fieldvalue[":".$input_name] = $fieldValue;
				}
				elseif($input_name=="packresponse_avg_date_end" && trim($input_value)!="")
				{
					$fieldName = "customers_ref";
					$fieldValue = date("Y-m-d");
					$fieldValue = '"'.$fieldValue.'"';
					if($input_value > 0)
					{
						$fieldValue = date("Y-m-d", strtotime("-".$input_value." days"));
						$fieldValue = '"'.$fieldValue.'"';
					}
					

					$arrayJoinTable[] = ' customers ';

					$pdo_fieldname[] = " ".$fieldName." IN (SELECT `custpack_customer_ref` FROM `custpack` WHERE `custpack_status_id` = 1 AND custpack_feedback = 1 AND  custpack_feedback_on >=  ".$fieldValue." GROUP BY `custpack_customer_ref` HAVING count(1) >= 0 )";
					// $pdo_fieldvalue[":".$input_name] = $fieldValue;
				}

				elseif($input_name=="custpack_already_sent_ignore" && trim($input_value)=="1")
				{
					$fieldName = "customers_ref";
					$fieldValue = $_POST['com_generator_name'];
					$fieldValue = '"'.$fieldValue.'"';
					

					$arrayJoinTable[] = ' customers ';

					$pdo_fieldname[] = " ".$fieldName." NOT IN (SELECT DISTINCT `custpack_customer_ref` FROM `custpack` WHERE `custpack_status_id` = 1 AND custpack_pack_ref =  ".$fieldValue.")";
					// $pdo_fieldvalue[":".$input_name] = $fieldValue;
				}

				elseif($input_name=="custcom_already_sent_ignore" && trim($input_value)=="1")
				{
					$fieldName = "customers_ref";
					$fieldValue = $_POST['com_generator_name'];
					$fieldValue = '"'.$fieldValue.'"';
					

					$arrayJoinTable[] = ' customers ';

					$pdo_fieldname[] = " ".$fieldName." NOT IN (SELECT DISTINCT `custcom_customer_ref` FROM `custcom` WHERE `custcom_status_id` = 1 AND custcom_communication_ref =  ".$fieldValue.")";
					// $pdo_fieldvalue[":".$input_name] = $fieldValue;
				}


				elseif($input_name=="custpack_score_incl_1_start" && trim($input_value)!="")
				{
					$fieldName = "customers_ref";
					$fieldValue = $input_value;
					

					$arrayJoinTable[] = ' customers ';

					$pdo_fieldname[] = " ".$fieldName." IN ( SELECT `custpackfeedback_customer_ref` FROM `custpackfeedback` WHERE `custpackfeedback_status_id` = 1  AND  (`custpackfeedback_wine_1_smell` = '1'  OR `custpackfeedback_wine_1_taste` = '1'  OR `custpackfeedback_wine_1_overall` = '1'  OR `custpackfeedback_wine_2_smell` = '1'  OR `custpackfeedback_wine_2_taste` = '1'  OR `custpackfeedback_wine_2_overall` = '1'  OR `custpackfeedback_wine_3_smell` = '1'  OR `custpackfeedback_wine_3_taste` = '1'  OR `custpackfeedback_wine_3_overall` = '1'  OR `custpackfeedback_wine_4_smell` = '1'  OR `custpackfeedback_wine_4_taste` = '1'  OR `custpackfeedback_wine_4_overall` = '1' ) GROUP BY custpackfeedback_customer_ref HAVING COUNT(1) >= ".$fieldValue." )";
					// $pdo_fieldvalue[":".$input_name] = $fieldValue;
				}
				elseif($input_name=="custpack_score_incl_1_end" && trim($input_value)!="")
				{
					$fieldName = "customers_ref";
					$fieldValue = $input_value;
					

					$arrayJoinTable[] = ' customers ';

					$pdo_fieldname[] = " ".$fieldName." IN ( SELECT `custpackfeedback_customer_ref` FROM `custpackfeedback` WHERE `custpackfeedback_status_id` = 1  AND  (`custpackfeedback_wine_1_smell` = '1'  OR `custpackfeedback_wine_1_taste` = '1'  OR `custpackfeedback_wine_1_overall` = '1'  OR `custpackfeedback_wine_2_smell` = '1'  OR `custpackfeedback_wine_2_taste` = '1'  OR `custpackfeedback_wine_2_overall` = '1'  OR `custpackfeedback_wine_3_smell` = '1'  OR `custpackfeedback_wine_3_taste` = '1'  OR `custpackfeedback_wine_3_overall` = '1'  OR `custpackfeedback_wine_4_smell` = '1'  OR `custpackfeedback_wine_4_taste` = '1'  OR `custpackfeedback_wine_4_overall` = '1' ) GROUP BY custpackfeedback_customer_ref HAVING COUNT(1) <= ".$fieldValue." )";
					// $pdo_fieldvalue[":".$input_name] = $fieldValue;
				}
				elseif($input_name=="custpack_score_incl_5_start" && trim($input_value)!="")
				{
					$fieldName = "customers_ref";
					$fieldValue = $input_value;
					

					$arrayJoinTable[] = ' customers ';

					$pdo_fieldname[] = " ".$fieldName." IN ( SELECT `custpackfeedback_customer_ref` FROM `custpackfeedback` WHERE `custpackfeedback_status_id` = 1  AND  (`custpackfeedback_wine_1_smell` = '5'  OR `custpackfeedback_wine_1_taste` = '5'  OR `custpackfeedback_wine_1_overall` = '5'  OR `custpackfeedback_wine_2_smell` = '5'  OR `custpackfeedback_wine_2_taste` = '5'  OR `custpackfeedback_wine_2_overall` = '5'  OR `custpackfeedback_wine_3_smell` = '5'  OR `custpackfeedback_wine_3_taste` = '5'  OR `custpackfeedback_wine_3_overall` = '5'  OR `custpackfeedback_wine_4_smell` = '5'  OR `custpackfeedback_wine_4_taste` = '5'  OR `custpackfeedback_wine_4_overall` = '5' ) GROUP BY custpackfeedback_customer_ref HAVING COUNT(1) >= ".$fieldValue." )";
					// $pdo_fieldvalue[":".$input_name] = $fieldValue;
				}
				elseif($input_name=="custpack_score_incl_5_end" && trim($input_value)!="")
				{
					$fieldName = "customers_ref";
					$fieldValue = $input_value;
					

					$arrayJoinTable[] = ' customers ';

					$pdo_fieldname[] = " ".$fieldName." IN ( SELECT `custpackfeedback_customer_ref` FROM `custpackfeedback` WHERE `custpackfeedback_status_id` = 1  AND  (`custpackfeedback_wine_1_smell` = '5'  OR `custpackfeedback_wine_1_taste` = '5'  OR `custpackfeedback_wine_1_overall` = '5'  OR `custpackfeedback_wine_2_smell` = '5'  OR `custpackfeedback_wine_2_taste` = '5'  OR `custpackfeedback_wine_2_overall` = '5'  OR `custpackfeedback_wine_3_smell` = '5'  OR `custpackfeedback_wine_3_taste` = '5'  OR `custpackfeedback_wine_3_overall` = '5'  OR `custpackfeedback_wine_4_smell` = '5'  OR `custpackfeedback_wine_4_taste` = '5'  OR `custpackfeedback_wine_4_overall` = '5' ) GROUP BY custpackfeedback_customer_ref HAVING COUNT(1) <= ".$fieldValue." )";
					// $pdo_fieldvalue[":".$input_name] = $fieldValue;
				}



			}
		}


		$arrayJoinTable = array_unique($arrayJoinTable);


		$tablesFromList =  implode(" LEFT JOIN ",$arrayJoinTable);

		$query_input = "";
		$query_input = implode(" AND ",$pdo_fieldname);

		if($query_input=="")
		{
			$query_input = "1";
		}

		if(isset($_POST['show_level']) && isset($_POST['com_generator_name']) && $_POST['show_level']=='4' && trim($_POST['com_generator_name'])!="")
		{

			////////////////
			// Get Total
			////////////////
			try
			{
				$querySelect = 	"SELECT 
								COUNT(DISTINCT customers_ref) as total ,
								IFNULL(group_concat( DISTINCT customers_id ),'') as totalCustomers
						 	FROM 
								".$tablesFromList."
						 	WHERE 
						 		".$query_input;

				$sth = $PDO->prepare($querySelect, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
				$sth->execute($pdo_fieldvalue);			

				$temp_data = $sth->fetch(PDO::FETCH_ASSOC);

				$com_generator_total = $temp_data['total'];
				$com_generator_customers_id = $temp_data['totalCustomers'];
			}
			catch(PDOException $e)
			{
				echo "Error: ".__LINE__. $e->getMessage();
			}
			


			$com_generator_ref = random_reference();
			try
			{
				$query = 	"INSERT INTO
							com_generator
							SET
							com_generator_created 				= :com_generator_created,
							com_generator_modified 			= :com_generator_modified,
							com_generator_ref 					= :com_generator_ref,
							com_generator_status_id 			= :com_generator_status_id,
							com_generator_name 				= :com_generator_name,
							com_generator_communication_ref 			= :com_generator_communication_ref,
							com_generator_total 				= :com_generator_total,
							com_generator_jsondata 			= :com_generator_jsondata,
							com_generator_customers_id 		= :com_generator_customers_id";
				
				$sth = $PDO_WRITE->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));

				$sth->execute(
					array(
						':com_generator_created' =>date('Y-m-d H:i:s'),
						':com_generator_modified' => date('Y-m-d H:i:s'),
						':com_generator_ref' => $com_generator_ref,
						':com_generator_status_id' => '1',
						':com_generator_name' => $_POST['com_generator_name'],
						':com_generator_communication_ref' => $_POST['com_generator_name'],
						':com_generator_total' => $com_generator_total,
						':com_generator_jsondata' => $requestThroughPostToSave,
						':com_generator_customers_id' => $com_generator_customers_id
					));
			}
			catch(PDOException $e)
			{
				echo "Error: " . __LINE__. $e->getMessage();
			}	
		}

		if(isset($_POST['show_level']) && isset($_POST['com_generator_name']) && $_POST['show_level']=='5' && trim($_POST['com_generator_name'])!="" && trim($_POST['customers_add_to_custpack'])=="1" && trim($com_generator_customers_id)!="")
		{

			////////////////
			// Get Total
			////////////////

			$packCode = getCommunicationCodeOnly($_POST['com_generator_name']);

			try
			{
				$query = 	"INSERT INTO
							custcom
							( `custcom_created`,
							  `custcom_modified`,
							  `custcom_status_id`,
							  `custcom_ref`,
							  `custcom_name`,
							  `custcom_customer_ref`,
							  `custcom_communication_ref`)
							SELECT 
							   NOW(),
							   NOW(),
							   '1',
							   UUID(),
							   :custcom_name ,
							   customers_ref,
							   :custcom_communication_ref
							FROM 
							   customers
							WHERE
							   customers_id IN (".$com_generator_customers_id.");
							  ";
				
				$sth = $PDO_WRITE->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));

				$sth->execute(
					array(
						':custcom_name' => $packCode,
						':custcom_communication_ref' => $_POST['com_generator_name']
					));
			}
			catch(PDOException $e)
			{
				echo "Error: " . __LINE__. $e->getMessage();
			}	
		}



		if(isset($_POST['show_level']) && isset($_POST['com_generator_name']) && $_POST['show_level']=='3' && trim($_POST['com_generator_name'])!="")
		{
			////////////////
			// Get Total
			////////////////
			try
			{
				$query = 	"SELECT 
								COUNT(DISTINCT customers_ref) as total
						 	FROM 
								".$tablesFromList."
						 	WHERE 
						 		".$query_input;
				//echo "<PRE>";die($query);

				$sth = $PDO->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
				$sth->execute($pdo_fieldvalue);			

				$temp_data = $sth->fetch(PDO::FETCH_ASSOC);
			}
			catch(PDOException $e)
			{
				echo "Error: ".__LINE__. $e->getMessage();
			}
			$RETURN['total_customers_found'] = $temp_data['total'];
		}




	}
	catch(PDOException $e)
	{
		//echo "Error: " . __LINE__. $e->getMessage();
		$RETURN['error'] = "Error: " . __LINE__. $e->getMessage();
	}

	return json_encode($RETURN);

}

$response_data = json_decode(com_generator_fetch_getdata());


?>