<?php 

namespace App\Actions\Reminders;

use App\Models\Reminder;

class UpdateReminderAction {
    
    public function __invoke(array $data, Reminder $reminder): bool {
        return (bool) $reminder->update($data);
    }

}