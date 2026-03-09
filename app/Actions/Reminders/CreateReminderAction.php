<?php 

namespace App\Actions\Reminders;

use App\Dto\Reminders\CreateReminderDto;
use App\Models\Reminder;

class CreateReminderAction {

    public function __invoke(CreateReminderDto $data): bool {
        return (bool) Reminder::create([
            'title' => $data->title,
            'description' => $data->description,
            'next_run_at' => $data->next_run_at,
            'frequency' => $data->frequency,
            'user_id' => auth()->id()
        ]); 
    } 

}