@extends('portal.layouts.container')
@section('content')

@section('jumbotron')
    <!-- START INFO -->
    <div class="jumbotron jumbotron-fluid jumbotron-success mt-3 pt-4 pb-4">
        <div class="container-fluid text-white info-block">
            <div class="row">
                <div class="col-lg-12">
                    <h4 class="label-heading-white">PROFILE</h4>
                    <h3 >KABUPATEN BOJONEGORO</h3>
                </div>
            </div>
        </div>
    </div>

@endsection

    <div class="container-fluid">
        <div id="accordion">
            @foreach($profileKabupaten as $idx=>$profile)
                <div class="card">
                    <div class="card-header" style="background:#43A047;"  id="heading{{$idx}}">
                        <h2>
                            <a class="text-white" data-toggle="collapse" data-target="#collapse{{$idx}}" aria-expanded="true" aria-controls="collapse{{$idx}}">
                                {{$profile->judul}}
                            </a>
                        </h2>
                    </div>
                    <div id="collapse{{$idx}}" class="collapse {{$idx == 0 ? 'show':''}}" aria-labelledby="heading{{$idx}}" data-parent="#accordion">
                        <div class="card-body">
                            <div class="container-small">
                                {!! $profile->narasi !!}
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>



@endsection
