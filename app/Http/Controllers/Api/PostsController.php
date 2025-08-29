<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Post;
use Exception;
use Symfony\Component\HttpFoundation\Response;

class PostsController extends Controller
{
    public function store(Request $resquest) {
        try {
            $post = Post::create($resquest->all());
            return response()->json([
                'data' => [
                    'id' => $post->id, 
                    'title' => $post->title, 
                    'body' => $post->body, 
                    'user_id' => $post->user_id
                ], 'message' => 'Post criado com sucesso'], Response::HTTP_CREATED);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        
    }

    public function update(Request $resquest, Post $post) {
        try {
            $post->update($resquest->all());
            return response()->json([
                'data' => [
                    'id' => $post->id, 
                    'title' => $post->title, 
                    'body' => $post->body, 
                    'user_id' => $post->user_id
                ], 'message' => 'Post atualizado com sucesso'], Response::HTTP_OK);
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
}
