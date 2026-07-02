@extends('layouts.manager')

@section('title', 'Dashboard Manager')
@section('page_label', 'Dashboard Manager')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/manager/dashboard.css') }}">
@endpush

@section('content')

<div class="dashboard-page">

    <!-- /* HEADER */ -->
    <div class="page-head">
        <div>
            <h1>Selamat bekerja, {{ Auth::user()->nama ?? 'Manager' }}</h1>
            <p>Ringkasan monitoring limbah B3 medis</p>
        </div>
    </div>

    <div class="stats-grid">
        <!-- /* TOTAL LIMBAH MASUK */ -->
        <div class="stats-card">
            <div class="card-top">
                <b>Total Limbah Masuk</b>

                <div class="card-icon">
                    <i class="fa-solid fa-square-plus"></i>
                </div>
            </div>

            <h2>{{ number_format($totalLimbahMasuk, 0, ',', '.') }} kg</h2>
            <span>limbah diterima</span>
        </div>

        <!-- /* TOTAL HASIL INSINERASI */ -->
        <div class="stats-card">
            <div class="card-top">
                <b>Total Hasil Insinerasi</b>

                <div class="card-icon">
                    <i class="fa-solid fa-recycle"></i>
                </div>
            </div>

            <h2>{{ number_format($totalLimbahKeluar, 0, ',', '.') }} kg</h2>
            <span>limbah dimusnahkan</span>
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

    <!-- /* LANGKAH PANDUAN */ -->

    <div class="guide-steps">

        <div class="guide-item">
            <div class="step-number">1</div>
            <div>
                <h4>Filter Rekapitulasi</h4>
                <p>
                    Pada menu Rekapitulasi, pilih fasyankes dan jenis data limbah untuk menampilkan
                    ringkasan data Limbah Masuk atau Hasil Insinerasi sesuai fasyankes yang dipilih.
                </p>
            </div>
        </div>

        <div class="guide-item">
            <div class="step-number">2</div>
            <div>
                <h4>Laporan</h4>
                <p>
                    Pilih bulan dan jenis data limbah pada menu Laporan untuk menampilkan preview laporan.
                    Laporan yang telah dibuat dapat di download sebagai dokumen pelaporan.
                </p>
            </div>
        </div>

    </div>

</div>

@endsection