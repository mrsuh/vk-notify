<?php

require __DIR__ . '/../vendor/autoload.php';

use Symfony\Component\Yaml\Parser;
use Longman\TelegramBot\Telegram;
use Longman\TelegramBot\Exception\TelegramException;

try {
    $parser = new Parser();
    $parameters = $parser->parse(file_get_contents('/../app/config/parameters.yml'));

    $telegram = new Telegram($API_KEY, $BOT_NAME);

    $result = $telegram->setWebHook($parameters['bot.hook_url']);
    if ($result->isOk()) {
        file_put_contents('bot.log', $result->getDescription(), FILE_APPEND);
    }
} catch (TelegramException $e) {
    file_put_contents('bot.log', $e->getMessage(), FILE_APPEND);
}