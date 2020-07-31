<?php

/**
-----------------
Language: English
-----------------
 **/

namespace nebulr\Locales;

class EN_US
{
    public function getLocale(): array
    {
        $locale['LOCALE_TITLE'] = 'English';
        $locale['LOCALE_CODE'] = 'en';

        $locale['LOCALE_CURRENT'] = '?hl=en';
        $locale['LOCALE_SWITCH'] = '?hl=de';
        $locale['LOCALE_SWITCH_CLASS'] = 'flag-de';

        $locale['TITLE'] = 'nebulr';
        $locale['TITLE_LONG'] = 'Web and Coding Projects';
        $locale['DESCRIPTION'] = 'Web and Coding Projects made by nebulr';
        $locale['TITLE_PRIVACY_POLICY'] = 'Privacy Policy - nebulr';

        $locale['GO_BACK'] = 'Go Back';

        $locale['PRIVACY_POLICY'] = 'Privacy Policy';

        $locale['NAV_HOME'] = 'Home';
        $locale['NAV_PROJECTS'] = 'Projects';

        $locale['CREDITS'] = 'This website was created by nebulr';

        $locale['SOCIAL_LINKS'] = 'Social Links';
        $locale['ABOUT'] = 'About';

        $locale['CONTACT_PREFIX'] = 'Contact me via';
        $locale['CONTACT_SUFFIX'] = 'for any commissions or questions';
        $locale['CONTACT_EMAIL'] = 'contact@nebulr.me';
        $locale['EMAIL'] = 'E-Mail';

        $locale['LAST_UPDATED'] = 'Last updated';

        $locale['SUBMIT'] = 'Submit';

        return $locale;
    }
}