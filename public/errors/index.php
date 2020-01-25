<!DOCTYPE>

<?php include_once __DIR__ . '/../../assets/php/locale.php' ?>
<?php include_once __DIR__ . '/../../assets/php/Components.php' ?>
<?php $components = new Components() ?>
<?php $error = $components->errorCode() ?>

<html lang='<?= $locale['LOCALE_CODE'] ?>'>

<head>
    <title><?= $error[0] ?> - nebulr</title>
    <link rel='canonical' href='<?= 'https://' . $_SERVER['SERVER_NAME'] . '/privacypolicy/' ?>'>

    <?php include_once __DIR__ . '/../assets/html/head.php' ?>
</head>

<body>

<div class='main-text-small'>
    <a id='back-button' href='/'><div class='border-button no-highlight'>
            <i class='fas fa-chevron-circle-left'></i> <?= $locale['GO_BACK'] ?>
        </div></a>
    <p class='title color-white weight-bold no-highlight'><?= $error[0] ?></p>
    <div class='text-light justify align-center'>
        <h1><?= $error[1] ?></h1>
    </div>
</div>
<?php include_once __DIR__ . '/../assets/html/footer.php' ?>
</body>

</html>