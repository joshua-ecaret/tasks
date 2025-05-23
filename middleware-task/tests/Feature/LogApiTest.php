<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Log;
use Tests\TestCase;

class LogApiTest extends TestCase
{
    /**
     * A basic feature test example.
     */
 public function test_logs_request_duration()
    {
        // Arrange: Fake the logger so no actual log is written
        Log::shouldReceive('info')
            ->once()
            ->withArgs(function ($message) {
                // Assert the log message contains method, path, and duration in ms
                return str_starts_with($message, 'GET') &&
                       str_contains($message, 'took') &&
                       str_ends_with($message, 'ms');
            });

        $validToken = 'my-secret-token';

        $response = $this->getJson('/up', [
            'Authorization' => 'Bearer ' . $validToken,
        ]);

        // Assert: Middleware does not block the request
        $response->assertStatus(200);
    }
}
