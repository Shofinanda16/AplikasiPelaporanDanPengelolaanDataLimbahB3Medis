@extends('layouts.admin')

@section('title', 'Dashboard Administrator Sistem')
@section('page_label', 'Dashboard Administrator Sistem')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/admin/dashboard.css') }}">
@endpush

@section('content')

<div class="dashboard-page">

    <!-- /* HEADER */ -->

    <div class="page-head">
        <h1>Selamat bekerja, {{ Auth::user()->nama }}</h1>
        <p>Manajemen user</p>
    </div>

    <div class="stats-grid">

        <!-- /* TOTAL USER */ -->

        <div class="stats-card">
            <div class="card-top">
                <h4>Total User</h4>

                <div class="card-icon">
                    <i class="fa-solid fa-users"></i>
                </div>
            </div>

            <h2>{{ $totalUser }}</h2>
            <span>pengguna aktif</span>
        </div>

        <!-- /* TOTAL STAF */ -->

        <div class="stats-card">
            <div class="card-top">
                <h4>Total Staf</h4>

                <div class="card-icon">
                    <i class="fa-solid fa-user"></i>
                </div>
            </div>

            <h2>{{ $totalStaf }}</h2>
            <span>staf members</span>
        </div>

        <!-- /* TOTAL PETUGAS */ -->

        <div class="stats-card">
            <div class="card-top">
                <h4>Total Petugas</h4>

                <div class="card-icon">
                    <i class="fa-solid fa-user"></i>
                </div>
            </div>

            <h2>{{ $totalPetugas }}</h2>
            <span>petugas aktif</span>
        </div>

        <!-- /* TOTAL MANAGER */ -->

        <div class="stats-card">
            <div class="card-top">
                <h4>Total Manager</h4>

                <div class="card-icon">
                    <i class="fa-solid fa-user"></i>
                </div>
            </div>

            <h2>{{ $totalManager }}</h2>
            <span>manager</span>
        </div>

    </div>

</div>

<!-- /* PANDUAN PENGGUNAAN */ -->

<div class="guide-card">

    <div class="guide-header">
        <i class="fa-solid fa-circle-info"></i>
        <h3>Panduan Penggunaan Aplikasi</h3>
    </div>

    <p class="guide-desc">
        Ikuti langkah berikut untuk melakukan pengelolaan limbah B3 medis dengan benar.
    </p>

    <div class="guide-steps">

        <div class="guide-item">
            <div class="step-number">1</div>

            <div>
                <h4>Kelola Data Pengguna</h4>
                <p>
                    Tambahkan data user pada menu Kelola User. Administrator Sistem juga dapat mengedit atau menghapus
                    data user yang telah tersimpan pada tombol Aksi data.
                </p>
            </div>
        </div>

        <div class="guide-item">
            <div class="step-number">2</div>

            <div>
                <h4>Atur Hak Akses Pengguna</h4>

                <p>
                    Tentukan role user sesuai dengan tugas dan tanggung jawabnya untuk
                    mengakses fitur aplikasi.
                </p>
            </div>
        </div>

    </div>

</div>

@endsection