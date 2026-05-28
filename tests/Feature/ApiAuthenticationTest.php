<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ApiAuthenticationTest extends TestCase
{
    use RefreshDatabase;

    public function test_api_tickets_requires_authentication(): void
    {
        $response = $this
            ->withHeaders([
                'Accept' => 'application/json',
            ])
            ->getJson('/api/tickets');

        $response->assertUnauthorized();
    }

    public function test_api_ticket_creation_requires_authentication(): void
    {
        $response = $this
            ->withHeaders([
                'Accept' => 'application/json',
            ])
            ->postJson('/api/tickets', []);

        $response->assertUnauthorized();
    }
}