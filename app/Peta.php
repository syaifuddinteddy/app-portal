<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Peta extends Model
{
    protected $table = 'm_peta_gis';
    public $timestamps = false;
    protected $primaryKey = 'id_peta_gis';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [

        'id_peta_gis', 'nama_peta_gis', 'nama_peta_gis_eng',
        'aktif', 'judul_menu', 'judul_menu_eng', 'zoom', 'jenis_peta'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];
}
