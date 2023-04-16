<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class InformasiController extends Controller{
    public function __construct(){
        $this->middleware('auth');
    }
    public function showListInformasi(){
       $dtInformasi = DB::table('t_informasi_terkini')
            ->select(['id_informasi_terkini','tgl_entri','nama_informasi_terkini',
                'tgl_mulai','tgl_akhir','tempat','waktu','status'])
            ->orderByDesc('tgl_entri')
            ->get();

        return view('admin.contents.informasi.list_informasi')
            ->with('informasi', $dtInformasi);
    }

    public function addInformasi(){
        return view('admin.contents.informasi.form_informasi')
            ->with('informasi', null);
    }

    public function saveInformasi(Request $req){
        $setId = DB::table('t_informasi_terkini')
            ->select('id_informasi_terkini')
            ->orderByDesc('id_informasi_terkini')
            ->first();

        DB::table('t_informasi_terkini')
            ->insert([
                'id_informasi_terkini' => $setId->id_informasi_terkini + 1,
                'id_user' => Auth::user()->id_user,
                'tgl_entri' => date('Y-m-d'),
                'nama_informasi_terkini' => $req['nama_informasi_terkini'],
                'nama_informasi_terkini_eng' => $req['nama_informasi_terkini_eng'],
                'keterangan_informasi_terkini' => $req['keterangan_informasi_terkini'],
                'keterangan_informasi_terkini_eng' => $req['keterangan_informasi_terkini_eng'],
                'tgl_mulai' => date_format(date_create($req['tgl_mulai']), 'Y-m-d'),
                'tgl_akhir' => date_format(date_create($req['tgl_akhir']), 'Y-m-d'),
                'tempat' => $req['tempat'],
                'waktu' => $req['waktu'],
                'status' => 1
            ]);

        session()->flash('msg', 'Sukses Menyimpan Data!');
        return Redirect::route('informasiTerkini');
    }


    public function editInformasi($id_informasi_terkini){
        $informasi = DB::table('t_informasi_terkini')
            ->where('id_informasi_terkini','=', $id_informasi_terkini)
            ->first();

        return view('admin.contents.informasi.form_informasi')
            ->with('informasi', $informasi);
    }

    public function updateInformasi(Request $req){
        DB::table('t_informasi_terkini')
            ->where('id_informasi_terkini','=', $req['id_informasi_terkini'])
            ->update([
                'id_user' => Auth::user()->id_user,
                'tgl_entri' => date('Y-m-d'),
                'nama_informasi_terkini' => $req['nama_informasi_terkini'],
                'nama_informasi_terkini_eng' => $req['nama_informasi_terkini_eng'],
                'keterangan_informasi_terkini' => $req['keterangan_informasi_terkini'],
                'keterangan_informasi_terkini_eng' => $req['keterangan_informasi_terkini_eng'],
                'tgl_mulai' => date_format(date_create($req['tgl_mulai']), 'Y-m-d'),
                'tgl_akhir' => date_format(date_create($req['tgl_akhir']), 'Y-m-d'),
                'tempat' => $req['tempat'],
                'waktu' => $req['waktu'],
                'status' => 1
            ]);

        session()->flash('msg', 'Sukses Menyimpan Data!');
        return Redirect::route('informasiTerkiniEdit',$req['id_informasi_terkini']);
    }

    public function deleteInformasi($id_informasi_terkini){

        DB::table('t_informasi_terkini')
            ->where('id_informasi_terkini','=', $id_informasi_terkini)
            ->delete();

        session()->flash('msg', 'Sukses Menghapus Data!');
        return Redirect::route('informasiTerkini');
    }


}
