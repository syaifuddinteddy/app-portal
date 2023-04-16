<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

class BannerLinkController extends Controller{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function showListBanner(){
        $banner = DB::table('t_banner_link')
            ->select('*')
            ->orderByDesc('tgl_entri')
            ->get();

        return view('admin.contents.banner_link.list_banner_link')
            ->with('banner', $banner);
    }

    public function showFormBanner(){
        return view('admin.contents.banner_link.form_banner_link')
            ->with('formType'.'add')
            ->with('banner',null);
    }

    public function saveBanner(Request $req){
        $setId = DB::table('t_banner_link')
            ->select('id_banner')
            ->orderByDesc('id_banner')
            ->first();


        $pathFolder = storage_path('app/public/uploads/banner_link');

        if (!file_exists($pathFolder)) {
            mkdir($pathFolder, 0777, true);
        }

        $file =$req->file('file');
        $fileName =  uniqid() . '_' . trim($file->getClientOriginalName());
        $file->move($pathFolder, $fileName);

        DB::table('t_banner_link')
            ->insert([
               "id_banner" => $setId->id_banner + 1,
               "id_user" => Auth::user()->id_user,
               "tgl_entri" => date('Y-m-d'),
               "nama_banner" => $req['nama_banner'],
               "url" => $req['url'],
               "file" => $fileName,
               "status" => 1,
               "jenis" => $req['jenis']

            ]);

        session()->flash('msg', 'Sukses Menyimpan Data!');
        return Redirect::route('bannerLink');
    }

    public function editBanner($id_banner){
        $banner = DB::table('t_banner_link')
            ->select('*')
            ->where('id_banner','=',$id_banner)
            ->first();


        return view('admin.contents.banner_link.form_banner_link')
            ->with('formType','edit')
            ->with('banner',$banner);
    }

    public function updateBanner(Request $req){
        if($req->file() != null){
            $pathFolder = storage_path('app/public/uploads/banner_link');

            //Delete file image
            Storage::delete('app/public/uploads/banner_link/'.$req['fileName']);

            if (!file_exists($pathFolder)) {
                mkdir($pathFolder, 0777, true);
            }

            $file =$req->file('file');
            $fileName =  uniqid() . '_' . trim($file->getClientOriginalName());
            $file->move($pathFolder, $fileName);
        }

        DB::table('t_banner_link')
            ->where('id_banner','=',$req['id_banner'])
            ->update([
                'id_user' => Auth::user()->id_user,
                'tgl_entri' => date('Y-m-d'),
                'file' => $req->file != null ? $fileName : $req['fileName'],
                'nama_banner' => $req['nama_banner'],
                'jenis' => $req['jenis'],
                'status' => $req['status']
            ]);

        session()->flash('msg', 'Sukses Mengupdate Data!');
        return Redirect::route('bannerLinkEdit',$req['id_banner']);
    }

    public function deleteBanner($id_banner){
        $banner = DB::table('t_banner_link')
            ->select('*')
            ->where('id_banner','=',$id_banner)
            ->first();

        //Delete file image
        Storage::delete('uploads/banner_link/'.$banner->file);

        DB::table('t_banner_link')->where('id_banner','=', $id_banner)->delete();

        session()->flash('msg', 'Sukses Menghapus Data!');
        return Redirect::route('bannerLink');
    }


}
