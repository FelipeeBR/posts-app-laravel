<?php

namespace Tests\Unit;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_create_user(): void {
        $response = $this->postJson('/api/user', [
            'name' => 'John Doe',
            'email' => 'LbHj0@example.com',
            'password' => 'password',
        ]);
       
        $response->assertStatus(201)->assertJsonStructure(['data' => ['id', 'name', 'email'], 'message']);

        $this->assertDatabaseHas('users', [
            'email' => 'LbHj0@example.com'
        ]);
    }

    public function test_cannot_create_user_with_existing_email(): void {
        $user = User::factory()->create();

        $response = $this->postJson('/api/user', [
            'name' => 'John Doe',
            'email' => $user->email,
            'password' => 'password',
        ]);

        $response->assertStatus(422);
    }

    public function test_cannot_create_user_with_invalid_name(): void {
        $response = $this->postJson('/api/user', [
            'name' => '',
            'email' => 'LbHj0@example.com',
            'password' => 'password',
        ]);

        $response->assertStatus(422);
    }

    public function test_cannot_create_user_with_invalid_email(): void {
        $response = $this->postJson('/api/user', [
            'name' => 'John Doe',
            'email' => 'invalid-email',
            'password' => 'password',
        ]);

        $response->assertStatus(422);
    }

    public function test_cannot_create_user_with_invalid_password(): void {
        $response = $this->postJson('/api/user', [
            'name' => 'John Doe',
            'email' => 'LbHj0@example.com',
            'password' => 'pass',
        ]);

        $response->assertStatus(422);
    }

    public function test_can_update_user(): void {
        $user = User::factory()->create();
        $token = $user->createToken('auth_token')->plainTextToken;

        $response = $this->withHeaders(['Authorization' => 'Bearer ' . $token])->putJson('/api/user/'. $user->id , [
            'id' => $user->id,
            'name' => 'John Doe',
            'email' => 'test@example.com',
            'password' => 'password',
        ]);

        $response->assertStatus(200);
    }

    public function test_can_delete_user(): void {
        $user = User::factory()->create();
        $token = $user->createToken('auth_token')->plainTextToken;

        $response = $this->withHeaders(['Authorization' => 'Bearer ' . $token])->deleteJson('/api/user/'. $user->id);

        $response->assertStatus(200);
    }
}
