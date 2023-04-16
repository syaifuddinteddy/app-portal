@extends('admin.layouts.container')
@section('title', 'Media Center')
@section('title_description', 'Jonegoro Jengker')
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
                      <h3 class="box-title">Edit Bojonegoro Siana</h3>
                  @else
                      <h3 class="box-title">Tambah Bojonegoro Siana</h3>
                  @endif
                </div>
                <!-- /.box-header -->

                        <form action="{{ URL::route('bukutamuUpdate') }}" method="POST">

                        {{csrf_field()}}
                        <input type="hidden" name="id_bukutamu" value="{{ $bukutamu != null ? $bukutamu->id_bukutamu: '' }}">
                        <div class="box-body ">
                            <div class="form-horizontal col-md-9">
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Nama :</label>

                                    <div class="col-sm-6">
                                        <input type="text" class="form-control" name="nama" value="{{ $bukutamu != null ? $bukutamu->nama : ''}}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Alamat :</label>

                                    <div class="col-sm-6">
                                        <input type="text" class="form-control" name="alamat" value="{{ $bukutamu != null ? $bukutamu->alamat : ''}}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Tempat Lahir :</label>

                                    <div class="col-sm-6">
                                        <input type="text" class="form-control" name="tempat_lahir" value="{{ $bukutamu != null ? $bukutamu->tempat_lahir : ''}}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Tgl Lahir :</label>

                                    <div class="col-sm-6">
                                        <input id="tgl_lahir" type="text" class="form-control date-picker" name="tgl_lahir" value="{{ $bukutamu != null ? $bukutamu->tgl_lahir : ''}}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Jenis Kelamin :</label>

                                    <div class="col-sm-6">
                                        <input type="text" class="form-control" name="jenis_kelamin" value="{{ $bukutamu != null ? $bukutamu->jenis_kelamin : ''}}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Nomor Handphone :</label>

                                    <div class="col-sm-6">
                                        <input type="text" class="form-control" name="no_hp" value="{{ $bukutamu != null ? $bukutamu->no_hp : ''}}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Pekerjaan :</label>

                                    <div class="col-sm-6">
                                        <input type="text" class="form-control" name="pekerjaan" value="{{ $bukutamu != null ? $bukutamu->pekerjaan : ''}}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Foto :</label>

                                    <div class="col-sm-6">
                                        @if( $bukutamu != null )
                                            <img src="{{ URL::to('storage/uploads/bukutamu/'.$bukutamu->foto)}}" style="width: 600px; height: 150px; align-content: center;">
                                            <input type="hidden" name="foto" type="hidden" value="{{$bukutamu->foto}}">
                                            </br>
                                        @endif
                                        <input type="file"  name="foto" >
                                        <p class="help-block">Pilih Gambar.</p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Email :</label>

                                    <div class="col-sm-6">
                                        <input type="text" class="form-control" name="email" value="{{ $bukutamu != null ? $bukutamu->email : ''}}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Pesan :</label>

                                    <div class="col-sm-6">
                                        <input type="text" class="form-control" name="pesan" value="{{ $bukutamu != null ? $bukutamu->pesan : ''}}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Pesan Balasan :</label>

                                    <div class="col-sm-6">
                                        <input type="text" class="form-control" name="balasan" value="{{ $bukutamu != null ? $bukutamu->balasan : ''}}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Status Tampil :</label>

                                    <div class="col-sm-6">
                                        <select class="form-control" name="status_tampil">

                                            <option value="{{ $bukutamu->status_tampil }}" selected>{{ $bukutamu->status_tampil == 1 ? 'Tampilkan' : 'Tidak ditampilkan' }}</option>
                                            <option value="{{ $bukutamu->status_tampil == 1 ? 0 : 1 }}">{{ $bukutamu->status_tampil == 1 ? 'Tidak ditampilkan' : 'Tampilkan' }}</option>

                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer ">
                            <a href="{{URL::route('bukuTamu')}}"><button type="button" class="btn btn-default">Cancel</button></a>
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

    <script type="text/javascript">
        $('#tgl_lahir').datepicker({
            changeMonth: true,
            changeYear: true,
            autoclose: true,
            format:'dd-mm-yyyy'

        });

    </script>
@stop
