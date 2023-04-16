<?php

namespace App\Http\Controllers;

use App\MenuPortal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class KontenMenuDinamisController extends Controller{

    public function __construct()
    {
        $this->middleware('auth',['except'=>['getInformasi']]);
    }

    public function getInformasi(Request $req){

        $menuInfo = MenuPortal::where('id_parent', 26)->with('menu_dinamis')->get();

        if ($req['id'] != null){
            $detailInfo = $this->getDetailInformasi($req['id']);
        }else{
            $detailInfo = null;
        }

        return view('portal.contents.informasiList')
            ->with('mn_informasi', $menuInfo)
            ->with('detailInformasi', $detailInfo);
    }

    public function getDetailInformasi($id){
        return DB::table('m_menu_dinamis')
            ->where('id_menu','=', $id)
            ->first();
    }


    public function showListKontenMenuDinamis($slug){

        $dtContent = DB::table('m_menu_dinamis')
            ->select(['id_menu','nama_menu','status','menu_utama'])
            ->where('menu_utama','=',$slug)
            ->orderByDesc('tgl_entri')
            ->get();

        return view('admin.contents.menu_dinamis.list_data_menu')
            ->with('dtContent', $dtContent);
    }

    public function showFormAddMenu($slug){

        return view('admin.contents.menu_dinamis.form_data_menu')
            ->with('content',null)
            ->with('slug',$slug);

    }

    public function saveKontenDataMenu(Request $req){
        $setId = DB::table('m_menu_dinamis')
            ->select('id_menu')
            ->orderByDesc('id_menu')
            ->first();

        DB::table('m_menu_dinamis')
            ->insert([
                'id_menu' => $setId->id_menu + 1,
                'nama_menu' => $req['nama_menu'],
                'nama_menu_eng' => $req['nama_menu_eng'],
                'url' => str_replace(" ","",$req['nama_menu']),
                'menu_utama' => $req['menu_utama'],
                'status' => 1,
                'narasi' => $req['narasi'],
                'narasi_eng' => $req['narasi_eng'],
                'judul' => $req['judul'],
                'judul_eng' => $req['judul_eng'],
                'tgl_entri' => date('Y-m-d'),
                'id_user' => Auth::user()->id_user

            ]);

        session()->flash('msg', 'Sukses Menyimpan Data!');
        return Redirect::route('menuDinamis',$req['menu_utama']);
    }

    public function editDataMenu($id_menu){
      $dtContent = DB::table('m_menu_dinamis')
            ->where('id_menu','=',$id_menu)
            ->first();

      return view('admin.contents.menu_dinamis.form_data_menu')
            ->with('content',$dtContent)
            ->with('slug', $dtContent->menu_utama);

    }

    public function updateDataMenu(Request $req){
       DB::table('m_menu_dinamis')
           ->where('id_menu','=',$req['id_menu'])
           ->update([
               'nama_menu' => $req['nama_menu'],
               'nama_menu_eng' => $req['nama_menu_eng'],
               'menu_utama' => $req['menu_utama'],
               'url' => str_replace(" ","",$req['nama_menu']),
               'status' => $req['status'],
               'narasi' => $req['narasi'],
               'narasi_eng' => $req['narasi_eng'],
               'judul' => $req['judul'],
               'judul_eng' => $req['judul_eng'],
               'tgl_entri' => date('Y-m-d'),
               'id_user' => Auth::user()->id_user
           ]);

        session()->flash('msg', 'Sukses Mengupdate Data!');
        return Redirect::route('menuDinamisEdit',$req['id_menu']);
    }

    public function deleteDataMenu($id_menu){
        DB::table('m_menu_dinamis')
            ->where('id_menu','=',$id_menu)
            ->delete();

        session()->flash('msg', 'Sukses Mengupdate Data!');
        return Redirect::back();
    }
}
