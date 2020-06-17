<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PasienPerKelurahan extends Model
{
    public $timestamps = false;
    protected $table = 'tb_positif';

    protected $fillable = [
        'kabupaten',
        'kecamatan',
        'kelurahan',
        'level',
        'ppln',
        'ppdn',
        'tl',
        'lainya',
        'perawatan',
        'sembuh',
        'meninggal',
        'tanggal'
    ];
}
