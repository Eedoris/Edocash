@extends('layouts.app')

@section('content')
<div class="article-detail-page">
    
    <nav class="article-breadcrumb">
        <div class="container">
            <a href="{{ route('press.index') }}" class="back-link">
                <svg width="20" height="20" viewBox="0 0 20 20" fill="none">
                    <path d="M15.8333 10H4.16667M4.16667 10L9.16667 15M4.16667 10L9.16667 5" 
                          stroke="currentColor" stroke-width="1.5" 
                          stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                Retour à l'espace presse
            </a>
        </div>
    </nav>

    <header class="article-header">
        <div class="container">
            @php
                $categoryLabel = match($article->category) {
                    'press' => 'Presse écrite',
                    'tv' => 'Télévision',
                    'web' => 'Web',
                    'release' => 'Communiqué',
                    default => 'Article',
                };
            @endphp
            
            <div class="article-category-badge">
                <span class="badge {{ $article->category }}">{{ $categoryLabel }}</span>
                <time class="article-date">
                    {{ $article->published_at?->translatedFormat('d F Y') ?? 'Date non précisée' }}
                </time>
            </div>
            
            <h1 class="article-title">{{ $article->title }}</h1>
            
            @if($article->excerpt)
            <div class="article-excerpt">
                <blockquote>
                    « {{ $article->excerpt }} »
                </blockquote>
            </div>
            @endif

            @if($article->external_url)
            <div class="external-source">
                <svg width="16" height="16" viewBox="0 0 16 16" fill="none">
                    <path d="M12.6667 8.66667V12.6667C12.6667 13.403 12.0697 14 11.3333 14H3.33333C2.59695 14 2 13.403 2 12.6667V4.66667C2 3.93029 2.59695 3.33333 3.33333 3.33333H7.33333" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
                    <path d="M10 2H14V6" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
                    <path d="M6.66667 9.33333L14 2" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
                </svg>
                <a href="{{ $article->external_url }}" target="_blank" rel="noopener noreferrer" class="source-link">
                    Lire l'article original
                </a>
            </div>
            @endif
        </div>
    </header>

   
    @if($article->image)
    <div class="article-featured-image">
        <div class="container">
            <img src="{{ asset('storage/' . $article->image) }}" 
                 alt="{{ $article->title }}" 
                 class="featured-img">
        </div>
    </div>
    @endif

    <article class="article-content">
        <div class="container">
            <div class="content-wrapper">
            
                <div class="article-body">
                    <div class="article-intro">
                        {!! $article->content !!}
                    </div>

                    @if($article->external_url)
                    <div class="read-more-cta">
                        <h3>Pour en savoir plus</h3>
                        <a href="{{ $article->external_url }}" target="_blank" rel="noopener noreferrer" class="external-btn">
                            <span>Lire l'article complet sur le site du média</span>
                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none">
                                <path d="M4.16675 10H15.8334M15.8334 10L10.8334 5M15.8334 10L10.8334 15" 
                                      stroke="currentColor" stroke-width="1.5" 
                                      stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </a>
                    </div>
                    @endif

                  
                    <div class="article-tags">
                        <span class="tags-label">Mots-clés :</span>
                        <a href="{{ route('press.index', ['category' => $article->category]) }}" class="tag">
                            {{ $categoryLabel }}
                        </a>
                        {{--<span class="tag">Fintech</span>
                        <span class="tag">Innovation</span>
                        <span class="tag">Afrique</span>--}}
                    </div>

                    <div class="share-widget">
                        <span class="share-label">Partager cet article :</span>
                        <div class="share-buttons">
                            @php
                                $shareUrl = url()->current();
                                $shareTitle = urlencode($article->title);
                                $shareText = urlencode($article->excerpt ?? '');
                            @endphp
                            
                            <a href="https://twitter.com/intent/tweet?url={{ $shareUrl }}&text={{ $shareTitle }}" 
                               target="_blank" 
                               class="share-btn twitter" 
                               title="Partager sur Twitter">
                                <svg width="20" height="20" viewBox="0 0 20 20" fill="none">
                                    <path d="M19.1666 2.50001C18.3686 3.0629 17.4851 3.4934 16.55 3.77501C16.0481 3.19794 15.3811 2.78894 14.6392 2.60332C13.8974 2.4177 13.1163 2.46435 12.4017 2.73705C11.6871 3.00976 11.0737 3.49534 10.6441 4.12811C10.2146 4.76088 9.98973 5.5103 9.99998 6.27501V7.10834C8.53551 7.14632 7.08438 6.82152 5.77582 6.16288C4.46726 5.50424 3.34191 4.53221 2.49998 3.33334C2.49998 3.33334 -0.833354 10.8333 6.66665 14.1667C4.95042 15.3316 2.90595 15.9158 0.833313 15.8333C8.33331 20 17.5 15.8333 17.5 6.25001C17.4992 6.01787 17.4769 5.78633 17.4333 5.55834C18.2838 4.71958 18.884 3.6606 19.1666 2.50001Z" 
                                          fill="currentColor"/>
                                </svg>
                            </a>
                            <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ $shareUrl }}" 
                               target="_blank" 
                               class="share-btn linkedin" 
                               title="Partager sur LinkedIn">
                                <svg width="20" height="20" viewBox="0 0 20 20" fill="none">
                                    <path d="M4.94063 6.66667H1.66667V18.3333H4.94063V6.66667Z" fill="currentColor"/>
                                    <path d="M3.28125 4.99999C4.32293 4.99999 5.16667 4.15625 5.16667 3.11458C5.16667 2.07291 4.32293 1.22916 3.28125 1.22916C2.23958 1.22916 1.39583 2.07291 1.39583 3.11458C1.39583 4.15625 2.23958 4.99999 3.28125 4.99999Z" fill="currentColor"/>
                                    <path d="M14.5896 6.66667C12.9021 6.66667 11.5729 7.39583 10.6646 8.375V6.66667H7.39062V18.3333H10.6646V12.2396C10.6646 10.6438 11.3396 9.86458 12.6979 9.86458C14.0562 9.86458 14.5896 10.7896 14.5896 12.3437V18.3333H17.8635V11.7396C17.8635 8.64583 16.7396 6.66667 14.5896 6.66667Z" fill="currentColor"/>
                                </svg>
                            </a>
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ $shareUrl }}" 
                               target="_blank" 
                               class="share-btn facebook" 
                               title="Partager sur Facebook">
                                <svg width="20" height="20" viewBox="0 0 20 20" fill="none">
                                    <path d="M18.3333 10C18.3333 5.4 14.6 1.66667 10 1.66667C5.4 1.66667 1.66667 5.4 1.66667 10C1.66667 13.9333 4.53333 17.2333 8.33333 18.0667V12.5H6.66667V10H8.33333V7.91667C8.33333 6.03333 9.86667 4.5 11.75 4.5H13.3333V7H11.75C11.0583 7 10.5 7.55833 10.5 8.25V10H13.3333V12.5H10.5V18.1667C14.85 17.7417 18.3333 14.2167 18.3333 10Z" fill="currentColor"/>
                                </svg>
                            </a>
                            <button class="share-btn copy-link" 
                                    title="Copier le lien" 
                                    onclick="copyToClipboard('{{ url()->current() }}')">
                                <svg width="20" height="20" viewBox="0 0 20 20" fill="none">
                                    <path d="M13.3333 10.8333V14.1667C13.3333 15.5474 12.214 16.6667 10.8333 16.6667H5.83333C4.45262 16.6667 3.33333 15.5474 3.33333 14.1667V9.16667C3.33333 7.78596 4.45262 6.66667 5.83333 6.66667H9.16667" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
                                    <path d="M16.6667 3.33333H11.6667C10.7462 3.33333 10 4.07953 10 5V10C10 10.9205 10.7462 11.6667 11.6667 11.6667H16.6667C17.5872 11.6667 18.3333 10.9205 18.3333 10V5C18.3333 4.07953 17.5872 3.33333 16.6667 3.33333Z" stroke="currentColor" stroke-width="1.5"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Sidebar -->
                <aside class="article-sidebar">
                    <!-- Related Articles -->
                    <div class="sidebar-widget">
                        <h3 class="widget-title">Articles similaires</h3>
                        @php
                            $relatedArticles = \App\Models\PressArticle::where('id', '!=', $article->id)
                                ->where('category', $article->category)
                                ->orderBy('published_at', 'desc')
                                ->limit(3)
                                ->get();
                        @endphp
                        
                        @if($relatedArticles->count() > 0)
                        <div class="related-articles">
                            @foreach($relatedArticles as $related)
                            <a href="{{ route('press.show', $related->slug) }}" class="related-article">
                                @if($related->image)
                                <div class="related-image">
                                    <img src="{{ asset('storage/' . $related->image) }}" 
                                         alt="{{ $related->title }}">
                                </div>
                                @endif
                                <div class="related-content">
                                    <h4>{{ Str::limit($related->title, 60) }}</h4>
                                    <time>{{ $related->published_at?->format('d/m/Y') }}</time>
                                </div>
                            </a>
                            @endforeach
                        </div>
                        @else
                        <p class="no-related">Aucun article similaire pour le moment.</p>
                        @endif
                    </div>

                    <!-- Newsletter -->
                    <div class="sidebar-widget newsletter-widget">
                        <h3 class="widget-title">Restez informé</h3>
                        <p>Recevez nos actualités presse par email</p>
                        <form class="newsletter-form">
                            <input type="email" placeholder="Votre email" class="newsletter-input" required>
                            <button type="submit" class="newsletter-btn">S'abonner</button>
                        </form>
                    </div>

                    <!-- Contact Presse -->
                    <div class="sidebar-widget contact-widget">
                        <h3 class="widget-title">Contact Presse</h3>
                        <p>Vous êtes journaliste ?</p>
                        <a href="mailto:presse@edocash.com" class="contact-link">
                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none">
                                <path d="M2.66667 4L8 8L13.3333 4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
                                <path d="M2.66667 12H13.3333C14.0697 12 14.6667 11.403 14.6667 10.6667V5.33333C14.6667 4.59695 14.0697 4 13.3333 4H2.66667C1.93029 4 1.33333 4.59695 1.33333 5.33333V10.6667C1.33333 11.403 1.93029 12 2.66667 12Z" stroke="currentColor" stroke-width="1.5"/>
                            </svg>
                            <span>presse@edocash.com</span>
                        </a>
                    </div>
                </aside>
            </div>
        </div>
    </article>

    <!-- Next Article CTA -->
    @php
        $nextArticle = null;
        if ($article->published_at) {
            $nextArticle = \App\Models\PressArticle::where('published_at', '>', $article->published_at)
                ->where('id', '!=', $article->id)
                ->orderBy('published_at', 'asc')
                ->first();
        }
    @endphp
    
    @if($nextArticle)
    <section class="next-article">
        <div class="container">
            <div class="next-article-content">
                <h3>Article suivant</h3>
                <a href="{{ route('press.show', $nextArticle->slug) }}" class="next-article-link">
                    <div class="next-article-info">
                        <span class="next-label">À lire ensuite</span>
                        <h2>{{ $nextArticle->title }}</h2>
                        <p>{{ Str::limit($nextArticle->excerpt, 120) }}</p>
                    </div>
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <path d="M5 12H19M19 12L13 6M19 12L13 18" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </a>
            </div>
        </div>
    </section>
    @endif
</div>

<style>
/* ===== PAGE DÉTAIL ARTICLE ===== */
.article-detail-page {
    background: #f8f9ff;
    min-height: 100vh;
}

/* Breadcrumb */
.article-breadcrumb {
    padding: 25px 0;
    background: white;
    border-bottom: 1px solid #f0f0f0;
}

.back-link {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    color: #6B4EFF;
    text-decoration: none;
    font-weight: 500;
    font-size: 15px;
    transition: all 0.3s ease;
}

.back-link:hover {
    gap: 15px;
    color: #4FC3F7;
}

/* Article Header */
.article-header {
    padding: 60px 0 40px;
    background: white;
    border-bottom: 1px solid #f0f0f0;
}

.article-category-badge {
    display: flex;
    align-items: center;
    gap: 20px;
    margin-bottom: 25px;
}

.badge {
    padding: 8px 20px;
    border-radius: 20px;
    font-size: 13px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.badge.press {
    background: linear-gradient(135deg, #2196F3, #21CBF3);
    color: white;
}

.badge.tv {
    background: linear-gradient(135deg, #FF4081, #FF80AB);
    color: white;
}

.badge.web {
    background: linear-gradient(135deg, #4CAF50, #81C784);
    color: white;
}

.badge.release {
    background: linear-gradient(135deg, #6B4EFF, #4FC3F7);
    color: white;
}

.badge.other {
    background: linear-gradient(135deg, #FF9800, #FFB74D);
    color: white;
}

.article-date {
    color: #999;
    font-size: 14px;
}

.article-title {
    font-size: 42px;
    line-height: 1.2;
    color: #00091A;
    margin-bottom: 30px;
    font-weight: 700;
    max-width: 800px;
}

@media (max-width: 768px) {
    .article-title {
        font-size: 32px;
    }
}

.article-excerpt blockquote {
    font-size: 20px;
    line-height: 1.5;
    color: #666;
    border-left: 4px solid #6B4EFF;
    padding-left: 25px;
    margin: 0 0 40px 0;
    font-style: italic;
    font-weight: 300;
    max-width: 700px;
}

.external-source {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    padding: 12px 20px;
    background: #f8f9ff;
    border-radius: 12px;
    color: #6B4EFF;
    font-weight: 500;
    font-size: 15px;
}

.source-link {
    color: #6B4EFF;
    text-decoration: none;
    border-bottom: 1px solid transparent;
    transition: border-color 0.3s ease;
}

.source-link:hover {
    border-color: #6B4EFF;
}

/* Featured Image */
.article-featured-image {
    padding: 60px 0;
    background: linear-gradient(135deg, #f8f9ff, #eef0ff);
}

.featured-img {
    width: 100%;
    height: 500px;
    object-fit: cover;
    border-radius: 20px;
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
}

@media (max-width: 768px) {
    .featured-img {
        height: 300px;
    }
}

/* Article Content */
.article-content {
    padding: 60px 0;
}

.content-wrapper {
    display: grid;
    grid-template-columns: 2fr 1fr;
    gap: 60px;
}

@media (max-width: 992px) {
    .content-wrapper {
        grid-template-columns: 1fr;
        gap: 40px;
    }
}


.article-body {
    background: white;
    border-radius: 20px;
    padding: 50px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
}

@media (max-width: 768px) {
    .article-body {
        padding: 30px 20px;
    }
}

.article-intro {
    font-size: 18px;
    line-height: 1.8;
    color: #333;
    margin-bottom: 40px;
}

.article-intro h2 {
    font-size: 28px;
    color: #00091A;
    margin: 40px 0 20px;
    font-weight: 700;
}

.article-intro h3 {
    font-size: 22px;
    color: #00091A;
    margin: 30px 0 15px;
    font-weight: 600;
}

.article-intro p {
    margin-bottom: 25px;
}

.article-intro ul, .article-intro ol {
    padding-left: 30px;
    margin-bottom: 25px;
}

.article-intro li {
    margin-bottom: 10px;
    line-height: 1.6;
}

.read-more-cta {
    background: linear-gradient(135deg, #6B4EFF10, #4FC3F710);
    border-radius: 16px;
    padding: 30px;
    margin: 40px 0;
    border: 2px solid #f0f0f0;
}

.read-more-cta h3 {
    font-size: 20px;
    color: #00091A;
    margin-bottom: 15px;
}

.external-btn {
    display: inline-flex;
    align-items: center;
    gap: 12px;
    color: #6B4EFF;
    text-decoration: none;
    font-weight: 600;
    font-size: 16px;
    transition: gap 0.3s ease;
}

.external-btn:hover {
    gap: 18px;
}

.article-tags {
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    gap: 15px;
    padding: 30px 0;
    border-top: 1px solid #f0f0f0;
    margin-top: 40px;
}

.tags-label {
    color: #666;
    font-weight: 500;
    font-size: 15px;
}

.tag {
    padding: 8px 16px;
    background: #f0f0f0;
    border-radius: 20px;
    color: #666;
    font-size: 14px;
    text-decoration: none;
    transition: all 0.3s ease;
}

.tag:hover {
    background: #6B4EFF;
    color: white;
}

/* Share Widget */
.share-widget {
    padding: 30px 0;
    border-top: 1px solid #f0f0f0;
    display: flex;
    align-items: center;
    gap: 20px;
    flex-wrap: wrap;
}

.share-label {
    color: #666;
    font-weight: 500;
    font-size: 15px;
}

.share-buttons {
    display: flex;
    gap: 10px;
}

.share-btn {
    width: 45px;
    height: 45px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    text-decoration: none;
    transition: all 0.3s ease;
    border: none;
    cursor: pointer;
}

.share-btn.twitter {
    background: #1DA1F2;
    color: white;
}

.share-btn.linkedin {
    background: #0077B5;
    color: white;
}

.share-btn.facebook {
    background: #1877F2;
    color: white;
}

.share-btn.copy-link {
    background: #666;
    color: white;
}

.share-btn:hover {
    transform: translateY(-3px);
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
}

/* Sidebar */
.article-sidebar {
    position: sticky;
    top: 100px;
    height: fit-content;
}

.sidebar-widget {
    background: white;
    border-radius: 16px;
    padding: 30px;
    margin-bottom: 30px;
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.05);
}

.widget-title {
    font-size: 20px;
    color: #00091A;
    margin-bottom: 20px;
    font-weight: 700;
}


.related-articles {
    display: flex;
    flex-direction: column;
    gap: 20px;
}

.related-article {
    display: flex;
    gap: 15px;
    text-decoration: none;
    padding: 15px;
    border-radius: 12px;
    transition: all 0.3s ease;
}

.related-article:hover {
    background: #f8f9ff;
    transform: translateX(5px);
}

.related-image {
    width: 80px;
    height: 80px;
    flex-shrink: 0;
    border-radius: 10px;
    overflow: hidden;
}

.related-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.related-content {
    flex: 1;
}

.related-content h4 {
    font-size: 16px;
    color: #00091A;
    margin-bottom: 8px;
    line-height: 1.4;
    font-weight: 600;
}

.related-content time {
    font-size: 13px;
    color: #999;
}

.no-related {
    color: #999;
    font-style: italic;
    text-align: center;
    padding: 20px 0;
}

/* Newsletter */
.newsletter-widget {
    background: linear-gradient(135deg, #6B4EFF, #4FC3F7);
    color: white;
}

.newsletter-widget .widget-title,
.newsletter-widget p {
    color: white;
}

.newsletter-form {
    display: flex;
    flex-direction: column;
    gap: 15px;
    margin-top: 20px;
}

.newsletter-input {
    padding: 14px 20px;
    border-radius: 10px;
    border: none;
    font-size: 15px;
    background: rgba(255, 255, 255, 0.9);
}

.newsletter-input:focus {
    outline: none;
    background: white;
}

.newsletter-btn {
    padding: 14px 20px;
    background: white;
    color: #6B4EFF;
    border: none;
    border-radius: 10px;
    font-weight: 600;
    font-size: 15px;
    cursor: pointer;
    transition: all 0.3s ease;
}

.newsletter-btn:hover {
    background: #f0f0f0;
    transform: translateY(-2px);
}

/* Contact Widget */
.contact-link {
    display: flex;
    align-items: center;
    gap: 10px;
    color: #6B4EFF;
    text-decoration: none;
    font-weight: 500;
    margin-top: 15px;
    padding: 12px;
    border-radius: 10px;
    background: #f8f9ff;
    transition: all 0.3s ease;
}

.contact-link:hover {
    background: #6B4EFF;
    color: white;
}

/* Next Article */
.next-article {
    background: linear-gradient(135deg, #f8f9ff, #eef0ff);
    padding: 60px 0;
    border-top: 1px solid #f0f0f0;
}

.next-article-content h3 {
    font-size: 18px;
    color: #666;
    margin-bottom: 15px;
    font-weight: 500;
}

.next-article-link {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 30px;
    background: white;
    border-radius: 20px;
    text-decoration: none;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
    transition: all 0.3s ease;
}

.next-article-link:hover {
    transform: translateY(-5px);
    box-shadow: 0 20px 40px rgba(107, 78, 255, 0.1);
}

.next-label {
    display: block;
    font-size: 14px;
    color: #6B4EFF;
    font-weight: 600;
    margin-bottom: 10px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.next-article-info h2 {
    font-size: 24px;
    color: #00091A;
    margin-bottom: 10px;
    font-weight: 700;
    line-height: 1.3;
}

.next-article-info p {
    color: #666;
    font-size: 16px;
    line-height: 1.5;
}

.next-article-link svg {
    flex-shrink: 0;
    margin-left: 30px;
}
</style>

<script>

function copyToClipboard(text) {
    navigator.clipboard.writeText(text).then(function() {
        // Afficher un message de succès
        const btn = event.target.closest('.share-btn');
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


document.querySelector('.newsletter-form')?.addEventListener('submit', function(e) {
    e.preventDefault();
    const email = this.querySelector('.newsletter-input').value;
    
    // faire un appel AJAX pour enregistrer l'email
    this.innerHTML = `
        <div style="text-align: center; padding: 20px 0;">
            <svg width="48" height="48" viewBox="0 0 48 48" fill="none">
                <path d="M24 44C35.0457 44 44 35.0457 44 24C44 12.9543 35.0457 4 24 4C12.9543 4 4 12.9543 4 24C4 35.0457 12.9543 44 24 44Z" fill="#4CAF50"/>
                <path d="M16 24L22 30L32 18" stroke="white" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
            <p style="margin-top: 15px; font-weight: 600;">Merci pour votre inscription !</p>
            <p style="font-size: 14px; opacity: 0.8;">Vous recevrez bientôt nos actualités.</p>
        </div>
    `;
});
</script>
@endsection