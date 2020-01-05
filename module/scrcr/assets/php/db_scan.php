<?php

use \Dotenv\Dotenv;

class db_scan
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

    public function scanCodes(): void
    {
        $six_months = 15552000;
        $current_timestamp = time();

        $stmt = $this->conn->prepare('SELECT * FROM codes');
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                if ($row['active'] && (strtotime($row['last_update']) + $six_months <= $current_timestamp)) {
                    $this->setInactive($row['code']);
                }
            }
        }
    }

    public function setInactive($code): void
    {
        $stmt = $this->conn->prepare('UPDATE codes SET active=0 WHERE code=?');
        $stmt->bind_param('s', $code);
        $stmt->execute();

        $qr_file_path = __DIR__ . '/../../../../public/module/scrcr/cache/qr/';
        $qr_file_ext = '.jpg';
        $this->deleteFile($qr_file_path . $code . $qr_file_ext);

        echo 'Code ' . $code . " set to inactive\n";
    }

    public function deleteFile($path): void
    {
        unlink($path);
    }
}

if (PHP_SAPI === 'cli') {
    $obj = new db_scan();
    $obj->scanCodes();
}
