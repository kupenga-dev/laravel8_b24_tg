<?php

namespace App\Models;

use App\Events\FeedbackCreated;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    use HasFactory;
    protected $table = 'feedbacks';
    protected $fillable = [
        'lastname',
        'firstname',
        'middlename',
        'birthday',
        'phone',
        'email',
        'comment',
        'lead_id',
        'contact_id'
    ];

    protected static function boot(): void
    {
        parent::boot();
        static::created(function (Feedback $feedback) {
            event(new FeedbackCreated($feedback));
        });
    }
}
