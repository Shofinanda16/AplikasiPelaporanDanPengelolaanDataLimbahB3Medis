@extends('layouts.staf')

@section('title', 'Data Fasyankes')
@section('page_label', 'Data Fasyankes')

@section('content')

<link rel="stylesheet" href="{{ asset('css/staf/fasyankes.css') }}">

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

<div class="page-head">
    <div>
        <h1>Data Fasilitas Pelayanan Kesehatan</h1>
        <p>Kelola Data Fasyankes</p>
    </div>

    <a href="/add-fasyankes" class="add-btn">
        <i class="fa-solid fa-plus"></i>
        Tambah Fasyankes
    </a>
</div>

<!-- /* TABEL FASYANKES */ -->
<div class="table-card">
    <div class="table-top">
        <div>
            <h3>Daftar Data Fasyankes</h3>
            <p>Total {{ $fasyankes->count() }} data fasyankes</p>
        </div>

        <div class="search-box">
            <i class="fa-solid fa-magnifying-glass"></i>
            <input type="text" id="searchInput" placeholder="Cari fasyankes...">
        </div>
    </div>

    <div class="table-responsive">
        <table id="dataTable">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Fasyankes</th>
                    <th>Kode Limbah</th>
                    <th>Jenis Limbah</th>
                    <th>Manifest</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
                <!-- /* DATA FASYANKES */ -->
                @foreach($fasyankes as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->fasyankes }}</td>
                    <td>{{ $item->kode_limbah }}</td>
                    <td>{{ $item->jenis_limbah }}</td>
                    <td>{{ $item->manifest }}</td>
                    <td>
                        <div class="action-group">
                            <a href="/edit-fasyankes/{{ $item->id_data_fasyankes }}" class="action-btn">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </a>

                            <form action="/delete-fasyankes/{{ $item->id_data_fasyankes }}" method="POST" class="delete-form">
                                @csrf
                                @method('DELETE')

                                <button type="submit" class="action-btn delete">
                                    <i class="fa-solid fa-trash-can"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>

                @endforeach
                <!-- /* DATA KOSONG */ -->
                @if($fasyankes->isEmpty())
                <tr>
                    <td colspan="5">
                        Belum ada data fasyankes
                    </td>
                </tr>

                @endif
            </tbody>
        </table>
    </div>
</div>

<script>

/* SEARCH FASYANKES */

const searchInput = document.getElementById('searchInput'),
      dataTable = document.getElementById('dataTable');

searchInput.addEventListener('keyup', function () {

    const keyword = this.value.toLowerCase(),
          rows = dataTable.querySelectorAll('tbody tr');

    rows.forEach(row => {

        const text = row.innerText.toLowerCase();

        row.style.display =
            text.includes(keyword)
            ? ''
            : 'none';

    });

});

/* DELETE FASYANKES */

document.querySelectorAll('.delete-form').forEach(form => {

    form.addEventListener('submit', function(e) {

        e.preventDefault();

        Swal.fire({

            title: 'Hapus Data?',
            text: 'Data yang dihapus tidak dapat dikembalikan.',
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