<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Accueil')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

</head>

<body class="site">
    @livewireStyles
    @livewireScripts

    @include('partials.navbar')
    

    <main>
        @yield('content')
    </main>

    <script src="{{ asset('js/script.js') }}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/lazysizes.min.js"></script>

    @isset($hero)
        <script>
            window.heroJobs = @json(collect($hero->jobs)->pluck('value'));
        </script>
    @endisset


    {{-- <script>
        document.addEventListener('DOMContentLoaded', () => {
            const btn = document.getElementById('showPhoneBtn');
            const phone = document.getElementById('phoneNumber');

            if (!btn || !phone) return;

            btn.addEventListener('click', () => {
                btn.classList.add('hidden');
                phone.classList.remove('hidden');
            });
        });
    </script> --}}

@include('partials.footer')
</body>

</html>
