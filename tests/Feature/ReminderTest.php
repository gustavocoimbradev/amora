<?php

use App\Models\Reminder;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('should not display the reminders page if user is not logged', function(){
    $this->get(route('reminders.index'))
        ->assertStatus(302)
        ->assertRedirect();
});

test('should display the reminders page if user is logged', function(){
    $user = User::factory()->create();
    $this->actingAs($user)->get(route('reminders.index'))
        ->assertStatus(200);
});

test('should not display the creating reminder form if user is not logged', function() {
    $this->get(route('reminders.create'))
        ->assertStatus(302)
        ->assertRedirect();
});

test('should display the creating reminder form if user is logged', function() {
    $user = User::factory()->create();
    $this->actingAs($user)
        ->get(route('reminders.create'))
        ->assertStatus(200);
});

test('should not display the individual reminder page if user is not the owner', function() {
    $user1 = User::factory()->create();
    $user2 = User::factory()->create();
    $reminder = Reminder::factory()->create(['user_id' => $user1->id]);
    $this->actingAs($user2)
        ->get(route('reminders.show', $reminder))
        ->assertStatus(403)
        ->assertDontSee($reminder->title);
});

test('should display the individual reminder page if user is the owner', function() {
    $user = User::factory()->create();
    $reminder = Reminder::factory()->create(['user_id' => $user->id]);
    $this->actingAs($user)
        ->get(route('reminders.show', $reminder))
        ->assertStatus(200)
        ->assertSee($reminder->title);
});

test('should not display the editing reminder form if user is not the owner', function() {
    $user1 = User::factory()->create();
    $user2 = User::factory()->create();
    $reminder = Reminder::factory()->create(['user_id' => $user1->id]);
    $this->actingAs($user2)
        ->get(route('reminders.edit', $reminder))
        ->assertStatus(403)
        ->assertDontSee($reminder->title);
});

test('should display the editing reminder form if user is the owner', function() {
    $user = User::factory()->create();
    $reminder = Reminder::factory()->create(['user_id' => $user->id]);
    $this->actingAs($user)
        ->get(route('reminders.edit', $reminder))
        ->assertStatus(200)
        ->assertSee($reminder->title);
});

test('should not create a new reminder if user is not logged', function() {

    $futureDate = now()->addDay()->format('Y-m-d');

    $payload = [
        'title' => 'Lorem ipsum',
        'description' => 'Lorem ipsum dolor sit amet',
        'next_run_at' => $futureDate,
        'frequency' => 1
    ];

    $this->post(route('reminders.store'), $payload)
        ->assertStatus(302);

    $this->assertDatabaseMissing('reminders', $payload);

});

test('should create a new reminder if user is logged', function() {

    $user = User::factory()->create();

    $futureDate = now()->addDay()->format('Y-m-d');

    $payload = [
        'title' => 'Lorem ipsum',
        'description' => 'Lorem ipsum dolor sit amet',
        'next_run_at' => $futureDate,
        'frequency' => 1 
    ]; 

    $this->actingAs($user)
        ->post(route('reminders.store'), $payload)
        ->assertStatus(302);

    $this->assertDatabaseHas('reminders', $payload);

});

test('should not delete the reminder if user is not the owner', function() {

    $user1 = User::factory()->create();
    $user2 = User::factory()->create();
    $reminder = Reminder::factory()->create(['user_id' => $user1->id]);

    $this->actingAs($user2)
        ->delete(route('reminders.destroy', $reminder))
        ->assertStatus(403);

    $this->assertDatabaseHas('reminders', ['id' => $reminder->id]);


});

test('should delete the reminder if user is the owner', function() {

    $user = User::factory()->create();
    $reminder = Reminder::factory()->create(['user_id' => $user->id]);

    $this->actingAs($user)
        ->delete(route('reminders.destroy', $reminder))
        ->assertStatus(302);

    $this->assertDatabaseMissing('reminders', ['id' => $reminder->id]);


});

test('should not update a new reminder if user is not the owner', function() {

    $user1 = User::factory()->create();
    $user2 = User::factory()->create();
    $reminder = Reminder::factory()->create(['user_id' => $user1->id]);

    $futureDate = now()->addDay()->format('Y-m-d H:i:s');

    $payload = [
        'title' => 'Lorem ipsum',
        'description' => 'Lorem ipsum dolor sit amet',
        'next_run_at' => $futureDate,
        'frequency' => 1
    ];

    $this->actingAs($user2)
        ->put(route('reminders.update', $reminder), $payload)
        ->assertStatus(403);

    $this->assertDatabaseMissing('reminders', $payload);

});

test('should update a new reminder if user is the owner', function() {

    $user = User::factory()->create();
    $reminder = Reminder::factory()->create(['user_id' => $user->id]);

    $futureDate = now()->addDay()->format('Y-m-d');

    $payload = [
        'title' => 'Lorem ipsum',
        'description' => 'Lorem ipsum dolor sit amet',
        'next_run_at' => $futureDate,
        'frequency' => 1
    ];

    $this->actingAs($user)
        ->put(route('reminders.update', $reminder), $payload)
        ->assertStatus(302);

    $this->assertDatabaseHas('reminders', $payload);

});