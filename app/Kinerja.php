<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kinerja extends Model
{
    protected $table = 't_kinerja';
    public $timestamps = false;
    protected $primaryKey = 'id_kinerja';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [

        'id_kinerja', 'id_user', 'tgl_entri',
        'tahun', 'judul', 'narasi', 'status'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];
}
