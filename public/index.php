<!DOCTYPE>

<?php include_once __DIR__ . '/../assets/php/locale.php' ?>
<html lang='<?= $locale['LOCALE_CODE'] ?>'>

<head>
    <title>nebulr</title>
    <meta name='description' content='<?= $locale['DESCRIPTION'] ?>'>
    <meta name='og:title' property='og:title' content='<?= $locale['TITLE'] ?>'>
    <meta name='og:description' property='og:description' content='<?= $locale['DESCRIPTION'] ?>'>
    <link rel='canonical' href='<?= 'https://' . $_SERVER['SERVER_NAME'] ?>'>

    <?php include_once __DIR__ . '/assets/html/head.php' ?>
    <?php include_once __DIR__ . '/../assets/php/Components.php' ?>
    <?php $components = new Components() ?>
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
        <?php $components->renderProjects('all') ?>
    </div>
</div>

<?php include_once __DIR__ . '/assets/html/footer.php' ?>

</body>

</html>
