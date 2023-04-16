<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Info_Pegawai extends Model
{
    protected $table = 'm_info_pegawai';
    public $timestamps = false;
    protected $primaryKey = 'id_info_pegawai';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [

        'id_info_pegawai', 'nip', 'nama',
        'jabatan', 'file_info_pegawai'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];
}
