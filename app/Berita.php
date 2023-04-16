<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Berita extends Model
{
    protected $table = 't_berita';
    public $timestamps = false;
    protected $primaryKey = 'id_berita';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [

        'id_berita', 'id_user', 'tgl_entri',
        'tgl_berita', 'judul', 'narasi', 'file',
        'status', 'judul_eng', 'narasi_eng'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];
}
