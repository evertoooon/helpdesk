<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TicketPermissionTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_access_own_ticket(): void
    {
        $user = User::factory()->create([
            'role' => User::ROLE_USER,
        ]);

        $category = Category::create([
            'name' => 'Hardware',
            'active' => true,
        ]);

        $ticket = Ticket::create([
            'user_id' => $user->id,
            'category_id' => $category->id,
            'title' => 'Computador sem internet',
            'description' => 'Não consigo acessar a rede.',
            'status' => Ticket::STATUS_ABERTO,
            'priority' => Ticket::PRIORITY_MEDIA,
        ]);

        $response = $this
            ->actingAs($user)
            ->get(route('tickets.show', $ticket));

        $response->assertOk();
        $response->assertSee('Computador sem internet');
    }

    public function test_user_cannot_access_ticket_from_another_user(): void
    {
        $owner = User::factory()->create([
            'role' => User::ROLE_USER,
        ]);

        $anotherUser = User::factory()->create([
            'role' => User::ROLE_USER,
        ]);

        $category = Category::create([
            'name' => 'Hardware',
            'active' => true,
        ]);

        $ticket = Ticket::create([
            'user_id' => $owner->id,
            'category_id' => $category->id,
            'title' => 'Computador sem internet',
            'description' => 'Não consigo acessar a rede.',
            'status' => Ticket::STATUS_ABERTO,
            'priority' => Ticket::PRIORITY_MEDIA,
        ]);

        $response = $this
            ->actingAs($anotherUser)
            ->get(route('tickets.show', $ticket));

        $response->assertForbidden();
    }

    public function test_admin_can_access_ticket_from_any_user(): void
    {
        $user = User::factory()->create([
            'role' => User::ROLE_USER,
        ]);

        $admin = User::factory()->create([
            'role' => User::ROLE_ADMIN,
        ]);

        $category = Category::create([
            'name' => 'Rede',
            'active' => true,
        ]);

        $ticket = Ticket::create([
            'user_id' => $user->id,
            'category_id' => $category->id,
            'title' => 'Internet instável',
            'description' => 'A conexão está caindo frequentemente.',
            'status' => Ticket::STATUS_ABERTO,
            'priority' => Ticket::PRIORITY_MEDIA,
        ]);

        $response = $this
            ->actingAs($admin)
            ->get(route('tickets.show', $ticket));

        $response->assertOk();
        $response->assertSee('Internet instável');
    }
}