<!DOCTYPE html>
<?php include_once __DIR__ . '/../src/routes.php' ?>

<?php

include_once __DIR__ . '/../src/classes/Main.php';
include_once __DIR__ . '/../src/classes/Locales.php';

use nebulr\Main;
use nebulr\Locales;

$main = new Main();
$locales = new Locales();

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