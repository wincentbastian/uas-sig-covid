<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kelurahan extends Model
{
    public $timestamps = false;
    protected $table = 'tb_kelurahan';

    protected $fillable = [
        'kelurahan'
    ];

}
