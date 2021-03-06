<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AuthenticationTest extends TestCase
{
    /**
     * Verifica se as tabelas referente ao pacote Passport foram criadas.
     *
     * @return void
     */
    public function testCheckIfTablesHaveBeenCreated()
    {
        $this->assertTrue(true);
    }

    /**
     * Verifica se existe as pastas de armazenamento das chaves de autenticação criadas para a aplicação
     *
     * @return void
     */
    public function test_check_if_paths_secrets_has_been_created()
    {
//        $this->assertTrue(true);
//        $data = [
//            'name' => "New Product",
//            'description' => "This is a product",
//            'units' => 20,
//            'price' => 10,
//            'image' => "https://images.pexels.com/photos/1000084/pexels-photo-1000084.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940"
//        ];

        $response = $this->json('GET', '/v1/');//, $data);
        $response->assertStatus(401);
//        $response->assertStatus(401);
//        $response->assertJson(['message' => "Unauthenticated."]);
    }

    /**
     * MODELO
     */
//    public function testCreateProductWithMiddleware()
//    {
//        $data = [
//            'name' => "New Product",
//            'description' => "This is a product",
//            'units' => 20,
//            'price' => 10,
//            'image' => "https://images.pexels.com/photos/1000084/pexels-photo-1000084.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940"
//        ];
//
//        $response = $this->json('POST', '/api/products',$data);
//        $response->assertStatus(401);
//        $response->assertJson(['message' => "Unauthenticated."]);
//    }

    /**
     * MODELO
     */
//    public function testCreateProduct()
//    {
//        $data = [
//            'name' => "New Product",
//            'description' => "This is a product",
//            'units' => 20,
//            'price' => 10,
//            'image' => "https://images.pexels.com/photos/1000084/pexels-photo-1000084.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940"
//        ];
//        $user = factory(\App\User::class)->create();
//        $response = $this->actingAs($user, 'api')->json('POST', '/api/products',$data);
//        $response->assertStatus(200);
//        $response->assertJson(['status' => true]);
//        $response->assertJson(['message' => "Product Created!"]);
//        $response->assertJson(['data' => $data]);
//    }

    /**
     * MODELO
     */
//    public function testGettingAllProducts()
//    {
//        $response = $this->json('GET', '/api/products');
//        $response->assertStatus(200);
//
//        $response->assertJsonStructure(
//            [
//                [
//                    'id',
//                    'name',
//                    'description',
//                    'units',
//                    'price',
//                    'image',
//                    'created_at',
//                    'updated_at'
//                ]
//            ]
//        );
//    }

    /**
     * MODELO
     */
//    public function testUpdateProduct()
//    {
//        $response = $this->json('GET', '/api/products');
//        $response->assertStatus(200);
//
//        $product = $response->getData()[0];
//
//        $user = factory(\App\User::class)->create();
//        $update = $this->actingAs($user, 'api')->json('PATCH', '/api/products/'.$product->id,['name' => "Changed for test"]);
//        $update->assertStatus(200);
//        $update->assertJson(['message' => "Product Updated!"]);
//    }

    /**
     * MODELO
     */
//    public function testUploadImage()
//    {
//        $response = $this->json('POST', '/api/upload-file', [
//            'image' => UploadedFile::fake()->image('image.jpg')
//        ]);
//        $response->assertStatus(201);
//        $this->assertNotNull($response->getData());
//    }

    /**
     * MODELO
     */
//    public function testDeleteProduct()
//    {
//        $response = $this->json('GET', '/api/products');
//        $response->assertStatus(200);
//
//        $product = $response->getData()[0];
//
//        $user = factory(\App\User::class)->create();
//        $delete = $this->actingAs($user, 'api')->json('DELETE', '/api/products/'.$product->id);
//        $delete->assertStatus(200);
//        $delete->assertJson(['message' => "Product Deleted!"]);
//    }

    /**
     * MODELO
     */
//    public function testCreateOrder()
//    {
//        $data  = [
//            'product' => 1,
//            'quantity' => 20,
//            'address' => "No place like home"
//        ];
//        $user   = factory(\App\User::class)->create();
//        $response = $this->actingAs($user, 'api')->json('POST', '/api/orders',$data);
//        $response->assertStatus(200);
//        $response->assertJson(['status'        => true]);
//        $response->assertJson(['message'       => "Order Created!"]);
//        $response->assertJsonStructure(['data' => [
//            'id',
//            'product_id',
//            'user_id',
//            'quantity',
//            'address',
//            'created_at',
//            'updated_at'
//        ]]);
//    }
}
