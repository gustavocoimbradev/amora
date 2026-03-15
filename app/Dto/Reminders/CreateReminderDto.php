<?php 

namespace App\Dto\Reminders;

use App\Http\Requests\Reminder\StoreRequest;

readonly class CreateReminderDto {

    public function __construct(
        public string $title,
        public string $description,
        public string $next_run_at,
        public string $frequency,
        public int $user_id
    ) {}

    public static function fromRequest(StoreRequest $request): self {
        $data = $request->validated();
        return new self(
            title: $data['title'],
            description: $data['description'],
            next_run_at: $data['next_run_at'],
            frequency: $data['frequency'],
            user_id: auth()->id()
        );
    }

}