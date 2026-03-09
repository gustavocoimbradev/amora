<?php 

namespace App\Actions\Reminders;

use App\Dto\Reminders\UpdateReminderDto;
use App\Models\Reminder;

class UpdateReminderAction {
    
    public function __invoke(UpdateReminderDto $data, Reminder $reminder): bool {
        return (bool) $reminder->update([
            'title' => $data->title,
            'description' => $data->description,
            'next_run_at' => $data->next_run_at,
            'frequency' => $data->frequency,
            'user_id' => auth()->id()
        ]);
    }

}