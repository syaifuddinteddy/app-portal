<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class VideoController extends Controller{

    public function __construct() {
        $this->middleware('auth');
    }

    public function showListVideo(){
        $video = DB::table('t_galeri_video')
            ->select('*')
            ->orderByDesc('tgl_entri')
            ->get();

        return view('admin.contents.video.list_video')
            ->with('video', $video);
    }

    public function addVideo(){
        return view('admin.contents.video.form_video')
            ->with('video', null);
    }

    public function saveVideo(Request $req){

        $setId = DB::table('t_galeri_video')
            ->select('id_video')
            ->orderByDesc('id_video')
            ->first();

        DB::table('t_galeri_video')
            ->insert([
                'id_video' => $setId->id_video + 1,
                'id_user' => Auth::user()->id_user,
                'tgl_entri' => date('Y-m-d'),
                'judul_video' => $req['judul_video'],
                'keterangan_video' => $req['keterangan_video'],
                'url' => $req['url'],
                'status' => 1
            ]);

        session()->flash('msg', 'Sukses Menyimpan Data!');
        return Redirect::route('galleryVideo');
    }

    public function editVideo($id_video){
        $video = DB::table('t_galeri_video')
            ->where('id_video','=', $id_video)
            ->first();

        return view('admin.contents.video.form_video')
            ->with('video', $video);
    }

    public function updateVideo(Request $req){
        DB::table('t_galeri_video')
            ->where('id_video','=', $req['id_video'])
            ->update([
                'id_user' => Auth::user()->id_user,
                'tgl_entri' => date('Y-m-d'),
                'judul_video' => $req['judul_video'],
                'keterangan_video' => $req['keterangan_video'],
                'url' => $req['url'],
                'status' => $req['status']
            ]);
        session()->flash('msg', 'Sukses Mengupdate Data!');
        return Redirect::route('galleryVideoEdit', $req['id_video']);
    }

    public function deleteVideo($id_video){
        DB::table('t_galeri_video')
            ->where('id_video','=', $id_video)
            ->delete();

        session()->flash('msg', 'Sukses Menghapus Data!');
        return Redirect::route('galleryVideo');
    }

}
