<?php

use nebulr\Main;
use nebulr\Locales;
use nebulr\Env;

$main = new Main();
$locales = new Locales();
$env = new Env();

$locale = $locales->getLocale();

$hashCss = $env->getAssetHashCss();
$hashJs = $env->getAssetHashJs();
$hashRes = $env->getAssetHashRes();

?>

<div class='main-text-medium'>
    <h1 class='title color-white weight-bold no-highlight margin-medium-bottom'><img class='title-icon-src center-mobile' src='assets/img/logo/logo.png<?= $hashRes ?>' alt='logo'>nebulr</h1>

    <div class='align-center margin-xl-bottom-mobile'>
        <a href='mailto:<?= $locale['CONTACT_EMAIL'] ?>'><div class='border-button no-highlight margin-medium-sides'>
                <i class='fas fa-paper-plane'></i> <?= $locale['EMAIL'] ?>
            </div></a>
        <a href='https://github.com/nebuIr' target='_blank'><div class='border-button no-highlight margin-medium-sides'>
                <i class='fab fa-github'></i> Github
            </div></a>
        <a href='https://twitter.com/nebulrs' target='_blank'><div class='border-button no-highlight margin-medium-sides'>
                <i class='fab fa-twitter'></i> Twitter
            </div></a>
    </div>

    <div class='grid'>
        <?php $main->renderProjects('all'); ?>
    </div>
</div>