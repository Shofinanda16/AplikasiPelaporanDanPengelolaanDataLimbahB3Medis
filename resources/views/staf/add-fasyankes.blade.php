@extends('layouts.staf')

@section('title', 'Tambah Data Fasyankes')
@section('page_label', 'Dashboard Staf')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/staf/add-fasyankes.css') }}">
@endpush

@section('content')

<div class="page-head">
    <div>
        <h1>Data Fasilitas Pelayanan Kesehatan</h1>
        <p>Kelola Data Fasyankes</p>
    </div>
</div>

<!-- /* FORM TAMBAH FASYANKES */ -->
<div class="form-card">
    <div class="form-title">
        <h3>
            <i class="fa-regular fa-hospital"></i>
            Tambah Data Fasyankes
        </h3>
        <p>Masukkan Informasi Data Fasyankes</p>
    </div>

    <form action="/store-fasyankes" method="POST">
        @csrf

        <!-- /* INPUT DATA FASYANKES */ -->
        <div class="form-grid">

            <!-- /* NAMA FASYANKES */ -->
            <div class="form-group">
                <label for="fasyankes">Nama Fasyankes</label>
                <input type="text" id="fasyankes" name="fasyankes" placeholder="Nama Fasyankes">
            </div>

            <!-- /* KODE LIMBAH */ -->
            <div class="form-group">
                <label for="kode_limbah">Kode Limbah</label>
                <input type="text" id="kode_limbah" name="kode_limbah" placeholder="Kode Limbah">
            </div>

            <!-- /* JENIS LIMBAH */ -->
            <div class="form-group">
                <label for="telepon">Jenis Limbah</label>
                <input type="text" id="jenis_limbah" name="jenis_limbah" placeholder="Jenis Limbah">
            </div>

            <!-- /* MANIFEST */ -->
            <div class="form-group">
                <label for="manifest">Manifest</label>
                <input type="text" id="manifest" name="manifest" placeholder="Manifest">
            </div>

        </div>

        <!-- /* TOMBOL AKSI */ -->
        <div class="form-actions">
            <button type="submit" class="save-btn">
                <i class="fa-regular fa-floppy-disk"></i>
                Simpan
            </button>

            <a href="/fasyankes" class="cancel-btn">
                <i class="fa-solid fa-xmark"></i>
                Batal
            </a>
        </div>
    </form>

</div>

@endsection