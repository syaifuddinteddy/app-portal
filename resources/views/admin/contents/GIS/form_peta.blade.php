@extends('admin.layouts.container')
@section('title', 'Web GIS City')
@section('title_description', 'Peta GIS')
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
                <div class="box-header with-border">
                  @if($formType == 'edit')
                      <h3 class="box-title">Edit Data Peta GIS</h3>
                  @else
                      <h3 class="box-title">Tambah Data Peta GIS</h3>
                  @endif
                </div>
                <!-- /.box-header -->

                    @if($formType == 'edit')
                        <form action="{{ URL::route('petaUpdate') }}" method="POST">
                    @else
                        <form action="{{ URL::route('petaSave') }}" method="POST">
                    @endif

                        {{csrf_field()}}
                        <input type="hidden" name="id_peta_gis" value="{{ $peta != null ? $peta->id_peta_gis: '' }}">
                        <div class="box-body ">
                            <div class="form-horizontal col-md-9">
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Jenis Peta :</label>

                                    <div class="col-sm-6">
                                        <input type="text" class="form-control" name="jenis_peta" value="{{ $peta != null ? $peta->jenis_peta : ''}}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Nama Menu :</label>

                                    <div class="col-sm-6">
                                        <input type="text" class="form-control" name="judul_menu" value="{{ $peta != null ? $peta->judul_menu : ''}}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Nama Menu Inggris :</label>

                                    <div class="col-sm-6">
                                        <input type="text" class="form-control" name="judul_menu_eng" value="{{ $peta != null ? $peta->judul_menu_eng : ''}}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Nama Peta :</label>

                                    <div class="col-sm-6">
                                        <input type="text" class="form-control" name="nama_peta_gis" value="{{ $peta != null ? $peta->nama_peta_gis : ''}}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Nama Peta Inggris :</label>

                                    <div class="col-sm-6">
                                        <input type="text" class="form-control" name="nama_peta_gis_eng" value="{{ $peta != null ? $peta->nama_peta_gis_eng : ''}}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Perbesar/Perkecil Peta :</label>

                                    <div class="col-sm-6">
                                        <input type="text" class="form-control" name="zoom" value="{{ $peta != null ? $peta->zoom : ''}}">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer ">
                            <a href="{{URL::route('peta')}}"><button type="button" class="btn btn-default">Cancel</button></a>
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
    <script src="{{ URL::to('/engine/ckeditor/ckeditor.js') }}"></script>

@stop
