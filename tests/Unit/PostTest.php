<?php

namespace Tests\Unit;

use App\Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PostTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_create_post(): void {
        $user = User::factory()->create();
        $token = $user->createToken('auth_token')->plainTextToken;

        $response = $this->withHeaders(['Authorization' => 'Bearer ' . $token])->postJson('/api/post', [
            'title' => 'Test Post',
            'body' => 'This is a test post.',
            'user_id' => $user->id
        ]);

        $response->assertStatus(201)->assertJsonStructure(['data' => ['id', 'title', 'body', 'user_id'], 'message']);
    }

    public function test_cannot_create_post_without_title(): void {
        $user = User::factory()->create();
        $token = $user->createToken('auth_token')->plainTextToken;

        $response = $this->withHeaders(['Authorization' => 'Bearer ' . $token])->postJson('/api/post', [
            'body' => 'This is a test post.',
            'user_id' => $user->id
        ]);

        $response->assertStatus(422);
    }
}
