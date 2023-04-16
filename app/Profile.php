<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $table = 't_profile';
    public $timestamps = false;
    protected $primaryKey = 'id_profile';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [

        'id_profile', 'id_user', 'id_submenu', 'tgl_entri',
        'judul', 'narasi', 'file' ,'status',
        'judul_eng','narasi_eng'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];
}
