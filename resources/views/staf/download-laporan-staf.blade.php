<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="{{ public_path('css/staf/download-laporan-staf.css') }}">
</head>

<body>

<!-- /* KOP LAPORAN */ -->
<div class="report-kop">
    <div class="kop-logo">
        <img src="{{ public_path('Logo.png') }}">
    </div>

    <div class="kop-text">
        <h1>
            LAPORAN PENGELOLAAN LIMBAH B3 MEDIS
        </h1>
 
        <h2>
            PT. Sriwijaya Mandiri Sumsel
        </h2>

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
            <td>:</td>
            <td>{{ date('F Y', strtotime($bulan)) }}</td>
        </tr>

        <tr>
            <td class="label">Jenis Laporan</td>
            <td>:</td>
            <td>
                {{ $jenisData == 'limbah_masuk'
                    ? 'Limbah Masuk'
                    : 'Hasil Insinerasi' }}
            </td>
        </tr>

        <tr>
            <td class="label">Total Data</td>
            <td>:</td>
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
                @if($jenisData == 'limbah_masuk')

                    {{ \Carbon\Carbon::parse($item->tanggal_penerimaan)->format('d-m-Y') }}

                @else

                    {{ \Carbon\Carbon::parse($item->tanggal_pemusnahan)->format('d-m-Y') }}

                @endif
            </td>
            <td>{{ $item->fasyankes->fasyankes ?? '-' }}</td>
            <td>{{ $item->fasyankes->kode_limbah ?? '-' }}</td>
            <td>{{ $item->fasyankes->jenis_limbah ?? '-' }}</td>
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

    @php
    $totalLimbah = $laporan->sum(function ($item) {
        return (float) $item->jumlah_limbah;
    });
    @endphp

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

</body>
</html>