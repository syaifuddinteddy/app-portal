@extends('admin.layouts.container')
@section('title', 'Manajemen Banner')
@section('title_description', 'Kelola Data Banner')
@section('css')
    <link href="{{ URL::to('/engine/multiSelect/css/multi-select.css') }}" media="screen" rel="stylesheet" type="text/css">
    <link href="{{ URL::to('/engine/adminLTE/dist/css/AdminLTE.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::to('/engine/adminLTE/dist/css/skins/skin-red.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::to('/engine/iCheck/flat/blue.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::to('/engine/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}" rel="stylesheet" type="text/css" />

@stop
@section('body-class', 'skin-red')
@section('content')
    <div class="row">
        <div class="col-md-12">

            @if(session('msg') != null)
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4><i class="icon fa fa-check"></i> Notifikasi!</h4>
                    {{session('msg')}}
                </div>
            @endif


            <div class="box box-info">

                @if($banner != null)
                    <div class="box-header with-border">
                        <h3 class="box-title">Edit Data Banner::{{$banner->nama_banner}}</h3>
                    </div>

                @else
                    <div class="box-header with-border">
                        <h3 class="box-title">Form Data Banner Utama</h3>
                    </div>
                @endif


                @if($banner != null)
                    <form action="{{URL::route('bannerLinkUpdate')}}" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="id_banner" value="{{$banner->id_banner}}">
                        @else
                            <form action="{{URL::route('bannerLinkSave')}}" method="POST" enctype="multipart/form-data">
                                @endif

                                {{csrf_field()}}
                                <div class="box-body">
                                    <div class="form-horizontal col-md-9">

                                        <div class="form-group">
                                            <label class="col-sm-4 control-label">Nama Banner</label>

                                            <div class="col-sm-6">
                                                <input type="text" class="form-control"
                                                       name="nama_banner"
                                                       value="{{$banner != null ? $banner->nama_banner : ''}}">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-sm-4 control-label">Link Tautan / URL</label>

                                            <div class="col-sm-6">
                                                <input type="text" class="form-control"
                                                       name="url" placeholder="contoh: http://bojonegoro.kab.go.id/"
                                                       value="{{$banner != null ? $banner->url: ''}}">
                                            </div>
                                        </div>

                                        @if($banner == null)
                                            <div class="form-group">
                                                <label class="col-sm-4 control-label">Kategori :</label>
                                                <div class="col-sm-6">
                                                    <select class="form-control" name="jenis">

                                                        <option disabled selected>Pilih Salah Satu ...</option>
                                                        <option value="BANNER LINK">Banner Link</option>
                                                        <option value="TRANSPARANSI">Transparansi</option>
                                                        <option value="PELAYANAN PUBLIK">Pelayanan Publik</option>
                                                        <option value="SKPD">Daftar SKPD</option>
                                                        <option value="WISATA">Tempat Wisata</option>

                                                    </select>
                                                </div>
                                            </div>
                                        @else
                                            <div class="form-group">
                                                <label class="col-sm-4 control-label">Kategori :</label>
                                                <div class="col-sm-6">
                                                    <select class="form-control" name="jenis">

                                                        <option disabled selected>Pilih Salah Satu ...</option>
                                                        <option value="BANNER LINK" {{$banner->jenis == 'BANNER LINK' ? 'selected':''}}>Banner Link</option>
                                                        <option value="TRANSPARANSI" {{$banner->jenis == 'TRANSPARANSI' ? 'selected':''}}>Transparansi</option>
                                                        <option value="PELAYANAN PUBLIK" {{$banner->jenis == 'PELAYANAN PUBLIK' ? 'selected':''}}>Pelayanan Publik</option>
                                                        <option value="SKPD" {{$banner->jenis == 'SKPD' ? 'selected':''}}>Daftar SKPD</option>
                                                        <option value="WISATA" {{$banner->jenis == 'WISATA' ? 'selected':''}}>Tempat Wisata</option>

                                                    </select>
                                                </div>
                                            </div>
                                        @endif

                                        @if($banner != null)
                                            <div class="form-group">
                                                <label class="col-sm-4 control-label">Status User :</label>
                                                <div class="col-sm-6">
                                                    <select class="form-control" name="status">

                                                        <option value="{{$banner->status}}" selected>{{ $banner->status == 1 ? 'Aktif' : 'Tidak Aktif' }}</option>
                                                        <option value="{{ $banner->status == 1 ? 2 : 1 }}">{{ $banner->status == 1 ? 'Tidak Aktif' : 'Aktif' }}</option>

                                                    </select>
                                                </div>
                                            </div>
                                        @endif

                                        <div class="form-group">
                                            <label class="col-sm-4 control-label">File Gambar</label>

                                            <div class="col-sm-6">
                                                @if($banner!=null)
                                                    <img src="{{ URL::to('storage/uploads/banner_link/'.$banner->file)}}" style="width: 600px; height: 150px; align-content: center;">
                                                    <input type="hidden" name="fileName" type="hidden" value="{{$banner->file}}">
                                                    </br>
                                                @endif
                                                <input type="file"  name="file" >
                                                <p class="help-block">Pilih Gambar.</p>
                                            </div>
                                        </div>

                                    </div>

                                </div>

                                <div class="box-footer ">
                                    <a href="{{URL::route('bannerLink')}}"><button type="button" class="btn btn-default">Cancel</button></a>
                                    <button type="submit" class="btn btn-success pull-right">Submit</button>
                                </div>
                            </form>

            </div>
        </div>

    </div>
@stop
@section('js')
    <script src="{{ URL::to('/engine/iCheck/icheck.min.js') }}" type="text/javascript"></script>
    <script src="{{ URL::to('/engine/fastclick/fastclick.min.js') }}"></script>
    <script src="{{ URL::to('/engine/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>

@stop
