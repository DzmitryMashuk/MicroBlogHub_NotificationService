<?php

declare(strict_types=1);

namespace App;

use GuzzleHttp\Client;
use Throwable;

class TelegramNotificationService
{
    private string $apiUrl;
    private string $chatId;
    private Client $client;

    public function __construct()
    {
        $token = $_ENV['TOKEN'];

        $this->apiUrl = "https://api.telegram.org/bot${token}/";
        $this->chatId = $_ENV['CHAT_ID'];
        $this->client = new Client();
    }

    public function sendMessage(string $message): array
    {
        $endpoint = $this->apiUrl . 'sendMessage';
        $params   = [
            'chat_id' => $this->chatId,
            'text'    => $message,
        ];

        try {
            $response = $this->client->post($endpoint, ['json' => $params]);
            return json_decode($response->getBody()->getContents(), true);
        } catch (Throwable $exception) {
            return [
                'status'  => 'error',
                'message' => $exception->getMessage(),
            ];
        }
    }

    public function getUpdates(): array
    {
        $endpoint = $this->apiUrl . 'getUpdates';

        try {
            $response = $this->client->get($endpoint);
            return json_decode($response->getBody()->getContents(), true);
        } catch (Throwable $exception) {
            return [
                'status'  => 'error',
                'message' => $exception->getMessage(),
            ];
        }
    }
}
