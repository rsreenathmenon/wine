<?php

include_once('../custom/globals-without-login.php');


$REF = $_REQUEST['ref'];
$CUS = $_REQUEST['cus'];

$PAGE = ($_REQUEST['p']) ? $_REQUEST['p'] : 1;
$ROWS_PER_PAGE = ($_REQUEST['r']) ? $_REQUEST['r'] :ROWS_PER_PAGE;

$SORTING_FIELD = $_REQUEST['sf'];
$SORTING_FIELD = ($_REQUEST['sf']) ? $_REQUEST['sf'] : "custpack_created";
$SORT_ORDER = ($_REQUEST['so']) ? $_REQUEST['so'] : "ASC";

$SHOW_FILTER = "1";
$PAGE_COUNT = 1;

function custpack_fetch_getdata()
{
	/* //////////////////////////////// */
	/*  PAGINATION CALCULATION START    */
	/* //////////////////////////////// */

	global $PDO,$PDO_WRITE;
	global $REF, $PAGE, $ROWS_PER_PAGE, $SORTING_FIELD, $SORT_ORDER;
	global $SHOW_FILTER, $PAGE_COUNT;

	global $CUS;

	$STARTING_LIMIT = ($PAGE - 1) * $ROWS_PER_PAGE;

	/* //////////////////////////////// */
	/*  PAGINATION CALCULATION END      */
	/* //////////////////////////////// */

	$RETURN = array();
	
	try 
	{

		$pdo_fieldname = array();
		$pdo_fieldvalue = array();

		foreach($_REQUEST as $input_name=>$input_value)
		{
			if(trim($input_value)!="")
			{
				
				//if($input_name != 'custpack_ref' && strpos($input_name,'custpack')===0)
				if($input_name=="custpack_name")
				{
					$pdo_fieldname[] = "\t\t".mysql_real_escape_string_function($input_name)." LIKE :".$input_name."";
					$pdo_fieldvalue[":".$input_name] = mysql_real_escape_string_function(strip_tags(("%".trim($input_value)."%"), '<p><font><span><div><ul><li><br><table><thead><tbody><th><tr><td>'));
				}
				else if(strpos($input_name,'custpack_')===0)
				{
					$pdo_fieldname[] = "\t\t".mysql_real_escape_string_function($input_name)." = :".$input_name."";
					$pdo_fieldvalue[":".$input_name] = mysql_real_escape_string_function(strip_tags(trim($input_value), '<p><font><span><div><ul><li><br><table><thead><tbody><th><tr><td>'));
				}
			}
		}

		$pdo_fieldname[] = "custpack_customer_ref = :custpack_customer_ref";
		$pdo_fieldvalue[":custpack_customer_ref"] = mysql_real_escape_string_function(strip_tags(trim($CUS), '<p><font><span><div><ul><li><br><table><thead><tbody><th><tr><td>'));

		$query_input = implode(" AND ",$pdo_fieldname);

		$SHOW_FILTER = "1";
		if($query_input=="custpack_customer_ref = :custpack_customer_ref")
		{
			$query_input = "custpack_customer_ref = :custpack_customer_ref";
			$SHOW_FILTER = "0";
		}




		////////////////
		// Get Total
		////////////////
		try
		{
			$query = 	"SELECT 
							COUNT(DISTINCT custpack_id) as total
					 	FROM 
							custpack
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
						custpack.*
				 	FROM 
						custpack
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
				$row['custpack_note'] = str_replace(array('\r', '\n'), array(chr(13), chr(10)), $row['custpack_note']);
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

if(! (isset($_REQUEST['cus'])) || (trim($_REQUEST['cus'])==""))
{
	$newURL = HTTP_SERVER."customers.php";
	header('Location: '.$newURL);
	die();
}

$response_data = json_decode(custpack_fetch_getdata());


?>