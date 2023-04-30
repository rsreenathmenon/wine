<?php

include_once('../custom/globals-without-login.php');


$SHOW_LEVEL = "1";



function report_pack_fetch_getdata()
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

	
	$RETURN['pack'] = getAllActivePackWithPackCode();


	if($SHOW_LEVEL == 2)
	{
		$cal_taste_score = array();
		$cal_smell_score = array();
		$cal_overall_score = array();
		$cal_first_in_pack_score = array();
		$cal_drink_again_score = array();

		$cal_most_expensive_score = array();
		$cal_cheapest_score = array();

		$tot_drink_again_score = 0;
		$tot_count = 0;

		$PACK_REF = $_REQUEST['report_pack_name'];

		for($WINE_SL_NO=1; $WINE_SL_NO<=4; $WINE_SL_NO++)
		{
			$RETURN['customers_fav_wine_'.$WINE_SL_NO] = getWine_detail_from_pack_mapping($PACK_REF, $WINE_SL_NO);
			$RETURN['customers_score_wine_'.$WINE_SL_NO] = getCustomer_feedback_score_for_pack($PACK_REF, $WINE_SL_NO);

			$RETURN['customers_score_wine_'.$WINE_SL_NO]['first_in_pack_score'] = $RETURN['customers_score_wine_'.$WINE_SL_NO]['first_in_pack_score'] * 2;
			$RETURN['customers_score_wine_'.$WINE_SL_NO]['first_in_pack_score'] = $RETURN['customers_score_wine_'.$WINE_SL_NO]['first_in_pack_score'] + $RETURN['customers_score_wine_'.$WINE_SL_NO]['second_in_pack_score'];


			$tempChecker = $RETURN['customers_score_wine_'.$WINE_SL_NO];


			if($tempChecker['total_count'] == 0)
			{
				$RETURN['customers_score_wine_'.$WINE_SL_NO]['taste_score'] = 0;
				$RETURN['customers_score_wine_'.$WINE_SL_NO]['smell_score'] = 0;
				$RETURN['customers_score_wine_'.$WINE_SL_NO]['overall_score'] = 0;
				$RETURN['customers_score_wine_'.$WINE_SL_NO]['first_in_pack_score'] = 0;
				$RETURN['customers_score_wine_'.$WINE_SL_NO]['most_expensive_score'] = 0;
				$RETURN['customers_score_wine_'.$WINE_SL_NO]['cheapest_score'] = 0;


				$tempChecker['taste_score'] = 0;
				$tempChecker['smell_score'] = 0;
				$tempChecker['overall_score'] = 0;
				$tempChecker['first_in_pack_score'] = 0;
				$tempChecker['most_expensive_score'] = 0;
				$tempChecker['cheapest_score'] = 0;

				$tempChecker['total_count'] = 1;

			}

			$cal_taste_score[] = $tempChecker['taste_score'];
			$cal_smell_score[] = $tempChecker['smell_score'];
			$cal_overall_score[] = $tempChecker['overall_score'];
			$cal_first_in_pack_score[] = $tempChecker['first_in_pack_score'];

			$cal_most_expensive_score[] = $tempChecker['most_expensive_score'];
			$cal_cheapest_score[] = $tempChecker['cheapest_score'];

			$tot_drink_again_score = $tempChecker['drink_again_score'];
			$tot_count = $tempChecker['total_count'];


			$tot_drink_again_score = number_format((($tot_drink_again_score / $tot_count) * 100), 2);
			$cal_drink_again_score[] = $tot_drink_again_score;
			$RETURN['customers_score_wine_'.$WINE_SL_NO]['drink_again'] = $tot_drink_again_score;

		}

		$RETURN['cal_taste_score'] 			= calculate_rank($cal_taste_score);
		$RETURN['cal_smell_score'] 			= calculate_rank($cal_smell_score);
		$RETURN['cal_overall_score'] 		= calculate_rank($cal_overall_score);
		$RETURN['cal_first_in_pack_score'] 	= calculate_rank($cal_first_in_pack_score);
		$RETURN['cal_drink_again_score'] 	= calculate_rank($cal_drink_again_score);
		$RETURN['cal_most_expensive_score'] = calculate_rank($cal_most_expensive_score);
		$RETURN['cal_cheapest_score'] 		= calculate_rank($cal_cheapest_score);
		
		// echo "<PRE>";
		// print_r($RETURN);
		// die();
	}
	


	return json_encode($RETURN);

}

$response_data = json_decode(report_pack_fetch_getdata());


?>