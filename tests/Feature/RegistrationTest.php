<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RegistrationTest extends TestCase {
    public function testUserCanLogin() {
        try {
            $response = $this->postJson('login', [
                'email' => 'abhishek@gmail.com',
                'password' => 'abhishek'
            ]);

            $response->assertStatus(200)->assertJson(['message'=>'success']);

        } catch(Throwable $th) {
            return $th->getMessage();
        }
    }
}
