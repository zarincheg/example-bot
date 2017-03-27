<?php
/**
 * Created by Kirill Zorin <zarincheg@gmail.com>
 * Personal website: http://libdev.ru
 *
 * Date: 25.03.2017
 * Time: 20:10
 */
include "vendor/autoload.php";

use Telegram\Bot\Api;
use josegonzalez\Dotenv\Loader;

$dotenvLoader = new Loader('.env');
$dotenvLoader->parse()->putenv(true);

$telegram = new Api(getenv("TELEGRAM_TOKEN"));
$telegram->setWebhook(['url' => 'https://exbot.libdev.ru/simplechat.php']);
