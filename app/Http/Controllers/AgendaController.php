<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Agenda;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Auth;

class AgendaController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth',['except'=>['showListByCategory','getDataKabupatenDetail']]);
    }

    public function showListByCategory(Request $req){

        switch ($req['category']) {

            case 'pemerintahan' :
                $agendaList = Agenda::where('id_submenu','=', 12)
                    ->where('status','=',1)
                    ->orderBy('id_agenda', 'desc')
                    ->paginate(5);
                break;
            case 'masyarakat':
                $agendaList = Agenda::where('id_submenu','=', 13)
                    ->where('status','=',1)
                    ->orderBy('id_agenda', 'desc')
                    ->paginate(5);

                break;
            default :
                $req['category'] = 'kabupaten';
                $agendaList = Agenda::where('id_submenu','=', 11)
                    ->where('status','=',1)
                    ->orderBy('id_agenda', 'desc')
                    ->paginate(5);
        }

        return view('portal.contents.agendaList')
            ->with('category',$req['category'])
            ->with('agendaList', $agendaList);
    }


    public function getDataKabupatenDetail($id_agenda){
        $agenda = Agenda::where('id_agenda','=',$id_agenda) //jika data tidak ditemukan, maka terlihat error
            ->first();

        return view('portal.contents.agendaDetail')
            ->with('agenda',$agenda)
            ->with('submenuId', $agenda->id_submenu);
    }


    // Kabupaten
    public function showListDataKabupaten(){
        $agenda = Agenda::where('id_submenu',11)->orderBy('id_agenda', 'desc')->get();

        return view('admin.contents.agenda.kabupaten')
            ->with('agenda', $agenda)
            ->with('submenuId', 11)
            ->with('menu_sub', null);
    }

    public function showFormAddKabupaten($id_submenu){

        return view('admin.contents.agenda.form_agenda')
            ->with('formType', 'add')
            ->with('submenuId', $id_submenu)
            ->with('agenda', null);
    }

    public function saveDataKabupaten(Request $req) {
        $setId = Agenda::orderByDesc('id_agenda')->first();

        //cek id_submenu untuk redirect
        $id_submenu = $req['id_submenu'];

        $agenda = new Agenda();
        $agenda->id_agenda = $setId != null ? $setId->id_agenda + 1 : 1;
        $agenda->id_user = Auth::user()->id_user;
        $agenda->id_submenu = $req['id_submenu'];
        $agenda->nama_kegiatan = $req['nama_kegiatan'];
        $agenda->nama_kegiatan_eng = $req['nama_kegiatan_eng'];
        $agenda->keterangan_kegiatan = $req['keterangan_kegiatan'];
        $agenda->keterangan_kegiatan_eng = $req['keterangan_kegiatan_eng'];
        $agenda->tempat = $req['tempat'];
        $agenda->waktu = $req['waktu'];
        $agenda->tgl_mulai = date_format(date_create($req['tgl_mulai']), 'Y-m-d');
        $agenda->tgl_akhir = date_format(date_create($req['tgl_akhir']), 'Y-m-d');
        $agenda->tgl_entri = date_format(now(), 'Y-m-d');
        $agenda->status = 1;
        $agenda->save();

        if ($agenda) {
            session()->flash('msg', 'Berhasil Menambahkan Agenda !');
        } else {
            session()->flash('msg_error', 'Gagal Menambahkan Agenda !');
        }

        if ($id_submenu == 11) {
            return Redirect::route('agendaKabupaten');
        } elseif ($id_submenu == 12) {
            return Redirect::route('agendaPemerintahan');
        } elseif ($id_submenu == 13) {
            return Redirect::route('agendaMasyarakat');
        }
    }

    public function getDataKabupaten($id_agenda){
        $agenda = Agenda::where('id_agenda','=',$id_agenda) //jika data tidak ditemukan, maka terlihat error
            ->first();

        return view('admin.contents.agenda.form_agenda')
            ->with('agenda',$agenda)
            ->with('formType', 'edit')
            ->with('submenuId', $agenda->id_submenu);
    }

    public function updateDataKabupaten(Request $req){

        Agenda::where('id_agenda','=',$req['id_agenda'])
            ->update([
                'nama_kegiatan'=>$req['nama_kegiatan'],
                'nama_kegiatan_eng'=>$req['nama_kegiatan_eng'],
                'keterangan_kegiatan'=>$req['keterangan_kegiatan'],
                'keterangan_kegiatan_eng'=>$req['keterangan_kegiatan_eng'],
                'tempat'=>$req['tempat'],
                'waktu'=>$req['waktu'],
                'tgl_mulai'=> date_format(date_create($req['tgl_mulai']), 'Y-m-d'),
                'tgl_akhir'=> date_format(date_create($req['tgl_akhir']), 'Y-m-d'),
            ]);

        session()->flash('msg', 'Sukses Mengupdate Data!');
        return Redirect::route('agendaKabupatenEdit',$req['id_agenda']);
    }

    public function deleteDataKabupaten($id_agenda){
        $agenda = Agenda::findOrFail($id_agenda); //jika data tidak ditemukan, maka 404
        $id_submenu = $agenda->id_submenu;
        $agenda->delete();
        //Agenda::where('id_agenda','=',$id_agenda)->delete();

        session()->flash('msg', 'Berhasil Menghapus Agenda !');
        if ($id_submenu == 11) {
            return Redirect::route('agendaKabupaten');
        } elseif ($id_submenu == 12) {
            return Redirect::route('agendaPemerintahan');
        } elseif ($id_submenu == 13) {
            return Redirect::route('agendaMasyarakat');
        }
    }

    // Pemerintahan
    public function showListDataPemerintahan(){
        $agenda = Agenda::where('id_submenu',12)->orderBy('id_agenda', 'desc')->get();

        return view('admin.contents.agenda.kabupaten')
            ->with('agenda',$agenda)
            ->with('submenuId', 12);
    }

    // Masyarakat
    public function showListDataMasyarakat(){
        $agenda = Agenda::where('id_submenu',13)->orderBy('id_agenda', 'desc')->get();

        return view('admin.contents.agenda.kabupaten')
            ->with('agenda',$agenda)
            ->with('submenuId', 13);
    }
}
