<?php

include_once __DIR__ . '/../../../../../module/scrcr/assets/php/db_scrcr.php';
$referral = new db_scrcr();

if (isset($_REQUEST['code'])) {
    $code = $_REQUEST['code'];

    $email = $_REQUEST['email'] ?? null;

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
                $referral->sendMail($code, 1);
                $response = 1;
            } else {
                $referral->addCode($code, $email);
                $referral->sendMail($code, 0);
                $response = 0;
            }
        } else {
            $response = 2;
        }
    }

    echo $response;
}

if (isset($_REQUEST['getcodecount'])) {
    echo getCodeCount();
}

function getCodeCount() {
    $referral = new db_scrcr();

    return $referral->getCodeCount();
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