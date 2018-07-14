<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SellerTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
         $this->json('GET', '/seller', ['name' => 'Sally'])
             ->seeJson([
                 'created' => true,
             ]);
    }

    // private $mytest;


    // protected function setUp()
    // {
    //     $this->mytest = new MyTest();
    // }


    // protected function tearDown()
    // {
    //     $this->mytest = NULL;
    // }


    // public function testAdd()
    // {
    //     $result = $this->mytest->add(1, 3);
    //     $this->assertEquals(4, $result);
    // }
}
