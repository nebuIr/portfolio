<?php

if(!isset($_SESSION)) { session_start(); }
header('Cache-control: private');

if (isSet($_GET['hl'])) {
    $locale = $_GET['hl'];

    $_SESSION['hl'] = $locale;

    setcookie('hl', $locale, time() + (3600 * 24 * 30));
} else {
    $locale = $_SESSION['hl'] ?? $_COOKIE['hl'] ?? 'en';
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

include __DIR__ . '/../locale/' . $locale_file;
