<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('should display the registration page', function(){
    $this->get(route('register.create'))
        ->assertStatus(200);
});

test('should not display the registration page if logged', function() {
    $user = User::factory()->create();
    $this->actingAs($user)
        ->get(route('register.create'))
        ->assertStatus(302);
});

test('should fail registration when email is invalid', function(){
    $payload = [
        'email'     => 'invalid_email', 
        'password'  => 'password123456'
    ];
    $this->post(route('register.store'), $payload)
        ->assertStatus(302)
        ->assertSessionHasErrors('email');
});

test('should fail registration when email is duplicated', function(){
    User::factory()->create(['email' => 'email@example.com']);
    $payload = [
        'email'     => 'email@example.com', 
        'password'  => 'password123456'
    ];
    $this->post(route('register.store'), $payload)
        ->assertStatus(302)
        ->assertSessionHasErrors('email');
});

test('should store the data into database when registration is succeed', function() {
    $payload = [
        'name'      => 'Walter White',  
        'email'     => 'email@example.com', 
        'password'  => 'password123456'
    ];
    $this->post(route('register.store'), $payload)
        ->assertStatus(302);
    $this->assertDatabaseHas('users', ['email' => 'email@example.com']);
}); 

test('should auto login and redirect to reminders page when registration is succeed', function() {
    $payload = [
        'name'      => 'Walter White',  
        'email'     => 'email@example.com', 
        'password'  => 'password123456'
    ];
    $this->post(route('register.store'), $payload)
        ->assertStatus(302)
        ->assertRedirectToRoute('reminders.index');
    $this->assertAuthenticated();
});

