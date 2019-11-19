<!DOCTYPE>

<html lang='en'>

<head>
    <?php include($_SERVER['DOCUMENT_ROOT'] . '/assets/html/head.php'); ?>
    <?php include_once($_SERVER['DOCUMENT_ROOT'] . '/assets/php/Components.php'); ?>
</head>

<body>
<?php include($_SERVER['DOCUMENT_ROOT'] . '/assets/html/nav.php'); ?>

<main class='main-text-medium'>
    <p align='center' class='title color-white weight-bold'>nebulr</p>

    <div class='grid'>
        <?php
        $components = new Components();
        $components->renderProjects();
        ?>
    </div>
</main>

<?php include($_SERVER['DOCUMENT_ROOT'] . '/assets/html/footer.php'); ?>

</body>

</html>
