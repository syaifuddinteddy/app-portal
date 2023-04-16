<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    protected $table = 'm_pegawai';
    public $timestamps = false;
    protected $primaryKey = 'id_pegawai';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [

        'id_pegawai', 'nama_lengkap', 'alamat',
        'no_telp', 'tempat_lahir', 'tgl_lahir' ,'pangkat',
        'jabatan','skpd','nip'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];
}
