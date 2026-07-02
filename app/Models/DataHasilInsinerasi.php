<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DataHasilInsinerasi extends Model
{
    protected $table = 'data_hasil_insinerasi' ;
    protected $primaryKey = 'id_hasil_insinerasi';
    protected $fillable = [
        'tanggal_pemusnahan',
        'id_data_fasyankes',
        'id_limbah_medis'
    ];

    public function fasyankes()
    {
        return $this->belongsTo(
            DataFasyankes::class,
            'id_data_fasyankes',
            'id_data_fasyankes'
        );
    }

    public function limbahMasuk()
    {
        return $this->belongsTo(
            DataLimbahMasuk::class,
            'id_limbah_medis',
            'id_limbah_medis'
        );
    }
}