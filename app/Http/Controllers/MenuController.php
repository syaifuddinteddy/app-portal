<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Menu;
use Illuminate\Support\Facades\DB;

class MenuController extends Controller{

    public function getMenuByUserGrant($id_kategori_user){
        return DB::table('v_menu_portal')
            ->select('*')
            ->where('id_kategori_user','=',$id_kategori_user)
            ->where('id_parent','=',0)
            ->get();
    }

    public function getSubMenuByUserGrant($id_kategori_user){
        return DB::table('v_menu_portal')
            ->select('*')
            ->where('id_kategori_user','=',$id_kategori_user)
            ->orderBy('id_menu')
            ->get();
    }

    public function getAllMenu(){
        return Menu::where('id_parent','=','0')->get();
    }

    public function getAllSubMenu(){
        return Menu::all();
    }

}
