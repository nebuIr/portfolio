<!DOCTYPE>

<?php include($_SERVER['DOCUMENT_ROOT'] . '/../assets/php/locale.php'); ?>
<?php include($_SERVER['DOCUMENT_ROOT'] . '/../module/STAR/assets/php/locale.php'); ?>
<html lang='<?php echo $locale['LOCALE_CODE'] ?>'>

<head>
    <title><?php echo $localeSCRR['RANDOMIZER_TITLE'] ?> - nebulr</title>
    <meta name='description' content='<?php echo $localeSCRR['RANDOMIZER_DESCRIPTION'] ?>'>
    <meta name='og:title' property='og:title' content='<?php echo $localeSCRR['RANDOMIZER_TITLE'] ?> - nebulr'>
    <meta name='og:description' property='og:description' content='<?php echo $localeSCRR['RANDOMIZER_DESCRIPTION'] ?>'>

    <link href='assets/css/base.css' type='text/css' rel='stylesheet'/>
    <script src='assets/js/base.js'></script>
    <?php include($_SERVER['DOCUMENT_ROOT'] . '/assets/html/head.php'); ?>
    <?php include_once($_SERVER['DOCUMENT_ROOT'] . '/../module/STAR/assets/php/STAR.php'); ?>
    <?php $referral = new STAR(); ?>

    <?php
    $randomCode = $referral->getRandomCode();

    if (isset($_POST['code'])) {
        $code = strtoupper($_POST['code']);
        $referralExists = $referral->exists($code);
        $referralIsValid = $referral->isValid($code);
        if ($code === '') {
            echo '<div class=\'color-white code-message\'>' . $localeSCRR['ENTER_REFERRAL_CODE'] . '</div>';

            return;
        }
        if ($referralIsValid) {
            if ($referralExists) {
                $referral->updateCode($code);
                echo '<div class=\'color-white code-message\'>' . $localeSCRR['THE_REFERRAL_CODE'] . ' "' . $code . '" ' . $localeSCRR['REFERRAL_CODE_UPDATED'] . '</div>';
            } else {
                $referral->addCode($code);
                echo '<div class=\'color-white code-message\'>' . $localeSCRR['THE_REFERRAL_CODE'] . ' "' . $code . '" ' . $localeSCRR['REFERRAL_CODE_ADDED'] . '</div>';
            }
        } else {
            echo '<div class=\'color-white code-message\'>' . $localeSCRR['THE_REFERRAL_CODE'] . ' "' . $code . '" ' . $localeSCRR['REFERRAL_CODE_INVALID'] . '</div>';
        }
        return;
    }
    ?>
</head>

<body>

<div class='main-text-medium'>
    <a id='back-button' href='/'><div class='border-button no-highlight'>
            <i class='fas fa-chevron-circle-left'></i> <?php echo $locale['GO_BACK'] ?>
        </div></a>

    <p class='color-white align-center font-size-medium weight-black margin-semi-large-top'><?php echo $localeSCRR['RANDOMIZER_GET'] ?></p>

    <div class='align-center margin-xl-bottom'>
        <a class='a-no-style' href='https://robertsspaceindustries.com/enlist?referral=<?php echo $randomCode ?>' target='_blank' rel='nofollow'>
            <div class='title color-white weight-bold random-code margin-top-reset'>
                <span><?php echo $randomCode ?></span>
                <img class='random-code-background no-highlight' src='assets/img/<?php echo $referral->getRandomBackground() ?>' alt='background' draggable='false'>
            </div>
        </a>

        <br>
        <div id='copyToClipboard' onclick='copyToClipboard()' title='<?php echo $randomCode ?>' class='border-button-transparent no-highlight margin-medium-sides'>
                <i class='far fa-clipboard'></i> <span id='copyToClipboard-txt'><?php echo $localeSCRR['CLIPBOARD'] ?></span>
            </div>
        <p class='text-light margin-semi-medium-top'><?php echo $localeSCRR['REFERRAL_CODE_REWARD'] ?></p>
    </div>

    <div class='align-center-force code-form'>
        <p class='color-white align-left'><?php echo $localeSCRR['RANDOMIZER_SET'] ?></p>

        <form action='' method='post' target='result'>
            <label><input class='input-field align-center' type='text' name='code' spellcheck='false'></label>
            <button class='border-button-transparent margin-large-sides submit-button' type='submit'><?php echo $locale['SUBMIT'] ?></button>
        </form>
        <p class='text-light align-left margin-bottom-reset'><?php echo $localeSCRR['REFERRAL_CODE_ACTIVE'] ?></p>
        <iframe name='result' class='code-iframe'></iframe>
    </div>
</div>

</body>

</html>
