<?php
header("Content-Type: application/json;charset=utf-8");
?>

<?php
    $str = <<<EOF
{"server_extension":"_________________________________________________________________________________________","request":{"{\"eventname\":\"\\\\core\\\\event\\\\user_enrolment_created\",\"component\":\"core\",\"action\":\"created\",\"target\":\"user_enrolment\",\"objecttable\":\"user_enrolments\",\"objectid\":20,\"crud\":\"c\",\"edulevel\":0,\"contextid\":107,\"contextlevel\":50,\"contextinstanceid\":\"11\",\"userid\":\"2\",\"courseid\":\"11\",\"relateduserid\":\"35\",\"anonymous\":0,\"other\":{\"enrol\":\"manual\"},\"timecreated\":1630736333,\"host\":\"lms_sip-and-learn_com\",\"token\":\"\",\"extra\":\"\"}":""},"request_extension":"_________________________________________________________________________________________","post":{"{\"eventname\":\"\\\\core\\\\event\\\\user_enrolment_created\",\"component\":\"core\",\"action\":\"created\",\"target\":\"user_enrolment\",\"objecttable\":\"user_enrolments\",\"objectid\":20,\"crud\":\"c\",\"edulevel\":0,\"contextid\":107,\"contextlevel\":50,\"contextinstanceid\":\"11\",\"userid\":\"2\",\"courseid\":\"11\",\"relateduserid\":\"35\",\"anonymous\":0,\"other\":{\"enrol\":\"manual\"},\"timecreated\":1630736333,\"host\":\"lms_sip-and-learn_com\",\"token\":\"\",\"extra\":\"\"}":""},"post_extension":"_________________________________________________________________________________________","get":[]}
EOF;
    $str;

    $strUncode = json_decode($str);
?>