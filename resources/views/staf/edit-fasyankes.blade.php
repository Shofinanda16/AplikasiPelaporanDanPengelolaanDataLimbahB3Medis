@extends('layouts.staf')

@section('title', 'Edit Data Fasyankes')
@section('page_label', 'Dashboard Staf')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/staf/add-fasyankes.css') }}">
@endpush

@section('content')

<div class="page-head">
    <div>
        <h1>Data Fasilitas Pelayanan Kesehatan</h1>
        <p>Edit Data Fasyankes</p>
    </div>
</div>

<!-- /* FORM EDIT FASYANKES */ -->
<div class="form-card">
    <div class="form-title">
        <h3>
            <i class="fa-regular fa-hospital"></i>
            Edit Data Fasyankes
        </h3>
        <p>Perbarui informasi data fasyankes</p>
    </div>

    <form action="/update-fasyankes/{{ $fasyankes->id_data_fasyankes }}"method="POST">

        @csrf
        @method('PUT')

        <!-- /* INPUT DATA FASYANKES */ -->
        <div class="form-grid">

            <!-- /* NAMA FASYANKES */ -->
            <div class="form-group">
                <label>Nama Fasyankes</label>
                <input type="text"name="fasyankes"value="{{ $fasyankes->fasyankes }}">
            </div>

            <!-- /* KODE LIMBAH */ -->
            <div class="form-group">
                <label>Kode Limbah</label>
                <input type="text" name="kode_limbah" value="{{ $fasyankes->kode_limbah }}">
            </div>

            <!-- /* JENIS LIMBAH */ -->
            <div class="form-group">
                <label>Jenis Limbah</label>
                <input type="text" name="jenis_limbah" value="{{ $fasyankes->jenis_limbah }}">
            </div>

            <!-- /* MANIFEST */ -->
            <div class="form-group">
                <label>Manifest</label>
                <input type="text" name="manifest" value="{{ $fasyankes->manifest }}">
            </div>
        </div>

        <!-- /* TOMBOL AKSI */ -->
        <div class="form-actions">
            <button type="submit" class="save-btn">
                <i class="fa-regular fa-floppy-disk"></i>
                Simpan Perubahan
            </button>

            <a href="/fasyankes" class="cancel-btn">
                <i class="fa-solid fa-xmark"></i>
                Batal
            </a>
        </div>
    </form>
</div>

@endsection