<?php

require __DIR__ . '/vendor/autoload.php';

use App\TelegramNotificationService;
use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

$telegramNotificationService = new TelegramNotificationService();
$response = $telegramNotificationService->sendMessage('Test Message');

print_r($response);
