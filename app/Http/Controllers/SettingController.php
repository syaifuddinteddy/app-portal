<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class SettingController extends Controller{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function showSetting(){

        $profile = DB::table('profil_dinas')
            ->select('*')
            ->first();

        return view('admin.contents.settings.form_setting')
            ->with('profile',$profile);
    }

    public function updateSetting(Request $req){

        DB::table('profil_dinas')
            ->where('id_profile','=', $req['id_profile'])
            ->update([
                'nama_dinas' => $req['nama_dinas'],
                'alamat' =>$req['alamat'],
                'telp' => $req['telp'],
                'fax' =>$req['fax'],
                'email' =>$req['email'],
                'facebook' =>$req['facebook'],
                'twitter' =>$req['twitter'],
                'running' =>$req['running'],
                'instagram' => $req['instagram']
            ]);

        session()->flash('msg', 'Berhasil Mengupdate Kontak !');
        return Redirect::route('dinas');
    }
}
