<?php
/**
 * Created by Kirill Zorin <zarincheg@gmail.com>
 * Personal website: http://libdev.ru
 *
 * Date: 25.03.2017
 * Time: 18:38
 */
include "../vendor/autoload.php";

use ExampleDialogs\HelloDialog;
use josegonzalez\Dotenv\Loader;
use Telegram\Bot\Api;
use Illuminate\Redis\RedisManager as Redis;
use BotDialogs\Dialogs;

$dotenvLoader = new Loader('../.env');
$dotenvLoader->parse()->putenv(true);

$telegram = new Api(getenv("TELEGRAM_TOKEN"));
$redis = new Redis('predis', [
    'cluster' => false,
    'default' => [
        'host' => '127.0.0.1',
        'port' => '6379',
        'database' => 0
    ]
]);
$dialogs = new Dialogs($telegram, $redis);
$update = $telegram->getWebhookUpdates();
$dialogs->add(new HelloDialog($update));
$dialogs->proceed($update);