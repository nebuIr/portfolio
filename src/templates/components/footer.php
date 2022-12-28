<footer class='radius-medium'>
    <p class='text-light'><?= $locale['CREDITS'] ?> <img class="text-icon" src='/assets/img/logo/logo.svg?<?= substr(md5_file(__DIR__ . '/../../../public/assets/img/logo/logo.svg'), 0, 8) ?>' alt='logo' height='24px' width='24px'>
        <br><?= $locale['CONTACT_PREFIX'] ?> <a class='text-underline' href='mailto:<?= $locale['CONTACT_EMAIL'] ?>'><?= $locale['EMAIL'] ?></a> <?= $locale['CONTACT_SUFFIX'] ?></p>
    <p class='footer-title color-white weight-bold'><?= $locale['SOCIAL_LINKS'] ?></p>
    <a href='https://github.com/nebuIr' target='_blank' rel='nofollow'><div class='border-button no-highlight'>
            <i class='fab fa-github'></i> Github
        </div></a>
    <a href='https://twitter.com/nebulrs' target='_blank' rel='nofollow'><div class='border-button no-highlight'>
            <i class='fab fa-twitter'></i> Twitter
        </div></a>
    <a href='https://youtube.com/nebulr' target='_blank' rel='nofollow'><div class='border-button no-highlight'>
            <i class='fab fa-youtube'></i> YouTube
        </div></a><br>
    <p class='footer-title color-white weight-bold'><?= $locale['ABOUT'] ?></p>
    <a href='<?= $locale['LOCALE_SWITCH'] ?>' rel='nofollow'><div class='border-button no-highlight float-right flag <?= $locale['LOCALE_SWITCH_CLASS'] ?>'>
            <i class='fas fa-language fa-lg hide show-on-hover'></i>
        </div></a>
    <a href='/privacypolicy'><div class='border-button no-highlight'>
            <i class='fas fa-user-shield'></i> <?= $locale['PRIVACY_POLICY'] ?>
        </div></a>
</footer>