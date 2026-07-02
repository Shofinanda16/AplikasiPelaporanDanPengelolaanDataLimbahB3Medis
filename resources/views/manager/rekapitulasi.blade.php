@extends('layouts.manager')

@section('title', 'Rekapitulasi Limbah B3 Medis')
@section('page_label', 'Dashboard Manager')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/manager/rekapitulasi.css') }}">
@endpush

@section('content')

<div class="rekap-page">
    <div class="page-head">
        <div>
            <h1>Rekapitulasi Limbah B3 Medis</h1>
            <p>Rekap data limbah B3 medis berdasarkan fasyankes dan data limbah</p>
        </div>
    </div>

    <!-- /* FILTER DATA */ -->
    <div class="filter-card">
        <div class="filter-head">
            <h3>Filter Data</h3>
            <p>Pilih fasyankes dan data limbah yang ingin ditampilkan</p>
        </div>

        <form action="/rekapitulasi-manager" method="GET">

            <div class="form-grid">

                <!-- /* FILTER FASYANKES */ -->
                <div class="form-group">
                    <label for="fasyankes">Fasyankes</label>
                    <select id="fasyankes" name="fasyankes">

                        <option value="" disabled selected>
                            Pilih Fasyankes
                        </option>

                        @foreach($fasyankesList as $item)

                        <option value="{{ $item->fasyankes }}"
                            {{ request('fasyankes') == $item->fasyankes ? 'selected' : '' }}>
                            {{ $item->fasyankes }}
                        </option>

                        @endforeach
                    </select>
                </div>

                <!-- /* FILTER JENIS DATA */ -->
                <div class="form-group">
                    <label for="jenis_data">Limbah B3 Medis</label>
                    <select id="jenis_data" name="jenis_data">

                        <option value="" disabled selected>
                            Pilih Limbah B3 Medis
                        </option>

                        <option value="semua_data"
                            {{ request('jenis_data') == 'semua_data' ? 'selected' : '' }}>
                            Limbah Masuk
                        </option>

                        <option value="hasil_insinerasi"
                            {{ request('jenis_data') == 'hasil_insinerasi' ? 'selected' : '' }}>
                            Hasil Insinerasi
                        </option>
                    </select>
                </div>
            </div>

            <button type="submit" class="filter-btn">
                <i class="fa-solid fa-filter"></i>
                Tampilkan Data
            </button>
        </form>
    </div>

    <!-- /* TABEL REKAPITULASI */ -->

    <div class="table-card">
        <div class="table-top">
            <div>
                <h3>Hasil Rekapitulasi</h3>
                <p>Data rekapitulasi limbah B3 medis</p>
            </div>
        </div>

        <div class="table-responsive">
            <!-- /* TOTAL LIMBAH */ -->

            @php

            if(request('jenis_data') == 'hasil_insinerasi') {

                $totalJumlahLimbah = $rekapitulasi->sum(function($item) {
                    return $item->limbahMasuk->jumlah_limbah ?? 0;
                });

            } else {

                $totalJumlahLimbah = $rekapitulasi->sum('jumlah_limbah');

            }

            @endphp
            <table>

                <!-- /* HEADER TABEL */ -->
                <thead>
                    <tr>
                        <th>No</th>
                        @if(request('jenis_data') == 'hasil_insinerasi')
                            <th>Tanggal Pemusnahan</th>
                        @else
                            <th>Tanggal Penerimaan</th>
                        @endif
                        <th>Fasyankes</th>
                        <th>Kode Cust</th>
                        <th>Kode Limbah</th>
                        <th>Jenis Limbah</th>
                        <th>Kemasan</th>
                        <th>Satuan</th>
                        <th>Jumlah Limbah</th>
                    </tr>
                </thead>

                <!-- /* DATA REKAPITULASI */ -->

                <tbody>
                @forelse($rekapitulasi as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>

                            @if(request('jenis_data') == 'hasil_insinerasi')

                                {{ \Carbon\Carbon::parse($item->tanggal_pemusnahan)->format('d-m-Y') }}

                            @else

                                {{ \Carbon\Carbon::parse($item->tanggal_penerimaan)->format('d-m-Y') }}

                            @endif
                        </td>
                        <td>{{ $item->fasyankes->fasyankes ?? '-' }}</td>
                        <td>
                            {{ request('jenis_data') == 'hasil_insinerasi'
                                ? ($item->limbahMasuk->kode_cust ?? '-')
                                : ($item->kode_cust ?? '-') }}
                        </td>
                        <td>{{ $item->fasyankes->kode_limbah ?? '-' }}</td>
                        <td>{{ $item->fasyankes->jenis_limbah ?? '-' }}</td>
                        <td>
                            {{ request('jenis_data') == 'hasil_insinerasi'
                                ? ($item->limbahMasuk->kemasan ?? '-')
                                : ($item->kemasan ?? '-') }}
                        </td>

                        <td>
                            {{ request('jenis_data') == 'hasil_insinerasi'
                                ? ($item->limbahMasuk->satuan ?? '-')
                                : ($item->satuan ?? '-') }}
                        </td>

                        <td>
                            {{ number_format(
                                request('jenis_data') == 'hasil_insinerasi'
                                    ? ($item->limbahMasuk->jumlah_limbah ?? 0)
                                    : ($item->jumlah_limbah ?? 0),
                                2,
                                ',',
                                '.'
                            ) }}
                        </td>
                    </tr>

                @empty

                    <!-- /* DATA KOSONG */ -->
                    <tr>
                        <td colspan="9">Belum ada data rekapitulasi</td>
                    </tr>

                @endforelse
                <!-- /* TOTAL DATA */ -->
                @if($rekapitulasi->count() > 0)

                <tr class="total-row">
                    <td colspan="6" class="total-label">
                        Total
                    </td>

                    <td>
                        <strong>
                            @if(request('jenis_data') == 'hasil_insinerasi')

                                {{ $rekapitulasi->sum(fn($item) => $item->limbahMasuk->kemasan ?? 0) }}

                            @else

                                {{ $rekapitulasi->sum('kemasan') }}

                            @endif
                        </strong>
                    </td>

                    <td>
                        <strong>
                            @if(request('jenis_data') == 'hasil_insinerasi')

                                {{ $rekapitulasi->first()->limbahMasuk->satuan ?? '-' }}

                            @else

                                {{ $rekapitulasi->first()->satuan ?? '-' }}

                            @endif
                        </strong>
                    </td>

                    <td>
                        <strong>
                            {{ number_format($totalJumlahLimbah, 2, ',', '.') }} Kg
                        </strong>
                    </td>
                </tr>

                @endif
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection