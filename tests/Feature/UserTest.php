<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Product;

class ProductTest extends TestCase
{
    use RefreshDatabase;

    public function test_create_product()
    {
        $response = $this->post(route('ProductController.store'), [
            'name' => 'New Product Test',
            'description' => 'New Product Description',
            'price' => '99',
            'stock' => '10',
        ]);

        // Assert that the post is successfully stored in the database
        $this->assertCount(1, Product::all());

        // Assert that the user is redirected to the Posts Index page after post creation
        $response->assertRedirect(route('products.store'));
    }
}
