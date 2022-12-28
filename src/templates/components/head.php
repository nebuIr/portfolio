<?php $url = 'https://' . $_SERVER['SERVER_NAME'] ?>

<title><?= $main->getPageTitle($directory, $locale) ?></title>
<meta name='description' content='<?= $locale['DESCRIPTION'] ?>'>
<meta name='og:title' property='og:title' content='<?= $locale['TITLE_LONG'] . ' - ' . $locale['TITLE']?>'>
<meta name='og:description' property='og:description' content='<?= $locale['DESCRIPTION'] ?>'>
<link rel='canonical' href='<?= $url ?>'>

<!-- Basic -->
<meta charset='UTF-8'>
<meta name='viewport' content='width=device-width, initial-scale=1, shrink-to-fit=no, user-scalable=no'>
<link href='/assets/css/style.min.css?<?= substr(md5_file(__DIR__ . '/../../../public/assets/css/style.min.css'), 0, 8) ?>' type='text/css' rel='stylesheet'/>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700;800;900&display=swap" rel="stylesheet">

<!-- Fontawesome -->
<script src="https://kit.fontawesome.com/8119fd0658.js" crossorigin="anonymous"></script>

<!-- Analytics -->
<script async defer data-website-id="a1dfae06-d013-46a2-a498-7b8204beaf3c" src="https://um.nblr.cc/script.js"></script>

<!-- Favicon -->
<link rel='apple-touch-icon' sizes='180x180' href='/assets/img/favicon/apple-touch-icon.png?<?= substr(md5_file(__DIR__ . '/../../../public/assets/img/favicon/apple-touch-icon.png'), 0, 8) ?>'>
<link rel='icon' type='image/png' sizes='32x32' href='/assets/img/favicon/favicon-32x32.png?<?= substr(md5_file(__DIR__ . '/../../../public/assets/img/favicon/favicon-32x32.png'), 0, 8) ?>'>
<link rel='icon' type='image/png' sizes='16x16' href='/assets/img/favicon/favicon-16x16.png?<?= substr(md5_file(__DIR__ . '/../../../public/assets/img/favicon/favicon-16x16.png'), 0, 8) ?>'>
<link rel='manifest' href='/assets/img/favicon/site.webmanifest?<?= substr(md5_file(__DIR__ . '/../../../public/assets/img/favicon/site.webmanifest'), 0, 8) ?>'>
<link rel='mask-icon' href='/assets/img/favicon/safari-pinned-tab.svg?<?= substr(md5_file(__DIR__ . '/../../../public/assets/img/favicon/safari-pinned-tab.svg'), 0, 8) ?>' color='#202225'>
<link rel='shortcut icon' href='/assets/img/favicon/favicon.ico?<?= substr(md5_file(__DIR__ . '/../../../public/assets/img/favicon/favicon.ico'), 0, 8) ?>'>
<meta name='msapplication-TileColor' content='#202225'>
<meta name='msapplication-config' content='/assets/img/favicon/browserconfig.xml'>
<meta name='theme-color' content='#202225'>