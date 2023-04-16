<?php

namespace App\Http\Controllers;
use App\Buku_Tamu;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use Illuminate\Http\Request;

class BukuTamuController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void

    public function __construct()
    {
        $this->middleware('auth');
    } */

    /** ============== Web Portal ============== **/
    public function getAllBukuTamu(){
        $bukutamu =  Buku_Tamu::where('status_tampil','=',1)
        ->orderBy('id_bukutamu', 'desc')
        ->get();

        return view('portal.contents.bukutamu')
            ->with('bukutamu', $bukutamu);
    }

    public function showFormAddBukuTamu(){
    return view('portal.contents.bukutamuForm')
        ->with('bukutamu', null)
        ->with('formType','add');
}

    public function saveDataBukuTamu(Request $req){

        $setId = Buku_Tamu::select('id_bukutamu')->orderByDesc('id_bukutamu')->first();

        $pathFolder = storage_path('app/public/uploads/bukutamu');

        if (!file_exists($pathFolder)) {
            mkdir($pathFolder, 0777, true);
        }

        $file =$req->file('foto');
        $fileName =  uniqid() . '_' . trim($file->getClientOriginalName());
        $file->move($pathFolder, $fileName);


        DB::table('t_buku_tamu')
            ->insert([
                'id_bukutamu' => $setId != null ? $setId->id_bukutamu + 1 : 1,
                'tgl_pesan' => date('Y-m-d'),
                'nama'=>$req['nama'],
                'alamat'=>$req['alamat'],
                'tempat_lahir'=>$req['tempat_lahir'],
                'tgl_lahir'=>date_format(date_create($req['tgl_lahir']), 'Y-m-d'),
                'jenis_kelamin'=>$req['jenis_kelamin'],
                'pekerjaan'=>$req['pekerjaan'],
                'no_hp'=>$req['no_hp'],
                'email'=>$req['email'],
                'foto'=>$fileName,
                'judul_pesan'=>$req['judul_pesan'],
                'pesan'=>$req['pesan'],

                'status_tampil'=>0,
                'status_lihat'=>0
            ]);

        session()->flash('msg', 'Terimakasih atas gagasannya!');
        return Redirect::route('jonegorojengker');
    }
    /** ============== Web Portal ============== **/

    public function showListBukuTamu(){
        $bukutamu = Buku_Tamu::orderBy('id_bukutamu', 'desc')->get();

        return view('admin.contents.media_center.bukutamu')
            ->with('bukutamu', $bukutamu);
    }

    public function getDataBukuTamu($id_bukutamu){
        $bukutamu = Buku_Tamu::where('id_bukutamu','=',$id_bukutamu) //jika data tidak ditemukan, maka terlihat error
            ->first();

        return view('admin.contents.media_center.form_bukutamu')
            ->with('bukutamu',$bukutamu)
            ->with('formType', 'edit');
    }

    public function updateDataBukuTamu(Request $req){

        Buku_Tamu::where('id_bukutamu','=',$req['id_bukutamu'])
            ->update([
                'nama'=>$req['nama'],
                'email'=>$req['email'],
                'pesan'=>$req['pesan'],
                'status_tampil'=>$req['status_tampil'],
                'status_lihat'=>$req['balasan'] == null ? 0 : 1,
                'id_user_approve'=>$req['status_tampil'] == 0 ? null : Auth::user()->id_user,
                'tgl_approve'=>$req['status_tampil'] == 0 ? null : date_format(now(), 'Y-m-d'),
                'balasan'=>$req['balasan'],
                'alamat'=>$req['alamat'],
                'tempat_lahir'=>$req['tempat_lahir'],
                'tgl_lahir'=>date_format(date_create($req['tgl_lahir']), 'Y-m-d'),
                'jenis_kelamin'=>$req['jenis_kelamin'],
                'no_hp'=>$req['no_hp'],
                'pekerjaan'=>$req['pekerjaan'],
            ]);

        session()->flash('msg', 'Sukses Mengupdate Data!');
        return Redirect::route('bukutamuEdit',$req['id_bukutamu']);
    }

    public function deleteDataBukuTamu($id_bukutamu){
        Buku_Tamu::where('id_bukutamu','=',$id_bukutamu)->delete();

        session()->flash('msg', 'Berhasil Menghapus Data !');
        return Redirect::route('bukutamu');
    }
}
