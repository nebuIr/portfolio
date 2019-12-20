<!DOCTYPE>

<html lang='en'>

<head>
    <title>nebulr</title>
    <?php include($_SERVER['DOCUMENT_ROOT'] . '/assets/html/head.php'); ?>
    <?php include_once($_SERVER['DOCUMENT_ROOT'] . '/assets/php/Components.php'); ?>
    <?php $components = new Components(); ?>
</head>

<body>

<div class='main-text-medium'>
    <p class='title color-white weight-bold no-highlight'><img class='title-icon-src center-mobile' src='assets/img/logo/logo.png' alt='logo'>nebulr</p>

    <div class='grid'>
        <?php $components->renderProjects('all'); ?>
    </div>
</div>

<?php include($_SERVER['DOCUMENT_ROOT'] . '/assets/html/footer.php'); ?>

</body>

</html>
