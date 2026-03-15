<?php 

namespace App\Actions\Reminders;

use App\Mail\ReminderEmail;
use App\Models\Reminder;
use Illuminate\Support\Facades\Mail;

class SendReminderAction {

    public function __invoke(Reminder $reminder) {

        Mail::to($reminder->user->email)->queue(new ReminderEmail($reminder));
        
        $nextRun = match ($reminder->frequency) {
            1 => now()->addDay(),
            2 => now()->addWeek(),
            3 => now()->addMonth(),
            4 => now()->addYear(),
            default => null
        };

        $reminder->update([
            'last_sent_at' => now(),
            'next_run_at' => $nextRun,
        ]);
        
    }

}