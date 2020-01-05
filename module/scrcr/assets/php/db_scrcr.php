<?php

use \Dotenv\Dotenv;
use \chillerlan\QRCode\QRCode;
use \chillerlan\QRCode\QROptions;

class db_scrcr
{
    private $conn;

    public function __construct()
    {
        require_once __DIR__ . '/../../../../vendor/autoload.php';

        $dotenv = Dotenv::create(__DIR__ . '/../../../../');
        $dotenv->load();

        $db_host = getenv('DB_HOST');
        $db_name = getenv('DB_NAME');
        $db_user = getenv('DB_USER');
        $db_pass = getenv('DB_PASS');

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

    public function addCode($code): void
    {
        $timestamp = date('Y-m-d H:i:s');

        $stmt = $this->conn->prepare('INSERT INTO codes (code, last_update) VALUES (?, ?)');
        $stmt->bind_param('ss', $code, $timestamp);
        $stmt->execute();

        $this->generateQRCode($code);
    }

    public function updateCode($code): void
    {
        $timestamp = date('Y-m-d H:i:s');

        $stmt = $this->conn->prepare('UPDATE codes SET active=1, last_update=? WHERE code=?');
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
        $cache_path = $_SERVER['DOCUMENT_ROOT'] . '/module/scrcr/cache/qr/' . $code . '.svg';
        $options = new QROptions([
            'version'    => 5,
            'outputType' => QRCode::OUTPUT_MARKUP_SVG,
            'eccLevel'   => QRCode::ECC_L,
        ]);

        $qrcode = new QRCode($options);

        $qrcode->render($data, $cache_path);
    }
}