<?php 

namespace App\Actions\Auth;

use Illuminate\Support\Facades\Auth;

class AuthenticateUserAction {

    public function __invoke(array $data): bool {
        return Auth::attempt($data);
    }

}