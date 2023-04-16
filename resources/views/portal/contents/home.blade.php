@extends('portal.layouts.container')
@section('content')
<div class="container-fluid">
    <!-- START BACKGROUND -->
    <div class="bg-overlay">
        <div class="container p-0">
            <div class="row vertical-center">
                <div class="logo">
                    <img src="{{ URL::to('portal/assets/img/logo-web.png') }}" alt=""/>
                </div>
                <div class="text">
                    <h2>
                        PEMERINTAH <br/>
                        KABUPATEN BOJONEGORO
                    </h2>
                </div>
            </div>
        </div>
    </div>
    <!-- END BACKGROUND -->
    <!-- START CAROUSEL -->
    <div id="slideIndicator" class="carousel slide web-carousel" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#slideIndicator" data-slide-to="0" class="active"></li>
            <li data-target="#slideIndicator" data-slide-to="1"></li>
        </ol>
        <div class="carousel-inner">
            @foreach($banner as $idx => $dtbanner)
                <div class="carousel-item {{ $idx == 0 ? 'active':'' }}">
                    <img class="d-block w-100" src="{{ URL::to('storage/uploads/banner/'.$dtbanner->file) }}" alt="{{$dtbanner->keterangan_banner}}"/>
                </div>
            @endforeach
        </div>
    </div>
    <!-- END CAROUSEL -->
    <!-- START INFO -->
    <div class="jumbotron jumbotron-fluid jumbotron-success mt-3 pt-4 pb-4">
        <div class="container text-white info-block">
            <div class="row">
                <div class="col-lg-9">
                    <h2>BOJONEGORO TANGGAP COVID-19</h2>
                </div>
                <div class="col-lg-3">
                    <a href="http://lawancorona.bojonegorokab.go.id" target="blank" class="btn btn-lg btn-light text-success btn-success float-right">
                        <b>INFO COVID-19</b>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- END INFO -->
    <!-- START NEWS -->
    <div id="news-section">
        <h4 class="label-heading">BERITA TERBARU</h4>
        <h3 class="label-heading-2">KABUPATEN BOJONEGORO</h3>
        <div class="row m-0 p-0 mt-4">
            @if($berita != null && sizeof($berita) > 0)
                <div class="col-lg-5 main-news">
                    <div class="col-lg-10 p-0">
                        <h4>{{$berita[0]->judul}}</h4>
                        <img src=" {{ URL::to('storage/uploads/berita/'.$berita[0]->file) }}"
                             style="width: 100%; height: 50%; max-height: 250px;" alt=""/>
                        <span class="date">{{  date_format(date_create($berita[0]->tgl_berita), 'd-m-Y') }}</span>
                        <div class="content-news">
                            {!! strip_tags(substr($berita[0]->narasi,0,300)) !!}....
                        </div>
                        <a href="{{ URL::to('berita/'.$berita[0]->id_berita) }}">READ MORE <span class="fa fa-chevron-right"></span></a>
                    </div>
                </div>

                <div class="col-lg-7 box-news">
                    <div class="row box-other-news">
                        @foreach($berita->skip(1) as $idx => $valBerita)
                        <div class="col-lg-4 mt-3">
                            <div class="img-news">
                                <img src="{{ URL::to('storage/uploads/berita/'.$valBerita->file) }}"
                                     class="w-100"
                                     style="height: 50%; max-height: 250px;" alt=""/>
                            </div>
                            <div class="card-news">
                                <span class="date">{{  date_format(date_create($valBerita->tgl_berita), 'd-m-Y') }}</span>
                                <h4>{{ $valBerita->judul }}</h4>
                                <div class="content-news">
                                    {!! strip_tags(substr($valBerita->narasi,0,100)) !!}...
                                </div>
                                <a href="{{ URL::to('berita/'.$valBerita->id_berita) }}">READ MORE <span class="fa fa-chevron-right"></span></a>
                            </div>
                        </div>
                        @endforeach
                        <div class="col-lg-12">
                            <center><button class="btn btn-lg btn-news btn-success">Selengkapnya <span class="fa fa-arrow-right"></span></button></center>
                        </div>
                    </div>
                </div>

            @endif

        </div>
    </div>
    <!-- END NEWS -->
    <!-- START PUBLIC SERVICE -->
    <div id="public-section">
        <h5 class="label-heading-center">INFORMASI</h5>
        <h4>PELAYANAN PUBLIK</h4>
        <div class="row public-content seven-cols">
            <div class="col-lg-1">
                <div class="public-circle">
                    <img src="{{ URL::to('portal/assets/img/logo.png') }}" alt=""/>
                </div>
                <h5>PIP</h5>
                <span>LAYANAN INFORMASI PUBLIK DAERAH</span>
            </div>
            <div class="col-lg-1">
                <div class="public-circle">
                    <img src="{{ URL::to('portal/assets/img/logo.png') }}" alt=""/>
                </div>
                <h5>ALOKASI DANA DESA</h5>
            </div>
            <div class="col-lg-1">
                <div class="public-circle">
                    <img src="{{ URL::to('portal/assets/img/logo.png') }}" alt=""/>
                </div>
                <h5>DISDAG-ONLINE</h5>
                <span>INFO HARGA</span>
            </div>
            <div class="col-lg-1">
                <div class="public-circle">
                    <img src="{{ URL::to('portal/assets/img/logo.png') }}" alt=""/>
                </div>
                <h5>KOPERASI DAN UKM ONLINE</h5>
            </div>
            <div class="col-lg-1">
                <div class="public-circle">
                    <img src="{{ URL::to('portal/assets/img/logo.png') }}" alt=""/>
                </div>
                <h5>E-LETTER</h5>
            </div>
            <div class="col-lg-1">
                <div class="public-circle">
                    <img src="{{ URL::to('portal/assets/img/logo.png') }}" alt=""/>
                </div>
                <h5>ABSENSI ONLINE</h5>
            </div>
            <div class="col-lg-1">
                <div class="public-circle">
                    <img src="{{ URL::to('portal/assets/img/logo.png') }}" alt=""/>
                </div>
                <h5>DINPERINAKER-ONLINE</h5>
                <span>DISPLAY PRODUK IKM</span>
            </div>
        </div>
        <div class="row public-content seven-cols no-bg-border">
            <div class="col-lg-1">
                <img src="{{ URL::to('portal/assets/pemerintahan/city.png') }}" alt=""/>
                <!--a href="www.bojonegorokab.go.id/menu/index/Badan" class="box-agenda-title"></a-->
                <h5>BADAN</h5>
                <span>KAB BOJONEGORO</span>
            </div>
            <div class="col-lg-1">
                <img src="{{ URL::to('portal/assets/pemerintahan/goverment.png') }}" alt=""/>
                <h5>DINAS</h5>
                <span>KAB BOJONEGORO</span>
            </div>
            <div class="col-lg-1">
                <img src="{{ URL::to('portal/assets/pemerintahan/building.png') }}" alt=""/>
                <h5>SETDA</h5>
                <span>KAB BOJONEGORO</span>
            </div>
            <div class="col-lg-1">
                <img src="{{ URL::to('portal/assets/pemerintahan/museum.png') }}" alt=""/>
                <h5>KECAMATAN</h5>
                <span>KAB BOJONEGORO</span>
            </div>
            <div class="col-lg-1">
                <img src="{{ URL::to('portal/assets/pemerintahan/hospital.png') }}" alt=""/>
                <h5>RSUD</h5>
                <span>KAB BOJONEGORO</span>
            </div>
            <div class="col-lg-1">
                <img src="{{ URL::to('portal/assets/pemerintahan/urban.png') }}" alt=""/>
                <h5>BUMD</h5>
                <span>KAB BOJONEGORO</span>
            </div>
            <div class="col-lg-1">
                <img src="{{ URL::to('portal/assets/pemerintahan/town.png') }}" alt=""/>
                <h5>SETWAN</h5>
                <span>KAB BOJONEGORO</span>
            </div>
        </div>
    </div>
    <!-- END PUBLIC SERVICE -->
    <!-- START AGENDA -->
    <div id="agenda-section">
        <div class="row">
            <div class="col-lg-3 my-auto pl-5">
                <h3 class="label-heading">DAFTAR</h3>
                <h2 class="label-heading-2 ml-5">AGENDA</h2>
            </div>
            <div class="col-lg-9 right-offset">
                <div class="row">
                    @foreach($agenda as $key => $value)
                        @if($value != null)
                            <div class="col-lg-4">
                                <h4>{{ ['Kabupaten', 'Pemerintah', 'Masyarakat'][$key] }}</h4>
                                <div class="box-agenda">
                                    <ul>
                                        @foreach($value as $idx=>$agendaKab)
                                            <li>
                                                <a href="{{ URL::route('agendaDetail', [$agendaKab->id_agenda, $agendaKab->id_submenu]) }}" class="box-agenda-title">
                                                    <span class="box-agenda-title">{{ $agendaKab->nama_kegiatan }}</span>
                                                </a>
                                                <span>{{ $agendaKab->keterangan_kegiatan }}</span>
                                            </li>
                                        @endforeach
                                    </ul>
                                    @if($key == 0)
                                        <a href="{{ URL::route('agenda').'?&category=kabupaten' }}">Selengkapnya <span class="fa fa-chevron-right"></span></a>
                                    @elseif($key == 1)
                                        <a href="{{ URL::route('agenda').'?&category=pemerintahan' }}">Selengkapnya <span class="fa fa-chevron-right"></span></a>
                                    @elseif($key == 2)
                                        <a href="{{ URL::route('agenda').'?&category=masyarakat' }}">Selengkapnya <span class="fa fa-chevron-right"></span></a>
                                    @endif
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <!-- END AGENDA -->
    <!-- START JENGKER -->
    <div id="jengker-section">
        <div class="row">
            <div class="col-lg-6 col-5 p-4">
                <div class="float-right">
                    <h4 class="label-heading">JONEGORO</h4>
                    <h1 class="ml-2">JENGKER</h1>
                </div>
            </div>
            <div class="col-lg-6 col-7 p-4 vertical-line">
                <h5>Punya Gagasan Bojonegoro</h5>
                <h4>Silahkan sampaikan</h4>
                <a href="{{URL::route('jonegorojengker')}}"><button class="btn btn-sm btn-success">Klik disini!</button></a>
            </div>
        </div>
        <div class="row content-jengker">
            <div class="slide-feedback carousel-feedback owl-carousel owl-theme">
                @foreach($bukutamu as $idx => $valBukutamu)
                <div class="item">
                    <div class="row">
                        <div class="col-lg-3 col-2">
                            <img src="{{ URL::to('storage/uploads/bukutamu/'.$valBukutamu->foto) }}" class="w-100" alt="">
                        </div>
                        <div class="col-lg-9 col-10">
                            <label>{{ $valBukutamu->nama }}</label>
                            <span>{{ $valBukutamu->email }}</span>
                        </div>
                        <div class="col-lg-12">
                                <span>{!! strip_tags(substr($valBukutamu->pesan,0,100)) !!}...</span>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- END JENGKER -->
    <!-- START MALOWAPATI -->
    <div id="malowopati-section">
        <div class="row">
            <div class="col-lg-6">
                <h4 class="label-heading">Streaming <span>Malowopati FM</span></h4>
                <div class="row">
                    <div class="col-lg-3 col-3">
                        <span class="icon-radio float-right"></span>
                    </div>
                    <div class="col-lg-9 col-8 my-auto pt-4">
                        <audio controls>
                            <source src="" type="audio/mp3">
                        </audio>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <h4 class="label-heading">Peta <span>Rawan Bencana</span></h4>
                <div class="row pm-3">
                    <div class="col-lg-4 p-0">
                        <img src="{{ URL::to('portal/assets/img/peta.png') }}" class="w-100" alt="">
                    </div>
                    <div class="col-lg-8">
                        <p>Badan Penanggulangan Bencana Daerah (BPBD) Kabupaten Bojonegoro, Jawa Timur, mencatat dari 28 kecamatan yang ada, 21 kecamatan rawan bencana, baik puting beliung maupun banjir.</p>
                        <a href="" class="label text-success">SELENGKAPNYA <span class="fa fa-chevron-right"></span></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END MALOWAPATI -->
    <!-- START DESTINATION -->
    <div id="wisata-section">
        <div class="row">
            <div class="col-lg-5 main-destination">
                <div class="row">
                    <div class="col-lg-6 kominfo-widget">
                        <script defer src="https://widget.kominfo.go.id/gpr-widget-kominfo.min.js"></script>
                        <div id="gpr-kominfo-widget-container"></div>
                    </div>
                    <div class="col-lg-6">
                        <h5 class="label-heading">Informasi <span>Terkini</span></h5>
                        <div class="box box-info">
                            <div class="box-body">
                                @foreach($info_terkini as $info)
                                    <div class="row" style="margin-left: 15px;">
                                        <h6>{{ $info->nama_informasi_terkini }}</h6>
                                        <span >{!!  $info->keterangan_informasi_terkini  !!}</span>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <a href="" class="static-sm">Selengkapnya <span class="fa fa-chevron-right"></span></a>
                    </div>
                </div>
            </div>
            <div class="col-lg-7 box-destination">
                <h4 class="label-heading">WISATA <span>BOJONEGORO</span></h4>
                <div id="destinationCarousel" class="carousel slide" data-ride="carousel" data-interval="false">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <div class="row">
                                <div class="col-lg-5">
                                    <img src="{{ URL::to('portal/assets/wisata/bukit-cinta.png') }}" class="w-100" alt="">
                                    <span class="overlay"></span>
                                </div>
                                <div class="col-lg-7 box-destination-content">
                                    <h4>Bukit Cinta</h4>
                                    <div>
                                        Pariwisata Bojonegoro kini menjadi perhatian para wisatawan baik dari dalam kota maupun luar kota. Hal itu terbukti dari beberapa kendaraan dengan plat nomor luar kota mendatangi kawasan wisata Dander Bojonegoro. Hampir seluruh tempat wisata di kawasan ini di banjiri pengunjung saat long weekend
                                    </div>
                                    <a href="" class="btn btn-sm btn-success text-white float-right">Selengkapnya <span class="fa fa-arrow-right"></span></a>
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <div class="row">
                                <div class="col-lg-5">
                                    <img src="{{ URL::to('portal/assets/wisata/gofun.png') }}" class="w-100" alt="">
                                    <span class="overlay"></span>
                                </div>
                                <div class="col-lg-7 box-destination-content">
                                    <h4>Gofun</h4>
                                    <div>
                                        Bagi kamu yang ingin merencanakan liburan bersama keluarga pastinya harus memilih tempat liburan yang cocok untuk hal tersebut dong, nah bagi kamu yang belum memilih tempat liburan, coba deh sekali-kali berlibur ke tempat wisata yang terletak di Bojonegoro ini. Yaitu GoFun Bojonegoro Theme Park,
                                    </div>
                                    <a  href="" class="btn btn-sm btn-success text-white float-right">Selengkapnya <span class="fa fa-arrow-right"></span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <a class="carousel-control-prev" href="#destinationCarousel" role="button" data-slide="prev">
                        <span><i class="fa fa-angle-left" aria-hidden="true"></i></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#destinationCarousel" role="button" data-slide="next">
                        <span><i class="fa fa-angle-right" aria-hidden="true"></i></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- END DESTINATION -->
</div>
@endsection
