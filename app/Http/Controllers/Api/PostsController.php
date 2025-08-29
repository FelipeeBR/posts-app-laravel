<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Post;
use Exception;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Requests\PostRequest;
use App\Services\PostService;
use App\Http\Resources\PostResource;

class PostsController extends Controller
{
    public function store(PostRequest $request, PostService $postService) {
        try {
            $post = $postService->create($request->validated());

            return response()->json([
                'data' => new PostResource($post->load('tags')), 'message' => 'Post criado com sucesso'], Response::HTTP_CREATED);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        
    }

    public function update(PostRequest $request, Post $post, PostService $postService) {
        try {
            $postService->update($request->all(), $post);
            return response()->json([
                'data' => new PostResource($post->load('tags')), 'message' => 'Post atualizado com sucesso'], Response::HTTP_OK);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        
    }

    public function index() {
        $posts = Post::all();
        return response()->json(['data' => $posts], Response::HTTP_OK);
    }

    public function view(Post $post) {
        return response()->json(['data' => $post], Response::HTTP_OK);
    }

    public function delete(Post $post, PostService $postService) {
        $postService->delete($post);
        return response()->json(['message' => 'Post deletado com sucesso'], Response::HTTP_OK);
    }
}
