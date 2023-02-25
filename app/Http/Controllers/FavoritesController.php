<?php

namespace App\Http\Controllers;

use App\Http\Requests\GetContentRequest;
use App\Http\Resources\ContentResource;
use App\Models\Content;
use Illuminate\Http\Request;

class FavoritesController extends Controller
{
    public function index(GetContentRequest $request)
    {
        $content = $request->user()->favoriteContents()->get();

        return ContentResource::collection($content);

    }

    public function sync(Request $request, Content $content)
    {
        $request->user()->favoriteContents()->toggle([$content->id]);
        return (new ContentResource($content->refresh()));
    }
}
