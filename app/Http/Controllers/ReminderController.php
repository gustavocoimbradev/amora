<?php

namespace App\Http\Controllers;

use App\Actions\Reminders\CreateReminderAction;
use App\Actions\Reminders\DeleteReminderAction;
use App\Actions\Reminders\UpdateReminderAction;
use App\Dto\Reminders\CreateReminderDto;
use App\Dto\Reminders\UpdateReminderDto;
use App\Http\Requests\Reminder\{StoreRequest, UpdateRequest};
use Illuminate\Support\Facades\Gate;
use Inertia\{Inertia, Response as InertiaResponse};
use App\Models\Reminder;
use Illuminate\Http\RedirectResponse;

class ReminderController extends Controller
{
    
    public function index(): InertiaResponse {
        return Inertia::render('Reminders/Index', ['reminders' => Reminder::latestFirst(auth: true)->get()]);
    }

    public function create(): InertiaResponse {
        return Inertia::render('Reminders/Create');
    }
    
    public function show(Reminder $reminder): InertiaResponse {
        Gate::authorize('view', $reminder);
        return Inertia::render('Reminders/Show', ['reminder' => $reminder]);
    }

    public function edit(Reminder $reminder): InertiaResponse {
        Gate::authorize('update', $reminder);
        return Inertia::render('Reminders/Edit', ['reminder' => $reminder]);
    } 

    public function store(StoreRequest $request, CreateReminderAction $action): RedirectResponse {
        $dto = CreateReminderDto::fromRequest($request);
        if ($action($dto)) {
            return back()->with('success', 'Reminder created successfully!');
        } 
        return back()->withErrors('error', 'Failed to create the reminder');
    } 
 
    public function update(UpdateRequest $request, Reminder $reminder, UpdateReminderAction $action): RedirectResponse {
        Gate::authorize('update', $reminder);
        $dto = UpdateReminderDto::fromRequest($request);
        if ($action($dto, $reminder)) {
            return back()->with('success', 'Reminder updated successfully!');
        } 
        return back()->withErrors('error', 'Failed to update the reminder');
    } 

    public function destroy(Reminder $reminder, DeleteReminderAction $action): RedirectResponse {
        Gate::authorize('delete', $reminder);
        if ($action($reminder)) {
            return back()->with('success', 'Reminder deleted successfully!');
        } 
        return back()->withErrors('error', 'Failed to delete the reminder');
    }
 
}
