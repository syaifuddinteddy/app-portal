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

@section('css')
    <link href="{{ URL::to('/engine/multiSelect/css/multi-select.css') }}" media="screen" rel="stylesheet" type="text/css">
    <link href="{{ URL::to('/engine/adminLTE/dist/css/AdminLTE.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::to('/engine/adminLTE/dist/css/skins/skin-red.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::to('/engine/iCheck/flat/blue.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::to('/engine/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}" rel="stylesheet" type="text/css" />

@stop

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


        <div class="col-md-10">
            <form action="{{URL::route('bukutamuSave')}}" method="POST" enctype="multipart/form-data">

            {{csrf_field()}}
            <input type="hidden" name="id_banner" value="{{$bukutamu != null ? $bukutamu->id_bukutamu : ''}}">
            <div class="box-body">
                <div class="form-horizontal col-md-9">

                    <div class="form-group">
                        <label class="col-sm-4 control-label">Nama</label>

                        <div class="col-sm-6">
                            <input type="text" class="form-control"
                                   name="nama"
                                   value="{{$bukutamu != null ? $bukutamu->nama : ''}}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-4 control-label">Alamat</label>

                        <div class="col-sm-6">
                            <input type="text" class="form-control"
                                   name="alamat"
                                   value="{{$bukutamu != null ? $bukutamu->alamat : ''}}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-4 control-label">Tempat & Tgl Lahir</label>

                            <div class="col-sm-6">
                                <input type="text" class="form-control"
                                       name="tempat_lahir"
                                       value="{{$bukutamu != null ? $bukutamu->tempat_lahir : ''}}">
                            </div>
                    </div>

                    <div class="form-group">
                            <div class="col-sm-6">
                                <input type="date" id="tgl_lahir" name="tgl_lahir" class="form-control date-picker" value="{{ $bukutamu != null ? $bukutamu->tgl_lahir : ''}}">
                            </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-4 control-label">Jenis Kelamin</label>

                        <div class="col-sm-6">
                            <input type="text" class="form-control"
                                   name="jenis_kelamin"
                                   value="{{$bukutamu != null ? $bukutamu->jenis_kelamin : ''}}" >
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-4 control-label">Pekerjaan</label>

                        <div class="col-sm-6">
                            <input type="text" class="form-control"
                                   name="pekerjaan"
                                   value="{{$bukutamu != null ? $bukutamu->pekerjaan : ''}}" >
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-4 control-label">Nomor Handphone</label>

                        <div class="col-sm-6">
                            <input type="text" class="form-control"
                                   name="no_hp"
                                   value="{{$bukutamu != null ? $bukutamu->no_hp : ''}}" >
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-4 control-label">e-Mail</label>

                        <div class="col-sm-6">
                            <input type="text" class="form-control"
                                   name="email"
                                   value="{{$bukutamu != null ? $bukutamu->email : ''}}" >
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-4 control-label">Pas Foto</label>

                        <div class="col-sm-6">
                            @if($bukutamu!=null)
                                <img src="{{ URL::to('storage/uploads/banner/'.$bukutamu->foto)}}" style="width: 600px; height: 150px; align-content: center;">
                                <input type="hidden" name="foto" type="hidden" value="{{$bukutamu->foto}}">
                                </br>
                            @endif
                            <input id="image-input" type="file"  name="foto" >
                            <p class="help-block">Pilih Gambar.</p><p class="notif-alert-file"></p>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-4 control-label">Judul Gagasan</label>

                        <div class="col-sm-6">
                            <input type="text" class="form-control"
                                   name="judul_pesan"
                                   value="{{$bukutamu != null ? $bukutamu->judul_pesan : ''}}" >
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-4 control-label">Narasi Gagasan</label>

                        <div class="col-sm-6">
                            <input type="text" class="form-control"
                                   name="pesan"
                                   value="{{$bukutamu != null ? $bukutamu->pesan : ''}}" >
                        </div>
                    </div>

                </div>

            </div>

            <div class="col-md-10">
                <a href="{{URL::route('jonegorojengker')}}"><button type="button" class="btn btn-default">Cancel</button></a>
                <button id="btn" type="submit" class="btn btn-success pull-right">Submit</button>
            </div>
        </form>

        </div>
    </div>

</div>

@endsection

@section('js')
    <script src="{{ URL::to('/engine/iCheck/icheck.min.js') }}" type="text/javascript"></script>
    <script src="{{ URL::to('/engine/fastclick/fastclick.min.js') }}"></script>
    <script src="{{ URL::to('/engine/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ URL::to('/engine/ckeditor/ckeditor.js') }}"></script>

    <script>
        $('#image-input').on('change', function() {
            let size = this.files[0].size; // this is in bytes
            if (size > 2097152) {
                // do something. Prevent form submit. Show message, etc.
                $('.notif-alert-file').text('Inputan anda melebihi batas maksimal');
                $("#btn").attr("disabled", true);
            } else {
                $('.notif-alert-file').empty();
                $("#btn").attr("disabled", false);
            }
        });
    </script>
@stop
