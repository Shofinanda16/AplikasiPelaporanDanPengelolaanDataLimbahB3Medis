@extends('layouts.staf')

@section('title', 'Edit Data Limbah Masuk')
@section('page_label', 'Dashboard Staf')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/staf/add-limbah-masuk.css') }}">
@endpush

@section('content')

<div class="page-head">
    <div>
        <h1>Data Limbah Masuk</h1>
        <p>Edit data limbah B3 medis</p>
    </div>
</div>

<!-- /* FORM EDIT LIMBAH MASUK */ -->
<div class="form-card">
    <div class="form-title">
        <h3>
            <i class="fa-solid fa-folder-plus"></i>
            Edit Data Limbah Masuk
        </h3>
        <p>Perbarui informasi limbah B3</p>
    </div>

    <form action="/update-limbah-masuk/{{ $limbah->id_limbah_medis }}" method="POST">
        @csrf
        @method('PUT')

        <!-- /* DATA LIMBAH */ -->
        <div class="form-grid">

            <!-- /* FASYANKES */ -->
            <div class="form-group">
                <label>Fasyankes</label>
                <select id="fasyankes">
                    @foreach($fasyankes->unique('fasyankes') as $item)

                    <option value="{{ $item->fasyankes }}"
                        {{ $limbah->fasyankes->fasyankes == $item->fasyankes ? 'selected' : '' }}>
                        {{ $item->fasyankes }}
                    </option>

                    @endforeach
                </select>

                <input type="hidden" id="id_data_fasyankes" name="id_data_fasyankes" value="{{ $limbah->id_data_fasyankes }}">
            </div>

            <!-- /* KODE LIMBAH */ -->
            <div class="form-group">
                <label>Kode Limbah</label>
                <select id="kode_limbah" required></select>
            </div>

            <!-- /* JENIS LIMBAH */ -->
            <div class="form-group">
                <label>Jenis Limbah</label>
                <input type="text" id="jenisLimbah" name="jenis_limbah" value="{{ $limbah->fasyankes->jenis_limbah ?? '' }}" readonly>
            </div>

            <!-- /* MANIFEST */ -->
            <div class="form-group">
                <label>Manifest</label>
                <input type="text" id="manifest" name="manifest" value="{{ $limbah->fasyankes->manifest ?? '' }}" readonly>
            </div>

            <!-- /* TANGGAL PENGANGKUTAN */ -->
            <div class="form-group">
                <label>Tanggal Pengangkutan</label>
                <input type="date" id="tanggal_pengangkutan" name="tanggal_pengangkutan" value="{{ $limbah->tanggal_pengangkutan }}">
            </div>

            <!-- /* TANGGAL PENERIMAAN */ -->
            <div class="form-group">
                <label>Tanggal Penerimaan</label>
                <input type="date" id="tanggal_penerimaan" name="tanggal_penerimaan" value="{{ $limbah->tanggal_penerimaan }}">
            </div>

            <!-- /* TANGGAL BATAS PENYIMPANAN */ -->
            <div class="form-group">
                <label>Tanggal Batas Penyimpanan</label>
                <input type="date" id="tanggal_batas_penyimpanan" name="tanggal_batas_penyimpanan" value="{{ $limbah->tanggal_batas_penyimpanan }}" readonly>
            </div>

            <!-- /* KODE CUSTOMER */ -->
            <div class="form-group">
                <label>Kode Customer</label>
                <input type="text" id="kode_cust" name="kode_cust" value="{{ $limbah->kode_cust }}">
            </div>

            <!-- /* NO POLISI */ -->
            <div class="form-group">
                <label>No. Polisi</label>
                <input type="text" id="no_polisi" name="no_polisi" value="{{ $limbah->no_polisi }}">
            </div>

            <!-- /* DRIVER */ -->
            <div class="form-group">
                <label>Driver</label>
                <input type="text" id="driver" name="driver" value="{{ $limbah->driver }}">
            </div>

            <!-- /* KEMASAN */ -->

            <div class="form-group">
                <label>Kemasan</label>
                <input type="number" id="kemasan" name="kemasan" value="{{ $limbah->kemasan }}">
            </div>

            <!-- /* SATUAN */ -->
            <div class="form-group">
                <label>Satuan</label>
                <input type="text" id="satuan" name="satuan" value="{{ $limbah->satuan }}">
            </div>

            <!-- /* JUMLAH LIMBAH */ -->
            <div class="form-group">
                <label>Jumlah Limbah</label>
                <input type="text" id="jumlah_limbah" name="jumlah_limbah" value="{{ number_format($limbah->jumlah_limbah, 2, ',', '.') }}" class="form-control">
            </div>
        </div>

        <!-- /* TOMBOL AKSI */ -->
        <div class="form-actions">
            <button type="submit" class="save-btn">
                <i class="fa-regular fa-floppy-disk"></i>
                Simpan Perubahan
            </button>

            <a href="/limbah-masuk" class="cancel-btn">
                <i class="fa-solid fa-xmark"></i>
                Batal
            </a>

        </div>
    </form>
</div>

<script>

/* TANGGAL BATAS PENYIMPANAN */

const tanggalPenerimaan = document.getElementById('tanggal_penerimaan'),
      tanggalBatas = document.getElementById('tanggal_batas_penyimpanan');

tanggalPenerimaan.addEventListener('change', function () {

    if (this.value) {

        let tanggal = new Date(this.value);

        tanggal.setDate(tanggal.getDate() + 90);

        let tahun = tanggal.getFullYear(),
            bulan = String(tanggal.getMonth() + 1).padStart(2, '0'),
            hari  = String(tanggal.getDate()).padStart(2, '0');

        tanggalBatas.value = `${tahun}-${bulan}-${hari}`;

    }

});

/* DATA FASYANKES */

const dataFasyankes = @json($fasyankes),
      fasyankesSelect = document.getElementById('fasyankes'),
      kodeLimbahSelect = document.getElementById('kode_limbah'),
      jenisLimbahInput = document.getElementById('jenisLimbah'),
      manifestInput = document.getElementById('manifest'),
      idDataFasyankesInput = document.getElementById('id_data_fasyankes');

function loadKodeLimbah() {

    const selectedFasyankes = fasyankesSelect.value;

    kodeLimbahSelect.innerHTML = '';

    const filtered = dataFasyankes.filter(
        item => item.fasyankes === selectedFasyankes
    );

    filtered.forEach(item => {

        kodeLimbahSelect.innerHTML += `
            <option
                value="${item.id_data_fasyankes}"
                data-jenis="${item.jenis_limbah}"
                data-manifest="${item.manifest}"
                ${item.id_data_fasyankes == idDataFasyankesInput.value ? 'selected' : ''}
            >
                ${item.kode_limbah}
            </option>
        `;

    });

    updateData();

}

function updateData() {

    const selectedOption =
        kodeLimbahSelect.options[kodeLimbahSelect.selectedIndex];

    if (!selectedOption) return;

    idDataFasyankesInput.value = selectedOption.value;
    jenisLimbahInput.value = selectedOption.dataset.jenis;
    manifestInput.value = selectedOption.dataset.manifest;

}

fasyankesSelect.addEventListener('change', loadKodeLimbah);
kodeLimbahSelect.addEventListener('change', updateData);

loadKodeLimbah();

</script>

@endsection