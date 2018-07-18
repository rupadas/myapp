<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SellerTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testAllSellersInfo()
    {
        $response = $this->json('GET', 'api/v1/sellers');

        // assert
        $response ->assertStatus(200)
                    ->assertJsonStructure([
                        'status',
                        'data' =>[
                            '*' => [
                                'id',
                                'name',
                                'seller_type_id',
                                'seller_type'=>[
                                    'id',
                                    'name',
                                    'created_at',
                                    'updated_at'
                                ]
                            ]
                        ]
                    ]);
    }

    public function testSellerSendEmail()
    {
        $response = $this->json('POST', 'api/v1/seller/1/sendEmail', ['body' => 'test', 'subject' => 'test','from' => 'test@email.com']);

        // assert
        $response ->assertStatus(200)
                ->assertJsonStructure(['status','message' ])
                ->assertJson(['status' => 200, 'message' => 'Email Sent']);
    }
}
