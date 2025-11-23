<?php
namespace Tests\Feature;

use Tests\TestCase;
use Mockery;
use App\Repositories\CheckoutRepository;
use App\Repositories\CheckoutItemRepository;

class CheckoutFeatureTest extends TestCase
{
    public function test_store_checkout_endpoint()
    {
        $payload = [
            'user_id' => 1,
            'status' => 'pending',
            'order_date' => now()->toDateTimeString(),
            'items' => [
                ['product_id' => 1, 'quantity' => 2, 'price_at_checkout' => 500],
            ],
        ];

        $response = $this->postJson('/api/checkout', $payload);
        $response->assertStatus(201)
                 ->assertJson([
                     'success' => true,
                     'message' => 'insert successfully!'
                 ]);
    }
}
