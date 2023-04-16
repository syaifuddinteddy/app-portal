<?php

namespace App\Http\Controllers;

use App\Berita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index(){


       return view('portal.contents.home')
           ->with('berita', $this->getArtikelBerita())
           ->with('banner', $this->getBanner())
           ->with('agenda',$this->getLatestAgenda())
           ->with('bukutamu',$this->getBukuTamu())
           ->with('info_terkini',$this->getLatestInformasiTerkini());
    }

    public function getBanner(){
        $banner = DB::table('t_banner')
            ->select(['file','keterangan_banner'])
            ->where('status','=',1)
            ->get();

        return $banner;
    }

    public function getArtikelBerita(){
        $berita = Berita::orderByDesc('tgl_entri')
            ->where('status','=',1)
            ->limit(4)
            ->get();

        return $berita;
    }

    public function getLatestAgenda(){
        $agendaKabupaten = DB::table('t_agenda')
            ->where([['id_submenu','=','11'], ['status','=','1']])
            ->orderByDesc('tgl_entri')
            ->limit(2)
            ->get();

        $agendaPemerintahan = DB::table('t_agenda')
            ->where([['id_submenu','=','12'], ['status','=','1']])
            ->orderByDesc('tgl_entri')
            ->limit(2)
            ->get();

        $agendaMasyarakat = DB::table('t_agenda')
            ->where([['id_submenu','=','13'], ['status','=','1']])
            ->orderByDesc('tgl_entri')
            ->limit(2)
            ->get();

        $agenda = [$agendaKabupaten, $agendaPemerintahan, $agendaMasyarakat];

        return $agenda;
    }

    public function getLatestInformasiTerkini(){
        return DB::table('t_informasi_terkini')
            ->orderByDesc('tgl_entri')
            ->limit(2)
            ->get();
    }

    public function getBukuTamu(){
        $banner = DB::table('t_buku_tamu')
            ->orderByDesc('id_bukutamu')
            ->where('status_tampil','=',1)
            ->limit(4)
            ->get();

        return $banner;
    }
}
