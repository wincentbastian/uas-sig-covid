<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kabupaten extends Model
{
    public $timestamps = false;
    protected $table = 'tb_kabupaten';

    protected $fillable = [
        'kabupaten'
    ];

    public function pasien(){
        return $this->hasMany('App\Pasien','id','kabupaten_id');
    }

}
