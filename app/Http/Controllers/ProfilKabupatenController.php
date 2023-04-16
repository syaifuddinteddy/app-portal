<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Profile;
use Illuminate\Support\Facades\DB;

class ProfilKabupatenController extends Controller
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
            ->whereIn('id_submenu',[1,2,3,4,5])
            ->orderBy('id_submenu', 'asc')
            ->get();

        $narasi = Profile::where('id_submenu','=', $req['category'])
            ->where('status','=',1)
            ->get();

        return view('portal.contents.profileKabupaten')
            ->with('category',$req['category'])
            ->with('narasi',$narasi)
            ->with('profileKabupaten', $profile);
    }

    // update data profile (Global)
    public function updateDataSejarah(Request $request) {
        // update data profile
        Profile::where('id_submenu',$request->id)->update([
            'judul' => $request->judul,
            'judul_eng' => $request->judul_eng,
            'narasi' => $request->narasi,
            'narasi_eng' => $request->narasi_eng
        ]);

        // alihkan halaman ke halaman profile
        if ( $request->id == 1 ):
            return redirect('/profilSejarah');
        elseif ( $request->id == 2 ):
            return redirect('/profilGeografi');
        elseif ( $request->id == 3 ):
            return redirect('/profilDemografi');
        elseif ( $request->id == 4 ):
            return redirect('/profilSosialEkonomi');
        elseif ( $request->id == 5 ):
            return redirect('/profilPrestasi');
        endif;
    }

    //======================= Sejarah =======================
    public function showFormSejarah(){

        $profile = Profile::where('id_submenu',1)->get();

        return view('admin.contents.profil_kabupaten.sejarah')
            ->with('profile',$profile);
    }

    //======================= Sejarah =======================

    //======================= Geografi =======================
    public function showFormGeografi(){

        $profile = Profile::where('id_submenu',2)->get();

        return view('admin.contents.profil_kabupaten.geografi')
            ->with('profile',$profile);
    }
    //======================= Geografi =======================

    //======================= Demografi =======================
    public function showFormDemografi(){

        $profile = Profile::where('id_submenu',3)->get();

        return view('admin.contents.profil_kabupaten.demografi')
            ->with('profile',$profile);
    }
    //======================= Demografi =======================

    //======================= Sosial Ekonomi =======================
    public function showFormSosialEkonomi(){

        $profile = Profile::where('id_submenu',4)->get();

        return view('admin.contents.profil_kabupaten.sosialekonomi')
            ->with('profile',$profile);
    }
    //======================= Sosial Ekonomi =======================

    //======================= Prestasi =======================
    public function showFormPrestasi(){

        $profile = Profile::where('id_submenu',5)->get();

        return view('admin.contents.profil_kabupaten.prestasi')
            ->with('profile',$profile);
    }
    //======================= Prestasi =======================




    //======================= Visi Misi =======================
    public function showFormVisiMisi(){

        $profile = Profile::where('id_submenu',8)->get();

        return view('admin.contents.profil_pemerintah.visimisi')
            ->with('profile',$profile);
    }
    //======================= Visi Misi =======================

    //======================= Legislatif =======================
    public function showFormLegislatif(){

        $profile = Profile::where('id_submenu',9)->get();

        return view('admin.contents.profil_pemerintah.legislatif')
            ->with('profile',$profile);
    }
    //======================= Legislatif =======================
}
