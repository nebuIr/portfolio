<?php

/**
-----------------
Language: German
-----------------
 **/

namespace nebulr\Locales;

class DE_DE
{
    public function getLocale(): array
    {
        $locale['LOCALE_TITLE'] = 'Deutsch';
        $locale['LOCALE_CODE'] = 'de';

        $locale['LOCALE_CURRENT'] = '?hl=de';
        $locale['LOCALE_SWITCH'] = '?hl=en';
        $locale['LOCALE_SWITCH_CLASS'] = 'flag-en';

        $locale['TITLE'] = 'nebulr';
        $locale['TITLE_LONG'] = 'Web and Coding Projects';
        $locale['DESCRIPTION'] = 'Web and Coding Projects made by nebulr';
        $locale['TITLE_PRIVACY_POLICY'] = 'Datenschutzerklärung - nebulr';

        $locale['GO_BACK'] = 'Zurück';

        $locale['PRIVACY_POLICY'] = 'Da&shy;ten&shy;schutz&shy;er&shy;klä&shy;rung';

        $locale['NAV_HOME'] = 'Startseite';
        $locale['NAV_PROJECTS'] = 'Projekte';

        $locale['CREDITS'] = 'Diese Webseite wurde erstellt von nebulr';

        $locale['SOCIAL_LINKS'] = 'Soziale Links';
        $locale['ABOUT'] = 'Über';

        $locale['CONTACT_PREFIX'] = 'Kontaktiere mich per';
        $locale['CONTACT_SUFFIX'] = 'für Aufträge oder Fragen';
        $locale['CONTACT_EMAIL'] = 'hello@nblr.dev';
        $locale['EMAIL'] = 'E-Mail';

        $locale['LAST_UPDATED'] = 'Letzte Aktualisierung';

        $locale['SUBMIT'] = 'Senden';

        return $locale;
    }
}