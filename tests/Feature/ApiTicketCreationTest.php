<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class ApiTicketCreationTest extends TestCase
{
    use RefreshDatabase;

    public function test_authenticated_user_can_create_ticket_via_api(): void
    {
        $user = User::factory()->create([
            'role' => User::ROLE_USER,
        ]);

        Sanctum::actingAs($user);

        $category = Category::create([
            'name' => 'Software',
            'active' => true,
        ]);

        $response = $this
            ->withHeaders([
                'Accept' => 'application/json',
            ])
            ->postJson('/api/tickets', [
                'category_id' => $category->id,
                'title' => 'Erro no sistema',
                'description' => 'O sistema está travando ao salvar.',
            ]);

        $response
            ->assertCreated()
            ->assertJson([
                'success' => true,
                'message' => 'Chamado criado com sucesso.',
            ]);

        $this->assertDatabaseHas('tickets', [
            'title' => 'Erro no sistema',
            'description' => 'O sistema está travando ao salvar.',
            'status' => Ticket::STATUS_ABERTO,
            'priority' => Ticket::PRIORITY_MEDIA,
            'user_id' => $user->id,
        ]);
    }
}