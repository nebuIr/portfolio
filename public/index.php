<!DOCTYPE>

<?php include($_SERVER['DOCUMENT_ROOT'] . '/../assets/php/locale.php'); ?>
<html lang='<?php echo $locale['LOCALE_CODE'] ?>'>

<head>
    <title>nebulr</title>
    <meta name='description' content='<?php echo $locale['DESCRIPTION'] ?>'>
    <meta name='og:title' property='og:title' content='<?php echo $locale['TITLE'] ?>'>
    <meta name='og:description' property='og:description' content='<?php echo $locale['DESCRIPTION'] ?>'>

    <?php include($_SERVER['DOCUMENT_ROOT'] . '/assets/html/head.php'); ?>
    <?php include_once($_SERVER['DOCUMENT_ROOT'] . '/../assets/php/Components.php'); ?>
    <?php $components = new Components(); ?>
</head>

<body>

<div class='main-text-medium'>
    <p class='title color-white weight-bold no-highlight margin-medium-bottom'><img class='title-icon-src center-mobile' src='assets/img/logo/logo.png' alt='logo'>nebulr</p>

    <div class='align-center margin-xl-bottom-mobile'>
        <a href='mailto:<?php echo $locale['CONTACT_EMAIL'] ?>'><div class='border-button no-highlight margin-medium-sides'>
                <i class='fas fa-paper-plane'></i> <?php echo $locale['EMAIL'] ?>
            </div></a>
        <a href='https://github.com/xnebulr' target='_blank'><div class='border-button no-highlight margin-medium-sides'>
                <i class='fab fa-github'></i> Github
            </div></a>
        <a href='https://twitter.com/xnebulr' target='_blank'><div class='border-button no-highlight margin-medium-sides'>
                <i class='fab fa-twitter'></i> Twitter
            </div></a>
    </div>

    <div class='grid'>
        <?php $components->renderProjects('all'); ?>
    </div>
</div>

<?php include($_SERVER['DOCUMENT_ROOT'] . '/assets/html/footer.php'); ?>

</body>

</html>
