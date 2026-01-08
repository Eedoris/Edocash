<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use App\Models\Faq;
use App\Models\FaqCategory;
use App\Models\HomeHero;
use App\Models\HomeAbout;
use App\Models\HomeStats;
use App\Models\HomeArtisan;
use App\Models\Motif;
use App\Models\Motivation;
use App\Models\PressSection;
use App\Models\Reason;
use App\Models\Partners;

class HomeController extends Controller
{
    public function index()
    {
        $hero = HomeHero::first();

        if (! $hero) {
            $hero = (object) [
                'title_before' => 'Les meilleurs',
                'title_after' => 'sont déjà en chemin !',
                'subtitle' => 'interventions depuis 2013.',
                'cta_text' => 'J’ai besoin d’être dépanné',
                'cta_link' => '#',
                'jobs' => [
                    ['value' => 'plombier'],
                    ['value' => 'électricien'],
                    ['value' => 'serrurier'],
                    ['value' => 'chauffagiste'],
                ],
            ];
        }

        $reasons = Reason::orderBy('sort_order')->get();
        $motif = Motif::with('items')->first();
        $motivation = Motivation::with('items')->first();

        $press = PressSection::with('items')->first();

        $faqCategories = FaqCategory::orderBy('name')->get();

        $faqs = Faq::with('category')
            ->orderBy('created_at')
            ->get();
        $featuredPost = BlogPost::where('is_published', true)
            ->where('is_featured', true)
            ->latest('published_at')
            ->first();

        $latestPosts = BlogPost::where('is_published', true)
            ->where('is_featured', false)
            ->latest('published_at')
            ->take(3)
            ->get();
        // dd($faqCategories->count(), $faqs->count());

        $about = HomeAbout::first();
        $artisans = HomeArtisan::where('is_active', true)->orderBy('order')->get();
        $stats = HomeStats::orderBy('order')->get();
        $partners = Partners::where('is_active', true)->orderBy('order')->get();

        return view('home', compact('hero', 'featuredPost', 'latestPosts', 'reasons', 'motif', 'motivation', 'press', 'faqs', 'faqCategories','about','artisans','stats','partners'));
    }
}
