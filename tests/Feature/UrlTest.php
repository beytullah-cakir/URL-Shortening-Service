<?php

use App\Models\User;
use App\Models\Url;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;

uses(RefreshDatabase::class);

test("authenticated user can view their own url", function () {
    $user = User::factory()->create();
    $url = Url::create([
        'original_url' => 'https://google.com',
        'short_code' => 'goog12',
        'user_id' => $user->id,
        'is_active' => true,
    ]);

    Sanctum::actingAs($user);

    $response = $this->getJson("/api/urls/{$url->id}");

    $response->assertStatus(200)
        ->assertJsonFragment([
            'original_url' => 'https://google.com',
        ]);});

test("authenticated user cannot view another user's url", function () {
    $user1 = User::factory()->create();
    $user2 = User::factory()->create();
    $url = Url::create([
        'original_url' => 'https://google.com',
        'short_code' => 'goog12',
        'user_id' => $user1->id,
        'is_active' => true,
    ]);

    Sanctum::actingAs($user2);

    $response = $this->getJson("/api/urls/{$url->id}");

    $response->assertStatus(403);
});