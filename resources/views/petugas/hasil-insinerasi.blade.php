@extends('layouts.petugas')

@section('title', 'Data Hasil Insinerasi')
@section('page_label', 'Dashboard Petugas')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/petugas/hasil-insinerasi.css') }}">
@endpush

@section('content')

<div class="page-head">
    <div>
        <h1>Data Hasil Insinerasi</h1>
        <p>Data limbah B3 medis yang sudah dimusnahkan</p>
    </div>
</div>

<!-- /* TABEL HASIL INSINERASI */ -->
<div class="table-card">
    <div class="table-top">
        <div>
            <h3>Daftar Data Hasil Insinerasi</h3>
            <p>Total {{ $hasilInsinerasi->count() }} data tercatat</p>
        </div>

        <!-- /* SEARCH DATA */ -->
        <div class="search-box">
            <i class="fa-solid fa-magnifying-glass"></i>

            <input type="text" id="searchInput" placeholder="Cari data hasil insinerasi...">
        </div>
    </div>

    <div class="table-responsive">
        <!-- /* TOTAL LIMBAH */ -->
        @php
        $totalLimbah = $hasilInsinerasi->sum(function ($item) {
            return $item->limbahMasuk->jumlah_limbah ?? 0;
        });
        @endphp

        <table id="dataTable">
            <!-- /* HEADER TABEL */ -->
            <thead>
                <tr>
                    <th>No</th>
                    <th>Tanggal Pemusnahan</th>
                    <th>Fasyankes</th>
                    <th>Kode Limbah</th>
                    <th>Jenis Limbah</th>
                    <th>Jumlah Limbah</th>
                    <th>Status</th>
                </tr>
            </thead>

            <!-- /* DATA HASIL INSINERASI */ -->
            <tbody>
                @forelse($hasilInsinerasi as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td> {{ \Carbon\Carbon::parse($item->tanggal_pemusnahan)->format('d-m-Y') }} </td>
                    <td>{{ $item->fasyankes->fasyankes }}</td>
                    <td>{{ $item->fasyankes->kode_limbah }}</td>
                    <td>{{ $item->fasyankes->jenis_limbah }}</td>
                    <td>
                        <strong>
                            {{ number_format($item->limbahMasuk->jumlah_limbah ?? 0, 2, ',', '.') }}
                        </strong>
                    </td>

                    <td>
                        <span class="status-badge dimusnahkan">
                            Dimusnahkan
                        </span>
                    </td>
                </tr>

                @empty

                <!-- /* DATA KOSONG */ -->
                <tr>
                    <td colspan="7">
                        Belum ada data hasil insinerasi
                    </td>
                </tr>

                @endforelse

                <!-- /* TOTAL DATA */ -->
                @if($hasilInsinerasi->count() > 0)

                <tr class="total-row">
                    <td colspan="5">
                        <strong>Total Jumlah Limbah</strong>
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

<!-- /* SCRIPT SEARCH */ -->
<script>

/* ELEMENT */

const searchInput = document.getElementById('searchInput');
const dataTable = document.getElementById('dataTable');

/* SEARCH DATA */

searchInput.addEventListener('keyup', function () {

    const keyword = this.value.toLowerCase();

    const rows =
        dataTable.querySelectorAll('tbody tr:not(.total-row)');

    rows.forEach(row => {

        const text = row.innerText.toLowerCase();

        if (text.includes(keyword)) {

            row.style.display = '';

        } else {

            row.style.display = 'none';

        }

    });

});

</script>

@endsection