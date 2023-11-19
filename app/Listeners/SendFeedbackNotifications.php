<?php

namespace App\Listeners;

use App\Events\FeedbackCreated;
use App\Jobs\CreateContactInBitrix24;
use App\Jobs\CreateLeadInBitrix24;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendFeedbackNotifications
{
    public function __construct()
    {

    }

    public function handle(FeedbackCreated $event)
    {
        CreateContactInBitrix24::dispatch($event->getFeedback());
        CreateLeadInBitrix24::dispatch($event->getFeedback());
    }
}
