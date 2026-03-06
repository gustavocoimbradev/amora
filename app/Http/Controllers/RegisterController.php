<?php

namespace App\Http\Controllers;

use App\Http\Requests\Register\StoreRequest;
use App\Services\RegisterService;
use Illuminate\Http\RedirectResponse;
use Inertia\{Inertia, Response as InertiaResponse};

class RegisterController extends Controller
{
    public function create(): InertiaResponse {
        return Inertia::render('Register/Create');
    }
    public function store(StoreRequest $request, RegisterService $service): RedirectResponse {
        $user = $service->createUser($request->validated());
        auth()->login($user);
        return to_route('reminders.index');
    }
}
