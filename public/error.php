<!DOCTYPE html>

<?php
include_once __DIR__ . '/../src/classes/Main.php';
include_once __DIR__ . '/../src/classes/Locales.php';

use nebulr\Main;
use nebulr\Locales;

$main = new Main();
$locales = new Locales();

$locale = $locales->getLocale();

include_once __DIR__ . '/../src/routes.php';
$error = $main->errorCode()
?>

<html lang='<?= $locale['LOCALE_CODE'] ?>'>

<head>
    <title><?= $error[0] ?></title>
    <?php include_once __DIR__ . '/../src/templates/components/head.php' ?>

    <link rel='canonical' href='<?= $main->getURL() ?>'>
</head>

<body>

<main class='main-text-medium'>
    <nav id='top-buttons'>
        <a id='back-button' href='/'><div class='border-button no-highlight'>
                <i class='fas fa-chevron-circle-left'></i> <?= $locale['GO_BACK'] ?>
            </div></a>
    </nav>

    <section>
        <p class='title color-white weight-bold no-highlight'><?= $error[0] ?></p>
        <div class='text-light justify align-center'>
            <h1><?= $error[1] ?></h1>
        </div>
    </section>
</main>

<?php include_once __DIR__ . '/../src/templates/components/footer.php' ?>

</body>

</html>