<?php

namespace App\Http\Controllers;

use App\Models\PressArticle;
use Illuminate\Http\Request;

class PressController extends Controller
{
    public function index(Request $request)
    {
        $query = PressArticle::query();

 
       
        if ($request->filled('category') && $request->category !== 'all') {
            $query->where('category', $request->category);
        }

        $articles = $query
            ->orderByDesc('published_at')
            ->paginate(9)
            ->withQueryString(); 

        return view('press.index', compact('articles'));
    }

    public function show(string $slug)
    {
        $article = PressArticle::where('slug', $slug)->firstOrFail();
        return view('press.show', compact('article'));
    }
}
