<?php

namespace App\Providers;

use App\Models\Metier;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('partials.navbar', function ($view) {

            $metiers = Metier::with([
                'blogPosts' => function ($query) {
                    $query->where('is_published', true)
                        ->latest('published_at')
                        ->limit(3);
                },
            ])->orderBy('name')->get();

            $view->with('navMetiers', $metiers);
        });
    }
}
