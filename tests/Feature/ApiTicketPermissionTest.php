<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class ApiTicketPermissionTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_view_own_ticket_via_api(): void
    {
        $user = User::factory()->create([
            'role' => User::ROLE_USER,
        ]);

        Sanctum::actingAs($user);

        $category = Category::create([
            'name' => 'Hardware',
            'active' => true,
        ]);

        $ticket = Ticket::create([
            'user_id' => $user->id,
            'category_id' => $category->id,
            'title' => 'Problema no monitor',
            'description' => 'Tela piscando constantemente.',
            'status' => Ticket::STATUS_ABERTO,
            'priority' => Ticket::PRIORITY_MEDIA,
        ]);

        $response = $this->getJson("/api/tickets/{$ticket->id}");

        $response
            ->assertOk()
            ->assertJson([
                'success' => true,
            ]);
    }

    public function test_user_cannot_view_ticket_from_another_user_via_api(): void
    {
        $owner = User::factory()->create([
            'role' => User::ROLE_USER,
        ]);

        $anotherUser = User::factory()->create([
            'role' => User::ROLE_USER,
        ]);

        Sanctum::actingAs($anotherUser);

        $category = Category::create([
            'name' => 'Rede',
            'active' => true,
        ]);

        $ticket = Ticket::create([
            'user_id' => $owner->id,
            'category_id' => $category->id,
            'title' => 'Internet caiu',
            'description' => 'Sem conexão.',
            'status' => Ticket::STATUS_ABERTO,
            'priority' => Ticket::PRIORITY_ALTA,
        ]);

        $response = $this->getJson("/api/tickets/{$ticket->id}");

        $response
            ->assertForbidden()
            ->assertJson([
                'success' => false,
            ]);
    }

    public function test_admin_can_view_any_ticket_via_api(): void
    {
        $user = User::factory()->create([
            'role' => User::ROLE_USER,
        ]);

        $admin = User::factory()->create([
            'role' => User::ROLE_ADMIN,
        ]);

        Sanctum::actingAs($admin);

        $category = Category::create([
            'name' => 'Sistema',
            'active' => true,
        ]);

        $ticket = Ticket::create([
            'user_id' => $user->id,
            'category_id' => $category->id,
            'title' => 'Erro interno',
            'description' => 'Sistema travando.',
            'status' => Ticket::STATUS_ABERTO,
            'priority' => Ticket::PRIORITY_URGENTE,
        ]);

        $response = $this->getJson("/api/tickets/{$ticket->id}");

        $response
            ->assertOk()
            ->assertJson([
                'success' => true,
            ]);
    }

    public function test_user_cannot_delete_ticket_via_api(): void
    {
        $user = User::factory()->create([
            'role' => User::ROLE_USER,
        ]);

        Sanctum::actingAs($user);

        $category = Category::create([
            'name' => 'Software',
            'active' => true,
        ]);

        $ticket = Ticket::create([
            'user_id' => $user->id,
            'category_id' => $category->id,
            'title' => 'Erro no programa',
            'description' => 'Aplicativo fechando sozinho.',
            'status' => Ticket::STATUS_ABERTO,
            'priority' => Ticket::PRIORITY_MEDIA,
        ]);

        $response = $this->deleteJson("/api/tickets/{$ticket->id}");

        $response->assertForbidden();

        $this->assertDatabaseHas('tickets', [
            'id' => $ticket->id,
        ]);
    }

    public function test_admin_can_delete_ticket_via_api(): void
    {
        $user = User::factory()->create([
            'role' => User::ROLE_USER,
        ]);

        $admin = User::factory()->create([
            'role' => User::ROLE_ADMIN,
        ]);

        Sanctum::actingAs($admin);

        $category = Category::create([
            'name' => 'Hardware',
            'active' => true,
        ]);

        $ticket = Ticket::create([
            'user_id' => $user->id,
            'category_id' => $category->id,
            'title' => 'Mouse não funciona',
            'description' => 'Mouse desconectando.',
            'status' => Ticket::STATUS_ABERTO,
            'priority' => Ticket::PRIORITY_BAIXA,
        ]);

        $response = $this->deleteJson("/api/tickets/{$ticket->id}");

        $response->assertOk();

        $this->assertDatabaseMissing('tickets', [
            'id' => $ticket->id,
        ]);
    }

    public function test_guest_cannot_access_api_routes(): void
    {
        $response = $this->getJson('/api/tickets');

        $response->assertUnauthorized();
    }
}