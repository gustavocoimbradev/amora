<?php

namespace App\Http\Controllers;

use App\Actions\Auth\AuthenticateUserAction;
use App\Http\Requests\Auth\StoreRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\{Inertia, Response as InertiaResponse};
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{ 
    public function create(): InertiaResponse {
        return Inertia::render('Auth/Create');
    }
    public function store(StoreRequest $request, AuthenticateUserAction $action): RedirectResponse {
        if ($action($request->validated())) {
            $request->session()->regenerate();
            return to_route('reminders.index');
        }
        return back()->withErrors('credentials', 'The credentials are invalid');
    }
    public function destroy(Request $request): RedirectResponse {
        if (Auth::logout()) {
            $request->session()->invalidate();
            $request->session()->regenerateToken();
        }
        return to_route('auth.create');
    }
}
