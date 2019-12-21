<?php $url = 'https://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI']; ?>

<!-- Basic -->
<meta charset='UTF-8'>
<meta name='viewport' content='width=device-width, initial-scale=1, shrink-to-fit=no'>
<link href='/assets/css/poppins.css' type='text/css' rel='stylesheet'/>
<link href='/assets/css/base.css' type='text/css' rel='stylesheet'/>
<?php include($_SERVER['DOCUMENT_ROOT'] . '/assets/locale/locale.php'); ?>
<html lang='<?php echo $locale['LOCALE_CODE'] ?>'>

<!-- External -->
<script async src='/assets/js/fontawesome.js' crossorigin='anonymous'></script>

<!-- Google Analytics -->
<script async src='https://www.googletagmanager.com/gtag/js?id=UA-68526906-5'></script>
<script async src='/assets/js/gtag.js'></script>

<!-- Favicon -->
<link rel='apple-touch-icon' sizes='180x180' href='/assets/img/favicon/apple-touch-icon.png'>
<link rel='icon' type='image/png' sizes='32x32' href='/assets/img/favicon/favicon-32x32.png'>
<link rel='icon' type='image/png' sizes='16x16' href='/assets/img/favicon/favicon-16x16.png'>
<link rel='manifest' href='/assets/img/favicon/site.webmanifest'>
<link rel='mask-icon' href='/assets/img/favicon/safari-pinned-tab.svg' color='#202225'>
<link rel='shortcut icon' href='/assets/img/favicon/favicon.ico'>
<meta name='msapplication-TileColor' content='#202225'>
<meta name='msapplication-config' content='/assets/img/favicon/browserconfig.xml'>
<meta name='theme-color' content='#202225'>