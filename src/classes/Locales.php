<?php

namespace nebulr;

use nebulr\Locales\EN_US;
use nebulr\Locales\DE_DE;

include_once __DIR__ . '/../locales/EN_US.php';
include_once __DIR__ . '/../locales/DE_DE.php';

class Locales
{
    private $locale;

    public function __construct()
    {
        $locale = $this->getDefLocale();
        $def_locale = new EN_US();
        $def_locale_array = $def_locale->getLocale();
        $sel_locale_array = [];

        if ('en' !== $locale) {
            switch ($locale) {
                case 'de':
                    $sel_locale = new DE_DE();
                    $sel_locale_array = $sel_locale->getLocale();
                    break;
            }
        }

        $this->locale = array_merge($def_locale_array, $sel_locale_array);
    }

    public function getDefLocale(): string
    {
        if (!isset($_SESSION)) {
            session_start();
        }
        header('Cache-control: private');

        if (isSet($_GET['hl'])) {
            $locale = $_GET['hl'];

            $_SESSION['hl'] = $locale;

            setcookie('hl', $locale, time() + (3600 * 24 * 30));
        } else {
            $locale = $_SESSION['hl'] ?? $_COOKIE['hl'] ?? 'en';
        }

        return $locale;
    }

    public function getLocale(): array
    {
        return $this->locale;
    }
}