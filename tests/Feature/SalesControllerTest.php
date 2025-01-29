<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Inertia\Testing\AssertableInertia as Assert;

class SalesControllerTest extends TestCase
{
    public function test_guest_cannot_access_sales_page()
    {
        $this->get('sales')
            ->assertRedirect('login');
    }

    public function test_auth_users_can_access_sales_page()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $this->get('sales')
            ->assertStatus(200)
            ->assertInertia(fn (Assert $page) => $page
                ->component('Sales')
                ->has('markup')
                ->has('shipping')
            );

    }
}
