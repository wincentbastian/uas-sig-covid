<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KabupatenNew extends Model
{
    public $timestamps = false;
    protected $table = 'tb_kabupatens';

    protected $fillable = [
        'kabupaten'
    ];

}
