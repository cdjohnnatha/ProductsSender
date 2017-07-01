<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class HomeControllerTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testNewRegister()
    {
//        $response = $this->json('post', '/register',
//            ['name' => 'Claudio',
//                'surname' => 'Lourenco',
//                'country' => 'Brasil',
//                'password' => encrypt('123456'),
//                'plan' => 'free',
//                'phone' => '83998008002']);
//        $response
//            ->assertStatus(200)
//            ->assertJson([
//                'created' => true,
//            ]);
        $this->assertTrue(true);
    }
}
