<!DOCTYPE>

<?php include($_SERVER['DOCUMENT_ROOT'] . '/../assets/php/locale.php'); ?>
<?php include($_SERVER['DOCUMENT_ROOT'] . '/../module/scrcr/assets/php/locale.php'); ?>
<html lang='<?php echo $locale['LOCALE_CODE'] ?>'>

<head>
    <title><?php echo $locale_scrcr['RANDOMIZER_TITLE'] ?> - nebulr</title>
    <meta name='description' content='<?php echo $locale_scrcr['RANDOMIZER_DESCRIPTION'] ?>'>
    <meta name='og:title' property='og:title' content='<?php echo $locale_scrcr['RANDOMIZER_TITLE'] ?> - nebulr'>
    <meta name='og:description' property='og:description' content='<?php echo $locale_scrcr['RANDOMIZER_DESCRIPTION'] ?>'>
    <link rel='canonical' href='<?php echo 'https://' . $_SERVER['SERVER_NAME'] . '/module/scrcr/'; ?>'>

    <link href='assets/css/frontend.css' type='text/css' rel='stylesheet'/>
    <script src='assets/js/jquery-3.4.1.min.js'></script>
    <script src='assets/js/frontend_scrcr.js'></script>
    <?php include($_SERVER['DOCUMENT_ROOT'] . '/assets/html/head.php'); ?>
    <?php include($_SERVER['DOCUMENT_ROOT'] . '/module/scrcr/assets/php/frontend_scrcr.php'); ?>
    <?php $code = getCode() ?>
</head>

<body>

<div class='main-text-medium'>
    <a id='back-button' href='/'><div class='border-button no-highlight'>
            <i class='fas fa-chevron-circle-left'></i> <?php echo $locale['GO_BACK'] ?>
        </div></a>

    <p class='color-white align-center font-size-medium weight-black margin-semi-large-top'><?php if ($code[1] === 0){echo $locale_scrcr['SHARED_REFERRAL'];} else {echo $locale_scrcr['RANDOMIZER_GET'];} ?></p>

    <div class='align-center margin-semi-large-bottom'>
        <a class='a-no-style' href='https://robertsspaceindustries.com/enlist?referral=<?php echo $code[0] ?>' target='_blank' rel='nofollow'>
            <div class='title color-white weight-bold random-code margin-top-reset'>
                <span><?php echo $code[0] ?></span>&nbsp;&nbsp;<i class="fas fa-external-link-alt"></i>
                <img class='random-code-background no-highlight' src='assets/img/<?php echo getRandomBackground() ?>' alt='background' draggable='false'>
            </div>
        </a>

        <br>
        <div id='copyToClipboard' onclick='copyToClipboard()' title='<?php echo $code[0] ?>' class='border-button-transparent no-highlight margin-medium-sides'>
                <i class='far fa-clipboard'></i> <span id='copyToClipboard-txt'><?php echo $locale_scrcr['CLIPBOARD'] ?></span>
            </div>
        <p class='text-light margin-semi-medium-top'><?php echo $locale_scrcr['REFERRAL_CODE_REWARD'] ?> <a class='text-underline' href="https://robertsspaceindustries.com/referral-program" target="_blank" rel="nofollow"><?php echo $locale_scrcr['HERE'] ?> <i class="fas fa-external-link-alt"></i></a>.</p>
    </div>

    <div class='align-center-force code-form'>
        <p class='color-white align-left'><?php echo $locale_scrcr['RANDOMIZER_SET'] ?></p>

        <form class='align-center'>
            <label><input id='code-input' class='input-field align-center' type='text' name='code' spellcheck='false'></label>
            <div class='border-button-transparent margin-large-sides submit-button no-highlight' onclick='submit_code(false)'><?php echo $locale['SUBMIT'] ?></div>
        </form>
        <span id='code-check' class='align-left color-white font-size-small text-underline cursor-pointer' onclick='submit_code(true)'>Check for referral code in database</span>

        <p id='code-message' class='color-white align-center hide'></p>
        <p id='code-disclaimer' class='text-light align-left margin-semi-medium-bottom'><?php echo $locale_scrcr['REFERRAL_CODE_ACTIVE'] ?></p>
    </div>
</div>

</body>

</html>
