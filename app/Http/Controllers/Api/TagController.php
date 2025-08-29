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
}
