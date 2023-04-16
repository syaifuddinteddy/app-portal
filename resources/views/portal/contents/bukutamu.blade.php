@extends('portal.layouts.container')

@section('jumbotron')
    <!-- START INFO -->
    <div class="jumbotron jumbotron-fluid jumbotron-success mt-3 pt-4 pb-4">
        <div class="container-fluid text-white info-block">
            <div class="row">
                <div class="col-lg-12">
                    <h4 class="label-heading-white">Jonegoro Jengker</h4>
                    <h3 >Media Center</h3>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="container-small">
        <ul class="news">

            @if(session('msg') != null)
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4><i class="icon fa fa-check"></i> Notifikasi!</h4>
                    {{session('msg')}}
                </div>
            @endif

            <div class="box-header with-border">
                <div class="pull-right">
                    <a href="{{URL::route('bukutamuAdd')}}"><button type="button" class="btn btn-success"><i class="fa fa-plus"></i> Punya Gagasan tentang Bojonegoro? Silahkan klik disini</button></a>
                </div>
            </div>

            @foreach($bukutamu as $idx=>$valBukutamu)
                <li>
                    <div class="row">
                        <div class="col-md-2 col-4">
                            <img src="{{ URL::to('storage/uploads/bukutamu/'.$valBukutamu->foto) }}" alt="" class="w-100 h-100">
                        </div>
                        <div class="col-md-8 col-8">
                            <h4>{{ $valBukutamu->nama }}</h4>
                            <h6>{{ $valBukutamu->email }}</h6>
                            <span class="date">{{  date_format(date_create($valBukutamu->tgl_pesan), 'd-m-Y') }}</span>
                            <div class="content-news">
                                {{ $valBukutamu->pesan }}
                            </div>
                            @if($valBukutamu->balasan != null)
                            <div class="col-sm-5">
                                <hr />
                                <div class="card">
                                    <div class="card-body">
                                        <div class="panel panel-default">
                                            <div class="panel-body">
                                                <div class="content-news">
                                                    {{ $valBukutamu->balasan }}
                                                </div>
                                            </div><!-- /panel-body -->
                                            <div class="panel-heading">
                                                <h6>- By : Admin</h6>
                                            </div>
                                        </div><!-- /panel panel-default -->
                                    </div>
                                </div>
                            </div><!-- /col-sm-5 -->
                            @endif
                        </div>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>

@endsection
