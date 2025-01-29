<?php

namespace Tests\Feature\Api;

use Tests\TestCase;
use App\Models\Sale;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SalesControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_auth_user_can_index_their_sales()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        Sale::factory(5)->create([
            'user_id' => $user->id
        ]);

        // factory some more for different users
        Sale::factory(5)->create();

        $response = $this->json(
            'GET',
            'api/sales'
        )->assertStatus(200);

        $data = json_decode($response->getContent(), true);

        $this->assertCount(5, $data);
    }

    public function test_auth_user_can_record_new_sale()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->json(
            'POST',
            'api/sales',
            [
                'quantity' => 5,
                'unit_cost' => 10,
                'selling_cost' => 15.88
            ]
        )->assertStatus(200);

        $data = json_decode($response->getContent(), true);

        $this->assertEquals('Order created successfully', $data['message']);

        $this->assertDatabaseHas('sales', [
            'user_id' => $user->id,
            'quantity' => 5,
            'unit_cost' => 10,
            'selling_cost' => 15.88
        ]);
    }

    public function test_validation_will_fail_if_fields_missing()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->json(
            'POST',
            'api/sales',
            [

            ]
        )->assertStatus(422)
            ->assertJsonFragment([
                'quantity' => ['The quantity field is required.'],
                'unit_cost' => ['The unit cost field is required.'],
                'selling_cost' => ['The selling cost field is required.']
            ]);
    }

    public function test_validattion_will_fail_if_quantity_not_a_number()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->json(
            'POST',
            'api/sales',
            [
                'quantity' => 1.2,
                'unit_cost' => 10,
                'selling_cost' => 15.88
            ]
        )->assertStatus(422)
            ->assertJsonFragment([
                'quantity' => ['The quantity field must be an integer.']
            ]);
    }

    public function test_validattion_will_fail_if_unit_cost_is_not_numeric()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->json(
            'POST',
            'api/sales',
            [
                'quantity' => 1,
                'unit_cost' => 'not numeric number',
                'selling_cost' => 15.88
            ]
        )->assertStatus(422)
            ->assertJsonFragment([
                'unit_cost' => ['The unit cost field must be a number.']
            ]);
    }
}
