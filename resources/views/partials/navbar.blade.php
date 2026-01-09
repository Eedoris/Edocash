<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Navbar Menu Overlay</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

<header class="navbar">
    <button class="menu-btn" id="openMenu">☰</button>
    <span class="logo">EdoCash</span>
    
    <a href="{{ url('/admin/login') }}">Login</a>
</header>


<div class="menu-overlay" id="menu">
    <div class="menu-header">
        <span class="menu-logo">EdoCash</span>
        <button class="close-btn" id="closeMenu">✕</button>
    </div>

    <div class="menu-content">

        <div class="menu-column">
            <h4>Nos Blogs</h4>

            @foreach ($navMetiers as $metier)
                <div class="menu-metier">
                    <a href="#}"
                       class="menu-metier-title">
                        {{ $metier->name }}
                    </a>

                    @if ($metier->blogPosts->count())
                        <div class="menu-metier-blogs">
                            @foreach ($metier->blogPosts as $post)
                                <a href="{{ route('blog.show', $post->slug) }}"
                                   class="menu-blog-link">
                                    {{ Str::limit($post->title, 40) }}
                                </a>
                            @endforeach
                        </div>
                    @endif
                </div>
            @endforeach
        </div>
 
        <div class="menu-column">
            <h4>Mieux comprendre</h4>
            <a href="{{ url('/#faq') }}">FAQ</a>

            <a href="{{ route('blog.index') }}">Tous les articles</a>
        </div>

        <div class="menu-column">
            <h4>Nous connaître</h4>
            <a href="{{ route('about') }}">À propos</a>
        </div>

    </div>
</div>
</body>

