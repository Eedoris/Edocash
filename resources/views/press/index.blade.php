@extends('layouts.app')

@section('content')
    <section class="press-hero">
        <div class="container">
             <a href="{{ route('home.index') }}" class="back-link">
                <svg width="20" height="20" viewBox="0 0 20 20" fill="none">
                    <path d="M15.8333 10H4.16667M4.16667 10L9.16667 15M4.16667 10L9.16667 5" 
                          stroke="currentColor" stroke-width="1.5" 
                          stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                Retour 
            </a>
            <h1 class="press-hero__title">Espace Presse EdoCash</h1>
            <p class="press-hero__subtitle">Découvrez toutes nos actualités, interventions médias et communiqués officiels
            </p>
        </div>
    </section>
    
    <!-- Filtres -->
    {{--<section class="press-filters">
        <div class="container">

            <form method="GET" action="{{ route('press.index') }}" class="filters-wrapper">

                <!-- Recherche -->
                
                <div class="search-container">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none">
                        <path
                            d="M9 17C13.4183 17 17 13.4183 17 9C17 4.58172 13.4183 1 9 1C4.58172 1 1 4.58172 1 9C1 13.4183 4.58172 17 9 17Z"
                            stroke="#666" stroke-width="2" />
                        <path d="M19 19L14.65 14.65" stroke="#666" stroke-width="2" />
                    </svg>

                    <livewire:press-search />


                </div>

                <!-- Filtres -->
                <div class="filter-tabs">

                    @php
                        $active = request('category', 'all');
                    @endphp

                    @foreach ([
            'all' => 'Tous',
            'press' => 'Presse écrite',
            'tv' => 'Télévision',
            'web' => 'Web',
            'release' => 'Communiqués',
        ] as $key => $label)
                        <input type="radio" name="category" id="filter-{{ $key }}" value="{{ $key }}"
                            {{ $active === $key ? 'checked' : '' }} hidden>

                        <label for="filter-{{ $key }}" class="filter-tab {{ $active === $key ? 'active' : '' }}"
                            onclick="this.closest('form').submit()">
                            {{ $label }}
                        </label>
                    @endforeach
                </div>

            </form>

        </div>
    </section>
    <!-- Grid des articles -->
    <section class="press-grid">
        <div class="container">

            <div class="press-grid__header">
                <h2 class="press-grid__title">Nos dernières actualités</h2>
                <p class="press-grid__count">{{ $articles->total() }} articles</p>
            </div>

            <div class="pressroom-releases" id="articlesGrid">

                @foreach ($articles as $article)
                    <div class="pressroom-releases__item" data-category="{{ $article->category }}">

                        <a href="{{ route('press.show', $article->slug) }}" class="pressroom-releases__image-wrapper">

                            <img class="pressroom-releases__image" src="{{ asset('storage/' . $article->image) }}"
                                alt="{{ $article->title }}" sizes="551px">
                        </a>

                        <div class="pressroom-releases__description">

                            <p class="pressroom-releases__title ">
                                <a href="{{ route('press.show', $article->slug) }}">
                                    {{ $article->title }}
                                </a>
                            </p>

                            <p class="pressroom-releases__text">
                                {{ $article->excerpt }}
                            </p>

                            <div class="pressroom-releases__meta">
                                <span class="pressroom-releases__date">
                                    {{ $article->published_at?->translatedFormat('d F Y') }}
                                </span>

                                <span class="pressroom-releases__category">
                                    {{ ucfirst($article->category_label) }}
                                </span>
                            </div>

                        </div>
                    </div>
                @endforeach

            </div>

            <!-- Pagination -->
            <div class="press-pagination">
                {{ $articles->links() }}
            </div>

        </div>
    </section>--}}
    <livewire:press-search />

    <!-- Contact Presse -->
    <section class="press-contact">
        <div class="container">
            <div class="contact-card">
                <div class="contact-content">
                    <h3 class="contact-title">Contact Presse EdoCash</h3>
                    <p class="contact-text">
                        Vous êtes journaliste et souhaitez en savoir plus sur nos innovations ?<br>
                        Notre équipe presse est à votre disposition pour toute information.
                    </p>
                    <div class="contact-details">
                        <div class="contact-item">
                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none">
                                <path
                                    d="M2.5 6.66667C2.5 5.38334 3.55 4.33334 4.83333 4.33334H15.1667C16.45 4.33334 17.5 5.38334 17.5 6.66667V13.3333C17.5 14.6167 16.45 15.6667 15.1667 15.6667H4.83333C3.55 15.6667 2.5 14.6167 2.5 13.3333V6.66667Z"
                                    stroke="currentColor" stroke-width="1.5" />
                                <path d="M17.5 6.66667L10 10.8333L2.5 6.66667" stroke="currentColor" stroke-width="1.5"
                                    stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            <span>presse@edocash.com</span>
                        </div>
                        <div class="contact-item">
                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none">
                                <path
                                    d="M17.5 15.8333C17.5 16.75 16.75 17.5 15.8333 17.5H4.16667C3.25 17.5 2.5 16.75 2.5 15.8333V4.16667C2.5 3.25 3.25 2.5 4.16667 2.5H15.8333C16.75 2.5 17.5 3.25 17.5 4.16667V15.8333Z"
                                    stroke="currentColor" stroke-width="1.5" />
                                <path
                                    d="M13.3333 10C13.3333 11.8417 11.8417 13.3333 10 13.3333C8.15833 13.3333 6.66667 11.8417 6.66667 10C6.66667 8.15833 8.15833 6.66667 10 6.66667C11.8417 6.66667 13.3333 8.15833 13.3333 10Z"
                                    stroke="currentColor" stroke-width="1.5" />
                            </svg>
                            <span>+228 70 12 34 56</span>
                        </div>
                    </div>
                </div>
                <div class="contact-action">
                    <a href="mailto:presse@edocash.com" class="contact-btn">
                        Contacter la presse
                    </a>
                </div>
            </div>
        </div>
    </section>

<style>
    .back-link {
    /*align-items: center;
    gap: 10px;*/
    display: flex;
    margin-left:5px;
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
</style>
@endsection
