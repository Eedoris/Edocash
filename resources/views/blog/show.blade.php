@extends('layouts.app')

@section('content')
    <div class="article-show-page">
        <!-- Header minimaliste -->
        <header class="article-header">
            <div class="container">
                <nav class="article-nav">
                    <a href="{{ route('blog.index') }}" class="back-home">
                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none">
                            <path d="M3.33325 8H12.6666M12.6666 8L8.66659 4M12.6666 8L8.66659 12" stroke="currentColor"
                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        Retour aux articles
                    </a>
                    <span class="article-date">
                        {{ $post->published_at?->translatedFormat('d F Y') }}
                    </span>
                </nav>

                <h1 class="article-title">{{ $post->title }}</h1>

                @if ($post->excerpt)
                    <p class="article-subtitle">{{ $post->excerpt }}</p>
                @endif

                <div class="article-meta">
                    <div class="meta-item">
                        <span class="meta-icon">
                            <i class="far fa-clock"></i>
                        </span>
                        <span>{{ $post->reading_time ?? '5' }} min de lecture</span>
                    </div>
                    <div class="meta-item">
                        <span class="meta-icon">
                            <i class="far fa-eye"></i>
                        </span>
                        <span>Lecture facile</span>
                    </div>
                </div>
            </div>
        </header>

        <!-- Image héro -->
        @if ($post->image)
            <div class="article-hero-image">
                <div class="hero-image-wrapper">
                    <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}">
                </div>
            </div>
        @endif

        <div class="article-content-wrapper">
            <article class="article-content">
 
                <div class="article-intro">
                    {{ $post->excerpt ?? 'Découvrez dans cet article des informations précieuses et des conseils pratiques.' }}
                </div>

                {!! $post->content !!}

        
            </article>

            <!-- Partage social -->
            <div class="social-share">
                <span class="share-label">Partager cet article :</span>
                <div class="share-buttons">
                    <a href="#" class="share-button facebook"
                        onclick="window.open('https://www.facebook.com/sharer/sharer.php?u=' + encodeURIComponent(window.location.href), 'facebook-share-dialog', 'width=626,height=436'); return false;">
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none">
                                    <path d="M18.3333 10C18.3333 5.4 14.6 1.66667 10 1.66667C5.4 1.66667 1.66667 5.4 1.66667 10C1.66667 13.9333 4.53333 17.2333 8.33333 18.0667V12.5H6.66667V10H8.33333V7.91667C8.33333 6.03333 9.86667 4.5 11.75 4.5H13.3333V7H11.75C11.0583 7 10.5 7.55833 10.5 8.25V10H13.3333V12.5H10.5V18.1667C14.85 17.7417 18.3333 14.2167 18.3333 10Z" fill="currentColor"/>
                                </svg>
                    </a>
                    <a href="#" class="share-button twitter"
                        onclick="window.open('https://twitter.com/share?url=' + encodeURIComponent(window.location.href) + '&text=' + encodeURIComponent('{{ $post->title }}'), 'twitter-share-dialog', 'width=626,height=436'); return false;">
                          <svg width="20" height="20" viewBox="0 0 20 20" fill="none">
                                    <path d="M19.1666 2.50001C18.3686 3.0629 17.4851 3.4934 16.55 3.77501C16.0481 3.19794 15.3811 2.78894 14.6392 2.60332C13.8974 2.4177 13.1163 2.46435 12.4017 2.73705C11.6871 3.00976 11.0737 3.49534 10.6441 4.12811C10.2146 4.76088 9.98973 5.5103 9.99998 6.27501V7.10834C8.53551 7.14632 7.08438 6.82152 5.77582 6.16288C4.46726 5.50424 3.34191 4.53221 2.49998 3.33334C2.49998 3.33334 -0.833354 10.8333 6.66665 14.1667C4.95042 15.3316 2.90595 15.9158 0.833313 15.8333C8.33331 20 17.5 15.8333 17.5 6.25001C17.4992 6.01787 17.4769 5.78633 17.4333 5.55834C18.2838 4.71958 18.884 3.6606 19.1666 2.50001Z" 
                                          fill="currentColor"/>
                                </svg>
                    </a>
                    <a href="#" class="share-button linkedin"
                        onclick="window.open('https://www.linkedin.com/shareArticle?mini=true&url=' + encodeURIComponent(window.location.href) + '&title=' + encodeURIComponent('{{ $post->title }}'), 'linkedin-share-dialog', 'width=626,height=436'); return false;">
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none">
                                    <path d="M4.94063 6.66667H1.66667V18.3333H4.94063V6.66667Z" fill="currentColor"/>
                                    <path d="M3.28125 4.99999C4.32293 4.99999 5.16667 4.15625 5.16667 3.11458C5.16667 2.07291 4.32293 1.22916 3.28125 1.22916C2.23958 1.22916 1.39583 2.07291 1.39583 3.11458C1.39583 4.15625 2.23958 4.99999 3.28125 4.99999Z" fill="currentColor"/>
                                    <path d="M14.5896 6.66667C12.9021 6.66667 11.5729 7.39583 10.6646 8.375V6.66667H7.39062V18.3333H10.6646V12.2396C10.6646 10.6438 11.3396 9.86458 12.6979 9.86458C14.0562 9.86458 14.5896 10.7896 14.5896 12.3437V18.3333H17.8635V11.7396C17.8635 8.64583 16.7396 6.66667 14.5896 6.66667Z" fill="currentColor"/>
                                </svg>
                    </a>
                     <button class="share-button link" 
                                    title="Copier le lien" 
                                    onclick="copyToClipboard('{{ url()->current() }}')">
                                <svg width="20" height="20" viewBox="0 0 20 20" fill="none">
                                    <path d="M13.3333 10.8333V14.1667C13.3333 15.5474 12.214 16.6667 10.8333 16.6667H5.83333C4.45262 16.6667 3.33333 15.5474 3.33333 14.1667V9.16667C3.33333 7.78596 4.45262 6.66667 5.83333 6.66667H9.16667" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
                                    <path d="M16.6667 3.33333H11.6667C10.7462 3.33333 10 4.07953 10 5V10C10 10.9205 10.7462 11.6667 11.6667 11.6667H16.6667C17.5872 11.6667 18.3333 10.9205 18.3333 10V5C18.3333 4.07953 17.5872 3.33333 16.6667 3.33333Z" stroke="currentColor" stroke-width="1.5"/>
                                </svg>
                    </button>
                </div>
            </div>

           
            <div class="article-navigation">
                @if ($previousPost)
                    <a href="{{ route('blog.show', $previousPost->slug) }}" class="nav-card">
                        <div class="nav-icon">
                            <i class="fas fa-arrow-left"></i>
                        </div>
                        <div class="nav-content">
                            <h4>Article précédent</h4>
                            <h3>{{ $previousPost->title }}</h3>
                        </div>
                    </a>
                @endif

                @if ($nextPost)
                    <a href="{{ route('blog.show', $nextPost->slug) }}" class="nav-card next">
                        <div class="nav-icon">
                            <i class="fas fa-arrow-right"></i>
                        </div>
                        <div class="nav-content">
                            <h4>Article suivant</h4>
                            <h3>{{ $nextPost->title }}</h3>
                        </div>
                    </a>
                @endif
            </div>

           
            @if ($relatedPosts && $relatedPosts->count())
                <section class="recommended-articles">
                    <div class="section-header">
                        <h2 class="section-title">Articles similaires</h2>
                        <p class="section-subtitle">Découvrez d'autres articles qui pourraient vous intéresser</p>
                    </div>

                    <div class="recommended-grid">
                        @foreach ($relatedPosts as $related)
                            <a href="{{ route('blog.show', $related->slug) }}" class="recommended-card">
                                @if ($related->image)
                                    <img src="{{ asset('storage/' . $related->image) }}" alt="{{ $related->title }}"
                                        class="card-image">
                                @endif
                                <div class="card-content">
                                    <span class="card-category">Article</span>
                                    <h3 class="card-title">{{ $related->title }}</h3>
                                    <div class="card-meta">
                                        <span>{{ $related->published_at?->translatedFormat('d M Y') }}</span>
                                        <span>•</span>
                                        <span>{{ $related->reading_time ?? '3' }} min</span>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </section>
            @endif
        </div>
    </div>
    <script>
        function copyToClipboard(text) {
    navigator.clipboard.writeText(text).then(function() {
        
        const btn = event.target.closest('.share-button');
        const originalHTML = btn.innerHTML;
        
        btn.innerHTML = `
            <svg width="20" height="20" viewBox="0 0 20 20" fill="none">
                <path d="M16.6667 5L7.5 14.1667L3.33333 10" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        `;
        btn.style.background = '#4CAF50';
        
        setTimeout(() => {
            btn.innerHTML = originalHTML;
            btn.style.background = '';
        }, 2000);
    }).catch(function(err) {
        console.error('Erreur lors de la copie: ', err);
        alert('Impossible de copier le lien');
    });
}

    </script>
    <style>
        
.article-show-page {
    background: #fff;
    min-height: 100vh;
    width: 100%;
}

/* Header minimaliste - Corrigé */
.article-header {
    padding: 30px 0 40px;
    background: linear-gradient(135deg, #f8faff 0%, #f0f4ff 100%);
    border-bottom: 1px solid #eef2ff;
    margin-bottom: 30px;
    width: 100%;
}

.article-header .container {
    max-width: 100%;
    padding: 0 5%;
    margin: 0;
}

/* Navigation - Corrigé */
.article-nav {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 25px;
    flex-wrap: wrap;
    gap: 15px;
}

.back-home {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    color: #6B4EFF;
    text-decoration: none;
    font-weight: 500;
    font-size: 14px;
    padding: 8px 16px;
    border-radius: 20px;
    background: rgba(107, 78, 255, 0.1);
    transition: all 0.3s ease;
}

.back-home:hover {
    background: #6B4EFF;
    color: white;
    transform: translateX(-3px);
}

.article-date {
    color: #888;
    font-size: 13px;
    font-weight: 500;
    padding: 6px 14px;
    background: white;
    border-radius: 18px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
}

/* Titre principal - Corrigé */
.article-title {
    font-size: 36px;
    font-weight: 800;
    line-height: 1.2;
    color: #00091A;
    margin-bottom: 20px;
    letter-spacing: -0.3px;
    max-width: 95%;
}

.article-subtitle {
    font-size: 18px;
    line-height: 1.5;
    color: #666;
    font-weight: 400;
    margin-bottom: 25px;
    max-width: 90%;
}

/* Métadonnées élégantes - Corrigé */
.article-meta {
    display: flex;
    align-items: center;
    gap: 15px;
    padding: 15px 0;
    border-top: 1px solid #eef2ff;
    border-bottom: 1px solid #eef2ff;
    margin-bottom: 25px;
    flex-wrap: wrap;
}

.meta-item {
    display: flex;
    align-items: center;
    gap: 6px;
    color: #666;
    font-size: 13px;
    font-weight: 500;
}

.meta-icon {
    width: 28px;
    height: 28px;
    background: rgba(107, 78, 255, 0.1);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #6B4EFF;
    font-size: 12px;
}

/* Image principale avec effet - Corrigé */
.article-hero-image {
    width: 100%;
    margin: 0 0 40px 0;
    padding: 0 5%;
    position: relative;
}

.hero-image-wrapper {
    border-radius: 16px;
    overflow: hidden;
    box-shadow: 0 20px 40px rgba(107, 78, 255, 0.1);
    position: relative;
    max-height: 450px;
}

.hero-image-wrapper img {
    width: 100%;
    height: auto;
    max-height: 450px;
    object-fit: cover;
    display: block;
    transition: transform 0.8s ease;
}

.hero-image-wrapper:hover img {
    transform: scale(1.03);
}

/* Contenu principal - Corrigé pour plus large */
.article-content-wrapper {
    width: 100%;
    padding: 0 5% 50px;
    margin: 0;
}

/* Typographie riche - Corrigé */
.article-content {
    font-size: 18px;
    line-height: 1.8;
    color: #444;
    width: 100%;
    max-width: none;
}

/* Introduction - Corrigé */
.article-intro {
    font-size: 19px;
    line-height: 1.6;
    color: #333;
    font-weight: 500;
    margin-bottom: 40px;
    padding: 25px;
    background: linear-gradient(135deg, #f8faff 0%, #f5f8ff 100%);
    border-radius: 14px;
    border-left: 4px solid #6B4EFF;
    position: relative;
}

.article-intro::before {
    content: "💡";
    position: absolute;
    top: -12px;
    left: -12px;
    font-size: 20px;
    background: white;
    border-radius: 50%;
    width: 34px;
    height: 34px;
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 3px 10px rgba(0, 0, 0, 0.08);
}

/* Titres - Corrigés */
.article-content h2 {
    font-size: 28px;
    font-weight: 700;
    color: #00091A;
    margin: 50px 0 25px;
    padding-bottom: 12px;
    border-bottom: 2px solid #f0f4ff;
    position: relative;
}

.article-content h2::before {
    content: "";
    position: absolute;
    bottom: -2px;
    left: 0;
    width: 50px;
    height: 2px;
    background: linear-gradient(90deg, #6B4EFF, #4FC3F7);
}

.article-content h3 {
    font-size: 22px;
    font-weight: 600;
    color: #00091A;
    margin: 40px 0 20px;
    padding-left: 18px;
    border-left: 3px solid #6B4EFF;
}

.article-content h4 {
    font-size: 19px;
    font-weight: 600;
    color: #333;
    margin: 30px 0 15px;
}

/* Paragraphes - Corrigés */
.article-content p {
    margin-bottom: 25px;
    text-align: left;
    hyphens: auto;
}

/* Citations élégantes - Corrigées */
.article-content blockquote {
    margin: 40px 0;
    padding: 30px;
    background: linear-gradient(135deg, #f8faff 0%, #f0f4ff 100%);
    border-radius: 16px;
    border-left: none;
    position: relative;
    font-style: italic;
    font-size: 19px;
    line-height: 1.6;
    color: #00091A;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
}

.article-content blockquote::before {
    content: "❝";
    position: absolute;
    top: -15px;
    left: 20px;
    font-size: 60px;
    color: rgba(107, 78, 255, 0.15);
    font-family: serif;
    line-height: 1;
}

/* Listes stylées - Corrigées */
.article-content ul,
.article-content ol {
    margin: 30px 0;
    padding-left: 25px;
}

.article-content li {
    margin-bottom: 15px;
    position: relative;
    padding-left: 8px;
}

.article-content ul li::before {
    content: "";
    position: absolute;
    left: -18px;
    top: 10px;
    width: 6px;
    height: 6px;
    background: #6B4EFF;
    border-radius: 50%;
}

/* Images dans le contenu - Corrigées */
.article-content img {
    max-width: 100%;
    height: auto;
    border-radius: 12px;
    margin: 30px 0;
    display: block;
    box-shadow: 0 15px 30px rgba(0, 0, 0, 0.08);
    transition: transform 0.4s ease, box-shadow 0.4s ease;
}

.article-content img:hover {
    transform: translateY(-3px);
    box-shadow: 0 20px 40px rgba(107, 78, 255, 0.15);
}

/* Call-to-action élégant - Corrigé */
.article-cta {
    background: linear-gradient(135deg, #6B4EFF 0%, #4FC3F7 100%);
    color: white;
    padding: 40px;
    border-radius: 20px;
    margin: 50px 0;
    text-align: center;
    position: relative;
    overflow: hidden;
}

.cta-content {
    position: relative;
    z-index: 2;
    max-width: 100%;
    margin: 0;
}

.cta-title {
    font-size: 26px;
    font-weight: 700;
    margin-bottom: 15px;
}

.cta-text {
    font-size: 16px;
    opacity: 0.9;
    margin-bottom: 25px;
    line-height: 1.5;
}

.cta-button {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    padding: 14px 32px;
    background: white;
    color: #6B4EFF;
    border: none;
    border-radius: 40px;
    font-weight: 700;
    font-size: 15px;
    cursor: pointer;
    transition: all 0.3s ease;
    text-decoration: none;
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
}

.cta-button:hover {
    transform: translateY(-3px);
    box-shadow: 0 15px 35px rgba(0, 0, 0, 0.25);
    background: #FFD700;
    color: #00091A;
}

/* Partage social élégant - Corrigé */
.social-share {
    display: flex;
    align-items: center;
    gap: 20px;
    margin: 40px 0;
    padding: 25px;
    background: #f8faff;
    border-radius: 18px;
    border: 1px solid #eef2ff;
    flex-wrap: wrap;
}

.share-label {
    font-weight: 600;
    color: #333;
    font-size: 15px;
    min-width: fit-content;
}

.share-buttons {
    display: flex;
    gap: 10px;
    flex-wrap: wrap;
}

.share-button {
    width: 44px;
    height: 44px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    text-decoration: none;
    color: white;
    font-size: 16px;
    transition: all 0.3s ease;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
     border: none;
    cursor: pointer;
}
  
   
.share-button.twitter {
    background: #1DA1F2;
    color: white;
}


.share-button.linkedin {
    background: #0077B5;
    color: white;
}

.share-button.facebook {
    background: #1877F2;
    color: white;
}

.share-button.link {
    background: #666;
    color: white;
}

.share-button:hover {
    transform: translateY(-3px) scale(1.05);
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
}

/* Navigation entre articles - Corrigée */
.article-navigation {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 20px;
    margin: 50px 0;
}

.nav-card {
    background: white;
    border-radius: 18px;
    padding: 25px;
    text-decoration: none;
    color: inherit;
    transition: all 0.3s ease;
    border: 2px solid transparent;
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.04);
    display: flex;
    align-items: center;
    gap: 18px;
}

.nav-card:hover {
    border-color: #6B4EFF;
    transform: translateY(-3px);
    box-shadow: 0 15px 35px rgba(107, 78, 255, 0.1);
}

.nav-icon {
    width: 50px;
    height: 50px;
    background: rgba(107, 78, 255, 0.1);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #6B4EFF;
    font-size: 18px;
    flex-shrink: 0;
}

.nav-content h4 {
    color: #666;
    font-size: 13px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    margin-bottom: 6px;
}

.nav-content h3 {
    color: #00091A;
    font-size: 16px;
    font-weight: 700;
    line-height: 1.3;
}

.nav-card.next {
    text-align: right;
    flex-direction: row-reverse;
}

/* Articles recommandés - Corrigé */
.recommended-articles {
    margin-top: 70px;
    padding: 0;
}

.section-header {
    text-align: left;
    margin-bottom: 40px;
}

.section-title {
    font-size: 28px;
    font-weight: 800;
    color: #00091A;
    margin-bottom: 12px;
    letter-spacing: -0.3px;
}

.section-subtitle {
    color: #666;
    font-size: 16px;
    max-width: 100%;
    margin: 0;
}

.recommended-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 25px;
}

.recommended-card {
    background: white;
    border-radius: 18px;
    overflow: hidden;
    text-decoration: none;
    color: inherit;
    transition: all 0.3s ease;
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.04);
    border: 1px solid #f0f4ff;
}

.recommended-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 20px 40px rgba(107, 78, 255, 0.1);
}

.card-image {
    width: 100%;
    height: 180px;
    object-fit: cover;
    display: block;
}

.card-content {
    padding: 25px;
}

.card-category {
    display: inline-block;
    color: #6B4EFF;
    font-size: 11px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 1px;
    margin-bottom: 12px;
    padding: 5px 10px;
    background: rgba(107, 78, 255, 0.1);
    border-radius: 18px;
}

.card-title {
    font-size: 18px;
    font-weight: 700;
    color: #00091A;
    line-height: 1.3;
    margin-bottom: 12px;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.card-meta {
    display: flex;
    align-items: center;
    gap: 12px;
    color: #888;
    font-size: 13px;
    padding-top: 15px;
    border-top: 1px solid #f0f4ff;
}

/* Responsive - Corrigé */
@media (min-width: 1200px) {
    .article-header .container,
    .article-hero-image,
    .article-content-wrapper {
        padding: 0 8%;
    }
    
    .article-title {
        font-size: 42px;
        max-width: 90%;
    }
    
    .article-content {
        max-width: 90%;
    }
}

@media (max-width: 992px) {
    .article-title {
        font-size: 32px;
    }
    
    .article-hero-image {
        margin-bottom: 30px;
    }
    
    .hero-image-wrapper {
        max-height: 400px;
    }
    
    .article-navigation {
        grid-template-columns: 1fr;
        gap: 15px;
    }
    
    .article-header .container,
    .article-hero-image,
    .article-content-wrapper {
        padding: 0 4%;
    }
}

@media (max-width: 768px) {
    .article-header {
        padding: 25px 0 30px;
        margin-bottom: 25px;
    }
    
    .article-title {
        font-size: 26px;
        max-width: 100%;
    }
    
    .article-subtitle {
        font-size: 16px;
        max-width: 100%;
    }
    
    .article-meta {
        flex-direction: row;
        gap: 12px;
    }
    
    .hero-image-wrapper {
        max-height: 350px;
        border-radius: 14px;
    }
    
    .article-content {
        font-size: 17px;
    }
    
    .article-content h2 {
        font-size: 24px;
        margin: 40px 0 20px;
    }
    
    .article-content h3 {
        font-size: 20px;
        margin: 35px 0 18px;
    }
    
    .article-intro {
        font-size: 17px;
        padding: 20px;
        margin-bottom: 30px;
    }
    
    .article-cta {
        padding: 30px 20px;
        margin: 40px 0;
    }
    
    .cta-title {
        font-size: 22px;
    }
    
    .social-share {
        flex-direction: column;
        align-items: flex-start;
        gap: 15px;
        padding: 20px;
    }
    
    .share-buttons {
        width: 100%;
        justify-content: center;
    }
    
    .article-header .container,
    .article-hero-image,
    .article-content-wrapper {
        padding: 0 20px;
    }
}

@media (max-width: 480px) {
    .article-title {
        font-size: 22px;
    }
    
    .article-subtitle {
        font-size: 15px;
    }
    
    .article-content h2 {
        font-size: 21px;
    }
    
    .article-content h3 {
        font-size: 18px;
    }
    
    .recommended-grid {
        grid-template-columns: 1fr;
        gap: 20px;
    }
    
    .article-cta {
        padding: 25px 18px;
    }
    
    .cta-title {
        font-size: 20px;
    }
    
    .cta-button {
        padding: 12px 28px;
        font-size: 14px;
    }
    
    .nav-card {
        padding: 20px;
    }
    
    .nav-icon {
        width: 44px;
        height: 44px;
        font-size: 16px;
    }
    
    .nav-content h3 {
        font-size: 15px;
    }
}

/* Effets de scroll - Légers */
.article-content > * {
    opacity: 0;
    transform: translateY(20px);
    animation: fadeUp 0.6s ease forwards;
}

@keyframes fadeUp {
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.article-content > *:nth-child(1) { animation-delay: 0.1s; }
.article-content > *:nth-child(2) { animation-delay: 0.2s; }
.article-content > *:nth-child(3) { animation-delay: 0.3s; }

/* Effet de surbrillance pour les liens */
.article-content a {
    color: #6B4EFF;
    text-decoration: none;
    position: relative;
    padding-bottom: 2px;
    background: linear-gradient(90deg, #6B4EFF, #6B4EFF) no-repeat;
    background-size: 0% 2px;
    background-position: 0 100%;
    transition: background-size 0.3s ease, color 0.3s ease;
}

.article-content a:hover {
    color: #4FC3F7;
    background-size: 100% 2px;
}

/* Style pour les tableaux */
.article-content table {
    width: 100%;
    border-collapse: separate;
    border-spacing: 0;
    margin: 30px 0;
    border-radius: 14px;
    overflow: hidden;
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.04);
    background: white;
}

.article-content table thead {
    background: linear-gradient(135deg, #6B4EFF 0%, #4FC3F7 100%);
}

.article-content table th {
    color: white;
    font-weight: 600;
    padding: 16px;
    text-align: left;
    border-bottom: 1px solid rgba(255, 255, 255, 0.2);
    font-size: 15px;
}

.article-content table td {
    padding: 16px;
    border-bottom: 1px solid #f0f4ff;
    font-size: 15px;
}

.article-content table tbody tr:hover {
    background: #f8faff;
}
    </style>
@endsection

@push('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
@endpush
