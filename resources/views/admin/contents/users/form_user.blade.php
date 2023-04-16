@extends('admin.layouts.container')
@section('title', 'Manajemen User')
@section('title_description', 'Edit Data Pegawai')
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
                    <h3 class="box-title">Data Pegawai::{{$pegawai != null ? $pegawai->nama_lengkap:''}}</h3>
                </div>
                <!-- /.box-header -->

                    @if($formType == 'edit')
                        <form action="{{ URL::route('pegawaiUpdate') }}" method="POST">
                    @else
                        <form action="{{ URL::route('pegawaiSave') }}" method="POST">
                    @endif

                        {{csrf_field()}}
                        <input type="hidden" name="id_pegawai" value="{{ $pegawai != null ? $pegawai->id_pegawai: '' }}">
                        <div class="box-body ">
                            <div class="form-horizontal col-md-9">
                                <div class="form-group">

                                    <label class="col-sm-4 control-label">NIP :</label>

                                    <div class="col-sm-6">
                                        <input type="text" class="form-control" name="nip" value="{{ $pegawai != null ? $pegawai->nip : ''}}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Nama Lengkap :</label>

                                    <div class="col-sm-6">
                                        <input type="text" class="form-control" name="nama_lengkap" value="{{ $pegawai != null ? $pegawai->nama_lengkap : ''}}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Alamat :</label>

                                    <div class="col-sm-6">
                                        <input type="text" class="form-control" name="alamat" value="{{ $pegawai != null ? $pegawai->alamat : ''}}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">No.Telp :</label>

                                    <div class="col-sm-6">
                                        <input type="text" class="form-control" name="no_telp" value="{{ $pegawai != null ? $pegawai->no_telp : ''}}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Tempat Lahir :</label>

                                    <div class="col-sm-6">
                                        <input type="text" class="form-control" name="tempat_lahir" value="{{ $pegawai != null ? $pegawai->tempat_lahir : ''}}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Tanggal Lahir :</label>

                                    <div class="col-sm-6">
                                        <input id="tgl_lahir" type="text" class="form-control date-picker" name="tgl_lahir" value="{{ $pegawai != null ? $pegawai->tgl_lahir : ''}}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Pangkat :</label>

                                    <div class="col-sm-6">
                                        <input type="text" class="form-control" name="pangkat" value="{{ $pegawai != null ? $pegawai->pangkat : ''}}">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Jabatan :</label>

                                    <div class="col-sm-6">
                                        <input type="text" class="form-control" name="jabatan" value="{{ $pegawai != null ? $pegawai->jabatan : ''}}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">SKPD :</label>

                                    <div class="col-sm-6">
                                        <input type="text" class="form-control" name="skpd" value="{{ $pegawai != null ? $pegawai->skpd :''}}">
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Kategori User :</label>
                                    <div class="col-sm-6">
                                        <select class="form-control" name="id_kategori_user">
                                                <option value="{{ $pegawai != null ? $pegawai->id_kategori_user : ''}}" selected>{{ $pegawai != null ? $pegawai->kategori_user : 'Pilih Salah Satu'}}</option>
                                            @foreach($optUserCategory as $idx => $category)
                                                @if($pegawai != null)
                                                    @if($category->id_kategori_user != $pegawai->id_kategori_user)
                                                        <option value="{{$category->id_kategori_user}}">{{$category->kategori_user}}</option>
                                                    @endif
                                                @else
                                                    <option value="{{$category->id_kategori_user}}">{{$category->kategori_user}}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                @if($pegawai != null)
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Status User :</label>
                                    <div class="col-sm-6">
                                        <select class="form-control" name="status">

                                            <option value="{{$pegawai->status}}" selected>{{ $pegawai->status == 1 ? 'Aktif' : 'Tidak Aktif' }}</option>
                                            <option value="{{ $pegawai->status == 1 ? 0 : 1 }}">{{ $pegawai->status == 1 ? 'Tidak Aktif' : 'Aktif' }}</option>

                                        </select>
                                    </div>
                                </div>
                                @endif

                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Username :</label>

                                    <div class="col-sm-6">
                                        <input type="text" class="form-control" name="username" value="{{$pegawai != null ? $pegawai->username : ''}}">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Password :</label>

                                    <div class="col-sm-6">
                                        <input type="password" class="form-control" name="password" >
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Ulangi Password :</label>

                                    <div class="col-sm-6">
                                        <input type="password" class="form-control" name="password">
                                    </div>
                                </div>


                            </div>
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer ">
                            <a href="{{URL::route('pegawai')}}"><button type="button" class="btn btn-default">Cancel</button></a>
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


    <script type="text/javascript">
        $('#tgl_lahir').datepicker({
            changeMonth: true,
            changeYear: true,
            autoclose: true,
            format:'dd-mm-yyyy'

        });

    </script>
@stop
