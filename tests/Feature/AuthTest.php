<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('should display the login page', function(){
    $this->get(route('auth.create'))
        ->assertStatus(200);
});

test('should not display the login page if logged', function(){
    $user = User::factory()->create();
    $this->actingAs($user)
        ->get(route('auth.create'))
        ->assertStatus(302);
});

test('should authenticate when credentials is valid', function(){
    $user = User::factory()->create(['password' => 'password123456']);
    $payload = [
        'email'     => $user->email,
        'password'  => 'password123456'
    ];
    $this->post(route('auth.store', $payload))
        ->assertStatus(302)
        ->assertSessionHasNoErrors();
    $this->assertAuthenticated();
});

test('should not authenticate when credentials is invalid', function(){
    $user = User::factory()->create(['password' => 'password123456']);
    $payload = [
        'email'     => $user->email,
        'password'  => 'password_incorrect'
    ];
    $this->post(route('auth.store', $payload))
        ->assertStatus(302)
        ->assertSessionHasErrors();
    $this->assertGuest();
});

test('should disconnect user authenticated if logged', function() {
    $user = User::factory()->create();
    $this->actingAs($user)
        ->delete(route('auth.destroy'))
        ->assertStatus(302)
        ->assertRedirectToRoute('auth.create')
        ->assertSessionHasNoErrors();
    $this->assertGuest();
});