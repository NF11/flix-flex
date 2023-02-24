<?php

namespace App\Http\Controllers;

use App\Http\Requests\GetContentRequest;
use App\Http\Resources\ContentResource;
use App\Models\Content;
use Illuminate\Http\Request;

class ContentsController extends Controller
{
    public function index(GetContentRequest $request)
    {
        $content = Content::withFilter(keyword: $request->get('q'), type: $request->get('type'))
            ->with('category')
            ->paginate(config('content.page_limit'));
        return ContentResource::collection($content);
    }

    public function store(Request $request)
    {
    }

    public function show(Content $content)
    {
    }

    public function update(Request $request, Content $content)
    {
    }

    public function destroy(Content $content)
    {
    }

    public function getTopRating(GetContentRequest $request)
    {
        $topContent = Content::withFilter(keyword: $request->get('q'), type: $request->get('type'))
            ->topRating()
            ->with('category')
            ->limit(config('content.top_limit'));
        return ContentResource::collection($topContent);
    }
}
