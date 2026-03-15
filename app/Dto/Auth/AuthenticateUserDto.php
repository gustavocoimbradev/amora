<?php 

namespace App\Dto\Auth;

use App\Http\Requests\Auth\StoreRequest;

readonly class AuthenticateUserDto {

    public function __construct(
        public string $email,
        public string $password
    ) {}

    public static function fromRequest(StoreRequest $request): self {
        $data = $request->validated();
        return new self(
            email: $data['email'],
            password: $data['password']
        );
    }

}