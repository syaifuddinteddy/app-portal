<?php

namespace App\Http\Controllers;
use App\Icon;
use App\Peta;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class GISController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function showListIcon(){
        $icon = Icon::orderBy('id_icon', 'desc')->get();

        return view('admin.contents.GIS.icon')
            ->with('icon', $icon);
    }

    public function showFormAddIcon(){
        return view('admin.contents.GIS.form_icon')
            ->with('formType', 'add')
            ->with('icon', null);
    }

    public function saveDataIcon(Request $req) {
        $setId = Icon::orderByDesc('id_icon')->first();

        $icon = new Icon();
        $icon->id_icon = $setId != null ? $setId->id_icon + 1 : 1;
        $icon->nama_icon = $req['nama_icon'];
        $icon->file = $req['file'];
        $icon->save();

        if ($icon) {
            session()->flash('msg', 'Berhasil Menambahkan Data !');
        } else {
            session()->flash('msg_error', 'Gagal Menambahkan Data !');
        }

        return Redirect::route('icon');
    }

    public function getDataIcon($id_icon){
        $icon = Icon::where('id_icon','=',$id_icon) //jika data tidak ditemukan, maka terlihat error
            ->first();

        return view('admin.contents.GIS.form_icon')
            ->with('icon',$icon)
            ->with('formType', 'edit');
    }

    public function updateDataIcon(Request $req){

        Icon::where('id_icon','=',$req['id_icon'])
            ->update([
                'nama_icon'=>$req['nama_icon'],
                'file'=>$req['file'],
            ]);

        session()->flash('msg', 'Sukses Mengupdate Data!');
        return Redirect::route('iconEdit',$req['id_icon']);
    }

    public function deleteDataIcon($id_icon){
        Icon::where('id_icon','=',$id_icon)->delete();

        session()->flash('msg', 'Berhasil Menghapus Data !');
        return Redirect::route('icon');
    }

    public function showListPeta(){
        $peta = Peta::orderBy('id_peta_gis', 'desc')->get();

        return view('admin.contents.GIS.peta')
            ->with('peta', $peta);
    }

    public function showFormAddPeta(){
        return view('admin.contents.GIS.form_peta')
            ->with('formType', 'add')
            ->with('peta', null);
    }

    public function saveDataPeta(Request $req) {
        $setId = Peta::orderByDesc('id_peta_gis')->first();

        $peta = new Peta();
        $peta->id_peta_gis = $setId != null ? $setId->id_peta_gis + 1 : 1;
        $peta->nama_peta_gis = $req['nama_peta_gis'];
        $peta->nama_peta_gis_eng = $req['nama_peta_gis_eng'];
        $peta->aktif = $req['aktif'];
        $peta->judul_menu = $req['judul_menu'];
        $peta->judul_menu_eng = $req['judul_menu_eng'];
        $peta->zoom = $req['zoom'];
        $peta->jenis_peta = $req['jenis_peta'];
        $peta->aktif = 1;
        $peta->save();

        if ($peta) {
            session()->flash('msg', 'Berhasil Menambahkan Data !');
        } else {
            session()->flash('msg_error', 'Gagal Menambahkan Data !');
        }

        return Redirect::route('peta');
    }

    public function getDataPeta($id_peta_gis){
        $peta = Peta::where('id_peta_gis','=',$id_peta_gis) //jika data tidak ditemukan, maka terlihat error
            ->first();

        return view('admin.contents.GIS.form_peta')
            ->with('peta',$peta)
            ->with('formType', 'edit');
    }

    public function updateDataPeta(Request $req){

        Peta::where('id_peta_gis','=',$req['id_peta_gis'])
            ->update([
                'nama_peta_gis'=>$req['nama_peta_gis'],
                'nama_peta_gis_eng'=>$req['nama_peta_gis_eng'],
                'aktif'=>$req['aktif'],
                'judul_menu'=>$req['judul_menu'],
                'judul_menu_eng'=>$req['judul_menu_eng'],
                'zoom'=>$req['zoom'],
                'jenis_peta'=>$req['jenis_peta'],
            ]);

        session()->flash('msg', 'Sukses Mengupdate Data!');
        return Redirect::route('petaEdit',$req['id_peta_gis']);
    }

    public function deleteDataPeta($id_peta_gis){
        Peta::where('id_peta_gis','=',$id_peta_gis)->delete();

        session()->flash('msg', 'Berhasil Menghapus Data !');
        return Redirect::route('peta');
    }
}
