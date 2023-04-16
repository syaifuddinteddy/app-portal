<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Berita;
use App\Investasi;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Auth;

class BeritaController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth',['except'=>['getListArtikel','getDetailArtikel']]);
    }

    public function getListArtikel(){
        $berita = Berita::orderByDesc('tgl_entri')
            ->where('status','=',1)
            ->paginate(5);

        return view('portal.contents.beritaList')
            ->with('berita',$berita);
    }

    public function getDetailArtikel($id_berita){
        $berita = DB::table('t_berita')
            ->select(['t_berita.* as berita','m_pegawai.nama_lengkap as editor'])
            ->join('t_user_portal','t_user_portal.id_user','=','t_berita.id_user')
            ->join('m_pegawai','m_pegawai.id_pegawai','=','t_user_portal.id_pegawai')
            ->where('t_berita.id_berita','=',$id_berita)
            ->first();

        if($berita != null){
            return view('portal.contents.beritaDetail')
                ->with('berita',$berita);
        }else{
            return Redirect::route('berita');
        }


    }

    public function showListArtikel(){
        $berita = Berita::orderBy('id_berita', 'desc')->get();

        return view('admin.contents.berita.artikel')
            ->with('berita', $berita);
    }

    public function showFormAddArtikel(){
        return view('admin.contents.berita.form_artikel')
            ->with('formType', 'add')
            ->with('berita', null);
    }

    public function saveDataArtikel(Request $req) {
        $setId = Berita::orderByDesc('id_berita')->first();

        $pathFolder = storage_path('app/public/uploads/berita');

        if (!file_exists($pathFolder)) {
            mkdir($pathFolder, 0777, true);
        }

        $file =$req->file('file');
        $fileName =  uniqid() . '_' . trim($file->getClientOriginalName());
        $file->move($pathFolder, $fileName);

        $berita = new Berita();
        $berita->id_berita = $setId != null ? $setId->id_berita + 1 : 1;
        $berita->id_user = Auth::user()->id_user;
        $berita->tgl_entri = date_format(now(), 'Y-m-d');
        $berita->tgl_berita = date_format(date_create($req['tgl_berita']), 'Y-m-d');
        $berita->judul = $req['judul'];
        $berita->judul_eng = $req['judul_eng'];
        $berita->file = $fileName;
        $berita->narasi = $req['narasi'];
        $berita->narasi_eng = $req['narasi_eng'];
        $berita->status = $req['status'];
        $berita->save();

        if ($berita) {
            session()->flash('msg', 'Berhasil Menambahkan Data !');
        } else {
            session()->flash('msg_error', 'Gagal Menambahkan Data !');
        }

        return Redirect::route('artikel');
    }

    public function getDataArtikel($id_berita){
        $berita = Berita::where('id_berita','=',$id_berita) //jika data tidak ditemukan, maka terlihat error
            ->first();

        return view('admin.contents.berita.form_artikel')
            ->with('berita',$berita)
            ->with('formType', 'edit');
    }

    public function updateDataArtikel(Request $req){
        if($req->file() != null){
            $pathFolder = storage_path('app/public/uploads/berita');

            //Delete file image
            Storage::delete('app/public/uploads/berita/'.$req['fileName']);

            if (!file_exists($pathFolder)) {
                mkdir($pathFolder, 0777, true);
            }

            $file =$req->file('file');
            $fileName =  uniqid() . '_' . trim($file->getClientOriginalName());
            $file->move($pathFolder, $fileName);
        }

        Berita::where('id_berita','=',$req['id_berita'])
            ->update([
                'tgl_berita'=> date_format(date_create($req['tgl_berita']), 'Y-m-d'),
                'judul'=>$req['judul'],
                'judul_eng'=>$req['judul_eng'],
                'file' => $req->file != null ? $fileName : $req['fileName'],
                'narasi'=>$req['narasi'],
                'narasi_eng'=>$req['narasi_eng'],
                'status'=>$req['status'],
            ]);

        session()->flash('msg', 'Sukses Mengupdate Data!');
        return Redirect::route('artikelEdit',$req['id_berita']);
    }

    public function deleteDataArtikel($id_berita){
        Berita::where('id_berita','=',$id_berita)->delete();

        session()->flash('msg', 'Berhasil Menghapus Data !');
        return Redirect::route('artikel');
    }

    public function showListInvestasi(){
        $investasi = Investasi::orderBy('id_investasi', 'desc')->get();

        return view('admin.contents.berita.investasi')
            ->with('investasi', $investasi);
    }

    public function showFormAddInvestasi(){
        return view('admin.contents.berita.form_investasi')
            ->with('formType', 'add')
            ->with('investasi', null);
    }

    public function saveDataInvestasi(Request $req) {
        $setId = Investasi::orderByDesc('id_investasi')->first();

        $pathFolder = storage_path('app/public/uploads/berita');

        if (!file_exists($pathFolder)) {
            mkdir($pathFolder, 0777, true);
        }

        $file =$req->file('file');
        $fileName =  uniqid() . '_' . trim($file->getClientOriginalName());
        $file->move($pathFolder, $fileName);

        $investasi = new Investasi();
        $investasi->id_investasi = $setId != null ? $setId->id_investasi + 1 : 1;
        $investasi->id_user = Auth::user()->id_user;
        //$investasi->tgl_investasi = date_format(date_create($req['tgl_investasi']), 'Y-m-d');
        $investasi->judul = $req['judul'];
        $investasi->judul_eng = $req['judul_eng'];
        $investasi->file = $fileName;
        $investasi->narasi = $req['narasi'];
        $investasi->narasi_eng = $req['narasi_eng'];
        $investasi->save();

        if ($investasi) {
            session()->flash('msg', 'Berhasil Menambahkan Data !');
        } else {
            session()->flash('msg_error', 'Gagal Menambahkan Data !');
        }

        return Redirect::route('investasi');
    }

    public function getDataInvestasi($id_investasi){
        $investasi = Investasi::where('id_investasi','=',$id_investasi) //jika data tidak ditemukan, maka terlihat error
            ->first();

        return view('admin.contents.berita.form_investasi')
            ->with('investasi',$investasi)
            ->with('formType', 'edit');
    }

    public function updateDataInvestasi(Request $req){
        if($req->file() != null){
            $pathFolder = storage_path('app/public/uploads/berita');

            //Delete file image
            Storage::delete('app/public/uploads/berita/'.$req['$fileName']);

            if (!file_exists($pathFolder)) {
                mkdir($pathFolder, 0777, true);
            }

            $file =$req->file('file');
            $fileName =  uniqid() . '_' . trim($file->getClientOriginalName());
            $file->move($pathFolder, $fileName);
        }

        Investasi::where('id_investasi','=',$req['id_investasi'])
            ->update([
                'tgl_investasi'=> date_format(date_create($req['tgl_investasi']), 'Y-m-d'),
                'judul'=>$req['judul'],
                'judul_eng'=>$req['judul_eng'],
                'file'=>$req['file'],
                'narasi'=>$req['narasi'],
                'narasi_eng'=>$req['narasi_eng'],
            ]);

        session()->flash('msg', 'Sukses Mengupdate Data!');
        return Redirect::route('investasiEdit',$req['id_investasi']);
    }

    public function deleteDataInvestasi($id_investasi){
        Investasi::where('id_investasi','=',$id_investasi)->delete();

        session()->flash('msg', 'Berhasil Menghapus Data !');
        return Redirect::route('investasi');
    }
}
