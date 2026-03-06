<?php 

namespace App\Services;

use App\Models\Reminder;
use Illuminate\Support\Collection;

class ReminderService {

    public function createReminder(array $data): bool {
        return (bool) Reminder::create($data);
    }

    public function updateReminder(array $data, Reminder $reminder): bool {
        return (bool) $reminder->update($data);
    }

    public function deleteReminder(Reminder $reminder): bool {
        return (bool) $reminder->delete();
    }
 
    public function getAllReminders(): Collection {
        return Reminder::orderBy('id', 'desc')->get();
    }

    public function getAllRemindersForAuthenticatedUser(): Collection {
        return Reminder::orderBy('id', 'desc')->where('user_id', auth()->id())->get();
    }

    public function getPendingReminders(): Collection 
    {
        return Reminder::with('user')
            ->where('next_run_at', '<=', now())
            ->orderBy('id', 'desc')
            ->get();
    }

}