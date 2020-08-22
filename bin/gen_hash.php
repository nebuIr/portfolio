<?php
(PHP_SAPI !== 'cli' || isset($_SERVER['HTTP_USER_AGENT'])) && die('cli only');

if (PHP_SAPI === 'cli') {
    $obj = new gen_hash();
    $obj->main();
}

class gen_hash
{
    public function main(): void
    {
        $hash_css = $this->get_hash();
        $hash_js = $this->get_hash();
        $hash_res = $this->get_hash();

        $hash = "ASSET_HASH_CSS=$hash_css\n" . "ASSET_HASH_JS=$hash_js\n" . "ASSET_HASH_RES=$hash_res";

        $file_env = '/../.env.hash';
        $this->write_to_env($hash, $file_env);
    }

    public function write_to_env($hash, $file): void
    {
        $fp = fopen(__DIR__ . $file, 'wb');
        fwrite($fp, $hash);
        fclose($fp);

        echo "'" . $file . "'" . ": \n" . $hash . "\n\n";
    }

    public function get_hash()
    {
        return substr(md5(uniqid(mt_rand(), true)), 0, 8);
    }
}