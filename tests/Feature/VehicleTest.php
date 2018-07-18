<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class VehicleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    
    public function testListingVehicles()
    {
        //$response = $this->json('GET', 'api/v1/listings', ['type_id' => '1']);

        $response = $this->json('GET', 'api/v1/listings');
        // assert
        $response   ->assertStatus(200)
                    ->assertJsonStructure([
                        'status',
                        'data' =>[
                            '*' => [
                                'id',
                                'year',
                                'make',
                                'model',
                                'price',
                                'meta_deta',
                                'type_id',
                                'seller_id',
                                'created_at',
                                'updated_at',
                                'type'=>[
                                    'id',
                                    'name',
                                    'created_at',
                                    'updated_at'
                                ]
                            ]
                        ]
                    ]);
    }

    public function testSearchListingVehicles()
    {
        $response = $this->json('POST', 'api/v1/listings/search', ['type_id' => '1']);
        // assert
        $response   ->assertStatus(200)
                    ->assertJsonStructure([
                        'status',
                        'data' =>[
                            '*' => [
                                'id',
                                'year',
                                'make',
                                'model',
                                'price',
                                'meta_deta',
                                'type_id',
                                'seller_id',
                                'created_at',
                                'updated_at',
                                'type'=>[
                                    'id',
                                    'name',
                                    'created_at',
                                    'updated_at'
                                ]
                            ]
                        ]
                    ]);
    }

    public function testListingDetails()
    {
        $response = $this->json('GET', 'api/v1/listing/1');

        // assert
        $response   ->assertStatus(200)
                    ->assertSuccessful()
                    ->assertJsonStructure([
                        'status',
                        'data' =>[
                            '*' => [
                                'id',
                                'year',
                                'make',
                                'model',
                                'price',
                                'meta_deta',
                                'type_id',
                                'seller_id',
                                'created_at',
                                'updated_at',
                                'type'=>[
                                    'id',
                                    'name',
                                    'created_at',
                                    'updated_at'
                                ],
                                'seller'=>[
                                    'id',
                                    'name',
                                    'email',
                                    'phone',
                                    'website',
                                    'address',
                                    'seller_type_id',
                                    'created_at',
                                    'updated_at'
                                ],
                                'reviews'=> [
                                    '*' => [
                                        'id',
                                        'comment',
                                        'seller_id',
                                        'vehicle_id',
                                        'created_at',
                                        'updated_at'
                                    ]
                                ],
                                'images'=>[
                                    '*' => [
                                        'id',
                                        'path',
                                        'name',
                                        'created_at',
                                        'updated_at',
                                        'pivot' => [
                                            'vehicle_id',
                                            'image_id'
                                        ]
                                    ]
                                ]
                            ]
                        ]
                    ]);
    }

    public function testlistingReviewResponse()
    {
        $response = $this->json('GET', 'api/v1/listing/1/reviews');

        // assert
        $response   ->assertStatus(200)
                    ->assertSuccessful()
                    ->assertJsonStructure([
                        'status',
                        'data' =>[
                            '*' => [
                                'id',
                                'year',
                                'make',
                                'model',
                                'price',
                                'meta_deta',
                                'type_id',
                                'seller_id',
                                'created_at',
                                'updated_at',
                                'reviews'=> [
                                    '*' => [
                                        'id',
                                        'comment',
                                        'seller_id',
                                        'vehicle_id',
                                        'created_at',
                                        'updated_at'
                                    ]
                                ],
                            ]
                        ]
                    ]);
    }

    public function testGetVehicleListView()
    {
        $response = $this->get('/vehicles');
        $response->assertStatus(200)->assertViewHas('data');
    }

    public function testGetVehicleDetailsView()
    {
        $response = $this->get('/vehicles/details/1');
        $response->assertStatus(200)->assertViewHas('data');
    }

    public function testGetVehicleSearchListView()
    {
        $response = $this->get('/vehicles/search?type_id=1');
        $response->assertStatus(200)->assertViewHas('data');
    }
}
