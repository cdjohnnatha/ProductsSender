<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UserRestTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testGetAllUsers()
    {
        $response = $this->json('GET', '/user');
        $response->assertStatus(200);
    }

    public function testGetFirstUser()
    {
        $response = $this->json('GET', '/user/1');
        $response->assertStatus(200);
    }

//    public function testUpdateUser()
//    {
//        $user = array('_method' => 'PUT', '_token' => csrf_token(),
//            "name" => "Claudio", "surname" => "Djohnnatha",
//            "email" => "claudio@example.com", "plan" => "free", "phone" => "83998000802");
//
//        $response = $this->post('/user/1/update', $data = $user);
//        $response->assertStatus(201);
//
//    }
}
