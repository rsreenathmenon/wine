<?php

include_once('../custom/globals-without-login.php');



if($json = json_decode(file_get_contents("php://input"), true)) {
      // print_r($json);
      $data = $json;
  } else {
      // print_r($_POST);
      $data = $_POST;
  }


extract($data);

if($eventname == "\\core\\event\\user_enrolment_created")
{
	$CUSTOMER_MOODLE_ID = $relateduserid;
	$COURSE_ID = $courseid;

	$CUST_REF = "";
	$COURSE_REF = "";

	$result_array['objecttable'] = "user_enrolments";
	$result_array['CUSTOMER_MOODLE_ID'] = $relateduserid;
	$result_array['COURSE_ID'] = $courseid;


	/*
	*************************************************************
	GET CUSTOMER REF - START
	*************************************************************
	*/
	$CUST_REF = getCustomersRefOnlyMoodle($CUSTOMER_MOODLE_ID);

	if($CUST_REF == "")
	{
		$CUST_EMAIL = getCustomersEmailAPI($CUSTOMER_MOODLE_ID);

		if($CUST_EMAIL != "")
		{
			$CUST_REF = getCustomersRefOnly($CUST_EMAIL);
		}
	}

	$result_array['CUST_REF'] = $CUST_REF;

	/*
	*************************************************************
	GET CUSTOMER REF - END
	*************************************************************
	*/


	
	/*
	*************************************************************
	GET COURSE REF - START
	*************************************************************
	*/
	$COURSE_REF = getCourseDetailsMoodle($COURSE_ID);

	if($COURSE_REF == "")
	{
		$COURSE_ARRAY = getCourseDetailsAPI($COURSE_ID);

		if($COURSE_ARRAY['course_name'] != "")
		{
			$COURSECATEGORY_REF = getCourseCategoryDetailsMoodle($COURSE_ARRAY);
			if($COURSECATEGORY_REF != "")
			{
				$COURSE_REF = addCourseForRef($COURSE_ID, $COURSECATEGORY_REF, $COURSE_ARRAY);
			}
		}
	}

	$result_array['COURSE_REF'] = $COURSE_REF;

	/*
	*************************************************************
	GET COURSE REF - END
	*************************************************************
	*/



	/*
	*************************************************************
	ADD COURSE TO CUSTOMER - START
	*************************************************************
	*/

	if(($COURSE_REF !="") && ($CUST_REF != ""))
	{
		$custcourse_ref = addCourseToCustomer($CUST_REF, $COURSE_REF);


	$result_array['customer_ref'] = $CUST_REF;
	$result_array['course_ref'] = $COURSE_REF;
	$result_array['custcourse_ref'] = $custcourse_ref;

	}

	/*
	*************************************************************
	ADD COURSE TO CUSTOMER - END
	*************************************************************
	*/




	$strTo = "avron@rubaywines.com";
	$strTo = "rsreenathmenon@gmail.com";
	$strSubject = "Call to API of RubayWines";
	$message = json_encode($result_array);

	//SendGridSentEmail($strTo,$strSubject,$message);
}
else if($eventname == "\\core\\event\\user_enrolment_deleted")
{
	$CUSTOMER_MOODLE_ID = $relateduserid;
	$COURSE_ID = $courseid;

	$CUST_REF = "";
	$COURSE_REF = "";

	$result_array['objecttable'] = "user_enrolments";
	$result_array['CUSTOMER_MOODLE_ID'] = $relateduserid;
	$result_array['COURSE_ID'] = $courseid;


	/*
	*************************************************************
	GET CUSTOMER REF - START
	*************************************************************
	*/
	$CUST_REF = getCustomersRefOnlyMoodle($CUSTOMER_MOODLE_ID);

	if($CUST_REF == "")
	{
		$CUST_EMAIL = getCustomersEmailAPI($CUSTOMER_MOODLE_ID);

		if($CUST_EMAIL != "")
		{
			$CUST_REF = getCustomersRefOnly($CUST_EMAIL);
		}
	}

	$result_array['CUST_REF'] = $CUST_REF;

	/*
	*************************************************************
	GET CUSTOMER REF - END
	*************************************************************
	*/


	
	/*
	*************************************************************
	GET COURSE REF - START
	*************************************************************
	*/
	$COURSE_REF = getCourseDetailsMoodle($COURSE_ID);

	if($COURSE_REF == "")
	{
		$COURSE_ARRAY = getCourseDetailsAPI($COURSE_ID);

		if($COURSE_ARRAY['course_name'] != "")
		{
			$COURSECATEGORY_REF = getCourseCategoryDetailsMoodle($COURSE_ARRAY);
			if($COURSECATEGORY_REF != "")
			{
				$COURSE_REF = addCourseForRef($COURSE_ID, $COURSECATEGORY_REF, $COURSE_ARRAY);
			}
		}
	}

	$result_array['COURSE_REF'] = $COURSE_REF;

	/*
	*************************************************************
	GET COURSE REF - END
	*************************************************************
	*/



	/*
	*************************************************************
	ADD COURSE TO CUSTOMER - START
	*************************************************************
	*/

	if(($COURSE_REF !="") && ($CUST_REF != ""))
	{
		deleteCourseToCustomer($CUST_REF, $COURSE_REF);


		$result_array['customer_ref'] = $CUST_REF;
		$result_array['course_ref'] = $COURSE_REF;

	}

	/*
	*************************************************************
	ADD COURSE TO CUSTOMER - END
	*************************************************************
	*/




	$strTo = "avron@rubaywines.com";
	$strTo = "rsreenathmenon@gmail.com";
	$strSubject = "Call to API of RubayWines";
	$message = json_encode($result_array);

	//SendGridSentEmail($strTo,$strSubject,$message);
}
else if($eventname == "\\core\\event\\course_completed")
{
	$CUSTOMER_MOODLE_ID = $relateduserid;
	$COURSE_ID = $courseid;

	$CUST_REF = "";
	$COURSE_REF = "";

	$result_array['objecttable'] = "user_enrolments";
	$result_array['CUSTOMER_MOODLE_ID'] = $relateduserid;
	$result_array['COURSE_ID'] = $courseid;


	/*
	*************************************************************
	GET CUSTOMER REF - START
	*************************************************************
	*/
	$CUST_REF = getCustomersRefOnlyMoodle($CUSTOMER_MOODLE_ID);

	if($CUST_REF == "")
	{
		$CUST_EMAIL = getCustomersEmailAPI($CUSTOMER_MOODLE_ID);

		if($CUST_EMAIL != "")
		{
			$CUST_REF = getCustomersRefOnly($CUST_EMAIL);
		}
	}

	$result_array['CUST_REF'] = $CUST_REF;

	/*
	*************************************************************
	GET CUSTOMER REF - END
	*************************************************************
	*/


	
	/*
	*************************************************************
	GET COURSE REF - START
	*************************************************************
	*/
	$COURSE_REF = getCourseDetailsMoodle($COURSE_ID);

	if($COURSE_REF == "")
	{
		$COURSE_ARRAY = getCourseDetailsAPI($COURSE_ID);

		if($COURSE_ARRAY['course_name'] != "")
		{
			$COURSECATEGORY_REF = getCourseCategoryDetailsMoodle($COURSE_ARRAY);
			if($COURSECATEGORY_REF != "")
			{
				$COURSE_REF = addCourseForRef($COURSE_ID, $COURSECATEGORY_REF, $COURSE_ARRAY);
			}
		}
	}

	$result_array['COURSE_REF'] = $COURSE_REF;

	/*
	*************************************************************
	GET COURSE REF - END
	*************************************************************
	*/



	/*
	*************************************************************
	ADD COURSE TO CUSTOMER - START
	*************************************************************
	*/

	if(($COURSE_REF !="") && ($CUST_REF != ""))
	{
		completeCourseToCustomer($CUST_REF, $COURSE_REF);


		$result_array['customer_ref'] = $CUST_REF;
		$result_array['course_ref'] = $COURSE_REF;

	}

	/*
	*************************************************************
	ADD COURSE TO CUSTOMER - END
	*************************************************************
	*/




	$strTo = "avron@rubaywines.com";
	$strTo = "rsreenathmenon@gmail.com";
	$strSubject = "Call to API of RubayWines";
	$message = json_encode($result_array);

	//SendGridSentEmail($strTo,$strSubject,$message);
}


?>