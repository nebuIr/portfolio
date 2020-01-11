<?php

use \Dotenv\Dotenv;
use \chillerlan\QRCode\QRCode;
use \chillerlan\QRCode\QROptions;

class db_scrcr
{
    private $conn;
    private $from_email;

    public function __construct()
    {
        require_once __DIR__ . '/../../../../vendor/autoload.php';

        $dotenv = Dotenv::create(__DIR__ . '/../../../../');
        $dotenv->load();

        $db_host = getenv('DB_HOST');
        $db_name = getenv('DB_NAME');
        $db_user = getenv('DB_USER');
        $db_pass = getenv('DB_PASS');

        $this->from_email = getenv('FROM_EMAIL');

        $this->conn = new mysqli($db_host, $db_user, $db_pass, $db_name);
        if (!$this->conn) {
            die('Connection failed: ' . $this->conn->connect_error);
        }
    }

    public function exists($code): bool
    {
        $stmt = $this->conn->prepare('SELECT * FROM codes WHERE code=?');
        $stmt->bind_param('s', $code);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->num_rows > 0;
    }

    public function isValid($code): bool
    {
        if (preg_match('/^STAR-[A-Z0-9]{4}-[A-Z0-9]{4}$/', $code)) {
            return true;
        }

        return false;
    }

    public function addCode($code, $email): void
    {
        $timestamp = date('Y-m-d H:i:s');
        $token = md5(uniqid(mt_rand(), true));

        $stmt = $this->conn->prepare('INSERT INTO codes (code, email, token, last_update) VALUES (?, ?, ?, ?)');
        $stmt->bind_param('ssss', $code, $email, $token, $timestamp);
        $stmt->execute();

        $this->generateQRCode($code);
    }

    public function updateCode($code): void
    {
        $timestamp = date('Y-m-d H:i:s');

        $stmt = $this->conn->prepare('UPDATE codes SET active=1, email_sent=0, last_update=? WHERE code=?');
        $stmt->bind_param('ss', $timestamp, $code);
        $stmt->execute();

        $this->generateQRCode($code);
    }

    public function isActive($code): int
    {
        $stmt = $this->conn->prepare('SELECT * FROM codes WHERE code=?');
        $stmt->bind_param('s', $code);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        return (int) $row['active'];
    }

    public function getTimestamp($code): int
    {
        $stmt = $this->conn->prepare('SELECT * FROM codes WHERE code=?');
        $stmt->bind_param('s', $code);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        return (int) strtotime($row['last_update']);
    }

    public function mailSent($code): bool
    {
        $stmt = $this->conn->prepare('SELECT * FROM codes WHERE code=?');
        $stmt->bind_param('s', $code);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        return (bool) $row['email_sent'];
    }

    public function getMail($code)
    {
        $stmt = $this->conn->prepare('SELECT * FROM codes WHERE code=?');
        $stmt->bind_param('s', $code);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        return $row['email'] ?? false;
    }

    public function getToken($code)
    {
        $stmt = $this->conn->prepare('SELECT * FROM codes WHERE code=?');
        $stmt->bind_param('s', $code);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        return $row['token'];
    }

    public function getRandomCode(): string
    {
        $stmt = $this->conn->prepare('SELECT * FROM codes WHERE active=1 ORDER BY RAND() LIMIT 1');
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        if ($result->num_rows === 0) {
            return 'STAR-XXXX-XXXX';
        }

        return $row['code'];
    }

    public function getRandomBackground(): string
    {
        $path    = $_SERVER['DOCUMENT_ROOT'] . '/module/scrcr/assets/img';
        $file_array = preg_grep('/^([^.])/', scandir($path));
        $random_file = array_rand($file_array);

        return $file_array[$random_file];
    }

    public function generateQRCode($code): void
    {
        $analytics = '&source=qr';
        $data = 'https://nebulr.me/module/scrcr/?referral=' . $code . $analytics;
        $cache_path = $_SERVER['DOCUMENT_ROOT'] . '/module/scrcr/cache/qr/' . $code . '.jpg';
        $options = new QROptions([
            'version'    => 5,
            'outputType' => QRCode::OUTPUT_IMAGE_JPG,
            'eccLevel'   => QRCode::ECC_L,
        ]);

        $qrcode = new QRCode($options);

        $qrcode->render($data, $cache_path);
    }

    public function sendMail($code, $type): void
    {
        $to_email = $this->getMail($code);
        $token = $this->getToken($code);

        if ($to_email === null) {
            return;
        }

        switch ($type) {
            case 0:
                $subject = 'Your Star Citizen referral code was successfully added | SCRCR';
                $message = 'This mail was sent to confirm that your referral code "' . $code . '" was successfully added to the Star Citizen Referral Code Randomizer.';
                break;
            case 1:
                $subject = 'Your Star Citizen referral code was successfully updated | SCRCR';
                $message = 'This mail was sent to inform you that your referral code "' . $code . '" was successfully updated.';
                break;
            case 2:
                $subject = 'Notification about your Star Citizen referral code | SCRCR';
                $message = 'This mail was sent to inform you that your referral code "' . $code . '" submitted to the Star Citizen Referral Code Randomizer will become inactive in 7 days.' . "\n\n" . 'If you want your referral code to remain active, you can resubmit it here: https://nebulr.me/module/scrcr/';
                break;
        }
        $headers = 'From: ' . $this->from_email;
        $opt_out_url = 'https://nebulr.me/module/scrcr/opt-out/?code=' . $code . '&token=' . $token;
        $opt_out_message = "\n\n\n" . 'To unsubscribe and delete your email address, please visit this link: ' . $opt_out_url . "\n" . 'IMPORTANT: Once you click on the link, your email address will be removed. This cannot be undone!';

        mail($to_email, $subject, $message . $opt_out_message, $headers);
    }

    public function optOut(): void
    {
        $badge_classes_green = '<div class=\'' . 'code-form code-message badge badge-outline-green font-poppins-regular align-center-force margin-semi-medium-top overflow-hidden' . '\'>';
        $badge_classes_yellow = '<div class=\'' . 'code-form code-message badge badge-outline-yellow font-poppins-regular align-center-force margin-semi-medium-top overflow-hidden' . '\'>';
        $badge_classes_red = '<div class=\'' . 'code-form code-message badge badge-outline-red font-poppins-regular align-center-force margin-semi-medium-top overflow-hidden' . '\'>';
        $error = $badge_classes_red . 'An error occurred!</div>';
        $invalidToken = $badge_classes_red . 'Provided token is invalid!</div>';
        $alreadyOptOut = $badge_classes_yellow . 'Your email was already deleted!</div>';

        if (isset($_REQUEST['code'], $_REQUEST['token'])) {
            $code = $_REQUEST['code'];
            $token = $_REQUEST['token'];

            $stmt = $this->conn->prepare('SELECT * FROM codes WHERE code=?');
            $stmt->bind_param('s', $code);
            $stmt->execute();
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();

            $email = $row['email'];

            if ($result->num_rows === 0) {
                echo $error;

                return;
            }

            if ($token === $row['token']) {
                if ($email === null) {
                    echo $alreadyOptOut;

                    return;
                }

                $this->removeMail($code);
                echo $badge_classes_green . 'Your email "' . $email . '" was successfully deleted!</div>';

                return;
            }

            echo $invalidToken;

            return;
        }

        echo $error;
    }

    public function removeMail($code): void
    {
        $stmt = $this->conn->prepare('UPDATE codes SET email=null WHERE code=?');
        $stmt->bind_param('s', $code);
        $stmt->execute();
    }
}