<?php

namespace App\Http\Controllers;

use App\Http\Requests\Reminder\{StoreRequest, UpdateRequest};
use Illuminate\Support\Facades\Gate;
use Inertia\{Inertia, Response as InertiaResponse};
use App\Models\Reminder;
use App\Services\ReminderService;
use Illuminate\Http\RedirectResponse;

class ReminderController extends Controller
{

    public function __construct(protected ReminderService $service) { }
    
    public function index(): InertiaResponse {
        return Inertia::render('Reminders/Index', ['reminders' => $this->service->getAllRemindersForAuthenticatedUser()]);
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

    public function store(StoreRequest $request): RedirectResponse {
        if ($this->service->createReminder($request->validated())) {
            return back()->with('success', 'Reminder created successfully!');
        } 
        return back()->withErrors('error', 'Failed to create the reminder');
    } 

    public function update(UpdateRequest $request, Reminder $reminder): RedirectResponse {
        Gate::authorize('update', $reminder);
        if ($this->service->updateReminder($request->validated(), $reminder)) {
            return back()->with('success', 'Reminder updated successfully!');
        } 
        return back()->withErrors('error', 'Failed to update the reminder');
    } 

    public function destroy(Reminder $reminder): RedirectResponse {
        Gate::authorize('delete', $reminder);
        if ($this->service->deleteReminder($reminder)) {
            return back()->with('success', 'Reminder deleted successfully!');
        } 
        return back()->withErrors('error', 'Failed to delete the reminder');
    }
 
}
