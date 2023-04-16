<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Regulasi extends Model
{
    protected $table = 't_galeri_file';
    public $timestamps = false;
    protected $primaryKey = 'id_file';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [

        'id_file', 'nama_file', 'keterangan_file',
        'id_user', 'tgl_entri', 'status', 'file',
        'nama_file_eng', 'keterangan_file_eng'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];
}
