<?php

namespace Tests\Browser;

use App\Models\User;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class AdminCategoryBrowserTest extends DuskTestCase
{
    public function test_admin_can_create_category_using_browser(): void
    {
        $admin = User::factory()->create([
            'name' => 'Admin Dusk',
            'email' => 'admin.' . uniqid() . '@example.com',
            'password' => bcrypt('password'),
            'role' => User::ROLE_ADMIN,
        ]);

        $this->browse(function (Browser $browser) use ($admin) {

            $browser
                ->visit('/login')

                ->waitFor('input[name="email"]', 5)

                ->type('email', $admin->email)
                ->type('password', 'password')

                ->pause(300)

                ->click('button[type="submit"]')

                ->waitForLocation('/dashboard', 10)

                ->visit('/categories/create')

                ->waitFor('input[name="name"]', 5)

                ->type(
                    'name',
                    'Categoria Dusk ' . uniqid()
                )

                ->type(
                    'description',
                    'Categoria criada automaticamente via Laravel Dusk.'
                )

                ->check('active')

                ->press('Salvar Categoria')

                ->pause(1000)

                ->assertSee('Categoria');
        });
    }
}
