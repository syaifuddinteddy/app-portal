@extends('admin.layouts.container')
@section('title', 'Manajemen Konten')
@section('title_description', 'Form Data Informasi Terkini')
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

                @if($informasi != null)
                    <div class="box-header with-border">
                        <h3 class="box-title">Edit Data Informasi::{{$informasi->nama_informasi_terkini}}</h3>
                    </div>

                @else
                    <div class="box-header with-border">
                        <h3 class="box-title">Form Add Data Informasi</h3>
                    </div>
                @endif


                @if($informasi != null)
                    <form action="{{URL::route('informasiTerkiniUpdate')}}" method="POST">
                        <input type="hidden" name="id_informasi_terkini" value="{{$informasi->id_informasi_terkini}}">
                        @else
                            <form action="{{URL::route('informasiTerkiniSave')}}" method="POST">
                                @endif

                                {{csrf_field()}}
                                <div class="box-body">
                                    <div class="form-horizontal col-md-12">

                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Judul Informasi</label>

                                            <div class="col-sm-6">
                                                <input type="text" class="form-control"
                                                       name="nama_informasi_terkini"
                                                       value="{{$informasi != null ? $informasi->nama_informasi_terkini : ''}}">
                                            </div>
                                        </div>


                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Judul Informasi Bahasa Inggris</label>

                                            <div class="col-sm-6">
                                                <input type="text" class="form-control"
                                                       name="nama_informasi_terkini_eng"
                                                       value="{{$informasi != null ? $informasi->nama_informasi_terkini_eng : ''}}">
                                            </div>
                                        </div>

                                        @if($informasi != null)
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label">Status Menu</label>
                                                <div class="col-sm-6">
                                                    <select class="form-control" name="status">

                                                        <option value="{{$informasi->status}}" selected>{{ $informasi->status == 1 ? 'Aktif' : 'Tidak Aktif' }}</option>
                                                        <option value="{{$informasi->status == 1 ? 2 : 1 }}">{{ $informasi->status == 1 ? 'Tidak Aktif' : 'Aktif' }}</option>

                                                    </select>
                                                </div>
                                            </div>
                                        @endif

                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Keterangan Informasi Terkini</label>

                                            <div class="col-md-8">
                                                <textarea class="ckeditor form-control required" id="f_narasi" type="text" name="keterangan_informasi_terkini">
                                                    {{$informasi != null ? $informasi->keterangan_informasi_terkini : ''}}
                                                </textarea>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Keterangan Informasi Terkini Bahasa Inggris</label>

                                            <div class="col-sm-8">
                                                <textarea class="ckeditor form-control required" id="f_narasi_eng" type="text" name="keterangan_informasi_terkini_eng">
                                                    {{$informasi != null ? $informasi->keterangan_informasi_terkini_eng : ''}}
                                                </textarea>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Tempat</label>

                                            <div class="col-sm-6">
                                                <input type="text" class="form-control"
                                                       name="tempat"
                                                       value="{{$informasi != null ? $informasi->tempat:''}}">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Waktu</label>

                                            <div class="col-sm-6">
                                                <input type="text" class="form-control"
                                                       name="waktu"
                                                       value="{{$informasi != null ? $informasi->waktu : ''}}">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Tanggal Mulai</label>

                                            <div class="col-sm-6">
                                                <input id="tgl_mulai" type="text" class="form-control date-picker"
                                                       name="tgl_mulai"
                                                       value="{{ $informasi != null ? date_format(date_create($informasi->tgl_mulai), 'd-m-Y') : ''}}"
                                                readonly>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Tanggal Akhir</label>

                                            <div class="col-sm-6">
                                                <input id="tgl_akhir" type="text" class="form-control date-picker"
                                                       name="tgl_akhir"
                                                       value="{{ $informasi != null ? date_format(date_create($informasi->tgl_akhir), 'd-m-Y') : ''}}"
                                                readonly>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <div class="box-footer ">
                                    <a href="{{URL::route('informasiTerkini')}}"><button type="button" class="btn btn-default">Cancel</button></a>
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
    <script src="{{ URL::to('/engine/ckeditor/ckeditor.js') }}"></script>

    <script src="{{ URL::to('/engine/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>


    <script type="text/javascript">
        $('#tgl_mulai').datepicker({
            changeMonth: true,
            changeYear: true,
            autoclose: true,
            format:'dd-mm-yyyy'

        });
        $('#tgl_akhir').datepicker({
            changeMonth: true,
            changeYear: true,
            autoclose: true,
            format:'dd-mm-yyyy'

        });
    </script>

@stop
