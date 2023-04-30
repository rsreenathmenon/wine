<?php

include_once('../custom/globals-without-login.php');


$REF = $_REQUEST['ref'];
$CUS = $_REQUEST['cus'];

$PAGE = ($_REQUEST['p']) ? $_REQUEST['p'] : 1;
$ROWS_PER_PAGE = ($_REQUEST['r']) ? $_REQUEST['r'] :ROWS_PER_PAGE;

$SORTING_FIELD = $_REQUEST['sf'];
$SORTING_FIELD = ($_REQUEST['sf']) ? $_REQUEST['sf'] : "custpackmystery_created";
$SORT_ORDER = ($_REQUEST['so']) ? $_REQUEST['so'] : "ASC";

$SHOW_FILTER = "1";
$PAGE_COUNT = 1;

function custpackmystery_fetch_getdata()
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
		$query = 	"SELECT 
						custpackmystery.*,
						CONCAT(`customers_firstname`,' ', `customers_lastname`) as customers_fullname
				 	FROM 
						custpackmystery
						LEFT JOIN customers ON customers.customers_ref = custpackmystery_customer_ref
				 	WHERE 
				 		custpackmystery_ref = :custpackmystery_ref
					ORDER BY 
						$SORTING_FIELD $SORT_ORDER
					LIMIT 
						$STARTING_LIMIT , $ROWS_PER_PAGE";

		// echo $query;
		// die();

		$sth = $PDO->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));

		$temp_array = array();

		$pdo_fieldvalue = array(':custpackmystery_ref' => $REF);

		if($sth->execute($pdo_fieldvalue))
		{
			if($row = $sth->fetch(PDO::FETCH_ASSOC))
			{
				$row['custpackmystery_note'] = str_replace(array('\r', '\n'), array(chr(13), chr(10)), $row['custpackmystery_note']);
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
			else
			{
				$row = array();
				$temp_array = array();

				//$row['custpackmystery_customer_ref'] = $CUS;
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

$response_data = json_decode(custpackmystery_fetch_getdata());

?>