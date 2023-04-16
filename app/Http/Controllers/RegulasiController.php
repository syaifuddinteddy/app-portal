<?php

namespace App\Http\Controllers;
use App\Regulasi;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class RegulasiController extends Controller
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

    public function showListRegulasi(){
        $regulasi = Regulasi::orderBy('id_file', 'desc')->get();

        return view('admin.contents.regulasi.regulasi')
            ->with('regulasi', $regulasi);
    }

    public function showFormAddRegulasi(){
        return view('admin.contents.regulasi.form_regulasi')
            ->with('formType', 'add')
            ->with('regulasi', null);
    }
    
    public function saveDataRegulasi(Request $req) {
        $setId = Regulasi::orderByDesc('id_file')->first();

        $regulasi = new Regulasi();
        $regulasi->id_file = $setId != null ? $setId->id_file + 1 : 1;
        $regulasi->id_user = Auth::user()->id_user;
        //$regulasi->tgl_entri = date_format(date_create($req['tgl_entri']), 'Y-m-d');
        $regulasi->nama_file = $req['nama_file'];
        $regulasi->keterangan_file = $req['keterangan_file'];
        $regulasi->status = $req['status'];
        $regulasi->file = $req['file'];
        $regulasi->nama_file_eng = $req['nama_file_eng'];
        $regulasi->keterangan_file_eng = $req['keterangan_file_eng'];
        $regulasi->save();

        if ($regulasi) {
            session()->flash('msg', 'Berhasil Menambahkan Data !');
        } else {
            session()->flash('msg_error', 'Gagal Menambahkan Data !');
        }

        return Redirect::route('regulasi');
    }

    public function getDataRegulasi($id_file){
        $regulasi = Regulasi::where('id_file','=',$id_file) //jika data tidak ditemukan, maka terlihat error
            ->first();

        return view('admin.contents.regulasi.form_regulasi')
            ->with('regulasi',$regulasi)
            ->with('formType', 'edit');
    }

    public function updateDataRegulasi(Request $req){

        Regulasi::where('id_file','=',$req['id_file'])
            ->update([
                'tgl_entri'=> date_format(date_create($req['tgl_entri']), 'Y-m-d'),
                'nama_file'=>$req['nama_file'],
                'keterangan_file'=>$req['keterangan_file'],
                'status'=>$req['status'],
                'file'=>$req['file'],
                'nama_file_eng'=>$req['nama_file_eng'],
                'keterangan_file_eng'=>$req['keterangan_file_eng'],
            ]);

        session()->flash('msg', 'Sukses Mengupdate Data!');
        return Redirect::route('regulasiEdit',$req['id_file']);
    }

    public function deleteDataRegulasi($id_file){
        Regulasi::where('id_file','=',$id_file)->delete();

        session()->flash('msg', 'Berhasil Menghapus Data !');
        return Redirect::route('regulasi');
    }
}
