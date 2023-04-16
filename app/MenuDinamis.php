<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MenuDinamis extends Model
{
    protected $table = 'm_menu_dinamis';
    public $timestamps = false;
    protected $primaryKey = 'id_menu';

    protected $guarded = [];

    protected $hidden = [];
}
