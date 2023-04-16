@extends('admin.layouts.container')
@section('title', 'Profil Pemerintah')
@section('title_description', 'Info Pejabat')
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
                      <h3 class="box-title">Edit Data Info Pejabat</h3>
                  @else
                      <h3 class="box-title">Tambah Data Info Pejabat</h3>
                  @endif
                </div>
                <!-- /.box-header -->

                    @if($formType == 'edit')
                        <form action="{{ URL::route('infoPegawaiUpdate') }}" method="POST">
                    @else
                        <form action="{{ URL::route('infoPegawaiSave') }}" method="POST">
                    @endif

                        {{csrf_field()}}
                        <input type="hidden" name="id_info_pegawai" value="{{ $info_pegawai != null ? $info_pegawai->id_info_pegawai: '' }}">
                        <div class="box-body ">
                            <div class="form-horizontal col-md-9">
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">NIP :</label>

                                    <div class="col-sm-6">
                                        <input type="text" class="form-control" name="nip" value="{{ $info_pegawai != null ? $info_pegawai->nip : ''}}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Nama Lengkap :</label>

                                    <div class="col-sm-6">
                                        <input type="text" class="form-control" name="nama" value="{{ $info_pegawai != null ? $info_pegawai->nama : ''}}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="editor2" class="col-sm-4 control-label">Jabatan :</label>

                                    <div class="col-sm-6">
                                        <textarea class="ckeditor form-control required" id="editor" name="jabatan" rows="10" cols="80">{{ $info_pegawai != null ? $info_pegawai->jabatan : ''}}</textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Foto :</label>

                                    <div class="col-sm-6">
                                        <input type="text" class="form-control" name="file_info_pegawai" value="{{ $info_pegawai != null ? $info_pegawai->file_info_pegawai : ''}}">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer ">
                            <a href="{{URL::route('infoPegawai')}}"><button type="button" class="btn btn-default">Cancel</button></a>
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
