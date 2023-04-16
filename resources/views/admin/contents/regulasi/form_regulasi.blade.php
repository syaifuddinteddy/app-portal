@extends('admin.layouts.container')
@section('title', 'Regulasi')
@section('title_description', 'Regulasi')
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
                      <h3 class="box-title">Edit Data Regulasi</h3>
                  @else
                      <h3 class="box-title">Tambah Data Regulasi</h3>
                  @endif
                </div>
                <!-- /.box-header -->

                    @if($formType == 'edit')
                        <form action="{{ URL::route('regulasiUpdate') }}" method="POST">
                    @else
                        <form action="{{ URL::route('regulasiSave') }}" method="POST">
                    @endif

                        {{csrf_field()}}
                        <input type="hidden" name="id_file" value="{{ $regulasi != null ? $regulasi->id_file: '' }}">
                        <div class="box-body ">
                            <div class="form-horizontal col-md-9">
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Nama File :</label>

                                    <div class="col-sm-6">
                                        <input type="text" class="form-control" name="nama_file" value="{{ $regulasi != null ? $regulasi->nama_file : ''}}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Nama File Bahasa Inggris :</label>

                                    <div class="col-sm-6">
                                        <input type="text" class="form-control" name="nama_file_eng" value="{{ $regulasi != null ? $regulasi->nama_file_eng : ''}}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Keterangan :</label>

                                    <div class="col-sm-6">
                                        <textarea cols="12" class="form-control required valid" name="keterangan_file" rows="3" maxlength="400" aria-required="true" aria-invalid="false">{{ $regulasi != null ? $regulasi->keterangan_file : ''}}</textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Keterangan Bahasa inggris :</label>

                                    <div class="col-sm-6">
                                        <textarea cols="12" class="form-control required valid" name="keterangan_file_eng" rows="3" maxlength="400" aria-required="true" aria-invalid="false">{{ $regulasi != null ? $regulasi->keterangan_file_eng : ''}}</textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">File :</label>

                                    <div class="col-sm-6">
                                        <input type="text" class="form-control" name="file" value="{{ $regulasi != null ? $regulasi->file : ''}}">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer ">
                            <a href="{{URL::route('regulasi')}}"><button type="button" class="btn btn-default">Cancel</button></a>
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
