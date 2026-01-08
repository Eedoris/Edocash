<?php

namespace App\Http\Controllers;
use App\Models\BlogPost;

class PostController extends Controller
{
    //
    public function index()
    {
        $posts = BlogPost::where('is_published', true)
            ->latest('published_at')
            ->paginate(9);

        return view('blog.index', compact('posts'));
    }

   public function show(string $slug)
{
    $post = BlogPost::where('slug', $slug)
        ->where('is_published', true)
        ->firstOrFail();

    // Article précédent
    $previousPost = null;
    $nextPost = null;

    if ($post->published_at) {
        $previousPost = BlogPost::where('is_published', true)
            ->whereNotNull('published_at')
            ->where('published_at', '<', $post->published_at)
            ->orderByDesc('published_at')
            ->first();

        $nextPost = BlogPost::where('is_published', true)
            ->whereNotNull('published_at')
            ->where('published_at', '>', $post->published_at)
            ->orderBy('published_at')
            ->first();
    }

    // Articles similaires
    $relatedPosts = BlogPost::where('is_published', true)
        ->where('slug', '!=', $slug)
        ->whereNotNull('published_at')
        ->orderByDesc('published_at')
        ->limit(3)
        ->get();

    return view('blog.show', compact(
        'post',
        'previousPost',
        'nextPost',
        'relatedPosts'
    ));
}

}
