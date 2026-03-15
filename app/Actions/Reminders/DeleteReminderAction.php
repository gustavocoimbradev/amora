<?php 

namespace App\Actions\Reminders;

use App\Models\Reminder;

class DeleteReminderAction {

   public function __invoke(Reminder $reminder): bool {
        return (bool) $reminder->delete();
    }

}