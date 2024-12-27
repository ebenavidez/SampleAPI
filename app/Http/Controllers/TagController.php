<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTagRequest;
use App\Http\Resources\TagResource;
use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function store(StoreTagRequest $request)
    {
        // Create the tag
        $tag = Tag::create([
            'name' => $request->name,
        ]);

        // Return the resource
        return new TagResource($tag);
    }

    public function search(Request $request)
    {
        $query = $request->input('query');

        $tags = Tag::query()
            ->where('name', 'LIKE', "%{$query}%")
            ->orderBy('name')
            ->limit(10) // Limit the results for performance
            ->get();

        return TagResource::collection($tags);
    }
}
