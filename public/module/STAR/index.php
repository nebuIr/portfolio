<!DOCTYPE>

<?php include($_SERVER['DOCUMENT_ROOT'] . '/../assets/php/locale.php'); ?>
<?php include($_SERVER['DOCUMENT_ROOT'] . '/../module/STAR/assets/php/locale.php'); ?>
<html lang='<?php echo $locale['LOCALE_CODE'] ?>'>

<head>
    <title><?php echo $localeSTAR['RANDOMIZER_TITLE'] ?> - nebulr</title>
    <meta name='description' content='<?php echo $localeSTAR['RANDOMIZER_DESCRIPTION'] ?>'>
    <meta name='og:title' property='og:title' content='<?php echo $localeSTAR['RANDOMIZER_TITLE'] ?> - nebulr'>
    <meta name='og:description' property='og:description' content='<?php echo $localeSTAR['RANDOMIZER_DESCRIPTION'] ?>'>

    <link href='assets/css/frontend.css' type='text/css' rel='stylesheet'/>
    <script src='assets/js/jquery-3.4.1.min.js'></script>
    <script src='assets/js/frontend_star.js'></script>
    <?php include($_SERVER['DOCUMENT_ROOT'] . '/assets/html/head.php'); ?>
    <?php include_once($_SERVER['DOCUMENT_ROOT'] . '/../module/STAR/assets/php/db_star.php'); ?>
    <?php $referral = new db_star(); ?>
    <?php $randomCode = $referral->getRandomCode(); ?>
</head>

<body>

<div class='main-text-medium'>
    <a id='back-button' href='/'><div class='border-button no-highlight'>
            <i class='fas fa-chevron-circle-left'></i> <?php echo $locale['GO_BACK'] ?>
        </div></a>

    <p class='color-white align-center font-size-medium weight-black margin-semi-large-top'><?php echo $localeSTAR['RANDOMIZER_GET'] ?></p>

    <div class='align-center margin-xl-bottom'>
        <a class='a-no-style' href='https://robertsspaceindustries.com/enlist?referral=<?php echo $randomCode ?>' target='_blank' rel='nofollow'>
            <div class='title color-white weight-bold random-code margin-top-reset'>
                <span><?php echo $randomCode ?></span>&nbsp;&nbsp;<i class="fas fa-external-link-alt"></i>
                <img class='random-code-background no-highlight' src='assets/img/<?php echo $referral->getRandomBackground() ?>' alt='background' draggable='false'>
            </div>
        </a>

        <br>
        <div id='copyToClipboard' onclick='copyToClipboard()' title='<?php echo $randomCode ?>' class='border-button-transparent no-highlight margin-medium-sides'>
                <i class='far fa-clipboard'></i> <span id='copyToClipboard-txt'><?php echo $localeSTAR['CLIPBOARD'] ?></span>
            </div>
        <p class='text-light margin-semi-medium-top'><?php echo $localeSTAR['REFERRAL_CODE_REWARD'] ?></p>
    </div>

    <div class='align-center-force code-form'>
        <p class='color-white align-left'><?php echo $localeSTAR['RANDOMIZER_SET'] ?></p>

        <form>
            <label><input id='code-input' class='input-field align-center' type='text' name='code' spellcheck='false'></label>
            <div class='border-button-transparent margin-large-sides submit-button' onclick='submit_code()'><?php echo $locale['SUBMIT'] ?></div>
        </form>

        <p id='code-message' class='color-white align-center hide'></p>
        <p id='code-disclaimer' class='text-light align-left margin-bottom-reset'><?php echo $localeSTAR['REFERRAL_CODE_ACTIVE'] ?></p>
        <iframe name='result' class='code-iframe'></iframe>
    </div>
</div>

</body>

</html>
