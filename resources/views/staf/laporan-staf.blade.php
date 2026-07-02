@extends('layouts.staf')

@section('title', 'Laporan Limbah B3 Medis')
@section('page_label', 'Dashboard Staf')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/staf/laporan-staf.css') }}">
@endpush

@section('content')

<div class="laporan-page">
    <div class="page-head">
        <div>
            <h1>Laporan Limbah B3 Medis</h1>
            <p>Generate dan download laporan berdasarkan periode</p>
        </div>
    </div>

    <!-- /* FILTER LAPORAN */ -->
    <div class="filter-card">
        <div class="filter-head">
            <h3>Filter Laporan</h3>
            <p>Pilih periode dan jenis data limbah yang ingin dibuat laporan</p>
        </div>

        <form action="/laporan-staf" method="GET">
            <div class="form-grid">

                <!-- /* FILTER BULAN */ -->
                <div class="form-group">
                    <label for="bulan" placeholder="Bulan">Bulan</label>
                    <input type="month" id="bulan" name="bulan" value="{{ $bulan ?? '' }}">
                </div>

                <!-- /* FILTER JENIS LIMBAH */ -->
                <div class="form-group">
                    <label for="jenis_limbah">Limbah B3 Medis</label>
                    <select id="jenis_limbah" name="jenis_limbah">
                        <option value="" disabled selected>
                            Pilih Limbah B3 Medis
                        </option>

                        <option value="limbah_masuk"
                            {{ ($jenisData ?? '') == 'limbah_masuk' ? 'selected' : '' }}>
                            Limbah Masuk
                        </option>

                        <option value="hasil_insinerasi"
                            {{ ($jenisData ?? '') == 'hasil_insinerasi' ? 'selected' : '' }}>
                            Hasil Insinerasi
                        </option>
                    </select>
                </div>
            </div>

            <button type="submit" class="generate-btn">
                <i class="fa-solid fa-file-pdf"></i>
                Generate Laporan
            </button>
        </form>
    </div>

    <!-- /* PREVIEW LAPORAN */ -->
    @if(isset($bulan) && isset($jenisData) && $bulan && $jenisData)

    <div class="preview-card">
        <div class="preview-top">
            <h3>Preview Laporan</h3>
            <a href="/download-laporan-staf?bulan={{ $bulan }}&jenis_limbah={{ $jenisData }}"
                class="download-btn">
                <i class="fa-solid fa-download"></i>
                Download
            </a>
        </div>

        <div class="report-page-preview">

            <!-- /* KOP LAPORAN */ -->
            <div class="report-kop">
                <div class="kop-logo">
                    <img src="{{ asset('Logo.png') }}" alt="Logo PT">
                </div>
                <div class="kop-text">
                    <h1>LAPORAN PENGELOLAAN LIMBAH B3 MEDIS</h1>
                    <h2>PT. Sriwijaya Mandiri Sumsel</h2>
                    <p>
                        Aplikasi Pelaporan dan Pengelolaan Data Limbah B3 Medis
                    </p>
                </div>
            </div>

            <!-- /* INFORMASI LAPORAN */ -->
            <div class="report-info">
                <table>
                    <tr>
                        <td class="label">Periode</td>
                        <td class="colon">:</td>
                        <td>{{ date('F Y', strtotime($bulan)) }}</td>
                    </tr>

                    <tr>
                        <td class="label">Jenis Laporan</td>
                        <td class="colon">:</td>
                        <td>
                            {{ $jenisData == 'limbah_masuk'
                                ? 'Limbah Masuk'
                                : 'Hasil Insinerasi' }}
                        </td>
                    </tr>
                    <tr>
                        <td class="label">Total Data</td>
                        <td class="colon">:</td>
                        <td>{{ $laporan->count() }} data</td>
                    </tr>
                </table>
            </div>

            <!-- /* TABEL LAPORAN */ -->

            <table class="report-table-formal">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>
                            {{ $jenisData == 'limbah_masuk'
                                ? 'Tanggal Penerimaan'
                                : 'Tanggal Pemusnahan' }}
                        </th>
                        <th>Fasyankes</th>
                        <th>Kode Limbah</th>
                        <th>Jenis Limbah</th>
                        <th>Kemasan</th>
                        <th>Jumlah Limbah</th>
                    </tr>
                </thead>
                <tbody>

                    <!-- /* DATA LAPORAN */ -->
                    @forelse($laporan as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>
                            {{ $jenisData == 'limbah_masuk'
                                ? date('d-m-Y', strtotime($item->tanggal_penerimaan))
                                : date('d-m-Y', strtotime($item->tanggal_pemusnahan)) }}
                        </td>
                        <td>{{ $item->Fasyankes->fasyankes ?? '-' }}</td>
                        <td>{{ $item->Fasyankes->kode_limbah ?? '-' }}</td>
                        <td>{{ $item->Fasyankes->jenis_limbah ?? '-' }}</td>
                        <td>    {{ $jenisData == 'limbah_masuk'
                                    ? ($item->kemasan ?? '-')
                                    : ($item->limbahMasuk->kemasan ?? '-') }} Kantong
                        </td>
                        <td>
                            @if($jenisData == 'limbah_masuk')

                                {{ number_format($item->jumlah_limbah, 2, ',', '.') }}

                            @else

                                {{ number_format($item->limbahMasuk->jumlah_limbah ?? 0, 2, ',', '.') }}

                            @endif
                        </td>
                    </tr>

                    @empty
                    <!-- /* DATA KOSONG */ -->
                    <tr>
                        <td colspan="6">
                            Tidak ada data laporan 
                        </td>
                    </tr>
                    @endforelse

                    <!-- /* TOTAL LIMBAH */ -->
                    @if($laporan->count() > 0)
                    <tr class="total-row">
                        <td colspan="5">
                            Total Jumlah Limbah
                        </td>
                        <td>
                            @php
                            $totalKemasan = $jenisData == 'limbah_masuk'
                                ? $laporan->sum('kemasan')
                                : $laporan->sum(function ($item) {
                                    return $item->limbahMasuk->kemasan ?? 0;
                                });
                            @endphp

                            {{ $totalKemasan }} Kantong
                        </td>
                        
                        <td>
                            @php
                            $totalLimbah = $jenisData == 'limbah_masuk'
                                ? $laporan->sum('jumlah_limbah')
                                : $laporan->sum(function ($item) {
                                    return $item->limbahMasuk->jumlah_limbah ?? 0;
                                });
                            @endphp

                            {{ number_format($totalLimbah, 2, ',', '.') }} Kg
                        </td>
                    </tr>
                    @endif
                </tbody>
            </table>

            <!-- /* TANDA TANGAN */ -->
            <div class="report-signature">
                <div class="signature-box">
                    <div class="date">
                        Palembang, {{ date('d-m-Y') }}
                    </div>

                    <div class="name">
                        PT. Sriwijaya Mandiri Sumsel
                    </div>
                </div>
            </div>
        </div>
    </div>

    @endif
</div>

@endsection