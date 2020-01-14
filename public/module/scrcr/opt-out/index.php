<!DOCTYPE>

<?php include_once __DIR__ . '/../../../../assets/php/locale.php' ?>
<html lang='<?= $locale['LOCALE_CODE'] ?>'>

<head>
    <title>Opt-out - nebulr</title>
    <link rel='canonical' href='<?= 'https://' . $_SERVER['SERVER_NAME'] . '/module/scrcr/' ?>'>

    <link href='../assets/css/frontend.css' type='text/css' rel='stylesheet'/>
    <?php include_once __DIR__ . '/../../../assets/html/head.php' ?>
    <?php include_once __DIR__ . '/../../../../module/scrcr/assets/php/db_scrcr.php' ?>
    <?php $referral = new db_scrcr(); $referral->optOut() ?>
</head>

<body>

<div class='main-text-medium'>

</div>

</body>

</html>