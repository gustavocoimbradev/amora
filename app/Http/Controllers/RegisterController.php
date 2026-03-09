<?php

namespace App\Http\Controllers;

use App\Actions\Register\CreateUserAction;
use App\Dto\Register\CreateUserDto;
use App\Http\Requests\Register\StoreRequest;
use Illuminate\Http\RedirectResponse;
use Inertia\{Inertia, Response as InertiaResponse};

class RegisterController extends Controller
{
    public function create(): InertiaResponse {
        return Inertia::render('Register/Create');
    }
    public function store(StoreRequest $request, CreateUserAction $action): RedirectResponse {
        $dto = CreateUserDto::fromRequest($request);
        $user = $action($dto);
        auth()->login($user);
        return to_route('reminders.index');
    }
}
