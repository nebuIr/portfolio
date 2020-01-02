<?php $url = 'https://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI']; ?>

<footer class='radius-medium'>
    <p class='text-light'><?php echo $locale['CREDITS']?> <img class="text-icon" src='/../assets/img/logo/logo.svg' alt='logo' height='24px' width='24px'>
        <br><?php echo $locale['CONTACT_PREFIX'] ?> <a class='text-underline' href='mailto:<?php echo $locale['CONTACT_EMAIL'] ?>'><?php echo $locale['EMAIL'] ?></a> <?php echo $locale['CONTACT_SUFFIX'] ?></p>
    <p class='footer-title color-white weight-bold'><?php echo $locale['SOCIAL_LINKS'] ?></p>
    <a href='https://github.com/xnebulr' target='_blank' rel='nofollow'><div class='border-button no-highlight'>
            <i class='fab fa-github'></i> Github
        </div></a>
    <a href='https://twitter.com/xnebulr' target='_blank' rel='nofollow'><div class='border-button no-highlight'>
            <i class='fab fa-twitter'></i> Twitter
        </div></a>
    <a href='https://youtube.com/nebulr' target='_blank' rel='nofollow'><div class='border-button no-highlight'>
            <i class='fab fa-youtube'></i> YouTube
        </div></a><br>
    <p class='footer-title color-white weight-bold'><?php echo $locale['ABOUT'] ?></p>
    <a href='<?php echo $locale['LOCALE_SWITCH'] ?>'><div class='border-button no-highlight align-right flag <?php echo $locale['LOCALE_SWITCH_CLASS'] ?>'>
            <i class='fas fa-language fa-lg hide show-on-hover'></i>
        </div></a>
    <a href='/../privacypolicy'><div class='border-button no-highlight'>
            <i class='fas fa-user-shield'></i> <?php echo $locale['PRIVACY_POLICY'] ?>
        </div></a>
</footer>