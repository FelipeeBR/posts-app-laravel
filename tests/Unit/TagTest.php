<?php

namespace Tests\Unit;

use App\Models\Tag;
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

    public function test_can_update_tag(): void {
        $user = User::factory()->create();
        $token = $user->createToken('auth_token')->plainTextToken;

        $tag = Tag::factory()->create();

        $response = $this->withHeaders(['Authorization' => 'Bearer ' . $token])->putJson('/api/tag/' . $tag->id, [
            'name' => 'Updated Tag',
            'slug' => 'updated-tag',
        ]);

        $response->assertStatus(200)->assertJsonStructure(['data' => ['id', 'name', 'slug'], 'message']);
    }

    public function test_can_delete_tag(): void {
        $user = User::factory()->create();
        $token = $user->createToken('auth_token')->plainTextToken;

        $tag = Tag::factory()->create();

        $response = $this->withHeaders(['Authorization' => 'Bearer ' . $token])->deleteJson('/api/tag/' . $tag->id);

        $response->assertStatus(200)->assertJsonStructure(['message']);
    }

    public function test_can_view_tag(): void {
        $user = User::factory()->create();
        $token = $user->createToken('auth_token')->plainTextToken;

        $tag = Tag::factory()->create();

        $response = $this->withHeaders(['Authorization' => 'Bearer ' . $token])->getJson('/api/tag/' . $tag->id);

        $response->assertStatus(200)->assertJsonStructure(['data' => ['id', 'name', 'slug']]);
    }

    public function test_can_view_all_tags(): void {
        $user = User::factory()->create();
        $token = $user->createToken('auth_token')->plainTextToken;

        $response = $this->withHeaders(['Authorization' => 'Bearer ' . $token])->getJson('/api/tag');

        $response->assertStatus(200);
    }
}
