@extends('layouts.app')

@section('content')
<style>
      
        .back{
            /*align-items: center;
                        gap: 10px;*/
            display: flex;
            margin-top: 50px;
            margin-left: 90px;
            color: #000000;
            text-decoration: none;
            font-weight: 700;
            font-size: 20px;
            transition: all 0.3s ease;
        }

        .back:hover {
            gap: 12px;
            color: #80d7ff;
        }
</style>
    <div >
        <a href="{{ route('home.index') }}" class="back">
            <svg width="20" height="20" viewBox="0 0 20 20" fill="none">
                <path d="M15.8333 10H4.16667M4.16667 10L9.16667 15M4.16667 10L9.16667 5" stroke="currentColor"
                    stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
            Retour
        </a>
    </div>
    <section class="who-we-are-static">

        <div class="wwa-static-bg">
            <div class="wwa-static-dots"></div>
            <div class="wwa-static-circle-1"></div>
            <div class="wwa-static-circle-2"></div>
        </div>

        <div class="container">


            @if ($artisans->count())
                <div class="wwa-static-artisans">
                    <div class="section-header-static" data-aos="fade-up">
                        <h3>Des artisans vérifiés près de chez vous</h3>
                        <p>Professionnels qualifiés avec expérience et excellentes évaluations</p>
                    </div>

                    <div class="artisans-grid-static" data-aos="fade-up" data-aos-duration="1000">
                        @foreach ($artisans as $artisan)
                            <div class="artisan-card-static">

                                <div class="artisan-avatar-static"
                                    style="background: linear-gradient(135deg, #6B4EFF, #4FC3F7);">
                                    {{ strtoupper(Str::substr($artisan->name, 0, 2)) }}
                                </div>

                                <div class="artisan-content-static">
                                    <div class="artisan-header-static">
                                        <h4>{{ $artisan->name }}</h4>
                                        @if ($artisan->job)
                                            <span class="artisan-badge-static">{{ $artisan->job }}</span>
                                        @endif
                                    </div>

                                    @if ($artisan->description)
                                        <p class="artisan-desc-static">
                                            {{ $artisan->description }}
                                        </p>
                                    @endif

                                    <div class="artisan-meta-static">
                                        @if ($artisan->rating)
                                            <div class="meta-item-static">
                                                ⭐ <span>{{ $artisan->rating }}</span>
                                            </div>
                                        @endif

                                        @if ($artisan->experience)
                                            <div class="meta-item-static">
                                                ⏱ <span>{{ $artisan->experience }}</span>
                                            </div>
                                        @endif

                                        @if ($artisan->status)
                                            <div class="meta-item-static">
                                                ✔ <span>{{ $artisan->status }}</span>
                                            </div>
                                        @endif
                                    </div>

                                    @if ($artisan->location)
                                        <div class="artisan-footer-static">
                                            <span class="location-static">
                                                📍 {{ $artisan->location }}
                                            </span>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            @if ($partners->count())
                <div class="wwa-static-partners">
                    <div class="section-header-static">
                        <h3>Ils nous font confiance</h3>
                        @if ($stats->count())
                            <div class="wwa-static-stats">
                                <div class="stats-grid-static">
                                    @foreach ($stats as $stat)
                                        <div class="stat-item-static" data-aos="zoom-in-down" data-aos-duration="2000">
                                            <div class="stat-number-static">{{ $stat->value }}</div>
                                            <div class="stat-label-static">{{ $stat->label }}</div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                        <p>Des partenaires de renom qui soutiennent notre démarche</p>
                    </div>

                    <div class="partners-grid-static" data-aos="zoom-in-down" data-aos-duration="2000">
                        @foreach ($partners as $partner)
                            <div class="partner-card-static">
                                <div class="partner-logo-static">
                                    @if ($partner->logo)
                                        <img src="{{ asset('storage/' . $partner->logo) }}" alt="{{ $partner->name }}"
                                            style="max-width:80px;">
                                    @endif
                                </div>

                                <div class="partner-content-static">
                                    <h4>{{ $partner->name }}</h4>

                                    @if ($partner->type)
                                        <p class="partner-type-static">{{ $partner->type }}</p>
                                    @endif

                                    @if ($partner->description)
                                        <p class="partner-desc-static">
                                            {{ $partner->description }}
                                        </p>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

        </div>
    </section>
@endsection
