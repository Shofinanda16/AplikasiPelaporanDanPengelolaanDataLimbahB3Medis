<!DOCTYPE html>
<html lang="en">

<head>
    <title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/jpeg" href="{{ asset('Logo.jpeg') }}">
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>

<body>
<div class="login-container">

    <!-- INFORMASI SISTEM -->
    <div class="info-section">

        <h1>
            Aplikasi Pelaporan dan
            Pengelolaan Limbah <br>B3 Medis</br>
        </h1>

        <div class="feature-grid">
            <div class="feature-card">
                <i class="fa-solid fa-hospital"></i>
                <h3>Data Fasyankes</h3>
                <small>Pengelolaan data fasilitas kesehatan</small>
            </div>

            <div class="feature-card">
                <i class="fa-solid fa-truck"></i>
                <h3>Limbah Masuk</h3>
                <small>Pencatatan penerimaan limbah medis</small>
            </div>

            <div class="feature-card">
                <i class="fa-solid fa-recycle"></i>
                <h3>Hasil Insinerasi</h3>
                <small>Monitoring proses pemusnahan</small>
            </div>

            <div class="feature-card">
                <i class="fa-solid fa-chart-column"></i>
                <h3>Rekapitulasi</h3>
                <small>Ringkasan data limbah</small>
            </div>

            <div class="feature-card laporan">
                <i class="fa-solid fa-file-lines"></i>
                <h3>Laporan</h3>
                <small>Cetak dan dokumentasi laporan</small>
            </div>
        </div>
    </div>

    <!-- LOGIN -->
    <div class="login-card">
        <div class="login-header">
            <img src="{{ asset('Logo.png') }}" alt="Logo" class="login-logo">
            <p>
                Silakan login menggunakan akun Anda
            </p>
        </div>

        @if(session('login_error'))
        <div class="login-alert">
            {{ session('login_error') }}
        </div>
        @endif

        <form action="/login" method="POST">
            @csrf

            <!-- USERNAME -->
            <div class="form-group">
                <label>Username</label>
                <div class="input-wrapper">
                    <i class="fa-regular fa-user"></i>
                    <input type="text" name="username" placeholder="Masukkan username">
                </div>
            </div>

            <!-- PASSWORD -->
            <div class="form-group">
                <label>Password</label>
                <div class="input-wrapper">
                    <i class="fa-solid fa-lock"></i>
                    <input type="password" name="password" placeholder="Masukkan password">
                </div>
            </div>

            <!-- ROLE -->
            <div class="form-group">
                <label>Role</label>

                <div class="select-wrapper">

                    <select name="role">

                        <option value="staf"
                            {{ old('role') == 'staf' ? 'selected' : '' }}>
                            Staf
                        </option>

                        <option value="petugas"
                            {{ old('role') == 'petugas' ? 'selected' : '' }}>
                            Petugas
                        </option>

                        <option value="manager"
                            {{ old('role') == 'manager' ? 'selected' : '' }}>
                            Manager
                        </option>

                        <option value="admin"
                            {{ old('role') == 'admin' ? 'selected' : '' }}>
                            Administrator Sistem
                        </option>

                    </select>

                    <span class="select-arrow">
                        <i class="fa-solid fa-sort-down arrow"></i>
                    </span>

                </div>

            </div>

            <!-- BUTTON LOGIN -->

            <button type="submit" class="login-btn">

                <i class="fa-solid fa-right-to-bracket"></i>

                Login

            </button>

        </form>

    </div>

</div>

</body>
</html>