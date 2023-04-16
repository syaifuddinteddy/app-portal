<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class GaleriFotoController extends Controller{


    public function __construct()
    {
        $this->middleware('auth');
    }

    public function showListAlbum(){
        $album = DB::table('t_album_foto')
            ->select('*')
            ->orderByDesc('tgl_entri')
            ->get();

        return view('admin.contents.foto.list_foto')
            ->with('album', $album);
    }

    public function addAlbum(){

        return view('admin.contents.foto.form_foto')
            ->with('album', null)
            ->with('foto', null);
    }

    public function saveAlbum(Request $req){

        $setId = DB::table('t_album_foto')
            ->select('id_album')
            ->orderByDesc('id_album')
            ->first();

        DB::table('t_album_foto')
            ->insert([
                'id_album' => $setId->id_album + 1,
                'id_user' => Auth::user()->id_user,
                'tgl_entri' => date('Y-m-d'),
                'nama_album'=>$req['nama_album'],
                'nama_album_eng'=>$req['nama_album_eng'],
                'status' => 1
            ]);

        session()->flash('msg', 'Sukses Menyimpan Data!');
        return Redirect::route('galleryFoto');
    }

    public function editAlbum($id_album){

        $album = DB::table('t_album_foto')
            ->where('id_album','=', $id_album)
            ->first();
        $foto = DB::select('
                    SELECT
                    foto.id_foto,
                    foto.file
                    FROM
                    "public".t_galeri_foto AS foto
                    INNER JOIN "public".t_album_foto AS album ON foto.id_album = album.id_album
                    WHERE
                    album.id_album = ?', [$id_album]);

        return view('admin.contents.foto.form_foto')
            ->with('album', $album)
            ->with('foto', $foto);

    }

    public function updateMetaAlbum(Request $req){
        DB::table('t_album_foto')
            ->where('id_album','=', $req['id_album'])
            ->update([
                'nama_album'=>$req['nama_album'],
                'nama_album_eng'=>$req['nama_album_eng'],
            ]);

        session()->flash('msg', 'Sukses Mengupdate Data!');
        return Redirect::route('galleryFotoEdit', $req['id_album'] );
    }

    public function deleteAlbumFoto($id_album){
        DB::table('t_album_foto')
            ->where('id_album','=', $id_album)
            ->delete();

        DB::table('t_galeri_foto')
            ->where('id_album','=', $id_album)
            ->delete();
        session()->flash('msg', 'Sukses Menghapus Data Album !');
        return Redirect::route('galleryFoto');
    }


    /**
     * BULK UPLOAD FOTO
     */

    public function processUploadFoto(Request $request){


        $path = storage_path('app/public/uploads/album');

        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }

        $file = $request->file('file');

        $name = uniqid() . '_' . trim($file->getClientOriginalName());

        $file->move($path, $name);

        return response()->json([
            'name'          => $name,
            'original_name' => $file->getClientOriginalName(),
        ]);

    }

    public function saveUploadedFotoData(Request $req){

        $getLastId = DB::table('t_galeri_foto')
            ->orderByDesc('id_foto')
            ->first();

        foreach ($req->input('foto',[]) as $idx => $file ){
            $idx = $idx + 1;
            DB::table('t_galeri_foto')
                ->insert([
                    'id_foto' => $getLastId->id_foto + $idx,
                    'id_user' => Auth::user()->id_user,
                    'id_album' => $req['id_album'],
                    'tgl_entri' => date('Y-m-d'),
                    'tag_foto' => null,
                    'keterangan_foto' => '',
                    'file' => $file,
                    'status' => 1
                ]);

        }

        // redirect
        Session::flash('msg', 'Sukses Menambahkan Foto !');
        return Redirect::route('galleryFotoEdit', $req['id_album'] );
    }

    public function deleteFoto($id_album, $id_foto){
        DB::table('t_galeri_foto')
            ->where('id_foto','=',$id_foto)
            ->delete();

        // redirect
        Session::flash('msg', 'Sukses Menghapus Foto !');
        return Redirect::route('galleryFotoEdit', $id_album );
    }

}
