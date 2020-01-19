<!DOCTYPE>

<?php include_once __DIR__ . '/../../../assets/php/locale.php' ?>
<?php include_once __DIR__ . '/../../../module/scrcr/assets/php/locale.php' ?>
<html lang='<?= $locale['LOCALE_CODE'] ?>'>

<head>
    <title><?= $locale_scrcr['RANDOMIZER_TITLE'] ?> - nebulr</title>
    <meta name='description' content='<?= $locale_scrcr['RANDOMIZER_DESCRIPTION'] ?>'>
    <meta name='og:title' property='og:title' content='<?= $locale_scrcr['RANDOMIZER_TITLE'] ?> - nebulr'>
    <meta name='og:description' property='og:description' content='<?= $locale_scrcr['RANDOMIZER_DESCRIPTION'] ?>'>
    <link rel='canonical' href='<?= 'https://' . $_SERVER['SERVER_NAME'] ?>'>

    <link href='assets/css/frontend.css' type='text/css' rel='stylesheet'/>
    <script src='assets/js/jquery-3.4.1.min.js'></script>
    <script src='assets/js/frontend_scrcr.js'></script>
    <?php include_once __DIR__ . '/../../assets/html/head.php' ?>
    <?php include_once __DIR__ . '/assets/php/frontend_scrcr.php' ?>
    <?php $code = getCode() ?>
</head>

<body>

<div class='main-text-medium'>
    <a id='back-button' href='<?= $asset_url ?>'><div class='border-button no-highlight'>
            <i class='fas fa-chevron-circle-left'></i> <?= $locale['GO_BACK'] ?>
        </div></a>
    <a href='privacypolicy'><div class='border-button no-highlight float-right'>
            <i class='fas fa-user-shield'></i> <?= $locale['PRIVACY_POLICY'] ?>
        </div></a>

    <h1 class='no-display'><?= $locale_scrcr['RANDOMIZER_TITLE'] ?></h1>

    <h2 class='color-white align-center font-size-medium weight-black margin-semi-large-top'>
        <?php
        if ($code[1] === 0) {
            echo $locale_scrcr['SHARED_REFERRAL'];
        } else {
            echo $locale_scrcr['RANDOMIZER_GET_1'] . '<span id=\'code-count\'>' . getCodeCount() . '</span>' . $locale_scrcr['RANDOMIZER_GET_2'];
        } ?>
    </h2>

    <div class='align-center margin-semi-large-bottom'>
        <a class='a-no-style' href='https://robertsspaceindustries.com/enlist?referral=<?= $code[0] ?>' target='_blank' rel='nofollow' onclick='trackCodeOnClick("<?= $code[0] ?>")'>
            <div class='title color-white weight-bold random-code margin-top-reset'>
                <span><?= $code[0] ?></span>&nbsp;&nbsp;<i class="fas fa-external-link-alt"></i>
                <img class='random-code-background no-highlight' src='assets/img/star-citizen/<?= getRandomBackground() ?>' alt='Star Citizen Background Image' draggable='false'>
            </div>
        </a>

        <br>
        <div id='copyToClipboard' onclick='copyToClipboard()' title='<?= $code[0] ?>' class='border-button-transparent no-highlight margin-medium-sides'>
                <i class='far fa-clipboard'></i> <span id='copyToClipboard-txt'><?= $locale_scrcr['CLIPBOARD'] ?></span>
            </div>
        <p class='text-light margin-semi-medium-top'><?= $locale_scrcr['REFERRAL_CODE_REWARD'] ?> <a class='text-underline' href="https://robertsspaceindustries.com/referral-program" target="_blank" rel="nofollow"><?= $locale_scrcr['HERE'] ?> <i class="fas fa-external-link-alt"></i></a>.</p>
    </div>

    <div id='code-form-container' class='align-center-force code-form'>
        <p class='color-white align-left'><?= $locale_scrcr['RANDOMIZER_SET'] ?></p>

        <form class='align-center'>
            <label><input id='code-input' class='input-field code-input uppercase align-center margin-medium-bottom' type='text' name='code' placeholder='STAR-XXXX-XXXX' spellcheck='false'></label>
            <label id='email-label' class='no-display'><input id='email-input' class='input-field code-input uppercase align-center margin-semi-medium-top margin-medium-sides' type='email' name='email' placeholder='email' spellcheck='false'></label>
            <div id='code-submit' class='border-button margin-large-sides submit-button no-highlight align-center margin-medium-bottom' onclick='submit_code(false)'><?= $locale['SUBMIT'] ?></div>
            <br><label><input id='email-checkbox' type='checkbox' onclick='emailCheckbox()'><span class='color-grey'><?= $locale_scrcr['REFERRAL_EMAIL'] ?></span></label>
        </form>
        <span id='code-check' class='color-white font-size-small text-underline cursor-pointer no-highlight' onclick='submit_code(true)'><?= $locale_scrcr['REFERRAL_CHECK'] ?></span>

        <div id='code-message-container' class='hide'>
            <div id='code-message'></div>
            <div id='code-message-qr'></div>
        </div>
        <p id='code-disclaimer' class='text-light align-left margin-semi-medium-bottom'><?= $locale_scrcr['REFERRAL_CODE_ACTIVE'] ?></p>
    </div>
</div>

</body>

</html>
