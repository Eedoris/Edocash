@extends('layouts.app')

@section('content')
    <style>
        .back-link {
            /*align-items: center;
                        gap: 10px;*/
            display: flex;
            margin-left: 5px;
            color: #ffffff;
            text-decoration: none;
            font-weight: 700;
            font-size: 15px;
            transition: all 0.3s ease;
        }

        .back-link:hover {
            gap: 15px;
            color: #80d7ff;
        }


        .blog-container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 20px;
        }

        .blog-list {
            display: flex;
            flex-direction: column;
            gap: 2.5rem;
            margin-top: 2rem;
        }

        .blog-list__item {
            display: flex;
            gap: 2rem;
            padding: 2rem;
            border-radius: 12px;
            background-color: white;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            border: 1px solid #eee;
            transition: all 0.3s ease;
            margin: 0;
        }

      

        .blog-list__image-wrapper {
            flex: 0 0 300px;
            height: 200px;
            border-radius: 8px;
            overflow: hidden;
        }

        .blog-list__image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .blog-list__item:hover .blog-list__image {
            transform: scale(1.05);
        }

        .blog-list__content {
            flex: 1;
            display: flex;
            flex-direction: column;
            padding-right: 1rem;
            /* Ajout d'espace à droite */
        }

        .blog-list__header {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-bottom: 0.75rem;
        }

        .blog-list__metier {
            padding: 0.35rem 0.875rem;
            background-color: #f0f7ff;
            color: #0066cc;
            border-radius: 20px;
            font-size: 0.875rem;
            font-weight: 500;
            display: inline-block;
        }

        .blog-list__category {
            padding: 0.35rem 0.875rem;
            background-color: #f8f9fa;
            color: #666;
            border-radius: 20px;
            font-size: 0.875rem;
            font-weight: 500;
            display: inline-block;
        }

        .blog-list__title {
            font-size: 1.5rem;
            font-weight: 600;
            color: #1a1a1a;
            margin-bottom: 0.75rem;
            line-height: 1.3;
            padding-right: 10px;
            /* Petit padding pour éviter le collage au bord */
        }

        .blog-list__title a {
            color: inherit;
            text-decoration: none;
        }

        .blog-list__title a:hover {
            color: #0066cc;
        }

        .blog-list__excerpt {
            color: #666;
            line-height: 1.6;
            margin-bottom: 1rem;
            flex-grow: 1;
            padding-right: 10px;
            /* Petit padding pour éviter le collage au bord */
        }

        .blog-list__meta {
            display: flex;
            align-items: center;
            gap: 1.5rem;
            color: #888;
            font-size: 0.875rem;
            margin-bottom: 1rem;
        }

        .blog-list__meta-item {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .blog-list__meta-item i {
            font-size: 0.875rem;
        }

        .blog-list__footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-top: 1rem;
            border-top: 1px solid #eee;
        }

        .blog-list__link {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            color: #0066cc;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.2s ease;
        }

        .blog-list__link:hover {
            color: #0052a3;
        }

        .blog-list__link svg {
            transition: transform 0.2s ease;
        }

        .blog-list__link:hover svg {
            transform: translateX(3px);
        }

        /* Responsive */
        @media (max-width: 1200px) {
            .blog-container {
                max-width: 100%;
                padding: 0 30px;
            }
        }

        @media (max-width: 992px) {
            .blog-container {
                padding: 0 25px;
            }

            .blog-list__item {
                padding: 1.75rem;
            }
        }

        @media (max-width: 768px) {
            .blog-container {
                padding: 0 20px;
            }

            .blog-list__item {
                flex-direction: column;
                gap: 1.5rem;
                padding: 1.5rem;
            }

            .blog-list__image-wrapper {
                flex: none;
                height: 200px;
                width: 100%;
            }

            .blog-list__content {
                padding-right: 0;
            }

            .blog-list__header {
                flex-wrap: wrap;
            }

            .blog-list__title,
            .blog-list__excerpt {
                padding-right: 0;
            }

            .blog-list__meta {
                flex-wrap: wrap;
                gap: 1rem;
            }
        }

        @media (max-width: 576px) {
            .blog-container {
                padding: 0 15px;
            }

            .blog-list__item {
                padding: 1.25rem;
                border-radius: 8px;
            }

            .blog-list__image-wrapper {
                height: 180px;
            }

            .blog-list__title {
                font-size: 1.25rem;
            }
        }

        /* Pour les très petits écrans */
        @media (max-width: 400px) {
            .blog-container {
                padding: 0 12px;
            }

            .blog-list__item {
                padding: 1rem;
            }
        }

        /* Option alternative: Container plus large pour le contenu */
        .blog-list__content-inner {
            padding-right: 2rem;
            /* Vous pouvez aussi ajouter un div intermédiaire */
        }

        /* Si le problème persiste, ajoutez ces règles */
        .blog-list__item>* {
            box-sizing: border-box;
        }

        /* Correction pour les badges trop près du bord */
        .blog-list__header {
            flex-wrap: wrap;
            gap: 0.75rem;
            margin-bottom: 1rem;
        }

        /* Pagination pour liste */
        .blog-pagination {
            margin-top: 3rem;
            padding-top: 2rem;
            border-top: 1px solid #eee;
        }

        /* Header du blog avec espacement */
        .blog-grid__header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
            padding: 0 10px;
            /* Petit padding pour l'alignement */
        }

        .blog-grid__title {
            font-size: 2rem;
            font-weight: 700;
            color: #1a1a1a;
            margin: 0;
        }

        .blog-grid__count {
            color: #666;
            font-size: 1rem;
        }
    </style>

    <section class="press-hero blog-hero">
        <div class="container">
            <a href="{{ route('home.index') }}" class="back-link">
                <svg width="20" height="20" viewBox="0 0 20 20" fill="none">
                    <path d="M15.8333 10H4.16667M4.16667 10L9.16667 15M4.16667 10L9.16667 5" stroke="currentColor"
                        stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
                Retour
            </a>
            <h1 class="press-hero__title">Espace Blog</h1>
            <p class="press-hero__subtitle">Découvrez toutes nos articles</p>
        </div>
    </section>


    <div class="blog-container">
        @if ($posts->count())
            <div class="blog-grid__header">
                <h2 class="blog-grid__title">Nos derniers articles</h2>
                <div class="blog-grid__count">{{ $posts->total() }} article{{ $posts->total() > 1 ? 's' : '' }}</div>
            </div>

            <div class="blog-list">
                @foreach ($posts as $post)
                    <article class="blog-list__item">
                        <a href="{{ route('blog.show', $post->slug) }}" class="blog-list__image-wrapper">
                            <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}"
                                class="blog-list__image">
                        </a>

                        <div class="blog-list__content">
                            <div class="blog-list__header">
                                @if ($post->metier)
                                    <span class="blog-list__metier">{{ $post->metier->name }}</span>
                                @endif

                                @if ($post->category)
                                    <span class="blog-list__category">{{ $post->category->name }}</span>
                                @endif
                            </div>

                            <h3 class="blog-list__title">
                                <a href="{{ route('blog.show', $post->slug) }}">
                                    {{ $post->title }}
                                </a>
                            </h3>

                            <p class="blog-list__excerpt">{{ $post->excerpt }}</p>

                            <div class="blog-list__meta">
                                <span class="blog-list__meta-item">
                                    <i class="far fa-calendar"></i>
                                    {{ $post->published_at?->translatedFormat('d M Y') }}
                                </span>
                                <span class="blog-list__meta-item">
                                    <i class="far fa-clock"></i>
                                    {{ $post->reading_time ?? '3' }} min de lecture
                                </span>
                            </div>

                            <div class="blog-list__footer">
                                <a href="{{ route('blog.show', $post->slug) }}" class="blog-list__link">
                                    Lire l'article
                                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none">
                                        <path d="M3.33325 8H12.6666M12.6666 8L8.66659 4M12.6666 8L8.66659 12"
                                            stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>

            <div class="blog-pagination">
                {{ $posts->links() }}
            </div>
        @else
            <!-- Gardez le même message pour aucun article -->
            <div class="blog-no-posts">
                <svg width="80" height="80" viewBox="0 0 24 24" fill="none" stroke="#666" stroke-width="1">
                    <path
                        d="M19 3H5C3.89543 3 3 3.89543 3 5V19C3 20.1046 3.89543 21 5 21H19C20.1046 21 21 20.1046 21 19V5C21 3.89543 20.1046 3 19 3Z"
                        stroke-linecap="round" stroke-linejoin="round" />
                    <path
                        d="M8 7V7.01M12 7V7.01M16 7V7.01M8 11V11.01M12 11V11.01M16 11V11.01M8 15V15.01M12 15V15.01M16 15V15.01"
                        stroke-linecap="round" stroke-linejoin="round" />
                </svg>
                <h3>Aucun article disponible</h3>
                <p>Nous publierons bientôt de nouveaux articles.</p>
            </div>
        @endif
    </div>
@endsection
