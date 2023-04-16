<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class MediaController extends Controller
{
    /** ============== Web Portal ============== **/

    public function getAllGaleriFoto(Request $req){
        $menuInfo  = DB::table('t_album_foto')
            ->where('status','=', 1)
            ->get();

        if ($req['id'] != null){
            $detailInfo = $this->getDetailInformasi($req['id']);
        }else{
            $detailInfo = null;
        }

        return view('portal.contents.galerifoto')
            ->with('mn_informasi', $menuInfo)
            ->with('detailInformasi', $detailInfo);
    }

    public function getDetailInformasi($id){
        return DB::table('t_galeri_foto')
            ->where('id_album','=', $id)
            ->get();
    }

    public function getAllGaleriVideo(){
        $video = DB::table('t_galeri_video')
            ->select('*')
            ->orderByDesc('tgl_entri')
            ->paginate(10);

        return view('portal.contents.galerivideo')
            ->with('video', $video);
    }

    public function getDetailGaleriVideo($id_video){
        $video = DB::table('t_galeri_video')
            ->where('id_video','=',$id_video)
            ->first();

        if($video != null){
            return view('portal.contents.galerivideoDetail')
                ->with('video',$video);
        }else{
            return Redirect::route('galeriVideo');
        }
    }

    /** ============== Web Portal ============== **/
}
