@extends('layouts.petugas')

@section('title', 'Data Limbah Masuk')
@section('page_label', 'Dashboard Petugas')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/petugas/limbah-masuk.css') }}">
@endpush

@section('content')

<div class="limbah-page">
    <!-- /* TOAST SUCCESS */ -->
    @if(session('success'))
    <div class="toast-popup" id="toastPopup">
        <i class="fa-solid fa-circle-check"></i>
        <span>{{ session('success') }}</span>
    </div>
    @endif

    <!-- /* TOAST ERROR */ -->
    @if(session('error'))
    <div class="toast-popup" id="toastPopup">
        <i class="fa-solid fa-circle-xmark"></i>
        <span>{{ session('error') }}</span>
    </div>
    @endif

    <!-- /* HEADER */ -->
    <div class="page-header">
        <div>
            <h1>Data Limbah Masuk</h1>
            <p>Validasi status data limbah B3 medis yang masuk</p>
        </div>
    </div>

    <!-- /* CARD TABEL */ -->
    <div class="card">
        <div class="card-head">
            <div>
                <h3>Daftar Data Limbah Masuk</h3>
                <p>Total {{ $limbahMasuk->count() }} data tercatat</p>
            </div>

            <!-- /* SEARCH */ -->
            <div class="search-box">
                <i class="fa-solid fa-magnifying-glass"></i>
                <input type="text" id="searchInput" placeholder="Cari data limbah">
            </div>
        </div>

        <div class="table-wrap">
            <!-- /* TOTAL LIMBAH */ -->
            @php
            $totalLimbah = $limbahMasuk->sum(function($item){
                return $item->jumlah_limbah;
            });
            @endphp

            <table id="dataTable">
                <!-- /* HEADER TABEL */ -->
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
                    </tr>
                </thead>

                <!-- /* DATA LIMBAH */ -->
                <tbody>
                    @foreach($limbahMasuk as $item)
 
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ \Carbon\Carbon::parse($item->tanggal_pengangkutan)->format('d-m-Y') }}</td>
                        <td>{{ \Carbon\Carbon::parse($item->tanggal_penerimaan)->format('d-m-Y') }}</td>
                        <td>{{ \Carbon\Carbon::parse($item->tanggal_batas_penyimpanan)->format('d-m-Y') }}</td>
                        <td>{{ $item->kode_cust }}</td>
                        <td>{{ $item->no_polisi }}</td>
                        <td>{{ $item->driver }}</td>
                        <td>{{ $item->fasyankes->fasyankes ?? '-' }}</td>
                        <td>{{ $item->fasyankes->kode_limbah ?? '-' }}</td>
                        <td>{{ $item->fasyankes->jenis_limbah ?? '-' }}</td>
                        <td>{{ $item->fasyankes->manifest ?? '-' }}</td>
                        <td>{{ $item->kemasan }}</td>
                        <td>{{ $item->satuan }}</td>
                        <td>{{ number_format($item->jumlah_limbah, 2, ',', '.') }}</td>

                        <!-- /* STATUS LIMBAH */ -->

                        <td>
                            <form action="/update-status-limbah/{{ $item->id_limbah_medis }}" method="POST">
                                @csrf
                                @method('PUT')

                                <select name="status" class="status-select {{ strtolower($item->status) }}">
                                    <option value="pending"
                                        disabled
                                        {{ $item->status == 'pending' ? 'selected' : '' }}>
                                        Pending
                                    </option>

                                    <option value="diterima"
                                        {{ $item->status == 'diterima' ? 'selected' : '' }}>
                                        Diterima
                                    </option>

                                    <option value="disimpan"
                                        {{ $item->status == 'disimpan' ? 'selected' : '' }}>
                                        Disimpan
                                    </option>

                                    <option value="dimusnahkan"
                                        {{ $item->status == 'dimusnahkan' ? 'selected' : '' }}>
                                        Dimusnahkan
                                    </option>
                                </select>
                            </form>
                        </td>
                    </tr>

                    @endforeach
                    <!-- /* DATA KOSONG */ -->

                    @if($limbahMasuk->isEmpty())

                    <tr>
                        <td colspan="15">Belum ada data limbah masuk</td>
                    </tr>

                    @else

                    <!-- /* TOTAL DATA */ -->
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

                        <td>
                            <strong>
                                {{ number_format($totalLimbah, 2, ',', '.') }} Kg
                            </strong>
                        </td>

                        <td></td>
                    </tr>

                    @endif

                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- /* SCRIPT STATUS */ -->

<script>

/* STATUS COLOR */

document.querySelectorAll('.status-select').forEach(function(select) {

    function updateStatusColor(el) {

        el.classList.remove(
            'pending',
            'diterima',
            'disimpan',
            'dimusnahkan'
        );

        el.classList.add(el.value);

    }

    updateStatusColor(select);

    select.addEventListener('change', function() {

        updateStatusColor(this);

        setTimeout(() => {
            this.form.submit();
        }, 150);

    });

});

/* TOAST AUTO HIDE */

setTimeout(() => {

    const toast = document.getElementById('toastPopup');

    if (toast) {

        toast.classList.add('hide');

        setTimeout(() => {
            toast.remove();
        }, 350);

    }

}, 1800);

/* SEARCH DATA */

const searchInput = document.getElementById('searchInput');
const dataTable = document.getElementById('dataTable');

searchInput.addEventListener('keyup', function () {

    const keyword = this.value.toLowerCase();
    const rows = dataTable.querySelectorAll('tbody tr:not(.total-row)');

    rows.forEach(row => {

        const text = row.innerText.toLowerCase();
        row.style.display = text.includes(keyword) ? '' : 'none';

    });

});

</script>

@endsection