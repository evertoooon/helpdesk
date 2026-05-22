<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TicketClosedCommentTest extends TestCase
{
    use RefreshDatabase;

    public function test_closed_ticket_cannot_receive_new_comments(): void
    {
        $user = User::factory()->create();

        $category = Category::create([
            'name' => 'Suporte',
            'active' => true
        ]);

        $ticket = Ticket::create([

            'user_id' => $user->id,

            'category_id' => $category->id,

            'title' => 'Erro crítico',

            'description' => 'Sistema não responde.',

            'status' => 'Resolvido',

            'priority' => 'Alta'

        ]);

        $response = $this
            ->actingAs($user)
            ->post("/tickets/{$ticket->id}/comments", [

                'comment' => 'Ainda estou com problema.'

            ]);

        $response->assertRedirect();

        $response->assertSessionHas('error');

        $this->assertDatabaseMissing('ticket_comments', [

            'comment' => 'Ainda estou com problema.'

        ]);
    }
}