<?php

include_once('../custom/globals-without-login.php');


$REF = $_REQUEST['ref'];

$PAGE = ($_REQUEST['p']) ? $_REQUEST['p'] : 1;
$ROWS_PER_PAGE = ($_REQUEST['r']) ? $_REQUEST['r'] :ROWS_PER_PAGE;

$SORTING_FIELD = $_REQUEST['sf'];
$SORTING_FIELD = ($_REQUEST['sf']) ? $_REQUEST['sf'] : "customers_created";
$SORT_ORDER = ($_REQUEST['so']) ? $_REQUEST['so'] : "ASC";

$SHOW_FILTER = "1";
$PAGE_COUNT = 1;

function customers_fetch_getdata()
{
	/* //////////////////////////////// */
	/*  PAGINATION CALCULATION START    */
	/* //////////////////////////////// */

	global $PDO,$PDO_WRITE;
	global $REF, $PAGE, $ROWS_PER_PAGE, $SORTING_FIELD, $SORT_ORDER;
	global $SHOW_FILTER, $PAGE_COUNT;

	$STARTING_LIMIT = ($PAGE - 1) * $ROWS_PER_PAGE;

	/* //////////////////////////////// */
	/*  PAGINATION CALCULATION END      */
	/* //////////////////////////////// */

	$RETURN = array();

	$ONLY_DEFAULT_FILTER = false;

	if(!(isset($_REQUEST['customers_status_id'])))
	{
	  $_REQUEST['customers_status_id'] = '1';

	  $ONLY_DEFAULT_FILTER = true;
	}
	
	try 
	{
		$query = 	"SELECT 
						branch_ref,
						branch_name,
						branch_code
				 	FROM 
						branch
				 	WHERE 
				 		branch_status_id = :branch_status_id
					ORDER BY 
						branch_name ASC";
		$sth = $PDO->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		$temp_array = array();
		$pdo_fieldvalue = array(':branch_status_id' => '1');

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
			$RETURN['branch'] = $temp_array;

		}
	}
	catch(PDOException $e)
	{
		//echo "Error: " . __LINE__. $e->getMessage();
		$RETURN['error'] = "Error: " . __LINE__. $e->getMessage();
	}
	
	try 
	{
		$query = 	"SELECT 
						country_ref,
						country_name
				 	FROM 
						country
				 	WHERE 
				 		country_status_id = :country_status_id
					ORDER BY 
						country_name ASC";
		$sth = $PDO->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		$temp_array = array();
		$pdo_fieldvalue = array(':country_status_id' => '1');

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
			$RETURN['country'] = $temp_array;

		}
	}
	catch(PDOException $e)
	{
		//echo "Error: " . __LINE__. $e->getMessage();
		$RETURN['error'] = "Error: " . __LINE__. $e->getMessage();
	}
	
	try 
	{
		$query = 	"SELECT 
						source_ref,
						source_name
				 	FROM 
						source
				 	WHERE 
				 		source_status_id = :source_status_id
					ORDER BY 
						source_name ASC";
		$sth = $PDO->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		$temp_array = array();
		$pdo_fieldvalue = array(':source_status_id' => '1');

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
			$RETURN['source'] = $temp_array;

		}
	}
	catch(PDOException $e)
	{
		//echo "Error: " . __LINE__. $e->getMessage();
		$RETURN['error'] = "Error: " . __LINE__. $e->getMessage();
	}
	
	try 
	{

		$pdo_fieldname = array();
		$pdo_fieldvalue = array();

		foreach($_REQUEST as $input_name=>$input_value)
		{
			if(trim($input_value)!="")
			{
				
				//if($input_name != 'customers_ref' && strpos($input_name,'customers')===0)
				if($input_name=="customers_name")
				{
					$ONLY_DEFAULT_FILTER = false;

					$pdo_fieldname[] = "\t\t".'concat(customers_firstname," ",customers_lastname)'." LIKE :".$input_name."";
					$pdo_fieldvalue[":".$input_name] = mysql_real_escape_string_function(strip_tags(("%".trim($input_value)."%"), '<p><font><span><div><ul><li><br><table><thead><tbody><th><tr><td>'));
				}
				else if($input_name=="customers_company" || $input_name=="customers_cohort")
				{

					$pdo_fieldname[] = "\t\t".mysql_real_escape_string_function($input_name)." LIKE :".$input_name."";
					$pdo_fieldvalue[":".$input_name] = mysql_real_escape_string_function(strip_tags(trim('%'.$input_value.'%'), '<p><font><span><div><ul><li><br><table><thead><tbody><th><tr><td>'));
				}
				else if($input_name=="customers_created_start")
				{

					$pdo_fieldname[] = "\t\t"."customers_created"." >= :".$input_name."";
					$pdo_fieldvalue[":".$input_name] = mysql_real_escape_string_function(strip_tags(trim($input_value), '<p><font><span><div><ul><li><br><table><thead><tbody><th><tr><td>'));
				}
				else if($input_name=="customers_created_end")
				{

					$pdo_fieldname[] = "\t\t"."customers_created"." <= :".$input_name."";
					$pdo_fieldvalue[":".$input_name] = mysql_real_escape_string_function(strip_tags(trim($input_value), '<p><font><span><div><ul><li><br><table><thead><tbody><th><tr><td>'));
				}
				else if(strpos($input_name,'customers_')===0)
				{
					if($input_name != "customers_status_id")
					{
						$ONLY_DEFAULT_FILTER = false;
					}

					$pdo_fieldname[] = "\t\t".mysql_real_escape_string_function($input_name)." = :".$input_name."";
					$pdo_fieldvalue[":".$input_name] = mysql_real_escape_string_function(strip_tags(trim($input_value), '<p><font><span><div><ul><li><br><table><thead><tbody><th><tr><td>'));
				}
			}
		}

		$query_input = "";
		$query_input = implode(" AND ",$pdo_fieldname);

		$SHOW_FILTER = "1";
		if($query_input=="")
		{
			$query_input = "1";
			$SHOW_FILTER = "0";
		}
		if($ONLY_DEFAULT_FILTER)
		{
			$SHOW_FILTER = "0";
		}




		////////////////
		// Get Total
		////////////////
		try
		{
			$query = 	"SELECT 
							COUNT(DISTINCT customers_id) as total
					 	FROM 
							customers
					 	WHERE 
					 		".$query_input;

			$sth = $PDO->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
			$sth->execute($pdo_fieldvalue);			

			$temp_data = $sth->fetch(PDO::FETCH_ASSOC);
		}
		catch(PDOException $e)
		{
			echo "Error: ".__LINE__. $e->getMessage();
		}
		$count = $temp_data['total'];

	    $PAGE_COUNT = intval(ceil($count/$ROWS_PER_PAGE));
	    if(($PAGE_COUNT==INF) || ($PAGE_COUNT==NAN) || ($PAGE_COUNT <= 0)){$PAGE_COUNT = 1;}


		////////////////
		// Get Total
		////////////////


		$query = 	"SELECT 
						customers.*,
						concat(customers_firstname,' ',customers_lastname) as customers_name
				 	FROM 
						customers
				 	WHERE 
				 		".$query_input." 
					ORDER BY 
						$SORTING_FIELD $SORT_ORDER
					LIMIT 
						$STARTING_LIMIT , $ROWS_PER_PAGE";

		// echo $query;
		// die();

		$sth = $PDO->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));

		$temp_array = array();

		if($sth->execute($pdo_fieldvalue))
		{
			while($row = $sth->fetch(PDO::FETCH_ASSOC))
			{
				$row['customers_note'] = str_replace(array('\r', '\n'), array(chr(13), chr(10)), $row['customers_note']);
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
			$RETURN['data'] = $temp_array;
			$RETURN['error'] = "";

		}
	}
	catch(PDOException $e)
	{
		//echo "Error: " . __LINE__. $e->getMessage();
		$RETURN['error'] = "Error: " . __LINE__. $e->getMessage();
	}

	return json_encode($RETURN);

}

$response_data = json_decode(customers_fetch_getdata());


?>