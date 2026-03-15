<?php

namespace App\Console\Commands;

use App\Actions\Reminders\SendReminderAction;
use App\Mail\ReminderEmail;
use App\Models\Reminder;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendReminders extends Command
{

    protected $signature = 'app:send-reminders';

    public function handle(SendReminderAction $action)
    {
        $reminders = Reminder::pending()->get();
        foreach ($reminders as $reminder) {
            $action($reminder);
        }
    }
}
