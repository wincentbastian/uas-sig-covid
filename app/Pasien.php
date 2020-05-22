<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pasien extends Model
{
    public $timestamps = false;
    protected $table = 'tb_pasien';

    protected $fillable = [
        'kabupaten_id',
        'positif',
        'tanggal'
    ];

    public function kabupaten()
    {
        return $this->hasOne('App\Kabupaten', 'id', 'kabupaten_id');
    }
}
