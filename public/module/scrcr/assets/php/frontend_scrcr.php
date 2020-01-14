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
                    $timestamp = strtotime($referral->getField('last_update', $code));
                    $validUntilTimestamp = $timestamp + $six_months;
                    $active = $referral->getField('active', $code);
                    if ($active) {
                        $response = ['code' => 6, 'timestamp' => $validUntilTimestamp, 'shown' => $referral->getField('shown', $code), 'clicked' => $referral->getField('clicked', $code)];
                    } else {
                        $response = ['code' => 5];
                    }
                } else {
                    $response = ['code' => 4];
                }
            } else {
                $response = ['code' => 2];
            }
        } else if ($referralIsValid) {
            if ($referralExists) {
                $referral->updateCode($code);
                $referral->sendMail($code, 1);
                $response = ['code' => 1];
            } else {
                $referral->addCode($code, $email);
                $referral->sendMail($code, 0);
                $response = ['code' => 0];
            }
        } else {
            $response = ['code' => 2];
        }
    }

    echo json_encode($response);
}

if (isset($_REQUEST['getcodecount'])) {
    echo json_encode(['count' => getCodeCount()]);
}

if (isset($_REQUEST['trackcode'])) {
    $code = $_REQUEST['trackcode'];

    $referral = new db_scrcr();
    $referral->incrementField('clicked', $code);
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
    $active = $referral->getField('active', $code);

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