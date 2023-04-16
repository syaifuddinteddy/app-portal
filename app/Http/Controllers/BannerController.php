<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

class BannerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function showListBanner(){
        $banner = DB::table('t_banner')
            ->select('*')
            ->orderByDesc('tgl_entri')
            ->get();

        return view('admin.contents.banner.list_banner')
            ->with('banner', $banner);
    }

    public function addBanner(){
        return view('admin.contents.banner.form_banner')
            ->with('banner', null)
            ->with('formType','add');
    }

    public function saveBanner(Request $req){

        $setId = DB::table('t_banner')
            ->select('id_banner')
            ->orderByDesc('id_banner')
            ->first();


        $pathFolder = storage_path('app/public/uploads/banner');

        if (!file_exists($pathFolder)) {
            mkdir($pathFolder, 0777, true);
        }

        $file =$req->file('file');
        $fileName =  uniqid() . '_' . trim($file->getClientOriginalName());
        $file->move($pathFolder, $fileName);



        DB::table('t_banner')
            ->insert([
                'id_banner' => $setId->id_banner + 1,
                'id_user' => Auth::user()->id_user,
                'tgl_entri' => date('Y-m-d'),
                'file' => $fileName,
                'keterangan_banner'=>$req['keterangan_banner'],
                'keterangan_banner2'=>$req['keterangan_banner2'],
                'keterangan_banner_eng'=>$req['keterangan_banner_eng'],
                'keterangan_banner2_eng'=>$req['keterangan_banner2_eng'],
                'status' => 1
            ]);

        session()->flash('msg', 'Sukses Menyimpan Data!');
        return Redirect::route('bannerUtama');
    }

    public function editBanner($id_banner){

        $banner = DB::table('t_banner')
            ->where('id_banner','=',$id_banner)->first();

        return view('admin.contents.banner.form_banner')
            ->with('banner', $banner)
            ->with('formType','add');
    }

    public function updateBanner(Request $req){

        if($req->file() != null){
            $pathFolder = storage_path('app/public/uploads/banner');

            //Delete file image
            Storage::delete('app/public/uploads/banner/'.$req['fileName']);

            if (!file_exists($pathFolder)) {
                mkdir($pathFolder, 0777, true);
            }

            $file =$req->file('file');
            $fileName =  uniqid() . '_' . trim($file->getClientOriginalName());
            $file->move($pathFolder, $fileName);
        }

        DB::table('t_banner')
            ->where('id_banner','=',$req['id_banner'])
            ->update([
                'id_user' => Auth::user()->id_user,
                'tgl_entri' => date('Y-m-d'),
                'file' => $req->file != null ? $fileName : $req['fileName'],
                'keterangan_banner'=>$req['keterangan_banner'],
                'keterangan_banner2'=>$req['keterangan_banner2'],
                'keterangan_banner_eng'=>$req['keterangan_banner_eng'],
                'keterangan_banner2_eng'=>$req['keterangan_banner2_eng'],
                'status' => $req['status']
            ]);

        session()->flash('msg', 'Sukses Mengupdate Data!');
        return Redirect::route('bannerUtamaEdit',$req['id_banner']);
    }

    public function deleteBanner($id_banner){
        $banner = DB::table('t_banner')
            ->select('*')
            ->where('id_banner','=',$id_banner)
            ->first();

        //Delete file image
        Storage::delete('uploads/banner/'.$banner->file);

        DB::table('t_banner')->where('id_banner','=', $id_banner)->delete();

        session()->flash('msg', 'Sukses Menghapus Data!');
        return Redirect::route('bannerUtama');
    }
}
