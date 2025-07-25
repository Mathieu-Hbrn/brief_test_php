<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Product;

class ProductTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        $this->seed();
    }

    public function test_list_product(){
        $showProduct = Product::all();
        $response = $this->get('/products');
        $response->assertStatus(200);
        $this->assertDatabaseHas('products',[]);
    }
    public function test_create_product()
    {
        $data = [
            'name' => 'New Product Test',
            'description' => 'New Product Description',
            'price' => 99.99,
            'stock' => 10,
        ];

        $product = Product::create($data);

        $response = $this->post(route('products.store'), $data);

        $this->assertDatabaseHas('products', [
            'name' => 'New Product Test',
        ]);
    }

    public function test_update_product()
    {
        $data = [
            'name' => 'New Product Test',
            'description' => 'New Product Description',
            'price' => 99.99,
            'stock' => 10,
        ];

        $dataUpdate = [
            'name' => 'Updated Product Test',
            'description' => 'Updated Product Description',
            'price' => 150.00,
            'stock' => 25,
        ];

        // Crée un produit initial
        $product = Product::create($data);

        // Fait la requête de mise à jour
        $product->update($dataUpdate);

        // Vérifie que la BDD contient la version mise à jour
        $this->assertDatabaseHas('products', [
            'id' => $product->id,
            'name' => 'Updated Product Test',
        ]);

    }

    public function test_delete_product()
    {
        $data = [
            'name' => 'New Product Test',
            'description' => 'New Product Description',
            'price' => 99.99,
            'stock' => 10,
        ];


        // Crée un produit initial
        $product = Product::create($data);
        $id = $product->id;

        // Fait la requête de delete
        $product->delete($id);

        // Vérifie que la BDD contient la version mise à jour
        $this->assertDatabaseMissing('products', [
            'id' => $product->id,
        ]);

    }



}
