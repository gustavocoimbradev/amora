<?php 

namespace App\Actions\Register;

use App\Models\User;

class CreateUserAction {

    public function __invoke(array $data): User {
        return User::create($data);
    }


}