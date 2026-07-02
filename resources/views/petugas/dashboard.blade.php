@extends('layouts.petugas')

@section('title', 'Dashboard Petugas')
@section('page_label', 'Dashboard Petugas')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/petugas/dashboard.css') }}">
@endpush

@section('content')

<div class="page-head">
    <div>
        <h1>Selamat bekerja, {{ Auth::user()->nama ?? 'Petugas' }}</h1>
        <p>Ringkasan Pengelolaan dan Insinerasi Limbah B3 Medis</p>
    </div>
</div>

<div class="summary-grid">

    <!-- /* LIMBAH MASUK */ -->
    <div class="summary-card">
        <div class="card-top">
            <b>Limbah Masuk</b>
            <i class="fa-solid fa-folder-plus"></i>
        </div>
        <h2>{{ $limbahMasuk }}</h2>
        <p>data tercatat</p>

    </div>

    <!-- /* HASIL INSINERASI */ -->
    <div class="summary-card">
        <div class="card-top">
            <b>Hasil Insinerasi</b>
            <i class="fa-solid fa-recycle"></i>
        </div>
        <h2>{{ $hasilInsinerasi }}</h2>
        <p>data tercatat</p>
    </div>

    <!-- /* LIMBAH DISIMPAN */ -->
    <div class="summary-card">
        <div class="card-top">
            <b>Limbah Disimpan</b>
            <i class="fa-regular fa-calendar"></i>
        </div>
        <h2>{{ $limbahDisimpan }}</h2>
        <p>data tercatat</p>
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
        <!-- /* LANGKAH 1 */ -->
        <div class="guide-item">
            <div class="step-number">1</div>
            <div>
                <h4>Informasi Data Limbah Masuk</h4>
                <p>
                    Lihat informasi limbah yang telah diinput oleh staf pada menu Data Limbah Masuk.
                    Meliputi tanggal pengelolaan limbah, data fasyankes, dan data limbah.
                </p>
            </div>
        </div>

        <!-- /* LANGKAH 2 */ -->
        <div class="guide-item">
            <div class="step-number">2</div>
            <div>
                <h4>Verifikasi Data Limbah Masuk</h4>
                <p>
                    Periksa kesesuaian limbah yang diterima dari transporter dengan data limbah pada menu Data Limbah Masuk.
                    Jika telah sesuai, validasi status menjadi <strong>Diterima</strong> melalui dropdown pada kolom status.
                </p>
            </div>
        </div>

        <!-- /* LANGKAH 3 */ -->
        <div class="guide-item">
            <div class="step-number">3</div>
            <div>
                <h4>Penyimpanan Limbah</h4>
                <p>
                    Jika limbah belum memasuki tahap insinerasi, validasi status limbah menjadi
                    <strong>Disimpan</strong> melalui dropdown pada kolom status.
                </p>
            </div>
        </div>

        <!-- /* LANGKAH 4 */ -->

        <div class="guide-item">
            <div class="step-number">4</div>
            <div>
                <h4>Proses Insinerasi</h4>
                <p>
                    Setelah limbah selesai dimusnahkan melalui proses insinerasi, validasi status menjadi
                    <strong>Dimusnahkan</strong> agar data otomatis tercatat pada Data Hasil Insinerasi.
                </p>
            </div>
        </div>

    </div>
</div>

@endsection