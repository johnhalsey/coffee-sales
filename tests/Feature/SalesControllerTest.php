<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Product;
use App\Http\Resources\ProductResource;
use Inertia\Testing\AssertableInertia as Assert;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SalesControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_cannot_access_sales_page()
    {
        $this->get('sales')
            ->assertRedirect('login');
    }

    public function test_auth_users_can_access_sales_page()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        Product::factory(5)->create();

        $response = $this->get('sales')
            ->assertStatus(200)
            ->assertInertia(fn (Assert $page) => $page
                ->component('Sales')
                ->has('products')
                ->has('shipping')
            );

        $data = $response->getOriginalContent()->getData();
        $this->assertCount(5, $data['page']['props']['products']['data']);

    }
}
