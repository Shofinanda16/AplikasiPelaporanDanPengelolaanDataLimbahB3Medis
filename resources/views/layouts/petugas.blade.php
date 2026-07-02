<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Petugas')</title>
    <link rel="icon" type="image/jpeg" href="{{ asset('Logo.jpeg') }}">
    <!-- /* BOOTSTRAP */ -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- /* FONT AWESOME */ -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <!-- /* CSS LAYOUT */ -->
    <link rel="stylesheet" href="{{ asset('css/layouts/petugas.css') }}">

    @stack('styles')
</head>

<body>

<!-- /* TOPBAR */ -->
<header class="topbar">
    <div class="brand">
        <div class="logo">
            <i class="fa-solid fa-user"></i>
        </div>

        <div>
            <h5>{{ ucfirst(Auth::user()->username ?? 'User') }}</h5>
            <span>{{ ucfirst(Auth::user()->role ?? 'Role') }}</span>
        </div>

    </div>

    <!-- /* INFORMASI PERUSAHAAN */ -->
    <div class="company">
        <strong>PT. Sriwijaya Mandiri Sumsel</strong>
        <span>Aplikasi Pelaporan dan Pengelolaan Data Limbah B3 Medis</span>
    </div>

    <!-- /* LOGOUT */ -->
    <a href="/login" class="logout-btn">
        <i class="fa-solid fa-right-from-bracket"></i>
        Logout
    </a>

</header>

<!-- /* LAYOUT */ -->
<div class="layout">

    <!-- /* SIDEBAR */ -->
    <aside class="sidebar">
        <ul>
            <li>
                <a href="/dashboard-petugas"
                   class="{{ request()->is('dashboard-petugas') ? 'active' : '' }}">
                    <i class="fa-solid fa-border-all"></i>
                    Dashboard
                </a>
            </li>

            <li class="has-submenu {{ request()->is('petugas-limbah-masuk') || request()->is('petugas-hasil-insinerasi') || request()->is('add-hasil-insinerasi') ? 'open' : '' }}">

                <button type="button"
                    class="submenu-toggle {{ request()->is('petugas-limbah-masuk') || request()->is('petugas-hasil-insinerasi') || request()->is('add-hasil-insinerasi') ? 'active' : '' }}">

                    <span>
                        <i class="fa-solid fa-biohazard"></i>
                        Data Limbah B3 Medis
                    </span>

                    <i class="fa-solid fa-sort-down arrow"></i>

                </button>

                <div class="submenu">

                    <a href="/petugas-limbah-masuk"
                       class="{{ request()->is('petugas-limbah-masuk') ? 'active' : '' }}">
                        <i class="fa-solid fa-folder-plus"></i>
                        Data Limbah Masuk
                    </a>

                    <a href="/petugas-hasil-insinerasi"
                       class="{{ request()->is('petugas-hasil-insinerasi') || request()->is('add-hasil-insinerasi') ? 'active' : '' }}">
                        <i class="fa-solid fa-recycle"></i>
                        Data Hasil Insinerasi
                    </a>

                </div>

            </li>

        </ul>

    </aside>

    <!-- /* CONTENT */ -->
    <main class="content">
        @yield('content')
    </main>

</div>

<!-- /* SCRIPT SIDEBAR */ -->
<script>

/* SIDEBAR LINK */

const sidebarLinks = document.querySelectorAll('.sidebar a');
const submenuToggles = document.querySelectorAll('.submenu-toggle');

/* ACTIVE MENU */

sidebarLinks.forEach(function(link) {

    link.addEventListener('click', function() {

        sidebarLinks.forEach(function(item) {
            item.classList.remove('active');
        });

        submenuToggles.forEach(function(item) {
            item.classList.remove('active');
        });

        this.classList.add('active');

        const parent = this.closest('.has-submenu');

        if (parent) {
            const toggle = parent.querySelector('.submenu-toggle');

            parent.classList.add('open');
            toggle.classList.add('active');
        }

    });

});

/* TOGGLE SUBMENU */

submenuToggles.forEach(function(button) {

    button.addEventListener('click', function() {

        sidebarLinks.forEach(function(item) {
            item.classList.remove('active');
        });

        submenuToggles.forEach(function(item) {
            item.classList.remove('active');
        });

        const parent = this.closest('.has-submenu');

        parent.classList.toggle('open');
        this.classList.add('active');

    });

});

</script>

</body>
</html>