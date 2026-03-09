<?php 

namespace App\Actions\Register;

use App\Dto\Register\CreateUserDto;
use App\Models\User;

class CreateUserAction {

    public function __invoke(CreateUserDto $data): User {
        return User::create([
            'name' => $data->name,
            'email' => $data->email,
            'password' => $data->password
        ]);
    }
 

}