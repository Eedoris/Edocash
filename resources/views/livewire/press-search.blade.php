<div>
    <section class="press-filters">
        <div class="container">

            <div class="filters-wrapper">

                <div class="search-container">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none">
                        <path
                            d="M9 17C13.4183 17 17 13.4183 17 9C17 4.58172 13.4183 1 9 1C4.58172 1 1 4.58172 1 9C1 13.4183 4.58172 17 9 17Z"
                            stroke="#666" stroke-width="2" />
                        <path d="M19 19L14.65 14.65" stroke="#666" stroke-width="2" />
                    </svg>

                    <input type="text" class="search-input" placeholder="Rechercher un article..."
                        wire:model.live.debounce.400ms="search">
                </div>
                <div class="filter-tabs">
                    @foreach ([
        'all' => 'Tous',
        'press' => 'Presse écrite',
        'tv' => 'Télévision',
        'web' => 'Web',
        'release' => 'Communiqués',
    ] as $key => $label)
                        <button type="button" class="filter-tab {{ $category === $key ? 'active' : '' }}"
                            wire:click="setCategory('{{ $key }}')">
                            {{ $label }}
                        </button>
                    @endforeach
                </div>

            </div>
        </div>
    </section>
    <section class="press-grid">
        <div class="container">

            <div class="press-grid__header">
                <h2 class="press-grid__title">Nos dernières actualités</h2>
                <p class="press-grid__count">
                    {{ $articles->total() }} articles
                </p>
            </div>

            <div class="pressroom-releases">

                @foreach ($articles as $article)
                    <div class="pressroom-releases__item">

                        <a href="{{ route('press.show', $article->slug) }}" class="pressroom-releases__image-wrapper">
                            <img class="pressroom-releases__image" src="{{ asset('storage/' . $article->image) }}"
                                alt="{{ $article->title }}">
                        </a>

                        <div class="pressroom-releases__description">

                            <p class="pressroom-releases__title">
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
                                    {{ ucfirst($article->category) }}
                                </span>
                            </div>

                        </div>
                    </div>
                @endforeach

            </div>

            <div class="press-pagination">
                {{ $articles->links() }}
            </div>

        </div>
    </section>

</div>
