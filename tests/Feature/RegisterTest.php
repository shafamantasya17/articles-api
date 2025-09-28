<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;

class RegisterTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_registers_user_successfully_with_valid_data()
    {
        $payload = [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => 'Passw0rd@'
        ];

        $response = $this->postJson('/api/register', $payload);

        $response->assertStatus(201)
                 ->assertJson([
                     'message' => 'User registered successfully'
                 ]);

        $this->assertDatabaseHas('users', [
            'email' => 'john@example.com'
        ]);
    }

    /** @test */
    public function it_fails_when_name_is_invalid()
    {
        $payload = [
            'name' => 'Jo1',
            'email' => 'john@example.com',
            'password' => 'Passw0rd@'
        ];

        $response = $this->postJson('/api/register', $payload);

        $response->assertStatus(422)
                 ->assertJsonStructure(['message','errors' => ['name']]);
    }

    /** @test */
    public function it_fails_when_email_is_invalid()
    {
        $payload = [
            'name' => 'John Doe',
            'email' => 'invalidemail',
            'password' => 'Passw0rd@'
        ];

        $response = $this->postJson('/api/register', $payload);

        $response->assertStatus(422)
                 ->assertJsonStructure(['message','errors' => ['email']]);
    }

    /** @test */
    public function it_fails_when_password_is_invalid()
    {
        $payload = [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => 'password'
        ];

        $response = $this->postJson('/api/register', $payload);

        $response->assertStatus(422)
                 ->assertJsonStructure(['message','errors' => ['password']]);
    }
}
