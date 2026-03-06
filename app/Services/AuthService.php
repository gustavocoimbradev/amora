<?php 

namespace App\Services;

use Illuminate\Support\Facades\Auth;

class AuthService {

    public function authUser(array $data): bool {
        return Auth::attempt($data);
    }

    public function logoutUser(): void {
        Auth::logout();
    }
 
}