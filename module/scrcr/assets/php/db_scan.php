<?php

include_once './db_scrcr.php';
use \Dotenv\Dotenv;

class db_scan
{
    private $conn;
    private $db_table;

    public function __construct()
    {
        require_once __DIR__ . '/../../../../vendor/autoload.php';

        $dotenv = Dotenv::create(__DIR__ . '/../../../../');
        $dotenv->load();

        $db_host = getenv('DB_HOST');
        $db_name = getenv('DB_NAME');
        $db_user = getenv('DB_USER');
        $db_pass = getenv('DB_PASS');
        $this->db_table = getenv('DB_TABLE');

        $this->conn = new mysqli($db_host, $db_user, $db_pass, $db_name);
        if (!$this->conn) {
            die('Connection failed: ' . $this->conn->connect_error);
        }
    }

    public function scanCodes(): void
    {
        $six_months = 15552000;
        $seven_days = 604800;
        $current_timestamp = time();

        $stmt = $this->conn->prepare("SELECT * FROM $this->db_table");
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                if ($row['active'] && (strtotime($row['last_update']) + $six_months <= $current_timestamp)) {
                    $this->setInactive($row['code']);
                }
                if ($row['active'] && (strtotime($row['last_update']) + $six_months - $seven_days <= $current_timestamp)) {
                    $referral = new db_scrcr();

                    if (!$referral->getField('email', $row['code']) || (bool)$referral->getField('email_sent', $row['code'])){
                        return;
                    }

                    $referral->sendMail($row['code'], 2);
                    $this->setMailSent($row['code'], $row['email']);
                }
            }
        }
    }

    public function setInactive($code): void
    {
        $stmt = $this->conn->prepare("UPDATE $this->db_table SET active=0 WHERE code=?");
        $stmt->bind_param('s', $code);
        $stmt->execute();

        $qr_file_path = __DIR__ . '/../../../../public/module/scrcr/cache/qr/';
        $qr_file_ext = '.jpg';
        $this->deleteFile($qr_file_path . $code . $qr_file_ext);

        echo 'Code ' . $code . " set to inactive\n";
    }

    public function setMailSent($code, $email): void
    {
        $stmt = $this->conn->prepare("UPDATE $this->db_table SET email_sent=1 WHERE code=?");
        $stmt->bind_param('s', $code);
        $stmt->execute();

        echo 'E-Mail notification for ' . $code . ' sent to ' . $email . "\n";
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
