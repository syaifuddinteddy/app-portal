<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Profile;
use App\Kinerja;
use App\Info_Pegawai;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Auth;

class ProfilPemerintahController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['getAllProfile']]);
    }

    public function getAllProfile(Request $req){
        $profile =  DB::table('t_profile')
            ->whereIn('id_submenu',[6,7,8,9,10])
            ->orderBy('id_submenu', 'asc')
            ->get();

        $narasi = Profile::where('id_submenu','=', $req['category'])
            ->where('status','=',1)
            ->get();

        return view('portal.contents.profilePemerintahan')
            ->with('category',$req['category'])
            ->with('narasi',$narasi)
            ->with('profilePemerintahan', $profile);
    }

    public function showListKinerja(){
        $kinerja = Kinerja::orderBy('id_kinerja', 'asc')->get();

        return view('admin.contents.profil_pemerintah.kinerja')
            ->with('kinerja', $kinerja);
    }

    public function showFormAddKinerja(){
        return view('admin.contents.profil_pemerintah.form_kinerja')
            ->with('formType', 'add')
            ->with('kinerja', null);
    }

    public function saveDataKinerja(Request $req) {
        $setId = Kinerja::orderByDesc('id_kinerja')->first();

        $kinerja = new Kinerja();
        $kinerja->id_kinerja = $setId != null ? $setId->id_kinerja + 1 : 1;
        $kinerja->id_user = Auth::user()->id_user;
        $kinerja->judul = $req['judul'];
        $kinerja->tahun = $req['tahun'];
        $kinerja->narasi = $req['narasi'];
        $kinerja->save();

        if ($kinerja) {
            session()->flash('msg', 'Berhasil Menambahkan Data !');
        } else {
            session()->flash('msg_error', 'Gagal Menambahkan Data !');
        }

        return Redirect::route('kinerjaPemerintah');
    }

    public function getDataKinerja($id_kinerja){
        $kinerja = Kinerja::where('id_kinerja','=',$id_kinerja) //jika data tidak ditemukan, maka terlihat error
            ->first();

        return view('admin.contents.profil_pemerintah.form_kinerja')
            ->with('kinerja',$kinerja)
            ->with('formType', 'edit');
    }

    public function updateDataKinerja(Request $req){

        Kinerja::where('id_kinerja','=',$req['id_kinerja'])
            ->update([
                'judul'=>$req['judul'],
                'tahun'=>$req['tahun'],
                'narasi'=>$req['narasi'],
            ]);

        session()->flash('msg', 'Sukses Mengupdate Data!');
        return Redirect::route('kinerjaPemerintahEdit',$req['id_kinerja']);
    }

    public function deleteDataKinerja($id_kinerja){
        Kinerja::where('id_kinerja','=',$id_kinerja)->delete();

        session()->flash('msg', 'Berhasil Menghapus Data !');
        return Redirect::route('kinerjaPemerintah');
    }

    public function showListPegawai(){
        $info_pegawai = Info_Pegawai::orderBy('id_info_pegawai', 'desc')->get();

        return view('admin.contents.profil_pemerintah.info_pegawai')
            ->with('info_pegawai', $info_pegawai);
    }

    public function showFormAddPegawai(){
        return view('admin.contents.profil_pemerintah.form_info_pegawai')
            ->with('formType', 'add')
            ->with('info_pegawai', null);
    }

    public function saveDataPegawai(Request $req) {
        $setId = Info_Pegawai::orderByDesc('id_info_pegawai')->first();

        $info_pegawai = new Info_Pegawai();
        $info_pegawai->id_info_pegawai = $setId != null ? $setId->id_info_pegawai + 1 : 1;
        $info_pegawai->nip = $req['nip'];
        $info_pegawai->nama = $req['nama'];
        $info_pegawai->jabatan = $req['jabatan'];
        $info_pegawai->file_info_pegawai = $req['file_info_pegawai'];
        $info_pegawai->save();

        if ($info_pegawai) {
            session()->flash('msg', 'Berhasil Menambahkan Data !');
        } else {
            session()->flash('msg_error', 'Gagal Menambahkan Data !');
        }

        return Redirect::route('infoPegawai');
    }

    public function getDataPegawai($id_info_pegawai){
        $info_pegawai = Info_Pegawai::where('id_info_pegawai','=',$id_info_pegawai) //jika data tidak ditemukan, maka terlihat error
            ->first();

        return view('admin.contents.profil_pemerintah.form_info_pegawai')
            ->with('info_pegawai',$info_pegawai)
            ->with('formType', 'edit');
    }

    public function updateDataPegawai(Request $req){

        Info_Pegawai::where('id_info_pegawai','=',$req['id_info_pegawai'])
            ->update([
                'nip'=>$req['nip'],
                'nama'=>$req['nama'],
                'jabatan'=>$req['jabatan'],
                'file_info_pegawai'=>$req['file_info_pegawai'],
            ]);

        session()->flash('msg', 'Sukses Mengupdate Data!');
        return Redirect::route('infoPegawaiEdit',$req['id_info_pegawai']);
    }

    public function deleteDataPegawai($id_info_pegawai){
        Info_Pegawai::where('id_info_pegawai','=',$id_info_pegawai)->delete();

        session()->flash('msg', 'Berhasil Menghapus Data !');
        return Redirect::route('infoPegawai');
    }
}
