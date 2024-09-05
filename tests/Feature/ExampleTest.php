<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function test_the_application_returns_a_redirect(): void
    {
        $response = $this->get('/');

        $response->assertStatus(302);
    }

    public function test_the_application_returns_a_successful_response_not_logged(): void
    {
        $response = $this->get('/dashboard');

        $response->assertStatus(302);
    }

    public function test_the_application_returns_a_successful_response(): void
    {
        $response = $this->get('/login');

        $response->assertStatus(200);
    }
}
