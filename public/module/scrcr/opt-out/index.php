<!DOCTYPE>

<?php include($_SERVER['DOCUMENT_ROOT'] . '/../assets/php/locale.php'); ?>
<html lang='<?php echo $locale['LOCALE_CODE'] ?>'>

<head>
    <title>Privacy Policy - nebulr</title>
    <link rel='canonical' href='<?php echo 'https://' . $_SERVER['SERVER_NAME'] . '/module/scrcr/'; ?>'>

    <link href='../assets/css/frontend.css' type='text/css' rel='stylesheet'/>
    <?php include($_SERVER['DOCUMENT_ROOT'] . '/assets/html/head.php'); ?>
    <?php include($_SERVER['DOCUMENT_ROOT'] . '/../module/scrcr/assets/php/db_scrcr.php'); ?>
    <?php $referral = new db_scrcr(); $referral->optOut() ?>
</head>

<body>

<div class='main-text-medium'>

</div>

</body>

</html>