<?php

namespace App\Http\Controllers;

use App\Http\Controllers\MenuController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class CategoryController extends Controller
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

    /**
     * Show the application list category.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function showListDataKategori()
    {
        $category = DB::table('m_kategori_user')->select('*')->get();

        //return session('menu');
        return view('admin.contents.category.list_category')
            ->with('category',$category);
    }

    public function showFormAddKategori(){

        $objMenu = new MenuController();
        $menu = $objMenu->getAllMenu();
        $subMenu = $objMenu->getAllSubMenu();

        return view('admin.contents.category.form_category')
            ->with('formType','add')
            ->with('menu',$menu)
            ->with('subMenu',$subMenu);

    }

    public function saveKategori(Request $req){

        $setIdCat = DB::table('m_kategori_user')
            ->select('id_kategori_user')
            ->orderByDesc('id_kategori_user')
            ->first();

        //Insert Master Kategori User
        $kategori = DB::table('m_kategori_user')
            ->insert([
                'id_kategori_user' => $setIdCat->id_kategori_user + 1,
                'kategori_user' => $req['kategori_user']
            ]);

        if($kategori){
            $checkedMenu = $req['checkbox_menu'];
            foreach ($checkedMenu as $idx=> $item){

                //var_dump($item);

                $setIdHakAkses = DB::table('t_hak_akses')
                    ->select('id_hak_akses')
                    ->orderByDesc('id_hak_akses')
                    ->first();

                //Insert Hak Akses By Kategori
                DB::table('t_hak_akses')->insert([
                    'id_hak_akses' => $setIdHakAkses->id_hak_akses + 1,
                    'id_kategori_user' => $setIdCat->id_kategori_user + 1,
                    'id_menu' => $item
                ]);
            }

            session()->flash('msg', 'Berhasil Menambah Kategori !');
        }else{
            session()->flash('msg_error', 'Gagal Menambah Kategori !');
        }


        return Redirect::route('kategoriUser');
    }

    public function editKategori($id_kategori_user){
        $kategori = DB::table('m_kategori_user')
            ->select('*')
            ->where('id_kategori_user','=', $id_kategori_user)
            ->first();

        $hakAkses = DB::table('t_hak_akses')
            ->select('id_menu')
            ->where('id_kategori_user','=',$id_kategori_user)
            ->get();

        $arrHakAkses =[];
        foreach ($hakAkses as $idx => $hakVal){
            $arrHakAkses[$idx] = $hakVal->id_menu;
        }

        $objMenu = new MenuController();
        $menu = $objMenu->getAllMenu();
        $subMenu = $objMenu->getAllSubMenu();

        return view('admin.contents.category.form_category')
            ->with('formType','edit')
            ->with('menu',$menu)
            ->with('subMenu',$subMenu)
            ->with('dtKategori',$kategori)
            ->with('dtHakAkses',$arrHakAkses);
    }

    public function updateKategori(Request $req){
        //Deleting Data Hak Akses
        DB::table('t_hak_akses')
            ->where('id_kategori_user','=',$req['id_kategori_user'])
            ->delete();

        //Reinserting
        $checkedMenu = $req['checkbox_menu'];
        foreach ($checkedMenu as $idx=> $item){

            //var_dump($item);

            $setIdHakAkses = DB::table('t_hak_akses')
                ->select('id_hak_akses')
                ->orderByDesc('id_hak_akses')
                ->first();

            //Insert Hak Akses By Kategori
            DB::table('t_hak_akses')->insert([
                'id_hak_akses' => $setIdHakAkses->id_hak_akses + 1,
                'id_kategori_user' => $req['id_kategori_user'],
                'id_menu' => $item
            ]);
        }

        session()->flash('msg', 'Berhasil Mengupdate Data !');
        return Redirect::route('kategoriUserEdit',$req['id_kategori_user']);
    }

    public function deleteKategoriHakAkses($id_kategori_user){
        DB::table('m_kategori_user')
            ->where('id_kategori_user','=',$id_kategori_user)
            ->delete();
        DB::table('t_hak_akses')
            ->where('id_kategori_user','=',$id_kategori_user)
            ->delete();

        session()->flash('msg', 'Berhasil Menghapus Data !');
        return Redirect::route('kategoriUser');
    }
}
