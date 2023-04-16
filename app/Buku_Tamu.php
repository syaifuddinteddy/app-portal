<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Buku_Tamu extends Model
{
    protected $table = 't_buku_tamu';
    public $timestamps = false;
    protected $primaryKey = 'id_bukutamu';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [

        'id_bukutamu', 'nama', 'email', 'pesan',
        'status_tampil', 'status_lihat', 'id_user_approve',
        'tgl_pesan', 'tgl_approve', 'balasan', 'alamat',
        'tempat_lahir', 'tgl_lahir', 'jenis_kelamin', 'no_hp',
        'pekerjaan', 'foto', 'judul_pesan'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];
}
