<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TicketCreationTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_cannot_access_ticket_from_another_user(): void
    {
        $owner = User::factory()->create();

        $anotherUser = User::factory()->create();

        $category = Category::create([
            'name' => 'Hardware',
            'active' => true
        ]);

        $ticket = Ticket::create([
            'user_id' => $owner->id,
            'category_id' => $category->id,
            'title' => 'Computador sem internet',
            'description' => 'Não consigo acessar a rede.',
            'status' => 'Aberto',
            'priority' => 'Média'
        ]);

        $response = $this
            ->actingAs($anotherUser)
            ->get("/tickets/{$ticket->id}");

        $response->assertStatus(403);
    }

    public function test_admin_can_access_ticket_from_any_user(): void
    {
        $user = User::factory()->create();

        $admin = User::factory()->create([
            'role' => 'admin'
        ]);

        $category = Category::create([
            'name' => 'Rede',
            'active' => true
        ]);

        $ticket = Ticket::create([
            'user_id' => $user->id,
            'category_id' => $category->id,
            'title' => 'Internet instável',
            'description' => 'A conexão está caindo frequentemente.',
            'status' => 'Aberto',
            'priority' => 'Média'
        ]);

        $response = $this
            ->actingAs($admin)
            ->get("/tickets/{$ticket->id}");

        $response->assertStatus(200);

        $response->assertSee('Internet instável');
    }
}