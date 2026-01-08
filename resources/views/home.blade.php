@extends('layouts.app')

@section('content')
    @if (isset($hero) && $hero)
        <section class="hero home"
            style="background-image: url('{{ !empty($hero->background_image) ? asset('storage/' . $hero->background_image) : asset('img/hero.png') }}');">

            <div class="hero__inner">

                <h1 class="hero__title">
                    {{ $hero->title_before }}
                    <span class="hero__word-wrapper">
                        <span id="dynamic-job" class="hero__title--animate"></span>
                    </span>
                    <br>
                    {{ $hero->title_after }}
                </h1>

                <p class="hero__about">
                    <span class="hero__about--line">+500 000</span>
                    {{ $hero->subtitle }}
                </p>

                <a href="{{ $hero->cta_link }}" class="btn-main">
                    <img class="btn-main__image btn-main__image--bounce lazyautosizes ls-is-cached lazyloaded"
                        data-src="{{ asset('img/fleche.svg') }}" src="{{ asset('img/fleche.svg') }}" alt="icon flèche"
                        sizes="30px">
                    {{ $hero->cta_text }}
                </a>

            </div>
        </section>
    @endif
    {{-- <section class="raisons">
        <div class="raison_head">
            <h2 class="head2"> Face à l'imprévu <br> <span class="sub">un dépannage fiable</span> </h2>
        </div>
        <div class="raisons_list raisons_listhome">
            <div class="list_details">
                <div class="list_imagewrapper">
                    <img src="" alt="icon" class="list_image lazyautosizes ls-is-cached lazyloaded">
                </div>
                <div class="list_description">
                    <h3 class="list_title">Zéro surprise</h3>
                    <p class="list_about"> Devis gratuit avant l'intervention, vous validez, vous payez après</p>
                </div>
            </div>
            <div class="list_details">
                <div class="list_imagewrapper">
                    <img src="" alt="icon" class="list_image lazyautosizes ls-is-cached lazyloaded">
                </div>
                <div class="list_description">
                    <h3 class="list_title">Zéro surprise</h3>
                    <p class="list_about"> Devis gratuit avant l'intervention, vous validez, vous payez après</p>
                </div>
            </div>

        </div>
    </section> --}}
    @if (isset($reasons) && count($reasons) > 0)
        <section class="raisons">
            <div class="raison_head">
                <h2 class="head2">
                    Face à l'imprévu <br>
                    <span class="sub">un dépannage fiable</span>
                </h2>
            </div>
            <div class="part">
                <img src="{{ asset('img/particles.svg') }}" alt="" aria-hidden="true">
            </div>

            <div class="raisons_list raisons_listhome">
                @foreach ($reasons as $reason)
                    <div class="list_details">
                        <div class="list_imagewrapper">
                            @if ($reason->image)
                                <img src="{{ Storage::url($reason->image) }}" class="list_image" alt="">
                            @endif
                        </div>

                        <div class="list_description">
                            <h3 class="list_title">{{ $reason->title }}</h3>
                            <p class="list_about">{{ $reason->description }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>
    @endif
    @if (isset($motif) && $motif)
        <div class="cercle-2">

        </div>
        <section class="motif">
            <div class=" motif_inner">
                <div class="motif_head">
                    <h2 class="head2"> {{ $motif->title }}
                        <br>
                        <span class="sub">{{ $motif->subtitle }}</span>
                    </h2>
                </div>
                <div class="motif_block">
                    <div class="motif_img">
                        @if ($motif->image)
                            <img data-src="{{ asset('storage/' . $motif->image) }}" class="lazyload lazyautosizes"
                                alt="{{ $motif->title }}" sizes="520px">
                        @endif
                    </div>

                    <div class="motif_slidercontainer">
                        <div class="motif_slider">
                            <div class="motif_scroll">
                                <div class="motif_scrollfill" style="transition: height 0.5s linear; height: 25%;">
                                </div>
                            </div>
                            <div class="motif_list">
                                @foreach ($motif->items as $index => $item)
                                    <div class="motif_listitem {{ $index === 0 ? 'active' : '' }}"
                                        data-index="{{ $index }}">
                                        <h3 class="list_itemtitle">{{ $item->title }}</h3>
                                        <p class="list_itemdesc"> {{ $item->description }} </p>
                                    </div>
                                @endforeach

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif
    <section class="urgent-banner">
        <div class="urgent-banner__content">
            <div class="urgent-banner__text">
                <h3>Vous avez une urgence ?</h3>
                <p>
                    Contactez-nous par téléphone<br>
                    Nos experts sont disponibles 7j/7 – 24h/24
                </p>
            </div>

            <div class="urgent-banner__action" id="phoneAction">
                <button class="phone-btn" id="phoneBtn">
                    📞 Contactez-nous
                </button>

                <div class="phone-number" id="phoneNumber">
                    <strong class="number">+228 93 81 81 08</strong>
                    </br>
                    <strong class="number">+229 01 95 24 24 82</strong>
                    {{-- <span>Prix d’un appel local</span> --}}
                </div>
            </div>
        </div>
    </section>
    @if ($motivation)
        <section class="motivations">
            <div class="cercle">

            </div>

            <div class="container">
                <div class="motiv-head">
                    <h2 class="head2">
                        {{ $motivation->title }}
                    </h2>
                    <span class="sub">{{ $motivation->subtitle }}</span>
                </div>

                <div class="motivations__slider-container">
                    <div class="motivations__nav">
                        <button class="slider-btn prev" aria-label="Précédent">‹</button>
                        <button class="slider-btn next" aria-label="Suivant">›</button>
                    </div>

                    <div class="motivations__slider" id="motivationsSlider">
                        @foreach ($motivation->items as $item)
                            <article class="motivation-card">
                                <h3 class="motivation-card__title">
                                    {{ $item->title }}
                                </h3>

                                <p class="motivation-card__desc">
                                    {{ $item->description }}
                                </p>

                                <div class="motivation-card__meta">
                                    @if ($item->author)
                                        <span class="author">{{ $item->author }}</span>
                                    @endif
                                    @if ($item->published_at)
                                        <span class="date">{{ $item->published_at->format('d/m/Y') }}</span>
                                    @endif
                                </div>
                            </article>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
    @endif

    {{-- <section class="press-section">
        <!-- Fond décoratif avec dégradé -->
        <div class="press-bg-gradient"></div>

        <div class="container">
            <!-- En-tête avec titre et icon -->
            <div class="press-header">
                <div class="press-title-wrapper">
                    <h2 class="press-title">
                        EdoCash<br>
                        <span class="press-subtitle">dans les médias</span>
                    </h2>
                    <p class="press-intro">Découvrez nos interventions et reportages dans les principaux médias</p>
                </div>
                <div class="press-icon">
                    <svg width="80" height="80" viewBox="0 0 80 80" fill="none">
                        <path
                            d="M40 80C62.0914 80 80 62.0914 80 40C80 17.9086 62.0914 0 40 0C17.9086 0 0 17.9086 0 40C0 62.0914 17.9086 80 40 80Z"
                            fill="#4FC3F7" fill-opacity="0.1" />
                        <path
                            d="M52 30C52 28.8954 51.1046 28 50 28H30C28.8954 28 28 28.8954 28 30V50C28 51.1046 28.8954 52 30 52H50C51.1046 52 52 51.1046 52 50V30Z"
                            fill="#6B4EFF" />
                        <path
                            d="M34 36C34 34.8954 34.8954 34 36 34H44C45.1046 34 46 34.8954 46 36V44C46 45.1046 45.1046 46 44 46H36C34.8954 46 34 45.1046 34 44V36Z"
                            fill="white" />
                        <path d="M36 40C36 40 38 38 40 38C42 38 44 40 44 40M36 44C36 44 38 42 40 42C42 42 44 44 44 44"
                            stroke="#6B4EFF" stroke-width="2" stroke-linecap="round" />
                    </svg>
                </div>
            </div>

            <!-- Contenu principal : Vidéo + Articles -->
            <div class="press-content">
                <!-- Partie Vidéo -->
                <div class="press-video-block">
                    <div class="video-wrapper">
                        <iframe src="https://www.youtube.com/embed/G6SSG2s1syk" frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                            allowfullscreen>
                        </iframe>
                    </div>
                    <h3 class="video-title">Interview du fondateur au JT</h3>
                </div>

                <!-- Slider des articles presse -->
                <div class="press-articles-slider">
                    <!-- Navigation des logos médias -->
                    <div class="media-logos-nav">
                        <button class="media-logo-btn active" data-index="0">
                            <img src="https://upload.wikimedia.org/wikipedia/commons/8/8a/TF1_logo_2013.svg"
                                alt="TF1" style="height: 30px;">
                        </button>
                        <button class="media-logo-btn" data-index="1">
                            <img src="https://upload.wikimedia.org/wikipedia/commons/7/7d/M6_logo_2018.svg" alt="M6"
                                style="height: 25px;">
                        </button>
                        <button class="media-logo-btn" data-index="2">
                            <img src="https://upload.wikimedia.org/wikipedia/commons/5/5d/BFM_TV_2018.svg" alt="BFM TV"
                                style="height: 25px;">
                        </button>
                        <button class="media-logo-btn" data-index="3">
                            <img src="https://upload.wikimedia.org/wikipedia/fr/4/4f/Le_Parisien.svg" alt="Le Parisien"
                                style="height: 30px;">
                        </button>
                        <button class="media-logo-btn" data-index="4">
                            <span class="media-logo-text">Les Échos</span>
                        </button>
                    </div>

                    <!-- Progress bar -->
                    <div class="slider-progress">
                        <div class="progress-bar"></div>
                    </div>

                    <!-- Articles slider -->
                    <div class="articles-container">
                        <article class="press-article active" data-index="0">
                            <blockquote class="article-quote">
                                « EdoCash garantit des solutions de paiement rapides et sécurisées pour tous vos besoins. »
                            </blockquote>

                            <div class="article-meta">
                                <a href="" class="article-source">
                                    Vu au JT de 20h de TF1
                                </a>
                                <span class="separator">–</span>
                                <time class="article-date">7 juillet 2024</time>
                            </div>
                        </article>

                        <article class="press-article" data-index="1">
                            <blockquote class="article-quote">
                                « Une plateforme innovante qui simplifie les transactions financières pour les particuliers
                                et professionnels. »
                            </blockquote>

                            <div class="article-meta">
                                <a href="" class="article-source">
                                    Reportage au 19.45 de M6
                                </a>
                                <span class="separator">–</span>
                                <time class="article-date">28 avril 2024</time>
                            </div>
                        </article>

                        <article class="press-article" data-index="2">
                            <blockquote class="article-quote">
                                « En cas de transaction urgente, il vaut mieux utiliser une plateforme reconnue comme
                                EdoCash. »
                            </blockquote>

                            <div class="article-meta">
                                <a href="" class="article-source">
                                    BFM Business - Analyse économique
                                </a>
                                <span class="separator">–</span>
                                <time class="article-date">1er mai 2024</time>
                            </div>
                        </article>

                        <article class="press-article" data-index="3">
                            <blockquote class="article-quote">
                                « Pour éviter les frais cachés, EdoCash propose une transparence totale avec des tarifs
                                annoncés à l'avance. »
                            </blockquote>

                            <div class="article-meta">
                                <a href="" class="article-source">
                                    Le Parisien - Économie & Innovation
                                </a>
                                <span class="separator">–</span>
                                <time class="article-date">28 avril 2024</time>
                            </div>
                        </article>

                        <article class="press-article" data-index="4">
                            <blockquote class="article-quote">
                                « Le fondateur d'EdoCash revient avec une vision novatrice du paiement en ligne, multipliant
                                les partenariats stratégiques. »
                            </blockquote>

                            <div class="article-meta">
                                <a href="" class="article-source">
                                    Les Échos Entrepreneurs
                                </a>
                                <span class="separator">–</span>
                                <time class="article-date">13 mai 2024</time>
                            </div>
                        </article>
                    </div>

                    <!-- Lien vers toutes les actualités -->
                    <a href="/espace-presse" class="all-articles-link">
                        <span>Toutes nos actualités presse</span>
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none">
                            <path d="M4.16675 10H15.8334M15.8334 10L10.8334 5M15.8334 10L10.8334 15" stroke="currentColor"
                                stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </section> --}}
    @if ($press)
        <div class="container">
            <div class="press-header">
                <div class="press-title-wrapper">
                    <h2 class="press-title">
                        {{ $press->title }}<br>
                        <span class="press-subtitle">{{ $press->subtitle }}</span>
                    </h2>

                    <p class="press-intro">
                        {{ $press->intro }}
                    </p>
                </div>

                <div class="press-icon">

                    <svg width="80" height="80" viewBox="0 0 80 80" fill="none">
                        <path
                            d="M40 80C62.0914 80 80 62.0914 80 40C80 17.9086 62.0914 0 40 0C17.9086 0 0 17.9086 0 40C0 62.0914 17.9086 80 40 80Z"
                            fill="#4FC3F7" fill-opacity="0.1" />
                        <path
                            d="M52 30C52 28.8954 51.1046 28 50 28H30C28.8954 28 28 28.8954 28 30V50C28 51.1046 28.8954 52 30 52H50C51.1046 52 52 51.1046 52 50V30Z"
                            fill="#6B4EFF" />
                        <path
                            d="M34 36C34 34.8954 34.8954 34 36 34H44C45.1046 34 46 34.8954 46 36V44C46 45.1046 45.1046 46 44 46H36C34.8954 46 34 45.1046 34 44V36Z"
                            fill="white" />
                        <path d="M36 40C36 40 38 38 40 38C42 38 44 40 44 40M36 44C36 44 38 42 40 42C42 42 44 44 44 44"
                            stroke="#6B4EFF" stroke-width="2" stroke-linecap="round" />
                    </svg>
                </div>
            </div>

            <div class="press-content">

                <div class="press-video-block">
                    <div class="video-wrapper">
                        @if ($press->video_url)
                            <iframe src="{{ $press->video_url }}" frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                allowfullscreen>
                            </iframe>
                        @endif
                    </div>

                    <h3 class="video-title">
                        {{ $press->video_title }}
                    </h3>
                </div>


                <div class="press-articles-slider">

                    <div class="media-logos-nav">
                        @foreach ($press->items as $index => $item)
                            <button class="media-logo-btn {{ $index === 0 ? 'active' : '' }}"
                                data-index="{{ $index }}">

                                @if ($item->media_logo)
                                    <img src="{{ asset('storage/' . $item->media_logo) }}" alt="{{ $item->source }}"
                                        style="height: 30px;">
                                @else
                                    <span class="media-logo-text">{{ $item->source }}</span>
                                @endif

                            </button>
                        @endforeach
                    </div>


                    <div class="slider-progress">
                        <div class="progress-bar"></div>
                    </div>

                    <div class="articles-container">
                        @foreach ($press->items as $index => $item)
                            <article class="press-article {{ $index === 0 ? 'active' : '' }}"
                                data-index="{{ $index }}">

                                <blockquote class="article-quote">
                                    {{ $item->quote }}
                                </blockquote>

                                <div class="article-meta">
                                    @if ($item->external_url)
                                        <a href="{{ $item->external_url }}" class="article-source" target="_blank"
                                            rel="noopener noreferrer">
                                            {{ $item->source }}
                                        </a>
                                    @else
                                        <span class="article-source">
                                            {{ $item->source }}
                                        </span>
                                    @endif


                                    <span class="separator">–</span>

                                    <time class="article-date">
                                        {{ optional($item->published_at)->format('d F Y') }}
                                    </time>
                                </div>
                            </article>
                        @endforeach
                    </div>

                    <a href="/espace-presse" class="all-articles-link">
                        <span>Toutes nos actualités presse</span>
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none">
                            <path d="M4.16675 10H15.8334M15.8334 10L10.8334 5M15.8334 10L10.8334 15" stroke="currentColor"
                                stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </a>

                </div>
            </div>
        </div>
    @endif


    <section class="blog-home">
        <div class="containerblog">

            <div class="blog-header">
                <h2>Actualités & Blog</h2>
                <a href="{{ route('blog.index') }}" class="see-all">
                    Voir tous les articles →
                </a>
            </div>

            <div class="blog-layout">

                {{-- Article principal --}}
                @if ($featuredPost)
                    <div class="blog-featured">
                        <img src="{{ asset('storage/' . $featuredPost->image) }}" alt="">
                        <h3>{{ $featuredPost->title }}</h3>
                        <p>{{ $featuredPost->excerpt }}</p>
                        <a href="{{ route('blog.show', $featuredPost->slug) }}">
                            Lire l’article
                        </a>
                    </div>
                @endif

                {{-- Articles secondaires --}}
                <div class="blog-grid">
                    @foreach ($latestPosts as $post)
                        <article class="blog-card">
                            <img src="{{ asset('storage/' . $post->image) }}" alt="">

                            <div class="blog-card-content">
                                <h4>{{ $post->title }}</h4>
                                <p>{{ $post->excerpt }}</p>
                                <a href="{{ route('blog.show', $post->slug) }}">Lire →</a>
                            </div>
                        </article>
                    @endforeach
                </div>

            </div>
        </div>
    </section>


    <section class="faq-section">

        <div class="faq-bg-elements">
            <div class="faq-circle circ-1"></div>
            <div class="faq-circle circ-2"></div>
            <div class="faq-dots"></div>
        </div>

        <div class="container">

            <div class="faq-header">
                <span class="faq-badge">FAQ</span>
                <h2 class="faq-title">Questions fréquentes</h2>
                <p class="faq-subtitle">Trouvez rapidement les réponses à vos questions sur EdoCash</p>


                <div class="faq-search">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none">
                        <path
                            d="M19 19L13 13M15 8C15 11.866 11.866 15 8 15C4.13401 15 1 11.866 1 8C1 4.13401 4.13401 1 8 1C11.866 1 15 4.13401 15 8Z"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                    </svg>
                    <input type="text" id="faqSearch" placeholder="Rechercher une question..."
                        class="faq-search-input">
                    <div class="search-results" id="searchResults"></div>
                </div>
            </div>


            <div class="faq-categories">
                <button class="category-btn active" data-category="all">Toutes</button>

                @foreach ($faqCategories as $category)
                    <button class="category-btn" data-category="{{ $category->slug }}">
                        {{ $category->name }}
                    </button>
                @endforeach
            </div>


            <div class="faq-accordion">

                @foreach ($faqs as $index => $faq)
                    <div class="faq-item" data-category="{{ $faq->category->slug }}" data-index="{{ $index }}">

                        <button class="faq-question" aria-expanded="false">
                            <span class="question-text">
                                {{ $faq->question }}
                            </span>

                            <span class="faq-icon">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
                                    <path d="M6 9L12 15L18 9" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </span>
                        </button>

                        <div class="faq-answer" aria-hidden="true">
                            <div class="answer-content">
                                {!! $faq->answer !!}
                            </div>

                            <div class="faq-meta">
                                <span class="faq-category-badge">
                                    {{ $faq->category->name }}
                                </span>

                                <span class="faq-date">
                                    Mise à jour :
                                    {{ $faq->updated_at->diffForHumans() }}
                                </span>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>


            <div class="faq-footer">
                <div class="faq-stats">
                    <div class="stat-item">
                        <span class="stat-number" data-value="{{ $faqs->count() }}">
                            {{ $faqs->count() }}
                        </span>
                        <span class="stat-label">Questions</span>
                    </div>

                    <div class="stat-item">
                        <span class="stat-number" data-value="{{ $faqCategories->count() }}">
                            {{ $faqCategories->count() }}
                        </span>
                        <span class="stat-label">Catégories</span>
                    </div>
                </div>



                <div class="faq-actions">
                    <button class="expand-all-btn" id="expandAll">
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none">
                            <path d="M10 6V14M6 10H14" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" />
                        </svg>
                        Tout développer
                    </button>

                    <a href="#" class="contact-btn">
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none">
                            <path
                                d="M2.003 5.884L10 9.882L17.997 5.884C17.967 5.374 17.744 4.895 17.372 4.545C17 4.195 16.508 4 16 4H4C3.492 4 3 4.195 2.628 4.545C2.256 4.895 2.033 5.374 2.003 5.884Z"
                                stroke="currentColor" stroke-width="1.5" />
                            <path
                                d="M2 7V13C2 13.5304 2.21071 14.0391 2.58579 14.4142C2.96086 14.7893 3.46957 15 4 15H16C16.5304 15 17.0391 14.7893 17.4142 14.4142C17.7893 14.0391 18 13.5304 18 13V7L10 11L2 7Z"
                                stroke="currentColor" stroke-width="1.5" />
                        </svg>
                        Une autre question ?
                    </a>
                </div>
            </div>
        </div>
    </section>





@endsection
