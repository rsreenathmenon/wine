<?php


$ACCESS_PERMISSION=false;

if((isset($_SERVER['PHP_AUTH_USER']) && isset($_SERVER['PHP_AUTH_PW'])) && ( ($_SERVER['PHP_AUTH_USER'] == "rubaywines" && $_SERVER['PHP_AUTH_PW'] == "GPjsOf!OPjj*hl^rJE51j!1C")))
{
        $ACCESS_PERMISSION=true;
}
else
{
    header("WWW-Authenticate: " ."Basic realm=\"Clarity clinic API \"");
    header("HTTP/1.0 401 Unauthorized");
    print("Provide a valid Username & Password to access this page.");
}

if($ACCESS_PERMISSION==true)
{
	include_once('../custom/globals-without-login.php');

	$result_array 	= array();
	$result_return	= array();


	$result_array['pack_code'] = $_REQUEST["pack"];
	$result_array['customers_email'] = $_REQUEST["email"];

	$result_array['selection'] = $_REQUEST["selection"];

	$result_array['customers_ref'] = getCustomersRefOnly($result_array['customers_email']);

	$selection = explode(",", $result_array['selection']);

	if(in_array("mydetails", $selection))
	{
		$response = getCustomersDetailsMyDetails($result_array['customers_ref']);
		$result_return['mydetails'] = $response;
	}

	if(in_array("myscore", $selection))
	{
		$pack_code_array = getPacksCodeFromFeedback($result_array['customers_ref']);

		$return_array = array();

		for($ijk=0; $ijk < count($pack_code_array); $ijk++)
		{
			$pack_code = $pack_code_array[$ijk];

			$response = getCustomersDetailsMyScore($result_array['customers_ref'],$pack_code);

			$pack_ref = getPacksRefOnly($pack_code);

			$allPackDetails = getPackWineRating($pack_ref);


			$best_wine_array = $allPackDetails['cal_first_in_pack_score'];
			
				$best_wine = array_keys($best_wine_array, min($best_wine_array));
				$response['overall_best_wine'] = $allPackDetails['customers_fav_wine_'.$best_wine[0]]['wine_name'];

				unset($best_wine_array[$best_wine[0]]);		
				$second_best_wine = array_keys($best_wine_array, min($best_wine_array));
				$response['overall_second_best_wine'] = $allPackDetails['customers_fav_wine_'.$second_best_wine[0]]['wine_name'];

			
			$most_expensive_array = $allPackDetails['cal_most_expensive_score'];
				$most_expensive = array_keys($most_expensive_array, min($most_expensive_array));
				$response['overall_most_expensive'] = $allPackDetails['customers_fav_wine_'.$most_expensive[0]]['wine_name'];

			
			$cheapest_array = $allPackDetails['cal_cheapest_score'];
				$cheapest = array_keys($cheapest_array, min($cheapest_array));
				$response['overall_cheapest'] = $allPackDetails['customers_fav_wine_'.$cheapest[0]]['wine_name'];


			$return_array[$pack_code] = $response;

		}

		$result_return['myscore'] = $return_array;
	}

	if(in_array("mymysteryscore", $selection))
	{
		$pack_code_array = getPacksCodeFromFeedbackMystery($result_array['customers_ref']);

		$return_array = array();

		for($ijk=0; $ijk < count($pack_code_array); $ijk++)
		{
			$pack_code = $pack_code_array[$ijk];
			
			$response = getCustomersDetailsMyMysteryScore($result_array['customers_ref'],$pack_code);

			$pack_ref = getPacksRefOnly($pack_code);

			$allPackDetails = getPackWineRating($pack_ref);


			$wine_array = $allPackDetails['customers_fav_wine_4'];
			$response['correct_region'] = $wine_array['region_name'];
			$response['correct_vintage'] = $wine_array['wine_vintage'];
			$response['correct_price'] = $wine_array['wine_price_point'];


			$return_array[$pack_code] = $response;

		}

		$result_return['mymysteryscore'] = $return_array;
	}

	if(in_array("mycourses", $selection))
	{

		$response = getCourseDetailsForACustomerRefAPI($result_array['customers_ref']);

		//$response = array();

		// $responseTemp['course_name'] = 'Wine Basic';
		// $responseTemp['compleated_date'] = '2021-05-08';
		// $response[] = $responseTemp;

		// $responseTemp['course_name'] = 'Wine June21';
		// $responseTemp['compleated_date'] = '2021-06-11';
		// $response[] = $responseTemp;

		// $responseTemp['course_name'] = 'Beer June21';
		// $responseTemp['compleated_date'] = '2021-07-19';
		// $response[] = $responseTemp;

		$result_return['mycourses'] = $response;
	}

	echo json_encode($result_return);

}

			
?>