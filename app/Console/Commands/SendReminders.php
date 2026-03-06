<?php

namespace App\Console\Commands;

use App\Mail\ReminderEmail;
use App\Services\ReminderService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendReminders extends Command
{

    protected $signature = 'app:send-reminders';

    protected $description = 'Command description';

    public function __construct(protected ReminderService $service) {
        parent::__construct();
    }

    public function handle()
    {

        foreach ($this->service->getPendingReminders() as $reminder) {
            $email = $reminder->user->email;
            Mail::to($email)->send(new ReminderEmail($reminder));
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
}
