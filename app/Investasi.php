<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Investasi extends Model
{
    protected $table = 't_investasi';
    public $timestamps = false;
    protected $primaryKey = 'id_investasi';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [

        'id_investasi', 'id_user', 'tgl_entri',
        'tgl_investasi', 'judul', 'narasi', 'file',
        'status', 'judul_eng', 'narasi_eng'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];
}
