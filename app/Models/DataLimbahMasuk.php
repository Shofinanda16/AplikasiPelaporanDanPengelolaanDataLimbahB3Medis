<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DataLimbahMasuk extends Model
{
    protected $table = 'data_limbah_masuk';
    protected $primaryKey = 'id_limbah_medis';
    protected $fillable = [
        'id_data_fasyankes',
        'tanggal_pengangkutan',
        'tanggal_penerimaan',
        'tanggal_batas_penyimpanan',
        'kode_cust',
        'no_polisi',
        'driver',
        'kemasan',
        'satuan',
        'jumlah_limbah',
        'status'
    ];

    public function fasyankes()
    {
        return $this->belongsTo(
            DataFasyankes::class,
            'id_data_fasyankes',
            'id_data_fasyankes'
        );
    }

    public function hasilInsinerasi()
    {
        return $this->hasOne(
            DataHasilInsinerasi::class,
            'id_limbah_medis',
            'id_limbah_medis'
        );
    }
}