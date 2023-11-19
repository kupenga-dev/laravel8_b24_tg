<?php

namespace App\Jobs;

use App\Http\Integration\Bitrix24\Bitrix24Client;
use App\Http\Integration\Telegram\TelegramClient;
use App\Models\Feedback;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class CreateLeadInBitrix24 implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private Feedback $feedback;

    public function __construct(Feedback $feedback)
    {
        $this->feedback = $feedback;
    }

    public function handle(Bitrix24Client $bitrix24Client, TelegramClient $telegramClient): void
    {
        try {
            $response = $bitrix24Client->addLead($this->feedback);
            $leadInfo = json_decode($response->getBody()->getContents(), true);
            $leadId = $leadInfo['result'] ?? null;
            $this->feedback->update([
                'lead_id' => $leadId
            ]);
            $telegramClient->sendMessage("Лид с id $leadId успешно создан!");
        }
        catch (GuzzleException $e){
            $errorMessage = $e->getMessage();
            $telegramClient->sendMessage($errorMessage);
        }
    }
}
