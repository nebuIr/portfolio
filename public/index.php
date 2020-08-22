<!DOCTYPE html>
<?php include_once __DIR__ . '/../src/routes.php' ?>

<?php

include_once __DIR__ . '/../src/classes/Main.php';
include_once __DIR__ . '/../src/classes/Locales.php';
include_once __DIR__ . '/../src/classes/Env.php';

use nebulr\Main;
use nebulr\Locales;
use nebulr\Env;

$main = new Main();
$locales = new Locales();
$env = new Env();

$locale = $locales->getLocale();
?>

<?php $directory = $main->getDirectory() ?>
<html lang='<?= $locale['LOCALE_CODE'] ?>'>

<?php include_once __DIR__ . '/../src/templates/components/head.php' ?>

<body>

<?php getPageContent($directory) ?>

</body>

<?php include_once __DIR__ . '/../src/templates/components/footer.php' ?>

</html>