@extends('layouts.staf')

@section('title', 'Tambah Data Limbah Masuk')
@section('page_label', 'Dashboard Staf')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/staf/add-limbah-masuk.css') }}">
@endpush

@section('content')

<div class="page-head">
    <div>
        <h1>Data Limbah Masuk</h1>
        <p>Kelola data limbah B3 medis</p>
    </div>

</div>

<!-- /* FORM TAMBAH LIMBAH MASUK */ -->
<div class="form-card">
    <div class="form-title">
        <h3>
            <i class="fa-solid fa-folder-plus"></i>
            Tambah Data Limbah Masuk
        </h3>
        <p>Masukkan informasi limbah B3 yang diterima</p>
    </div>

    <form action="/store-limbah-masuk" method="POST">
        @csrf

        <div class="form-grid">

            <!-- /* FASYANKES */ -->
            <div class="form-group">
                <label for="fasyankes">Fasyankes</label>
                <select id="fasyankes" required>
                    <option value="" disabled selected>
                        Pilih Fasyankes
                    </option>

                    @foreach($fasyankes->unique('fasyankes') as $item)
                        <option value="{{ $item->fasyankes }}">
                            {{ $item->fasyankes }}
                        </option>
                    @endforeach
                </select>

                <input type="hidden" id="id_data_fasyankes" name="id_data_fasyankes">
            </div>

            <!-- /* KODE LIMBAH */ -->
            <div class="form-group">
                <label for="kode_limbah">Kode Limbah</label>
                <select id="kode_limbah" required>
                    <option value="" disabled selected>
                        Pilih Kode Limbah
                    </option>
                </select>
            </div>

            <!-- /* JENIS LIMBAH */ -->
            <div class="form-group">
                <label for="jenis_limbah">Jenis Limbah</label>
                <input type="text" id="jenis_limbah" readonly>
            </div>

            <!-- /* MANIFEST */ -->
            <div class="form-group">
                <label for="manifest">Manifest</label>
                <input type="text" id="manifest" readonly>
            </div>

            <!-- /* TANGGAL PENGANGKUTAN */ -->
            <div class="form-group">
                <label for="tanggal_pengangkutan">Tanggal Pengangkutan</label>
                <input type="date" id="tanggal_pengangkutan" name="tanggal_pengangkutan" required>
            </div>

            <!-- /* TANGGAL PENERIMAAN */ -->
            <div class="form-group">
                <label for="tanggal_penerimaan">Tanggal Penerimaan</label>
                <input type="date" id="tanggal_penerimaan" name="tanggal_penerimaan" required>
            </div>

            <!-- /* TANGGAL BATAS PENYIMPANAN */ -->
            <div class="form-group">
                <label for="tanggal_batas_penyimpanan">Tanggal Batas Penyimpanan</label>
                <input type="date" id="tanggal_batas_penyimpanan" name="tanggal_batas_penyimpanan" readonly required>
            </div>

            <!-- /* KODE CUST */ -->

            <div class="form-group">
                <label for="kode_cust">Kode Cust</label>
                <input type="text" id="kode_cust" name="kode_cust" placeholder="SR-XXX" required>
            </div>

            <!-- /* NO POLISI */ -->
            <div class="form-group">
                <label for="no_polisi">No. Polisi</label>
                <input type="text" id="no_polisi" name="no_polisi" placeholder="BG XXXX" required>
            </div>

            <!-- /* DRIVER */ -->
            <div class="form-group">
                <label for="driver">Driver</label>
                <input type="text" id="driver" name="driver" placeholder="Nama driver" required>
            </div>

            <!-- /* KEMASAN */ -->
            <div class="form-group">
                <label for="kemasan">Kemasan</label>
                <input type="number" id="kemasan" name="kemasan" placeholder="Masukkan jumlah kemasan" required>
            </div>

            <!-- /* SATUAN */ -->
            <div class="form-group">
                <label for="satuan">Satuan</label>
                <input type="text" id="satuan" name="satuan" value="Kantong" readonly>
            </div>

            <!-- /* JUMLAH LIMBAH */ -->
            <div class="form-group">
                <label for="jumlah_limbah">Jumlah Limbah</label>
                <input type="text" name="jumlah_limbah" class="form-control" placeholder="Masukkan jumlah limbah" required>
            </div>
        </div>

        <!-- /* TOMBOL AKSI */ -->
        <div class="form-actions">
            <button type="submit" class="save-btn">
                <i class="fa-regular fa-floppy-disk"></i>
                Simpan
            </button>

            <a href="/limbah-masuk" class="cancel-btn">
                <i class="fa-solid fa-xmark"></i>
                Batal
            </a>
        </div>
    </form>
</div>

<!-- /* SCRIPT FASYANKES & LIMBAH */ -->

<script>

const dataFasyankes = @json($fasyankes);

const fasyankesSelect = document.getElementById('fasyankes');
const kodeLimbahSelect = document.getElementById('kode_limbah');
const jenisLimbahInput = document.getElementById('jenis_limbah');
const manifestInput = document.getElementById('manifest');
const idDataFasyankesInput = document.getElementById('id_data_fasyankes');

/* FASYANKES */

fasyankesSelect.addEventListener('change', function () {

    const Fasyankes = this.value;

    kodeLimbahSelect.innerHTML =
        '<option value="" disabled selected>Pilih Kode Limbah</option>';

    jenisLimbahInput.value = '';
    manifestInput.value = '';

    const filtered = dataFasyankes.filter(
        item => item.fasyankes === Fasyankes
    );

    filtered.forEach(item => {

        kodeLimbahSelect.innerHTML += `
            <option
                value="${item.id_data_fasyankes}"
                data-jenis="${item.jenis_limbah}"
                data-manifest="${item.manifest}">
                ${item.kode_limbah}
            </option>
        `;

    });

});

/* KODE LIMBAH */

kodeLimbahSelect.addEventListener('change', function () {

    const selectedOption =
        this.options[this.selectedIndex];

    idDataFasyankesInput.value =
        selectedOption.value;

    jenisLimbahInput.value =
        selectedOption.dataset.jenis;

    manifestInput.value =
        selectedOption.dataset.manifest;

});

/* TANGGAL BATAS PENYIMPANAN */

const tanggalPenerimaan =
    document.getElementById('tanggal_penerimaan');

const tanggalBatas =
    document.getElementById('tanggal_batas_penyimpanan');

tanggalPenerimaan.addEventListener('change', function () {

    if (this.value) {

        let tanggal = new Date(this.value);

        tanggal.setDate(
            tanggal.getDate() + 90
        );

        let tahun = tanggal.getFullYear();

        let bulan = String(
            tanggal.getMonth() + 1
        ).padStart(2, '0');

        let hari = String(
            tanggal.getDate()
        ).padStart(2, '0');

        tanggalBatas.value =
            `${tahun}-${bulan}-${hari}`;

    }

});

</script>

@endsection