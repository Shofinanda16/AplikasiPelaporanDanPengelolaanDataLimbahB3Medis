<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DataFasyankes extends Model
{
    protected $table = 'data_fasyankes';
    protected $primaryKey = 'id_data_fasyankes';
    protected $fillable = [
        'id_user',
        'fasyankes',
        'kode_limbah',
        'jenis_limbah',
        'manifest'
    ];

    public function limbahMasuk()
    {
        return $this->hasMany(
            DataLimbahMasuk::class,
            'id_data_fasyankes',
            'id_data_fasyankes'
        );
    }
}