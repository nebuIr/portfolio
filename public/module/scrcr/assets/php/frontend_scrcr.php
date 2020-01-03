<?php

include_once($_SERVER['DOCUMENT_ROOT'] . '/../module/scrcr/assets/php/db_scrcr.php');
$referral = new db_scrcr();

if (isset($_REQUEST['code'])) {
    $code = $_REQUEST['code'];

    if ($code !== '') {
        $referralExists = $referral->exists($code);
        $referralIsValid = $referral->isValid($code);
        if (isset($_REQUEST['check'])) {
            if ($referralIsValid) {
                if ($referralExists) {
                    $six_months = 15552000;
                    $timestamp = $referral->getTimestamp($code);
                    $validUntilTimestamp = $timestamp + $six_months;
                    $active = $referral->isActive($code);
                    if ($active) {
                        $response = $validUntilTimestamp;
                    } else {
                        $response = 5;
                    }
                } else {
                    $response = 4;
                }
            } else {
                $response = 2;
            }
        } else if ($referralIsValid) {
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

function getCode() {
    $referral = new db_scrcr();

    if (isset($_REQUEST['referral'])) {
        return checkCode(strtoupper($_REQUEST['referral']));
    }

    return [$referral->getRandomCode(), 1];
}

function checkCode($code) {
    $referral = new db_scrcr();

    $randomCode = $referral->getRandomCode();

    $valid = $referral->isValid($code);
    $exists = $referral->exists($code);
    $active = $referral->isActive($code);

    if ($valid) {
        if ($exists) {
            if ($active) {
                return [$code, 0];
            }

            return [$randomCode, 2];
        }

        return [$randomCode, 3];
    }

    return [$randomCode, 1];
}

function getRandomBackground() {
    $referral = new db_scrcr();

    return $referral->getRandomBackground();
}