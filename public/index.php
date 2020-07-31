<!DOCTYPE>

<?php

use nebulr\Locales;
use nebulr\Components;

include_once __DIR__ . '/../src/classes/Locales.php';
include_once __DIR__ . '/../src/classes/Components.php';
$components = new Components();
$neb_locale = new Locales();

$locale = $neb_locale->getLocale();

?>

<html lang='<?= $locale['LOCALE_CODE'] ?>'>

<head>
    <title><?= $locale['TITLE_LONG'] . ' - ' . $locale['TITLE']?></title>
    <meta name='description' content='<?= $locale['DESCRIPTION'] ?>'>
    <meta name='og:title' property='og:title' content='<?= $locale['TITLE_LONG'] . ' - ' . $locale['TITLE']?>'>
    <meta name='og:description' property='og:description' content='<?= $locale['DESCRIPTION'] ?>'>
    <?php include_once __DIR__ . '/assets/html/head.php' ?>

    <link rel='canonical' href='<?= $url ?>'>
</head>

<body>

<div class='main-text-medium'>
    <h1 class='title color-white weight-bold no-highlight margin-medium-bottom'><img class='title-icon-src center-mobile' src='assets/img/logo/logo.png' alt='logo'>nebulr</h1>

    <div class='align-center margin-xl-bottom-mobile'>
        <a href='mailto:<?= $locale['CONTACT_EMAIL'] ?>'><div class='border-button no-highlight margin-medium-sides'>
                <i class='fas fa-paper-plane'></i> <?= $locale['EMAIL'] ?>
            </div></a>
        <a href='https://github.com/xnebulr' target='_blank'><div class='border-button no-highlight margin-medium-sides'>
                <i class='fab fa-github'></i> Github
            </div></a>
        <a href='https://twitter.com/xnebulr' target='_blank'><div class='border-button no-highlight margin-medium-sides'>
                <i class='fab fa-twitter'></i> Twitter
            </div></a>
    </div>

    <div class='grid'>
        <?php try {
            $components->renderProjects('all');
        } catch (JsonException $e) {
        } ?>
    </div>
</div>

<?php include_once __DIR__ . '/assets/html/footer.php' ?>

</body>

</html>
