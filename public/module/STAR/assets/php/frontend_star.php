<?php

include_once($_SERVER['DOCUMENT_ROOT'] . '/../module/STAR/assets/php/db_star.php');
$referral = new db_star();

if (isset($_REQUEST['code'])) {
    $code = $_REQUEST['code'];

    if ($code !== '') {
        $referralExists = $referral->exists($code);
        $referralIsValid = $referral->isValid($code);
        if ($referralIsValid) {
            if ($referralExists) {
                $referral->updateCode($code);
                $response = 1;
            } else {
                $referral->addCode($code);
                $response = 0;
            }
        } else {
            $response = 2;
        }
    }

    echo $response;
}