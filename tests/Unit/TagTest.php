<?php

namespace Tests\Unit;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TagTest extends TestCase
{
    use RefreshDatabase;
    
    public function test_can_create_tag(): void {
        $user = User::factory()->create();
        $token = $user->createToken('auth_token')->plainTextToken;

        $response = $this->withHeaders(['Authorization' => 'Bearer ' . $token])->postJson('/api/tag', [
            'name' => 'Test Tag',
            'slug' => 'test-tag',
        ]);

        $response->assertStatus(201)->assertJsonStructure(['data' => ['id', 'name', 'slug'], 'message']);
    }
}
