@extends('portal.layouts.container')

@section('jumbotron')
    <!-- START INFO -->
    <div class="jumbotron jumbotron-fluid jumbotron-success mt-3 pt-4 pb-4">
        <div class="container-fluid text-white info-block">
            <div class="row">
                <div class="col-lg-12">
                    <h4 class="label-heading-white">Galeri Video</h4>
                    <h3 >Media Center</h3>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="container-small">
        <h2 style="text-align: center;">{{ $video->judul_video }}</h2>
        <br>
        <div class="row justify-content-center">
            <div class="mt-3">
                <iframe height="500" width="700" src="{{ str_replace("watch?v=","embed/", $video->url)  }}" frameborder="0" allowfullscreen></iframe>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="mt-3">
                <p style="text-align: center;">Keterangan : {!! strip_tags($video->keterangan_video) !!}</p>
            </div>
        </div>

        <div class="news-info">
            <span class="date">{{date_format(date_create($video->tgl_entri), 'd-m-Y')}}</span>
        </div>
    </div>
@endsection
