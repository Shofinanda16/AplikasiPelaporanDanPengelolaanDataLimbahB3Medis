@extends('layouts.staf')

@section('title', 'Dashboard Staf')
@section('page_label', 'Dashboard Staf')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/staf/dashboard-staf.css') }}">
@endpush

@section('content')

<div class="page-title">
    <h1>Selamat bekerja, {{ auth()->user()->nama }}</h1>
    <p>Ringkasan Data Limbah B3 Medis</p>

</div>

<div class="summary-grid">

    <!-- /* TOTAL DATA LIMBAH */ -->
    <div class="summary-card">
        <div class="card-header">
            <b>Total Data Limbah</b>
            <i class="fa-solid fa-clipboard-list"></i>
        </div>
        <h2 class="blue">{{ $totalDataLimbah }}</h2>
        <p>data tercatat</p>
    </div>

    <!-- /* DATA FASYANKES */ -->
    <div class="summary-card">
        <div class="card-header">
            <b>Data Fasyankes</b>
            <i class="fa-solid fa-hospital"></i>
        </div>
        <h2 class="blue">{{ $totalFasyankes }}</h2>
        <p>data tercatat</p>
    </div>

    <!-- /* LIMBAH MASUK */ -->
    <div class="summary-card">
        <div class="card-header">
            <b>Limbah Masuk</b>
            <i class="fa-solid fa-folder-plus"></i>
        </div>
        <h2 class="blue">{{ $limbahMasuk }}</h2>
        <p>data tercatat</p>
    </div>

    <!-- /* HASIL INSINERASI */ -->
    <div class="summary-card">
        <div class="card-header">
            <b>Hasil Insinerasi</b>
            <i class="fa-solid fa-recycle"></i>
        </div>
        <h2 class="blue">{{ $hasilInsinerasi }}</h2>
        <p>data tercatat</p>
    </div>
</div>

<!-- /* PANDUAN PENGGUNAAN */ -->
<div class="guide-card">
    <div class="guide-header">
        <i class="fa-solid fa-circle-info"></i>
        <h3>Panduan Penggunaan Aplikasi</h3>
    </div>

    <p class="guide-desc">Ikuti langkah berikut untuk melakukan pengelolaan limbah B3 medis dengan benar</p>
    <div class="guide-steps">

        <div class="guide-item">
            <div class="step-number">1</div>
            <div>
                <h4>Kelola Data Fasyankes</h4>
                <p>
                    Tambahkan data fasyankes pada menu Data Fasyankes.
                    Staf juga dapat mengedit atau menghapus data fasyankes
                    yang telah tersimpan pada tombol Aksi data.
                </p>
            </div>
        </div>

        <div class="guide-item">
            <div class="step-number">2</div>
            <div>
                <h4>Kelola Data Limbah Masuk</h4>
                <p>
                    Tambahkan data limbah masuk pada menu Data Limbah Masuk.
                    Staf juga dapat mengedit atau menghapus data limbah masuk
                    yang telah tersimpan pada tombol Aksi data.
                </p>
            </div>
        </div>

        <div class="guide-item">
            <div class="step-number">3</div>
            <div>
                <h4>Monitoring Status Limbah</h4>
                <p>
                    Monitoring status limbah pada menu Data Limbah Masuk,
                    status limbah akan divalidasi oleh petugas menjadi
                    Diterima, Disimpan atau Dimusnahkan sesuai proses
                    pengelolaan limbah.
                </p>
            </div>
        </div>

        <div class="guide-item">
            <div class="step-number">4</div>
            <div>
                <h4>Hasil Insinerasi</h4>
                <p>
                    Lihat informasi limbah yang telah dimusnahkan pada menu
                    Data Hasil Insinerasi. Data yang ditampilkan merupakan
                    limbah yang telah divalidasi oleh petugas dengan status
                    Dimusnahkan.
                </p>
            </div>
        </div>

        <div class="guide-item">
            <div class="step-number">5</div>
            <div>
                <h4>Laporan</h4>
                <p>
                    Pilih bulan dan jenis data limbah pada menu Laporan
                    untuk menampilkan preview laporan. Laporan yang telah
                    dibuat dapat di download sebagai dokumen pelaporan.
                </p>
            </div>
        </div>
    </div>

</div>

@endsection