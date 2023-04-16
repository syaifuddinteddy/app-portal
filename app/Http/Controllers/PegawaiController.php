<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Pegawai;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;

class PegawaiController extends Controller
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

    public function showListDataPegawai(){
        $pegawai = DB::table('v_user')->get();
        return view('admin.contents.users.list_user')
            ->with('pegawai',$pegawai);
    }

    public function showFormAddPegawai(){

        $optUserCategory = $this->fetchAllUserCategory();

        return view('admin.contents.users.form_user')
            ->with('optUserCategory',$optUserCategory)
            ->with('formType', 'add')
            ->with('pegawai', null);
    }

    public function saveDataPegawai(Request $req)
    {
        $setId = Pegawai::orderByDesc('id_pegawai')->first();

        $pegawai = new Pegawai();
        $pegawai->id_pegawai = $setId != null ? $setId->id_pegawai + 1 : 1;
        $pegawai->nip = $req['nip'];
        $pegawai->nama_lengkap = $req['nama_lengkap'];
        $pegawai->alamat = $req['alamat'];
        $pegawai->no_telp = $req['no_telp'];
        $pegawai->tempat_lahir = $req['tempat_lahir'];
        $pegawai->tgl_lahir = date_format(date_create($req['tgl_lahir']), 'Y-m-d');
        $pegawai->pangkat = $req['pangkat'];
        $pegawai->jabatan = $req['jabatan'];
        $pegawai->skpd = $req['skpd'];
        $pegawai->save();

        if ($pegawai->id_pegawai) {
            $setIdUser = User::orderByDesc('id_user')->first();

            $user = new User();
            $user->id_user = $setIdUser != null ? $setIdUser->id_user + 1 : 1;
            $user->id_pegawai = $pegawai->id_pegawai;
            $user->id_kategori_user = $req['id_kategori_user'];
            $user->username = $req['username'];
            $user->password = Hash::make($req['password']);
            $user->status = 1;
            $user->save();

            if ($user) {
                session()->flash('msg', 'Berhasil Menambahkan User !');
            } else {
                session()->flash('msg_error', 'Gagal Menambahkan User !');
            }
        } else {
            session()->flash('msg_error', 'Gagal Menambahkan Data Pegawai !');
        }

        return Redirect::route('pegawai');
    }

    public function deleteDataPegawai($id_pegawai){
        Pegawai::where('id_pegawai','=',$id_pegawai)->delete();
        User::where('id_pegawai','=', $id_pegawai)->delete();

        session()->flash('msg', 'Berhasil Menghapus User !');
        return Redirect::route('pegawai');
    }

    public function getDataPegawai($id_pegawai){
        $pegawai = DB::table('v_user')
            ->where('id_pegawai','=',$id_pegawai)
            ->first();

        $optUserCategory = $this->fetchAllUserCategory();

        return view('admin.contents.users.form_user')
            ->with('pegawai',$pegawai)
            ->with('formType', 'edit')
            ->with('optUserCategory',$optUserCategory);
    }

    public function updateDataPegawai(Request $req){

        Pegawai::where('id_pegawai','=',$req['id_pegawai'])
            ->update([
                'nip'=>$req['nip'],
                'nama_lengkap'=>$req['nama_lengkap'],
                'alamat'=>$req['alamat'],
                'no_telp'=>$req['no_telp'],
                'tempat_lahir'=>$req['tempat_lahir'],
                'tgl_lahir'=> date_format(date_create($req['tgl_lahir']), 'Y-m-d'),
                'pangkat'=>$req['pangkat'],
                'jabatan'=>$req['jabatan'],
                'skpd'=>$req['skpd']
            ]);

        User::where('id_pegawai','=',$req['id_pegawai'])
            ->update([
                'username'=>$req['username'],
                'password'=> Hash::make($req['password']),
                'id_kategori_user'=>$req['id_kategori_user'],
                'status'=>$req['status']
            ]);

        session()->flash('msg', 'Sukses Mengupdate Data!');
        return Redirect::route('pegawaiEdit',$req['id_pegawai']);
    }

    function fetchAllUserCategory(){
        return DB::table('m_kategori_user')
            ->select('*')
            ->get();
    }
}
