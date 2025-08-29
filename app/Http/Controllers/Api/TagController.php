<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Services\TagService;
use Exception;
use App\Http\Requests\TagRequest;
use App\Http\Resources\TagResource;

class TagController extends Controller
{
    public function store(TagRequest $request, TagService $tagService) {
        try {
           $tag = $tagService->create($request->all());
           return response()->json(['data' => new TagResource($tag), 'message' => 'Tag criada com sucesso'], Response::HTTP_CREATED);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], Response::HTTP_UNPROCESSABLE_ENTITY);
        }
    }

    public function update(TagRequest $request, Tag $tag, TagService $tagService) {
        try {
            $tag = $tagService->update($request->all(), $tag);
            return response()->json(['data' => new TagResource($tag), 'message' => 'Tag atualizada com sucesso'], Response::HTTP_OK);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], Response::HTTP_UNPROCESSABLE_ENTITY);
        } 
    }

    public function destroy(Tag $tag, TagService $tagService) {
        $tagService->delete($tag);
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
