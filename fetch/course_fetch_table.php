<?php

include_once('../custom/globals-without-login.php');


$REF = $_REQUEST['ref'];

$PAGE = ($_REQUEST['p']) ? $_REQUEST['p'] : 1;
$ROWS_PER_PAGE = ($_REQUEST['r']) ? $_REQUEST['r'] :ROWS_PER_PAGE;

$SORTING_FIELD = $_REQUEST['sf'];
$SORTING_FIELD = ($_REQUEST['sf']) ? $_REQUEST['sf'] : "course_created";
$SORT_ORDER = ($_REQUEST['so']) ? $_REQUEST['so'] : "ASC";

$SHOW_FILTER = "1";
$PAGE_COUNT = 1;

function course_fetch_getdata()
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
	
	try 
	{
		$query = 	"SELECT 
						coursecategory_ref,
						coursecategory_name
				 	FROM 
						coursecategory
				 	WHERE 
				 		coursecategory_status_id = :coursecategory_status_id
					ORDER BY 
						coursecategory_name ASC";
		$sth = $PDO->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		$temp_array = array();
		$pdo_fieldvalue = array(':coursecategory_status_id' => '1');

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
			$RETURN['coursecategory'] = $temp_array;

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
				
				//if($input_name != 'course_ref' && strpos($input_name,'course')===0)
				if($input_name=="course_name")
				{
					$pdo_fieldname[] = "\t\t".mysql_real_escape_string_function($input_name)." LIKE :".$input_name."";
					$pdo_fieldvalue[":".$input_name] = mysql_real_escape_string_function(strip_tags(("%".trim($input_value)."%"), '<p><font><span><div><ul><li><br><table><thead><tbody><th><tr><td>'));
				}
				else if(strpos($input_name,'course_')===0)
				{
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




		////////////////
		// Get Total
		////////////////
		try
		{
			$query = 	"SELECT 
							COUNT(DISTINCT course_id) as total
					 	FROM 
							course
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
						course.*,coursecategory_name
				 	FROM 
						course
						LEFT JOIN coursecategory on coursecategory_ref = course_coursecategory_ref
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
				$row['course_note'] = str_replace(array('\r', '\n'), array(chr(13), chr(10)), $row['course_note']);
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

$response_data = json_decode(course_fetch_getdata());


?>