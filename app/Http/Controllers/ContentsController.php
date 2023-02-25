<?php

namespace App\Http\Controllers;

use App\Http\Requests\GetContentRequest;
use App\Http\Resources\ContentResource;
use App\Models\Content;

class ContentsController extends Controller
{
    public function index(GetContentRequest $request)
    {
        $content = Content::withFilter(keyword: $request->get('q'), type: $request->get('type'))
            ->with('category')
            ->paginate(config('content.page_limit'));
        return ContentResource::collection($content);
    }

    public function show(Content $content)
    {
        return new ContentResource($content->load('category'));
    }

    public function getTopRating(GetContentRequest $request)
    {
        $topContent = Content::withFilter(keyword: $request->get('q'), type: $request->get('type'))
            ->topRating()
            ->with('category')
            ->limit(config('content.top_limit'))
            ->get();
        return ContentResource::collection($topContent);
    }
}
