<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/**
 *======================= WEB PORTAL ROUTE ===============================================
 */

Route::get('/', 'PortalController@index')->name('portal');
Route::get('/beranda','HomeController@index')->name('home');
Route::get('/profile/kabupaten','ProfilKabupatenController@getAllProfile')->name('portalProfilKabupaten');
Route::get('/profile/pemerintahan','ProfilPemerintahController@getAllProfile')->name('portalProfilPemerintahan');
Route::get('/informasi','KontenMenuDinamisController@getInformasi')->name('informasi');
Route::get('/agenda', 'AgendaController@showListByCategory')->name('agenda');
Route::get('/agenda/{id_agenda}', 'AgendaController@getDataKabupatenDetail')->name('agendaDetail');
Route::get('/berita', 'BeritaController@getListArtikel')->name('berita');
Route::get('/berita/{id_berita}', 'BeritaController@getDetailArtikel')->name('beritaDetail');
Route::get('/media/bukutamu', 'BukuTamuController@getAllBukuTamu')->name('jonegorojengker');
Route::get('/media/bukutamu/add','BukuTamuController@showFormAddBukuTamu')->name('bukutamuAdd');
Route::post('/media/bukutamu/save','BukuTamuController@saveDataBukuTamu')->name('bukutamuSave');
Route::get('/media/galerifoto', 'MediaController@getAllGaleriFoto')->name('galeriFoto');
Route::get('/media/galerifoto/{id_foto}', 'MediaController@getDetailGaleriFoto')->name('galeriFotoDetail');
Route::get('/media/galerivideo', 'MediaController@getAllGaleriVideo')->name('galeriVideo');
Route::get('/media/galerivideo/{id_video}', 'MediaController@getDetailGaleriVideo')->name('galeriVideoDetail');

/**
 * ==================== END WEB PORTAL ROUTE ============================================
 */


/**
 * ============================ ADMIN PANEL ROUTE ====================================================
 */
Route::get('/login', 'Auth\LoginController@showLoginForm')->name('loginForm');
Route::post('/login','Auth\LoginController@login')->name('login');
Route::get('/logout','Auth\LoginController@logout')->name('logout');
Route::get('/dashboard', 'DashboardController@index')->name('dashboard');


/// Profil Kabupaten
// Sejarah
Route::get('/profilSejarah', 'ProfilKabupatenController@showFormSejarah')->name('profilSejarah.getSejarah');
Route::post('/profilSejarah/store','ProfilKabupatenController@store')->name('profilSejarah.storeSejarah');
Route::post('/profilSejarah/update','ProfilKabupatenController@updateDataSejarah')->name('profilSejarah.updateSejarah');
// Geografi
Route::get('/profilGeografi', 'ProfilKabupatenController@showFormGeografi')->name('profilGeografi.getGeografi');
// Demografi
Route::get('/profilDemografi', 'ProfilKabupatenController@showFormDemografi')->name('profilDemografi.getDemografi');
// SosialEkonomi
Route::get('/profilSosialEkonomi', 'ProfilKabupatenController@showFormSosialEkonomi')->name('profilSosialEkonomi.getSosialEkonomi');
// Prestasi
Route::get('/profilPrestasi', 'ProfilKabupatenController@showFormPrestasi')->name('profilPrestasi.getPrestasi');

/// Profil Pemerintah
// kinerjaPemerintah
Route::get('/kinerjaPemerintah', 'ProfilPemerintahController@showListKinerja')->name('kinerjaPemerintah');
Route::get('/kinerjaPemerintah/add','ProfilPemerintahController@showFormAddKinerja')->name('kinerjaPemerintahAdd');
Route::post('/kinerjaPemerintah/save', 'ProfilPemerintahController@saveDataKinerja')->name('kinerjaPemerintahSave');
Route::get('/kinerjaPemerintah/edit/{id_kinerja}', 'ProfilPemerintahController@getDataKinerja')->name('kinerjaPemerintahEdit');
Route::post('/kinerjaPemerintah/update', 'ProfilPemerintahController@updateDataKinerja')->name('kinerjaPemerintahUpdate');
Route::get('/kinerjaPemerintah/delete/{id_kinerja}', 'ProfilPemerintahController@deleteDataKinerja')->name('kinerjaPemerintahDelete');
// visiMisi
Route::get('/visiMisi', 'ProfilKabupatenController@showFormVisiMisi')->name('visiMisi.getVisiMisi');
// legislatif
Route::get('/legislatif', 'ProfilKabupatenController@showFormLegislatif')->name('legislatif.getlegislatif');
// infoPegawai
Route::get('/infoPegawai', 'ProfilPemerintahController@showListPegawai')->name('infoPegawai');
Route::get('/infoPegawai/add','ProfilPemerintahController@showFormAddPegawai')->name('infoPegawaiAdd');
Route::post('/infoPegawai/save', 'ProfilPemerintahController@saveDataPegawai')->name('infoPegawaiSave');
Route::get('/infoPegawai/edit/{id_info_pegawai}', 'ProfilPemerintahController@getDataPegawai')->name('infoPegawaiEdit');
Route::post('/infoPegawai/update', 'ProfilPemerintahController@updateDataPegawai')->name('infoPegawaiUpdate');
Route::get('/infoPegawai/delete/{id_info_pegawai}', 'ProfilPemerintahController@deleteDataPegawai')->name('infoPegawaiDelete');

/// Agenda
// Kabupaten
Route::get('/agendaKabupaten', 'AgendaController@showListDataKabupaten')->name('agendaKabupaten');
Route::get('/agendaKabupaten/add/{id_submenu}', 'AgendaController@showFormAddKabupaten')->name('agendaKabupatenAdd');
Route::post('/agendaKabupaten/save', 'AgendaController@saveDataKabupaten')->name('agendaKabupatenSave');
Route::get('/agendaKabupaten/edit/{id_agenda}', 'AgendaController@getDataKabupaten')->name('agendaKabupatenEdit');
Route::post('/agendaKabupaten/update', 'AgendaController@updateDataKabupaten')->name('agendaKabupatenUpdate');
Route::get('/agendaKabupaten/delete/{id_agenda}', 'AgendaController@deleteDataKabupaten')->name('agendaKabupatenDelete');
// Pemerintah
Route::get('/agendaPemerintahan', 'AgendaController@showListDataPemerintahan')->name('agendaPemerintahan');
// Masyarakat
Route::get('/agendaMasyarakat', 'AgendaController@showListDataMasyarakat')->name('agendaMasyarakat');

/// Berita
// artikel
Route::get('/artikel', 'BeritaController@showListArtikel')->name('artikel');
Route::get('/artikel/add','BeritaController@showFormAddArtikel')->name('artikelAdd');
Route::post('/artikel/save', 'BeritaController@saveDataArtikel')->name('artikelSave');
Route::get('/artikel/edit/{id_info_pegawai}', 'BeritaController@getDataArtikel')->name('artikelEdit');
Route::post('/artikel/update', 'BeritaController@updateDataArtikel')->name('artikelUpdate');
Route::get('/artikel/delete/{id_info_pegawai}', 'BeritaController@deleteDataArtikel')->name('artikelDelete');
// investasi
Route::get('/investasi', 'BeritaController@showListInvestasi')->name('investasi');
Route::get('/investasi/add','BeritaController@showFormAddInvestasi')->name('investasiAdd');
Route::post('/investasi/save', 'BeritaController@saveDataInvestasi')->name('investasiSave');
Route::get('/investasi/edit/{id_info_pegawai}', 'BeritaController@getDataInvestasi')->name('investasiEdit');
Route::post('/investasi/update', 'BeritaController@updateDataInvestasi')->name('investasiUpdate');
Route::get('/investasi/delete/{id_info_pegawai}', 'BeritaController@deleteDataInvestasi')->name('investasiDelete');

/// Regulasi
// regulasi
Route::get('/galleryFile', 'RegulasiController@showListRegulasi')->name('regulasi');
Route::get('/galleryFile/add','RegulasiController@showFormAddRegulasi')->name('regulasiAdd');
Route::post('/galleryFile/save', 'RegulasiController@saveDataRegulasi')->name('regulasiSave');
Route::get('/galleryFile/edit/{id_info_pegawai}', 'RegulasiController@getDataRegulasi')->name('regulasiEdit');
Route::post('/galleryFile/update', 'RegulasiController@updateDataRegulasi')->name('regulasiUpdate');
Route::get('/galleryFile/delete/{id_info_pegawai}', 'RegulasiController@deleteDataRegulasi')->name('regulasiDelete');

/// Web GIS City
// iconpeta
Route::get('/iconpeta', 'GISController@showListIcon')->name('icon');
Route::get('/iconpeta/add','GISController@showFormAddIcon')->name('iconAdd');
Route::post('/iconpeta/save', 'GISController@saveDataIcon')->name('iconSave');
Route::get('/iconpeta/edit/{id_info_pegawai}', 'GISController@getDataIcon')->name('iconEdit');
Route::post('/iconpeta/update', 'GISController@updateDataIcon')->name('iconUpdate');
Route::get('/iconpeta/delete/{id_info_pegawai}', 'GISController@deleteDataIcon')->name('iconDelete');
// gis
Route::get('/gis', 'GISController@showListPeta')->name('peta');
Route::get('/gis/add','GISController@showFormAddPeta')->name('petaAdd');
Route::post('/gis/save', 'GISController@saveDataPeta')->name('petaSave');
Route::get('/gis/edit/{id_peta_gis}', 'GISController@getDataPeta')->name('petaEdit');
Route::post('/gis/update', 'GISController@updateDataPeta')->name('petaUpdate');
Route::get('/gis/delete/{id_peta_gis}', 'GISController@deleteDataPeta')->name('petaDelete');

/// Media Center
// Jonegoro Jengker
Route::get('/bukuTamu', 'BukuTamuController@showListBukuTamu')->name('bukuTamu');
Route::get('/bukuTamu/edit/{id_bukutamu}', 'BukuTamuController@getDataBukuTamu')->name('bukutamuEdit');
Route::post('/bukuTamu/update', 'BukuTamuController@updateDataBukuTamu')->name('bukutamuUpdate');
Route::get('/bukuTamu/delete/{id_bukutamu}', 'BukuTamuController@deleteDataBukuTamu')->name('bukutamuDelete');

Route::get('/pegawai','PegawaiController@showListDataPegawai')->name('pegawai');
Route::get('/pegawai/add','PegawaiController@showFormAddPegawai')->name('pegawaiAdd');
Route::post('/pegawai/save','PegawaiController@saveDataPegawai')->name('pegawaiSave');
Route::get('/pegawai/edit/{id_pegawai}' ,'PegawaiController@getDataPegawai')->name('pegawaiEdit');
Route::post('/pegawai/update','PegawaiController@updateDataPegawai')->name('pegawaiUpdate');
Route::get('/pegawai/delete/{id_pegawai}','PegawaiController@deleteDataPegawai')->name('pegawaiDelete');

Route::get('/kategoriUser','CategoryController@showListDataKategori')->name('kategoriUser');
Route::get('/kategoriUser/add','CategoryController@showFormAddKategori')->name('kategoriUserAdd');
Route::post('/kategoriUser/save','CategoryController@saveKategori')->name('kategoriUserSave');
Route::get('/kategoriUser/edit/{id_kategori_user}','CategoryController@editKategori')->name('kategoriUserEdit');
Route::post('/kategoriUser/update','CategoryController@updateKategori')->name('kategoriUserUpdate');
Route::get('/kategoriUser/delete/{id_kategori_user}','CategoryController@deleteKategoriHakAkses')->name('kategoriUserDelete');

Route::get('/dinas','SettingController@showSetting')->name('dinas');
Route::post('/dinas/update','SettingController@updateSetting')->name('dinasUpdate');

Route::get('/bannerUtama','BannerController@showListBanner')->name('bannerUtama');
Route::get('/bannerUtama/add','BannerController@addBanner')->name('bannerUtamaAdd');
Route::post('/bannerUtama/save','BannerController@saveBanner')->name('bannerUtamaSave');
Route::get('/bannerUtama/edit/{id_banner}','BannerController@editBanner')->name('bannerUtamaEdit');
Route::post('/bannerUtama/update','BannerController@updateBanner')->name('bannerUtamaUpdate');
Route::get('/bannerUtama/delete/{id_banner}','BannerController@deleteBanner')->name('bannerUtamaDelete');

Route::get('/bannerLink','BannerLinkController@showListBanner')->name('bannerLink');
Route::get('/bannerLink/add','BannerLinkController@showFormBanner')->name('bannerLinkAdd');
Route::post('/bannerLink/save','BannerLinkController@saveBanner')->name('bannerLinkSave');
Route::get('/bannerLink/edit/{id_banner}','BannerLinkController@editBanner')->name('bannerLinkEdit');
Route::post('/bannerLink/update','BannerLinkController@updateBanner')->name('bannerLinkUpdate');
Route::get('/bannerLink/delete/{id_banner}','BannerLinkController@deleteBanner')->name('bannerLinkDelete');

Route::get('/menuDinamis/{slug}','KontenMenuDinamisController@showListKontenMenuDinamis')->name('menuDinamis');
Route::get('/menuDinmais/add/{slug}','KontenMenuDinamisController@showFormAddMenu')->name('menuDinamisAdd');
Route::post('/menuDinamis/save','KontenMenuDinamisController@saveKontenDataMenu')->name('menuDinamisSave');
Route::get('/menuDinamis/edit/{id_menu}','KontenMenuDinamisController@editDataMenu')->name('menuDinamisEdit');
Route::post('/menuDinamis/update','KontenMenuDinamisController@updateDataMenu')->name('menuDinamisUpdate');
Route::get('/menuDinamis/delete/{id_menu}','KontenMenuDinamisController@deleteDataMenu')->name('menuDinamisDelete');

Route::get('/informasi_terkini','InformasiController@showListInformasi')->name('informasiTerkini');
Route::get('/informasi_terkini/add','InformasiController@addInformasi')->name('informasiTerkiniAdd');
Route::post('/informasi_terkini/save','InformasiController@saveInformasi')->name('informasiTerkiniSave');
Route::get('/informasi_terkini/edit/{id_informasi_terkini}','InformasiController@editInformasi')->name('informasiTerkiniEdit');
Route::post('/informasi_terkini/update','InformasiController@updateInformasi')->name('informasiTerkiniUpdate');
Route::get('/informasi_terkini/delete/{id_informasi_terkini}','InformasiController@deleteInformasi')->name('informasiTerkiniDelete');

Route::get('/galleryVideo','VideoController@showListVideo')->name('galleryVideo');
Route::get('/galleryVideo/add','VideoController@addVideo')->name('galleryVideoAdd');
Route::post('/galleryVideo/save','VideoController@saveVideo')->name('galleryVideoSave');
Route::get('/galleryVideo/edit/{id_video}','VideoController@editVideo')->name('galleryVideoEdit');
Route::post('/galleryVideo/update','VideoController@updateVideo')->name('galleryVideoUpdate');
Route::get('/galleryVideo/delete/{id_video}','VideoController@deleteVideo')->name('galleryVideoDelete');

Route::get('/galleryFoto','GaleriFotoController@showListAlbum')->name('galleryFoto');
Route::get('/galleryFoto/add','GaleriFotoController@addAlbum')->name('galleryFotoAdd');
Route::post('/galleryFoto/save','GaleriFotoController@saveAlbum')->name('galleryFotoSave');
Route::get('/galleryFoto/edit/{id_album}','GaleriFotoController@editAlbum')->name('galleryFotoEdit');
Route::post('/galleryFoto/update','GaleriFotoController@updateMetaAlbum')->name('galleryFotoUpdate');
Route::get('/galleryFoto/delete/{id_album}','GaleriFotoController@deleteAlbumFoto')->name('galleryFotoDelete');

Route::post('/galleryFoto/foto/add','GaleriFotoController@processUploadFoto')->name('uploadFoto');
Route::post('/galleryFoto/foto/save','GaleriFotoController@saveUploadedFotoData')->name('uploadFotoSave');
Route::get('/galleryFoto/{id_album}/{id_foto}','GaleriFotoController@deleteFoto')->name('uploadFotoDelete');

/*
 * FOR DEVELOPMENT PURPOSES
 */

//Route::get('/initadmin','Auth\RegisterController@create');



