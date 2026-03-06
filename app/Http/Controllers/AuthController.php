<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\StoreRequest;
use App\Services\AuthService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\{Inertia, Response as InertiaResponse};

class AuthController extends Controller
{ 
    public function create(): InertiaResponse {
        return Inertia::render('Auth/Create');
    }
    public function store(StoreRequest $request, AuthService $service): RedirectResponse {
        if ($service->authUser($request->validated())) {
            $request->session()->regenerate();
            return to_route('reminders.index');
        }
        return back()->withErrors('credentials', 'The credentials are invalid');
    }
    public function destroy(Request $request, AuthService $service): RedirectResponse {
        if ($service->logoutUser()) {
            $request->session()->invalidate();
            $request->session()->regenerateToken();
        }
        return to_route('auth.create');
    }
}
