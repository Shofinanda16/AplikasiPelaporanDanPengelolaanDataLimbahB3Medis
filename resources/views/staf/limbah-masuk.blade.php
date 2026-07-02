@extends('layouts.staf')

@section('title', 'Data Limbah Masuk')
@section('page_label', 'Dashboard Staf')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/staf/limbah-masuk.css') }}">
@endpush

@section('content')

<div class="limbah-page">

    <!-- TOAST SUCCESS -->
    @if(session('success'))
        <div class="toast-popup">
            <i class="fa-solid fa-circle-check"></i>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    <!-- TOAST ERROR -->
    @if(session('error'))
        <div class="toast-popup error">
            <i class="fa-solid fa-circle-xmark"></i>
            <span>{{ session('error') }}</span>
        </div>
    @endif

    <div class="page-content">
        <div class="page-header">
            <div>
                <h1>Data Limbah Masuk</h1>
                <p>Kelola data limbah B3 medis</p>
            </div>
            <a href="/add-limbah-masuk" class="btn-primary"> + Tambah Data Limbah </a>
        </div>

        <!-- CARD TABEL -->
        <div class="card">
            <div class="card-head">
                <div>
                    <h3>Daftar Data Limbah Masuk</h3>
                    <p>Total {{ $limbahMasuk->count() }} data tercatat</p>
                </div>

                <!-- SEARCH -->
                <div class="search-box">
                    <i class="fa-solid fa-magnifying-glass"></i>
                    <input type="text" id="searchInput" placeholder="Cari data limbah...">
                </div>
            </div>

            <div class="table-wrap">
                <!-- TOTAL LIMBAH -->
                @php
                $totalLimbah = $limbahMasuk->sum(function($item){
                    return $item->jumlah_limbah;
                });
                @endphp

                <table id="dataTable">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tanggal<br>Angkut</th>
                            <th>Tanggal<br>Terima</th>
                            <th>Tanggal Batas<br>Simpan</th>
                            <th>Kode<br>Cust</th>
                            <th>No<br>Polisi</th>
                            <th>Driver</th>
                            <th>Nama<br>Fasyankes</th>
                            <th>Kode<br>Limbah</th>
                            <th>Jenis<br>Limbah</th>
                            <th>Manifest</th>
                            <th>Kemasan</th>
                            <th>Satuan</th>
                            <th>Jumlah<br>Limbah</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>

                        <!-- DATA LIMBAH -->
                        @foreach($limbahMasuk as $item)

                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                {{ \Carbon\Carbon::parse($item->tanggal_pengangkutan)->format('d-m-Y') }}
                            </td>
 
                            <td>
                                {{ \Carbon\Carbon::parse($item->tanggal_penerimaan)->format('d-m-Y') }}
                            </td>

                            <td>
                                {{ \Carbon\Carbon::parse($item->tanggal_batas_penyimpanan)->format('d-m-Y') }}
                            </td>

                            <td>{{ $item->kode_cust }}</td>
                            <td>{{ $item->no_polisi }}</td>
                            <td>{{ $item->driver }}</td>
                            <td>
                                {{ $item->fasyankes->fasyankes ?? '-' }}
                            </td>

                            <td>
                                {{ $item->fasyankes->kode_limbah ?? '-' }}
                            </td>

                            <td>
                                {{ $item->fasyankes->jenis_limbah ?? '-' }}
                            </td>

                            <td>
                                {{ $item->fasyankes->manifest ?? '-' }}
                            </td>

                            <td>{{ $item->kemasan }}</td>
                            <td>{{ $item->satuan }}</td>

                            <td>
                                {{ number_format($item->jumlah_limbah, 2, ',', '.') }}
                            </td>

                            <!-- STATUS -->
                            <td>
                                <span class="status-badge {{ $item->status }}">
                                    {{ ucfirst($item->status) }}
                                </span>
                            </td>

                            <!-- AKSI -->
                            <td>
                                <div class="actions">
                                    <!-- EDIT -->
                                    <a href="/edit-limbah-masuk/{{ $item->id_limbah_medis }}" class="btn-action">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>

                                    <!-- DELETE -->
                                    <form
                                        action="/delete-limbah-masuk/{{ $item->id_limbah_medis }}" method="POST" class="delete-form">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" class="btn-action delete">
                                            <i class="fa-solid fa-trash-can"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>

                        @endforeach

                        <!-- DATA KOSONG -->
                        @if($limbahMasuk->isEmpty())
                        <tr>
                            <td colspan="16">
                                Belum ada data limbah masuk
                            </td>
                        </tr>

                        @else
                        <!-- TOTAL -->
                        <tr class="total-row">
                            <td colspan="11" class="total-label">
                                Total
                            </td>

                            <td>
                                <strong>
                                    {{ number_format($limbahMasuk->sum('kemasan'), 0, ',', '.') }}
                                </strong>
                            </td>

                            <td>
                                <strong>
                                    {{ $limbahMasuk->last()->satuan ?? '-' }}
                                </strong>
                            </td>

                            <td class="jumlah-total">
                                <strong>
                                    {{ number_format($totalLimbah, 2, ',', '.') }} Kg
                                </strong>
                            </td>

                            <td colspan="2"></td>
                        </tr>

                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- SCRIPT -->

<script>

/* SEARCH DATA LIMBAH */

const searchInput =
document.getElementById('searchInput');

const dataTable =
document.getElementById('dataTable');

searchInput.addEventListener('keyup', function () {

    const keyword =
    this.value.toLowerCase();

    const rows =
    dataTable.querySelectorAll(
        'tbody tr:not(.total-row)'
    );

    rows.forEach(row => {

        const text =
        row.innerText.toLowerCase();

        row.style.display =
        text.includes(keyword)
        ? ''
        : 'none';

    });

});


/* DELETE DATA LIMBAH */

document
.querySelectorAll('.delete-form')
.forEach(form => {

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