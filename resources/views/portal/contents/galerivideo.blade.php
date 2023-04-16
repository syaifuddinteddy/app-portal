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
        <ul class="news">
            @foreach($video as $idx=>$valVideo)
                <li>
                    <div class="row">
                        <div class="col-md-2 col-4">
                            <iframe width="100%" height="100%" src="{{ str_replace("watch?v=","embed/", $valVideo->url) }}" frameborder="0" allowfullscreen></iframe>
                        </div>
                        <div class="col-md-8 col-8">
                            <h4>{{ $valVideo->judul_video }}</h4>
                            <span class="date">{{  date_format(date_create($valVideo->tgl_entri), 'd-m-Y') }}</span>
                            <div class="content-news">
                                {!! strip_tags(substr($valVideo->keterangan_video,0,500)) !!}
                            </div>
                            <a href="{{ URL::route('galeriVideoDetail', $valVideo->id_video) }}">READ MORE <i class="fa fa-chevron-right"></i></a>
                        </div>
                    </div>
                </li>
            @endforeach
        </ul>

        <br>
        @if($video != null)
            {{ $video->render()}}
        @endif
    </div>

@endsection

@section('js')

@endsection
