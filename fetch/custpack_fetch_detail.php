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
		$query = 	"SELECT 
						pack_ref,
						pack_code,
						pack_name
				 	FROM 
						pack
				 	WHERE 
				 		pack_status_id = :pack_status_id
					ORDER BY 
						pack_name ASC";
		$sth = $PDO->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		$temp_array = array();
		$pdo_fieldvalue = array(':pack_status_id' => '1');

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
			$RETURN['pack'] = $temp_array;

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
						custpack.*
				 	FROM 
						custpack
				 	WHERE 
				 		custpack_ref = :custpack_ref
					ORDER BY 
						$SORTING_FIELD $SORT_ORDER
					LIMIT 
						$STARTING_LIMIT , $ROWS_PER_PAGE";

		// echo $query;
		// die();

		$sth = $PDO->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));

		$temp_array = array();

		$pdo_fieldvalue = array(':custpack_ref' => $REF);

		if($sth->execute($pdo_fieldvalue))
		{
			if($row = $sth->fetch(PDO::FETCH_ASSOC))
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
			else
			{
				$row = array();
				$temp_array = array();

				$row['custpack_customer_ref'] = $CUS;
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