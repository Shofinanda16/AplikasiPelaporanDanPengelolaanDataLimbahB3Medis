@extends('layouts.admin')

@section('title', 'Kelola User')
@section('page_label', 'Dashboard Administrator Sistem')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/admin/kelola-user.css') }}">
@endpush

@section('content')

<!-- /* TOAST SUCCESS */ -->

@if(session('success'))
<div class="toast-popup">
    <i class="fa-solid fa-circle-check"></i>
    <span>{{ session('success') }}</span>
</div>
@endif

<!-- /* TOAST ERROR */ -->

@if(session('error'))
<div class="toast-popup error">
    <i class="fa-solid fa-circle-xmark"></i>
    <span>{{ session('error') }}</span>
</div>
@endif

<!-- /* HEADER HALAMAN */ -->

<div class="page-head">

    <div>
        <h1>Kelola User</h1>
        <p>Manajemen pengguna sistem</p>
    </div>

    <a href="/add-user" class="add-btn">
        <i class="fa-solid fa-plus"></i>
        Tambah User
    </a>

</div>

<!-- /* TABEL USER */ -->

<div class="table-card">

    <div class="table-top">

        <div>
            <h3>Daftar User Sistem</h3>
            <p>Total {{ $users->count() }} pengguna</p>
        </div>

        <!-- /* SEARCH USER */ -->

        <div class="search-box">
            <i class="fa-solid fa-magnifying-glass"></i>
            <input type="text" id="searchInput" placeholder="Cari user...">
        </div>

    </div>

    <div class="table-responsive">

        <table id="userTable">

            <!-- /* HEADER TABEL */ -->

            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Username</th>
                    <th>Password</th>
                    <th>Role</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <!-- /* DATA USER */ -->

            <tbody>
            @forelse($users as $user)
                <tr>

                    <td>{{ $loop->iteration }}</td>

                    <td class="text-left">{{ $user->nama }}</td>

                    <td>{{ $user->username }}</td>

                    <td>
                        <span class="password-mask">••••••••</span>
                    </td>

                    <td>

                        <span class="role-badge
                            @if($user->role == 'admin') admin @endif
                            @if($user->role == 'staf') staf @endif
                            @if($user->role == 'manager') manager @endif
                            @if($user->role == 'petugas') petugas @endif">

                            @if($user->role == 'admin')
                                Administrator
                            @else
                                {{ ucfirst($user->role) }}
                            @endif

                        </span>

                    </td>

                    <!-- /* AKSI USER */ -->

                    <td>

                        <div class="action-group">
 
                            <a href="/edit-user/{{ $user->id_user }}" class="action-btn">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </a>

                            <form action="/delete-user/{{ $user->id_user }}" method="POST" class="delete-form">
                                @csrf
                                @method('DELETE')

                                <button type="submit" class="action-btn delete">
                                    <i class="fa-solid fa-trash-can"></i>
                                </button>
                            </form>

                        </div>

                    </td>

                </tr>

            @empty

                <!-- /* DATA KOSONG */ -->

                <tr>
                    <td colspan="6" class="empty-state">
                        <i class="fa-solid fa-users"></i>
                        <p>Belum ada data user</p>
                    </td>
                </tr>

            @endforelse

            </tbody>

        </table>

    </div>

</div>

<!-- /* SWEETALERT */ -->

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>

/* SEARCH USER */

const searchInput = document.getElementById('searchInput');
const userTable = document.getElementById('userTable');

searchInput.addEventListener('keyup', function () {

    const keyword = this.value.toLowerCase();
    const rows = userTable.querySelectorAll('tbody tr');

    rows.forEach(row => {
        const text = row.innerText.toLowerCase();
        row.style.display = text.includes(keyword) ? '' : 'none';
    });

});

/* DELETE USER */

document.querySelectorAll('.delete-form').forEach(form => {

    form.addEventListener('submit', function(e) {

        e.preventDefault();

        Swal.fire({
            title: 'Hapus User?',
            text: 'User yang dihapus tidak dapat dikembalikan.',
            icon: 'warning',
            width: '360px',
            showCancelButton: true,
            confirmButtonText: 'Hapus',
            cancelButtonText: 'Batal',
            reverseButtons: true,

            customClass: {
                popup: 'swal-custom',
                title: 'swal-title',
                htmlContainer: 'swal-text',
                confirmButton: 'swal-delete-btn',
                cancelButton: 'swal-cancel-btn'
            },

            buttonsStyling: false

        }).then((result) => {

            if (result.isConfirmed) {
                form.submit();
            }

        });

    });

});

</script>

@endsection