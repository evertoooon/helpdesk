<?php

namespace Tests\Browser;

use App\Models\Category;
use App\Models\User;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class CreateTicketBrowserTest extends DuskTestCase
{
    public function test_user_can_create_ticket_using_browser(): void
    {
        $user = User::factory()->create([
            'name' => 'Usuário Dusk',
            'email' => 'dusk.' . uniqid() . '@example.com',
            'password' => bcrypt('password'),
            'role' => User::ROLE_USER,
        ]);

        $category = Category::create([
            'name' => 'Software',
            'description' => 'Problemas relacionados a software',
            'active' => true,
        ]);

        $this->browse(function (Browser $browser) use ($user, $category) {

            $browser
                ->visit('/login')

                ->waitFor('input[name="email"]', 5)

                ->type('email', $user->email)
                ->type('password', 'password')

                ->pause(300)

                ->click('button[type="submit"]')

                ->waitForLocation('/dashboard', 10)

                ->visit('/tickets/create')

                ->waitFor('input[name="title"]', 5)

                ->select('category_id', (string) $category->id)

                ->type('title', 'Erro via Dusk')

                ->type(
                    'description',
                    'Chamado criado automaticamente pelo Laravel Dusk.'
                )

                ->press('Abrir Chamado')

                ->pause(1000)

                ->assertSee('Erro via Dusk');
        });
    }
}