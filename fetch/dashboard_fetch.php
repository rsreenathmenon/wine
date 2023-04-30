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

	$CURRENT_DATE_TIME = date('Y-m-d H:i:s');
	$CURRENT_DATE_TIME_STR_TO_TIME = strtotime($CURRENT_DATE_TIME);

	$SEVEN_DAY_OLD_DATE_TIME = date('Y-m-d H:i:s', strtotime("-7 day", $CURRENT_DATE_TIME_STR_TO_TIME));


	/* //////////////////////////////// */
	/*  PAGINATION CALCULATION END      */
	/* //////////////////////////////// */

	$RETURN = array();
	
	/*  CUSTOMER Registration Type  */
	$fieldName = 'customers_regtype';
	$groupByName = 'customers_regtype';
	$startDateTime = false;
	$endDateTime = false;
	$connectingTable = false;
	$connectingField = false;
	$FETCHED_DATA = getDashboardDetailsCustomerRelated($fieldName, $groupByName, $startDateTime, $endDateTime, $connectingTable, $connectingField);
	$FETCHED_DATA = calculateTotalOfDashData($FETCHED_DATA);
	$RETURN['customers_regtype'] = $FETCHED_DATA;
	
	/*  CUSTOMER Source Type  */
	$fieldName = 'source_name';
	$groupByName = 'source_name';
	$startDateTime = $SEVEN_DAY_OLD_DATE_TIME;
	$endDateTime = false;
	$connectingTable = 'source';
	$connectingField = 'customers_source_ref';
	$FETCHED_DATA = getDashboardDetailsCustomerRelated($fieldName, $groupByName, $startDateTime, $endDateTime, $connectingTable, $connectingField);
	$FETCHED_DATA = calculateTotalOfDashData($FETCHED_DATA);
	$RETURN['source_name'] = $FETCHED_DATA;
	
	/*  CUSTOMER Membership Type  */
	$fieldName = 'customers_memlvl';
	$groupByName = 'customers_memlvl';
	$startDateTime = false;
	$endDateTime = false;
	$connectingTable = false;
	$connectingField = false;
	$FETCHED_DATA = getDashboardDetailsCustomerRelated($fieldName, $groupByName, $startDateTime, $endDateTime, $connectingTable, $connectingField);
	$FETCHED_DATA = calculateTotalOfDashData($FETCHED_DATA);
	$RETURN['customers_memlvl'] = $FETCHED_DATA;
	
	/*  CUSTOMER Membership Type Last 7 days  */
	$fieldName = 'customers_memlvl';
	$groupByName = 'customers_memlvl';
	$startDateTime = $SEVEN_DAY_OLD_DATE_TIME;
	$endDateTime = false;
	$connectingTable = false;
	$connectingField = false;
	$FETCHED_DATA = getDashboardDetailsCustomerRelated($fieldName, $groupByName, $startDateTime, $endDateTime, $connectingTable, $connectingField);
	$FETCHED_DATA = calculateTotalOfDashData($FETCHED_DATA);
	$RETURN['customers_memlvl_last_7'] = $FETCHED_DATA;
	
	/*  CUSTOMER Loyalty Type  */
	$fieldName = 'customers_loyaltylvl';
	$groupByName = 'customers_loyaltylvl';
	$startDateTime = false;
	$endDateTime = false;
	$connectingTable = false;
	$connectingField = false;
	$FETCHED_DATA = getDashboardDetailsCustomerRelated($fieldName, $groupByName, $startDateTime, $endDateTime, $connectingTable, $connectingField);
	$FETCHED_DATA = calculateTotalOfDashData($FETCHED_DATA);
	$RETURN['customers_loyaltylvl'] = $FETCHED_DATA;
	
	/*  CUSTOMER Loyalty Type Last 7 days  */
	$fieldName = 'customers_loyaltylvl';
	$groupByName = 'customers_loyaltylvl';
	$startDateTime = $SEVEN_DAY_OLD_DATE_TIME;
	$endDateTime = false;
	$connectingTable = false;
	$connectingField = false;
	$FETCHED_DATA = getDashboardDetailsCustomerRelated($fieldName, $groupByName, $startDateTime, $endDateTime, $connectingTable, $connectingField);
	$FETCHED_DATA = calculateTotalOfDashData($FETCHED_DATA);
	$RETURN['customers_loyaltylvl_last_7'] = $FETCHED_DATA;
	
	/*  CUSTOMER Gender Type  */
	$fieldName = 'customers_sex';
	$groupByName = 'customers_sex';
	$startDateTime = false;
	$endDateTime = false;
	$connectingTable = false;
	$connectingField = false;
	$FETCHED_DATA = getDashboardDetailsCustomerRelated($fieldName, $groupByName, $startDateTime, $endDateTime, $connectingTable, $connectingField);
	$FETCHED_DATA = calculateTotalOfDashData($FETCHED_DATA);
	$RETURN['customers_sex'] = $FETCHED_DATA;
	
	/*  CUSTOMER OtherDrinkOfChoice Type  */
	$fieldName = 'customers_occas_drink_before_wine';
	$groupByName = 'customers_occas_drink_before_wine';
	$startDateTime = false;
	$endDateTime = false;
	$connectingTable = false;
	$connectingField = false;
	$FETCHED_DATA = getDashboardDetailsCustomerRelated($fieldName, $groupByName, $startDateTime, $endDateTime, $connectingTable, $connectingField);
	$FETCHED_DATA = calculateTotalOfDashData($FETCHED_DATA);
	$RETURN['customers_occas_drink_before_wine'] = $FETCHED_DATA;
	
	/*  CUSTOMER WineStylePref Type  */
	$fieldName = 'customers_fav_wine_1';
	$groupByName = 'customers_fav_wine_1';
	$startDateTime = false;
	$endDateTime = false;
	$connectingTable = false;
	$connectingField = false;
	$FETCHED_DATA = getDashboardDetailsCustomerRelated($fieldName, $groupByName, $startDateTime, $endDateTime, $connectingTable, $connectingField);
	$FETCHED_DATA = calculateTotalOfDashData($FETCHED_DATA);
	$RETURN['customers_fav_wine_1'] = $FETCHED_DATA;
	
	/*  CUSTOMER AvgWineSpend Type  */
	$fieldName = 'customers_avg_sp_per_bot_wine';
	$groupByName = 'customers_avg_sp_per_bot_wine';
	$startDateTime = false;
	$endDateTime = false;
	$connectingTable = false;
	$connectingField = false;
	$FETCHED_DATA = getDashboardDetailsCustomerRelated($fieldName, $groupByName, $startDateTime, $endDateTime, $connectingTable, $connectingField);
	$FETCHED_DATA = calculateTotalOfDashData($FETCHED_DATA);
	$RETURN['customers_avg_sp_per_bot_wine'] = $FETCHED_DATA;
	
	/*  CUSTOMER DrinksPerWeek Type  */
	$fieldName = 'customers_glasses_a_week';
	$groupByName = 'customers_glasses_a_week';
	$startDateTime = false;
	$endDateTime = false;
	$connectingTable = false;
	$connectingField = false;
	$FETCHED_DATA = getDashboardDetailsCustomerRelated($fieldName, $groupByName, $startDateTime, $endDateTime, $connectingTable, $connectingField);
	$FETCHED_DATA = calculateTotalOfDashData($FETCHED_DATA);
	$RETURN['customers_glasses_a_week'] = $FETCHED_DATA;


	/*  CUSTOMER AGE  */
	$RETURN['customers_age'] = array();
	for($i=18;$i<=58;$i=$i+8)
	{
		$DATE_RANGE_START = $i;
		$DATE_RANGE_END = $i+8;
		if($i>=58)
		{
			$DATE_RANGE_END = $i+300;
			$fieldName = $DATE_RANGE_START.'+';
		}
		else
		{
			$fieldName = $DATE_RANGE_START.' - '.($DATE_RANGE_END-1);
		}
		// echo $DATE_START = date('Y-m-d H:i:s', strtotime("-".$DATE_RANGE_END." year", $CURRENT_DATE_TIME_STR_TO_TIME));
		// echo "<BR />";
		// echo $DATE_END = date('Y-m-d H:i:s', strtotime("-".$DATE_RANGE_START." year", $CURRENT_DATE_TIME_STR_TO_TIME));
		// echo "<BR />";
		// echo "<HR />";

		$DATE_START = date('Y-m-d H:i:s', strtotime("-".$DATE_RANGE_END." year", $CURRENT_DATE_TIME_STR_TO_TIME));
		$DATE_END = date('Y-m-d H:i:s', strtotime("-".$DATE_RANGE_START." year", $CURRENT_DATE_TIME_STR_TO_TIME));


		$groupByName = false;
		$startDateTime = $DATE_START;
		$endDateTime = $DATE_END;
		$connectingTable = false;
		$connectingField = false;
		$FETCHED_DATA = getDashboardDetailsCustomerRelatedAge($fieldName, $groupByName, $startDateTime, $endDateTime, $connectingTable, $connectingField);
		array_push($RETURN['customers_age'], $FETCHED_DATA);

	}
	$RETURN['customers_age'] = calculateTotalOfDashData($RETURN['customers_age']);


	/*  CUSTOMER CREATED LINE CHART PER MONTH  */
	$RETURN['customers_created'] = array();
	for($i=0;$i<6;$i++)
	{
		// echo $DATE_START = date('Y-m-01', strtotime("-".$i." month", $CURRENT_DATE_TIME_STR_TO_TIME));
		// echo "<BR />";
		// echo $DATE_END = date('Y-m-t', strtotime("-".$i." month", $CURRENT_DATE_TIME_STR_TO_TIME));
		// echo "<BR />";
		// echo "<HR />";

		$DATE_START = date('Y-m-01', strtotime("-".$i." month", $CURRENT_DATE_TIME_STR_TO_TIME));
		$DATE_END = date('Y-m-t', strtotime("-".$i." month", $CURRENT_DATE_TIME_STR_TO_TIME));

		$fieldName = 'customers_created';
		$groupByName = 'customers_created';
		$startDateTime = $DATE_START;
		$endDateTime = $DATE_END;
		$connectingTable = false;
		$connectingField = false;
		$groupByNeeded = true;
		$FETCHED_DATA = getDashboardDetailsCustomerRelatedDates($fieldName, $groupByName, $startDateTime, $endDateTime, $connectingTable, $connectingField, $groupByNeeded);
		array_unshift($RETURN['customers_created'], $FETCHED_DATA);
	}

	/*  CUSTOMER CREATED LINE CHART TILL THAT MONTH  */
	$RETURN['customers_created_total'] = array();
	for($i=0;$i<6;$i++)
	{
		// echo $DATE_START = date('Y-m-01', strtotime("-".$i." month", $CURRENT_DATE_TIME_STR_TO_TIME));
		// echo "<BR />";
		// echo $DATE_END = date('Y-m-t', strtotime("-".$i." month", $CURRENT_DATE_TIME_STR_TO_TIME));
		// echo "<BR />";
		// echo "<HR />";

		$DATE_START = date('Y-m-01', strtotime("-".$i." month", $CURRENT_DATE_TIME_STR_TO_TIME));
		$DATE_END = date('Y-m-t', strtotime("-".$i." month", $CURRENT_DATE_TIME_STR_TO_TIME));
		
		$fieldName = 'customers_created';
		$groupByName = 'customers_created';
		$startDateTime = false;
		$endDateTime = $DATE_END;
		$connectingTable = false;
		$connectingField = false;
		$groupByNeeded = false;
		$FETCHED_DATA = getDashboardDetailsCustomerRelatedDates($fieldName, $groupByName, $startDateTime, $endDateTime, $connectingTable, $connectingField, $groupByNeeded);
		array_unshift($RETURN['customers_created_total'], $FETCHED_DATA);
	}
	


	return json_encode($RETURN);

}

$response_data = json_decode(customers_fetch_getdata());

// echo "<PRE>";
// print_r($response_data);
// die();

?>