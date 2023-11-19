<?php

namespace App\Service;

use App\Models\Feedback;

class FeedbackService
{
    public function createFeedback(array $data): void
    {
        $nameParts = explode(' ', $data['fullname']);
        unset($data['fullname']);
        $data['lastname'] = $nameParts[0];
        $data['firstname'] = $nameParts[1];
        $data['middlename'] = $nameParts[2] ?? null;
        Feedback::create($data);
    }
}
