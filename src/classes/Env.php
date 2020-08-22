<?php

namespace nebulr;

use Dotenv\Dotenv;

class Env
{
    private $assetHashCss;
    private $assetHashJs;
    private $assetHashRes;

    public function __construct()
    {
        require_once __DIR__ . '/../../vendor/autoload.php';

        $dotenv_hash = Dotenv::createImmutable(__DIR__ . '/../../',  '.env.hash');
        $dotenv_hash->load();

        $this->assetHashCss = $_ENV['ASSET_HASH_CSS'];
        $this->assetHashJs = $_ENV['ASSET_HASH_JS'];
        $this->assetHashRes = $_ENV['ASSET_HASH_RES'];
    }

    public function getAssetHashCss(): string
    {
        return '?' . $this->assetHashCss;
    }

    public function getAssetHashJs(): string
    {
        return '?' . $this->assetHashJs;
    }

    public function getAssetHashRes(): string
    {
        return '?' . $this->assetHashRes;
    }
}