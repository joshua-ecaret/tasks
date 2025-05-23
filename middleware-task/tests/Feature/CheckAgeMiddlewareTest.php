<?php

namespace Tests\Feature;

use Tests\TestCase;

class CheckAgeMiddlewareTest extends TestCase
{
    private $token = 'my-secret-token';

    public function test_access_valid_token()
    {
        $response = $this->getJson('/up', [
            'Authorization' => 'Bearer ' . $this->token,
        ]);

        $response->assertStatus(200);
    }

    public function test_access_invalid_token()
    {
        $invalidToken = 'my-secret-token-invalid';

        $response = $this->getJson('/up', [
            'Authorization' => 'Bearer ' . $invalidToken,
        ]);

        $response->assertStatus(403);
    }

    public function test_access_valid_token_valid_age()
    {
        $response = $this->getJson('/restricted-area?age=29', [
            'Authorization' => 'Bearer ' . $this->token,
        ]);

        $response->assertStatus(200);
    }

    public function test_access_valid_token_invalid_age()
    {
        $response = $this->getJson('/restricted-area?age=9', [
            'Authorization' => 'Bearer ' . $this->token,
        ]);

        $response->assertStatus(403);
    }
}
