<?php

use App\Models\Competition;
use App\Models\User;

it('redirects admin users to admin dashboard', function () {
    $admin = User::factory()->create(['role' => 'admin']);
    $this->actingAs($admin);
    
    $response = $this->get('/dashboard');
    $response->assertRedirect('/competitions/admin');
});

it('redirects regular users to user dashboard', function () {
    $user = User::factory()->create(['role' => 'user']);
    $this->actingAs($user);
    
    $response = $this->get('/dashboard');
    $response->assertRedirect('/competitions');
});

it('allows admin to create competition', function () {
    $admin = User::factory()->create(['role' => 'admin']);
    $this->actingAs($admin);
    
    $response = $this->get('/competitions/create');
    $response->assertStatus(200);
});

it('displays user dashboard to regular users', function () {
    $user = User::factory()->create(['role' => 'user']);
    $this->actingAs($user);
    
    $response = $this->get('/competitions');
    $response->assertStatus(200);
});

it('displays competition details', function () {
    $user = User::factory()->create();
    $this->actingAs($user);
    
    $competition = Competition::factory()->create();
    
    $response = $this->get('/competitions/' . $competition->id);
    $response->assertStatus(200);
});
