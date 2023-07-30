<?php


use Tests\TestCase;

class UsersTest extends TestCase
{
    public function test_the_application_returns_a_successful_response(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
    public function test_the_users_returns_a_successful_response(): void
    {
        $response = $this->get('/api/users');

        $response->assertStatus(200);
    }
}
