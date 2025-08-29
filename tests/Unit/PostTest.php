<?php

namespace Tests\Unit;

use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PostTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_create_post(): void {
        $user = User::factory()->create();
        $tags = Tag::factory()->create();
        $token = $user->createToken('auth_token')->plainTextToken;

        $response = $this->withHeaders(['Authorization' => 'Bearer ' . $token])->postJson('/api/post', [
            'title' => 'Test Post',
            'body' => 'This is a test post.',
            'user_id' => $user->id,
            'tags' => [$tags->id]
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

    public function test_can_update_post(): void {
        $user = User::factory()->create();
        $tags = Tag::factory()->create();
        $token = $user->createToken('auth_token')->plainTextToken;

        $post = Post::factory()->create([
            'user_id' => $user->id
        ]);

        $response = $this->withHeaders(['Authorization' => 'Bearer ' . $token])->putJson('/api/post/'. $post->id , [
            'id' => $post->id,
            'title' => 'Updated Post',
            'body' => 'This is an updated post.',
            'user_id' => $user->id,
            'tags' => [$tags->id]
        ]);

        $response->assertStatus(200);
    }

    public function test_can_view_post(): void {
        $user = User::factory()->create();
        $token = $user->createToken('auth_token')->plainTextToken;

        $post = Post::factory()->create([
            'user_id' => $user->id
        ]);

        $response = $this->withHeaders(['Authorization' => 'Bearer ' . $token])->getJson('/api/post/'. $post->id);

        $response->assertStatus(200);
    }

    public function test_can_views_all_posts(): void {
        $user = User::factory()->create();
        $token = $user->createToken('auth_token')->plainTextToken;

        $post = Post::factory()->create([
            'user_id' => $user->id
        ]);

        $response = $this->withHeaders(['Authorization' => 'Bearer ' . $token])->getJson('/api/post');

        $response->assertStatus(200);
    }

    public function test_can_delete_post(): void {
        $user = User::factory()->create();
        $token = $user->createToken('auth_token')->plainTextToken;

        $post = Post::factory()->create([
            'user_id' => $user->id
        ]);

        $response = $this->withHeaders(['Authorization' => 'Bearer ' . $token])->deleteJson('/api/post/'. $post->id);

        $response->assertStatus(200);
    }
}
