<?php

namespace Tests\Browser;

use App\Models\User;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class UnauthorizedAccessBrowserTest extends DuskTestCase
{
    public function test_user_cannot_access_admin_categories_page(): void
    {
        $user = User::factory()->create([
            'name' => 'Usuário Comum',
            'email' => 'user.' . uniqid() . '@example.com',
            'password' => bcrypt('password'),
            'role' => User::ROLE_USER,
        ]);

        $this->browse(function (Browser $browser) use ($user) {

            $browser
                ->visit('/login')

                ->waitFor('input[name="email"]', 5)

                ->type('email', $user->email)
                ->type('password', 'password')

                ->pause(300)

                ->click('button[type="submit"]')

                ->waitForLocation('/dashboard', 10)

                ->visit('/categories')

                ->pause(1000)

                ->assertPathIs('/categories')

                ->assertSee('403');
        });
    }
}
