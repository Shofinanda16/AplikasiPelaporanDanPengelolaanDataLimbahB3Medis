<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Administrator Sistem')</title>
    <link rel="icon" type="image/jpeg" href="{{ asset('Logo.jpeg') }}">
    <!-- /* BOOTSTRAP */ -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- /* FONT AWESOME */ -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <!-- /* CSS LAYOUT */ -->
    <link rel="stylesheet" href="{{ asset('css/layouts/admin.css') }}">

    <!-- /* SWEETALERT */ -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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
                <a href="/dashboard-admin"
                   class="{{ request()->is('dashboard-admin') ? 'active' : '' }}">
                    <i class="fa-solid fa-border-all"></i>
                    Dashboard
                </a>
            </li>

            <li>
                <a href="/kelolauser"
                   class="{{ request()->is('kelolauser') || request()->is('add-user') || request()->is('edit-user/*') ? 'active' : '' }}">
                    <i class="fa-solid fa-users"></i>
                    Kelola User
                </a>
            </li>
        </ul>
    </aside>

    <!-- /* CONTENT */ -->
    <main class="content">
        @yield('content')
    </main>

</div>

<!-- /* SCRIPT SIDEBAR ACTIVE */ -->

<script>
const sidebarLinks = document.querySelectorAll('.sidebar a');

sidebarLinks.forEach(function(link) {

    link.addEventListener('click', function() {

        sidebarLinks.forEach(function(item) {
            item.classList.remove('active');
        });

        this.classList.add('active');

    });

});

</script>

</body>
</html>