@extends('layouts.admin')

@section('title', 'Tambah User')
@section('page_label', 'Dashboard Administrator Sistem')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/admin/add-user.css') }}">
@endpush

@section('content')

<!-- /* HEADER HALAMAN */ -->

<div class="page-head">
    <div>
        <h1>Tambah User</h1>
        <p>Masukkan informasi pengguna baru</p>
    </div>
</div>

<!-- /* FORM TAMBAH USER */ -->

<div class="form-card">

    <div class="form-title">
        <h3>
            <i class="fa-solid fa-user-plus"></i>
            Tambah User Baru
        </h3>
        <p>Masukkan informasi pengguna baru</p>
    </div>

    <form action="/store-user" method="POST">
        @csrf

        <!-- /* DATA USER */ -->

        <div class="form-grid">

            <div class="form-group">
                <label>Nama</label>
                <input type="text" name="nama" placeholder="Nama lengkap">
            </div>

            <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" placeholder="Username">
            </div>

            <div class="form-group">
                <label>Password</label>
                <input type="text" name="password" placeholder="Password">
            </div>

            <div class="form-group">
                <label>Role</label>

                <select name="role">
                    <option value="staf">Staf</option>
                    <option value="petugas">Petugas</option>
                    <option value="manager">Manager</option>
                    <option value="admin">Administrator Sistem</option>
                </select>
            </div>

        </div>

        <!-- /* TOMBOL AKSI */ -->

        <div class="form-actions">

            <button type="submit" class="save-btn">
                <i class="fas fa-save"></i>
                Simpan
            </button>

            <a href="/kelolauser" class="cancel-btn">
                <i class="fas fa-times"></i>
                Batal
            </a>

        </div>

    </form>

</div>

@endsection