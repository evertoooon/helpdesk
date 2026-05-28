<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CategoryPermissionTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_cannot_access_categories(): void
    {
        $response = $this->get(route('categories.index'));

        $response->assertRedirect(route('login'));
    }

    public function test_user_cannot_access_categories(): void
    {
        $user = User::factory()->create([
            'role' => User::ROLE_USER,
        ]);

        $response = $this
            ->actingAs($user)
            ->get(route('categories.index'));

        $response->assertForbidden();
    }

    public function test_admin_can_access_categories(): void
    {
        $admin = User::factory()->create([
            'role' => User::ROLE_ADMIN,
        ]);

        Category::create([
            'name' => 'Hardware',
            'description' => 'Problemas relacionados a equipamentos físicos.',
            'active' => true,
        ]);

        $response = $this
            ->actingAs($admin)
            ->get(route('categories.index'));

        $response->assertOk();
        $response->assertSee('Hardware');
    }

    public function test_admin_can_create_category(): void
    {
        $admin = User::factory()->create([
            'role' => User::ROLE_ADMIN,
        ]);

        $response = $this
            ->actingAs($admin)
            ->post(route('categories.store'), [
                'name' => 'Rede',
                'description' => 'Problemas de conexão e internet.',
                'active' => true,
            ]);

        $response->assertRedirect(route('categories.index'));

        $this->assertDatabaseHas('categories', [
            'name' => 'Rede',
            'description' => 'Problemas de conexão e internet.',
            'active' => true,
        ]);
    }

    public function test_user_cannot_create_category(): void
    {
        $user = User::factory()->create([
            'role' => User::ROLE_USER,
        ]);

        $response = $this
            ->actingAs($user)
            ->post(route('categories.store'), [
                'name' => 'Segurança',
                'description' => 'Incidentes de segurança.',
                'active' => true,
            ]);

        $response->assertForbidden();

        $this->assertDatabaseMissing('categories', [
            'name' => 'Segurança',
        ]);
    }

    public function test_admin_cannot_create_duplicate_category_name(): void
    {
        $admin = User::factory()->create([
            'role' => User::ROLE_ADMIN,
        ]);

        Category::create([
            'name' => 'Hardware',
            'description' => 'Categoria existente.',
            'active' => true,
        ]);

        $response = $this
            ->actingAs($admin)
            ->post(route('categories.store'), [
                'name' => 'Hardware',
                'description' => 'Categoria duplicada.',
                'active' => true,
            ]);

        $response->assertSessionHasErrors('name');
    }

    public function test_admin_cannot_delete_category_with_tickets(): void
    {
        $admin = User::factory()->create([
            'role' => User::ROLE_ADMIN,
        ]);

        $user = User::factory()->create([
            'role' => User::ROLE_USER,
        ]);

        $category = Category::create([
            'name' => 'Sistema',
            'description' => 'Problemas internos do sistema.',
            'active' => true,
        ]);

        Ticket::create([
            'user_id' => $user->id,
            'category_id' => $category->id,
            'title' => 'Sistema travando',
            'description' => 'O sistema fecha sozinho.',
            'status' => Ticket::STATUS_ABERTO,
            'priority' => Ticket::PRIORITY_MEDIA,
        ]);

        $response = $this
            ->actingAs($admin)
            ->delete(route('categories.destroy', $category));

        $response->assertRedirect(route('categories.index'));

        $this->assertDatabaseHas('categories', [
            'id' => $category->id,
        ]);
    }
}