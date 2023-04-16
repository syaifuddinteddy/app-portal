<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MenuPortal extends Model
{
    protected $table = 'm_menu_portal';
    public $timestamps = false;
    protected $primaryKey = 'id_menu';

    protected $guarded = [];

    protected $hidden = [];

    public function menu_dinamis () {
        return $this->hasMany(MenuDinamis::class, 'menu_utama', 'link')->select('nama_menu','menu_utama','id_menu');
    }
}
