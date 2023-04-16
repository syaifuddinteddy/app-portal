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
        <h2>{{ $berita->judul }}</h2>
        <div class="row">
            <div class="mt-3 w-100 h-50">
                <img src="{{ URL::to('storage/uploads/berita/'.$berita->file) }}" class="wrap-image">
                {!! $berita->narasi !!}
            </div>
        </div>
        <div class="news-info">
            <span class="by">By: {{$berita->editor}}</span>
            <span class="date">{{date_format(date_create($berita->tgl_berita), 'd-m-Y')}}</span>
        </div>
    </div>
@endsection
