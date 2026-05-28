<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class ApiTicketValidationTest extends TestCase
{
    use RefreshDatabase;

    public function test_api_returns_422_when_required_fields_are_missing(): void
    {
        $user = User::factory()->create([
            'role' => User::ROLE_USER,
        ]);

        Sanctum::actingAs($user);

        $response = $this
            ->withHeaders([
                'Accept' => 'application/json',
            ])
            ->postJson('/api/tickets', [
                'title' => '',
                'description' => '',
            ]);

        $response
            ->assertUnprocessable()
            ->assertJsonValidationErrors([
                'category_id',
                'title',
                'description',
            ]);
    }
}