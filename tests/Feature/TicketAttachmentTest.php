<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class TicketAttachmentTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_create_ticket_with_image_attachment(): void
    {
        Storage::fake('public');

        $user = User::factory()->create([
            'role' => User::ROLE_USER,
        ]);

        $category = Category::create([
            'name' => 'Hardware',
            'active' => true,
        ]);

        $file = UploadedFile::fake()->create(
            'erro-monitor.png',
            100,
            'image/png'
        );

        $response = $this
            ->actingAs($user)
            ->post(route('tickets.store'), [
                'category_id' => $category->id,
                'title' => 'Monitor com erro',
                'description' => 'O monitor está piscando.',
                'attachment' => $file,
            ]);

        $response->assertRedirect(route('tickets.index'));

        $ticket = Ticket::where('title', 'Monitor com erro')->first();

        $this->assertNotNull($ticket);
        $this->assertNotNull($ticket->attachment);
        $this->assertSame(Ticket::STATUS_ABERTO, $ticket->status);
        $this->assertSame(Ticket::PRIORITY_MEDIA, $ticket->priority);

        $this->assertTrue(
            Storage::disk('public')->exists($ticket->attachment)
        );
    }

    public function test_user_can_create_ticket_without_attachment(): void
    {
        $user = User::factory()->create([
            'role' => User::ROLE_USER,
        ]);

        $category = Category::create([
            'name' => 'Software',
            'active' => true,
        ]);

        $response = $this
            ->actingAs($user)
            ->post(route('tickets.store'), [
                'category_id' => $category->id,
                'title' => 'Sistema travando',
                'description' => 'O sistema fecha sozinho.',
            ]);

        $response->assertRedirect(route('tickets.index'));

        $this->assertDatabaseHas('tickets', [
            'title' => 'Sistema travando',
            'attachment' => null,
            'status' => Ticket::STATUS_ABERTO,
            'priority' => Ticket::PRIORITY_MEDIA,
        ]);
    }

    public function test_invalid_attachment_type_is_rejected(): void
    {
        Storage::fake('public');

        $user = User::factory()->create([
            'role' => User::ROLE_USER,
        ]);

        $category = Category::create([
            'name' => 'Rede',
            'active' => true,
        ]);

        $file = UploadedFile::fake()->create(
            'arquivo.pdf',
            100,
            'application/pdf'
        );

        $response = $this
            ->actingAs($user)
            ->post(route('tickets.store'), [
                'category_id' => $category->id,
                'title' => 'Problema na rede',
                'description' => 'A internet está lenta.',
                'attachment' => $file,
            ]);

        $response->assertSessionHasErrors('attachment');

        $this->assertDatabaseMissing('tickets', [
            'title' => 'Problema na rede',
        ]);
    }

    public function test_large_attachment_is_rejected(): void
    {
        Storage::fake('public');

        $user = User::factory()->create([
            'role' => User::ROLE_USER,
        ]);

        $category = Category::create([
            'name' => 'Sistema',
            'active' => true,
        ]);

        $file = UploadedFile::fake()->create(
            'imagem-grande.png',
            3000,
            'image/png'
        );

        $response = $this
            ->actingAs($user)
            ->post(route('tickets.store'), [
                'category_id' => $category->id,
                'title' => 'Erro com imagem grande',
                'description' => 'Teste de imagem acima do limite.',
                'attachment' => $file,
            ]);

        $response->assertSessionHasErrors('attachment');

        $this->assertDatabaseMissing('tickets', [
            'title' => 'Erro com imagem grande',
        ]);
    }
}