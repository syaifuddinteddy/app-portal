@extends('portal.layouts.container')

@section('jumbotron')
    <!-- START INFO -->
    <div class="jumbotron jumbotron-fluid jumbotron-success mt-3 pt-4 pb-4">
        <div class="container-fluid text-white info-block">
            <div class="row">
                <div class="col-lg-12">
                    <h4 class="label-heading-white">BERITA</h4>
                    <h3 >KABUPATEN BOJONEGORO</h3>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="container-small">
        <ul class="news">
            @foreach($berita as $idx=>$valBerita)
                <li>
                    <div class="row">
                        <div class="col-md-2 col-4">
                            <img src="{{ URL::to('storage/uploads/berita/'.$valBerita->file) }}" alt="" class="w-100 h-100">
                        </div>
                        <div class="col-md-8 col-8">
                            <h4>{{ $valBerita->judul }}</h4>
                            <span class="date">{{  date_format(date_create($valBerita->tgl_berita), 'd-m-Y') }}</span>
                            <div class="content-news">
                                {!! strip_tags(substr($valBerita->narasi,0,500)) !!}
                            </div>
                            <a href="{{ URL::route('beritaDetail', $valBerita->id_berita) }}">READ MORE <i class="fa fa-chevron-right"></i></a>
                        </div>
                    </div>
                </li>
            @endforeach
        </ul>

        <br>
        @if($berita != null)
            {{ $berita->render()}}
        @endif
    </div>

@endsection

@section('js')

@endsection
