<?php

if(!isset($_SESSION)) { session_start(); }
header('Cache-control: private'); // IE 6 FIX

if (isSet($_GET['hl'])) {
    $locale = $_GET['hl'];

    $_SESSION['hl'] = $locale;

    setcookie('hl', $locale, time() + (3600 * 24 * 30));
} else if (isSet($_SESSION['hl'])) {
    $locale = $_SESSION['hl'];
} else if (isSet($_COOKIE['hl'])) {
    $locale = $_COOKIE['hl'];
} else {
    $locale = 'en';
}

switch ($locale) {
    case 'en':
        $locale_file = 'en-us.php';
        break;
    case 'de':
        $locale_file = 'de-de.php';
        break;
    default:
        $locale_file = 'en-us.php';
}

include $_SERVER['DOCUMENT_ROOT'] . '/../assets/locale/' . $locale_file;
