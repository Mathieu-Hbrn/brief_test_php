<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\Product;

class ProductFonctTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        $this->seed();
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

        $response= $this->get('/products');
        $response->assertStatus(200);
        $response->assertSee('New Product Test');

        $this->assertDatabaseHas('products', [
            'name' => 'New Product Test',
        ])
        ;
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
        $response= $this->get('/products');
        $response->assertStatus(200);
        $response->assertSee('New Product Test');

        // Fait la requête de mise à jour
        $product->update($dataUpdate);
        $response= $this->get('/products');
        $response->assertStatus(200);
        $response->assertSee('Updated Product Test');

        // Vérifie que la BDD contient la version mise à jour
        $this->assertDatabaseHas('products', [
            'id' => $product->id,
            'name' => 'Updated Product Test',
        ]);

    }

    public function testDestroyProduct(): void
    {
        $data = [
            'name' => 'New Product Test',
            'description' => 'New Product Description',
            'price' => 99.99,
            'stock' => 10,
        ];

        $product = Product::create($data);

        $this->withoutMiddleware(\App\Http\Middleware\VerifyCsrfToken::class);

        $response = $this->delete(route('products.destroy', $product));

        $response->assertStatus(302);
        $response->assertRedirect(route('products.index'));
        $this->assertDatabaseMissing('products', ['id' => $product->id]);
        $response->assertSessionHas('success', 'Produit supprimé avec succès !');
    }

}
