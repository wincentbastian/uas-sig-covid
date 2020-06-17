<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kecamatan extends Model
{
    public $timestamps = false;
    protected $table = 'tb_kecamatan';

    protected $fillable = [
        'kecamatan'
    ];

}
