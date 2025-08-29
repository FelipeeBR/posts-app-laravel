<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TagController extends Controller
{
    public function store(Request $request) {
        $tag = Tag::create($request->all());
        return response()->json(['data' => ['id' => $tag->id, 'name' => $tag->name, 'slug' => $tag->slug], 'message' => 'Tag criada com sucesso'], Response::HTTP_CREATED);
    }

    public function update(Request $request, Tag $tag) {
        $tag->update($request->all());
        return response()->json(['data' => ['id' => $tag->id, 'name' => $tag->name, 'slug' => $tag->slug], 'message' => 'Tag atualizada com sucesso'], Response::HTTP_OK);
    }

    public function destroy(Tag $tag) {
        $tag->delete();
        return response()->json(['message' => 'Tag deletada com sucesso'], Response::HTTP_OK);
    }

    public function view(Tag $tag) {
        return response()->json(['data' => $tag], Response::HTTP_OK);
    }

    public function index() {
        $tags = Tag::all();
        return response()->json(['data' => $tags], Response::HTTP_OK);
    }
}
