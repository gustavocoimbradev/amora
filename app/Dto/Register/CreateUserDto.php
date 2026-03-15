<?php

namespace App\Dto\Register;

use App\Http\Requests\Register\StoreRequest;

readonly class CreateUserDto {

    public function __construct(
        public string $name,
        public string $email, 
        public string $password
    ) {}

    public static function fromRequest(StoreRequest $request): self {
        $data = $request->validated();
        return new self(
            name: $data['name'],
            email: $data['email'],
            password: $data['password']
        );
    }

}