<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Agenda extends Model
{
    protected $table = 't_agenda';
    public $timestamps = false;
    protected $primaryKey = 'id_agenda';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [

        'id_agenda', 'id_user', 'id_submenu', 'tgl_entri',
        'tgl_mulai', 'tgl_akhir', 'tempat', 'waktu', 'status',
        'nama_kegiatan',  'keterangan_kegiatan',
        'nama_kegiatan_eng', 'keterangan_kegiatan_eng'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];
}
