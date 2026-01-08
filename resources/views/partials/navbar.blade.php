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
    <span class="logo">MonSite</span>
    
    <a href="{{ url('/admin/login') }}">Login</a>
</header>


<div class="menu-overlay" id="menu">
    <div class="menu-header">
        <span class="menu-logo">MonSite</span>
        <button class="close-btn" id="closeMenu">✕</button>
    </div>


    <div class="menu-content">
        <div class="menu-column"> 
            <h4>Nos services</h4>
            <a href="#">Plomberie</a>
            <a href="#">Électricité</a>
            <a href="#">Serrurerie</a>
        </div>

        <div class="menu-column">
            <h4>Mieux comprendre</h4>
            <a href="#">Comment ça marche</a>
            <a href="#">FAQ</a>
            <a href="#">Tarifs</a>
        </div>

        <div class="menu-column">
            <h4>Nous connaître</h4>
            <a href="#">À propos</a>
            <a href="#">Contact</a>
            <a href="#">Recrutement</a>
        </div>
    </div>
</div>

