<?php

namespace App\Http\Integration\Telegram;


use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class TelegramClient
{
    private Client $telegramClient;
    private string $chatId;

    public function __construct()
    {
        $this->telegramClient = new Client([
            'base_uri' => config('telegram.bot_url')
        ]);
        $this->chatId = config('telegram.chat_id');
    }

    public function sendMessage(string $message): void
    {
        try {
            $this->telegramClient->request('POST', 'sendMessage', [
                'form_params' => [
                    'chat_id' => $this->chatId,
                    'text' => $message
                ]
            ]);
        } catch (GuzzleException $e) {
            error_log($e->getMessage());
        }
    }
}
