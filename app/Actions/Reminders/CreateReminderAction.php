<?php 

namespace App\Actions\Reminders;

use App\Models\Reminder;

class CreateReminderAction {

    public function __invoke(array $data): bool {
        return (bool) Reminder::create($data);
    } 

}