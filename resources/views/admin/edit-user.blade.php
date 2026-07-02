@extends('layouts.admin')

@section('title', 'Edit User')
@section('page_label', 'Dashboard Administrator Sistem')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/admin/add-user.css') }}">
@endpush

@section('content')

<!-- /* HEADER HALAMAN */ -->

<div class="page-head">
    <div>
        <h1>Edit User</h1>
        <p>Perbarui informasi pengguna sistem</p>
    </div>
</div>

<!-- /* FORM EDIT USER */ -->

<div class="form-card">

    <div class="form-title">
        <h3>
            <i class="fas fa-user-edit"></i>
            Edit User
        </h3>
        <p>Perbarui informasi pengguna sistem</p>
    </div>

    <form action="/update-user/{{ $user->id_user }}" method="POST">
        @csrf
        @method('PUT')

        <!-- /* DATA USER */ -->

        <div class="form-grid">

            <div class="form-group">
                <label>Nama</label>
                <input type="text" name="nama" value="{{ $user->nama }}" required>
            </div>

            <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" value="{{ $user->username }}" required>
            </div>

            <div class="form-group">
                <label>Password</label>
                <input type="text" name="password" value="{{ $user->password }}" required>
            </div>

            <div class="form-group">
                <label>Role</label>

                <select name="role">

                    <option value="staf" {{ $user->role == 'staf' ? 'selected' : '' }}>
                        Staf
                    </option>

                    <option value="petugas" {{ $user->role == 'petugas' ? 'selected' : '' }}>
                        Petugas
                    </option>

                    <option value="manager" {{ $user->role == 'manager' ? 'selected' : '' }}>
                        Manager
                    </option>

                    <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>
                        Administrator
                    </option>

                </select>
            </div>

        </div>

        <!-- /* TOMBOL AKSI */ -->

        <div class="form-actions">

            <button type="submit" class="save-btn">
                <i class="fas fa-save"></i>
                Simpan Perubahan
            </button>

            <a href="/kelolauser" class="cancel-btn">
                <i class="fas fa-times"></i>
                Batal
            </a>

        </div>

    </form>

</div>

@endsection