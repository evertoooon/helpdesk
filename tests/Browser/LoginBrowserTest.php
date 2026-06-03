<?php

namespace Tests\Browser;

use App\Models\User;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class LoginBrowserTest extends DuskTestCase
{
    public function test_user_can_login_using_browser(): void
    {
        $user = User::factory()->create([
            'name' => 'Everton Teste',
            'email' => 'everton.teste.' . uniqid() . '@example.com',
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
                ->assertPathIs('/dashboard')
                ->assertSee('Everton Teste');
        });
    }
}