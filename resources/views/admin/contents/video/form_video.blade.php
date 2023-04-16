@extends('admin.layouts.container')
@section('title', 'Manajemen Media')
@section('title_description', 'Form Data Video')
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

                @if($video != null)
                    <div class="box-header with-border">
                        <h3 class="box-title">Edit Data Video::{{$video->judul_video}}</h3>
                    </div>

                @else
                    <div class="box-header with-border">
                        <h3 class="box-title">Form Add Data Video</h3>
                    </div>
                @endif


                @if($video != null)
                    <form action="{{URL::route('galleryVideoUpdate')}}" method="POST">
                        <input type="hidden" name="id_video" value="{{$video->id_video}}">
                        @else
                            <form action="{{URL::route('galleryVideoSave')}}" method="POST">
                                @endif

                                {{csrf_field()}}
                                <div class="box-body">
                                    <div class="form-horizontal col-md-12">

                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">URL</label>

                                            <div class="col-sm-6">
                                                <input id="panjangURL" type="text" class="form-control"
                                                       name="url"
                                                       value="{{$video != null ? $video->url : ''}}" maxlength="101">
                                                <p class="notif-alert-url"></p>
                                            </div>
                                        </div>


                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Judul Video</label>

                                            <div class="col-sm-6">
                                                <input id="panjangJudul" type="text" class="form-control"
                                                       name="judul_video"
                                                       value="{{$video != null ? $video->judul_video : ''}}" maxlength="101">
                                                <p class="notif-alert-judul"></p>
                                            </div>
                                        </div>

                                        @if($video != null)
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label">Status</label>
                                                <div class="col-sm-6">
                                                    <select class="form-control" name="status">

                                                        <option value="{{$video->status}}" selected>{{ $video->status == 1 ? 'Aktif' : 'Tidak Aktif' }}</option>
                                                        <option value="{{$video->status == 1 ? 2 : 1 }}">{{ $video->status == 1 ? 'Tidak Aktif' : 'Aktif' }}</option>

                                                    </select>
                                                </div>
                                            </div>
                                        @endif

                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Keterangan Video</label>

                                            <div class="col-md-8">
                                                <textarea id="karakter" maxlength="200"
                                                          class="form-control required"
                                                          type="text"
                                                          name="keterangan_video"
                                                          rows="9"  >{{$video != null ? $video->keterangan_video : ''}}</textarea>
                                                <span id="hitung">200</span> Karakter Tersisa.
                                            </div>
                                        </div>

                                </div>
                            </div>
                                <div class="box-footer">
                                    <a href="{{URL::route('galleryVideo')}}"><button type="button" class="btn btn-default">Cancel</button></a>
                                    <button id="btn" type="submit" class="btn btn-success pull-right">Submit</button>
                                </div>
                        </form>
                    </form>
            </div>
        </div>

    </div>
@stop
@section('js')
    <script src="{{ URL::to('/engine/iCheck/icheck.min.js') }}" type="text/javascript"></script>
    <script src="{{ URL::to('/engine/fastclick/fastclick.min.js') }}"></script>
    <script src="{{ URL::to('/engine/ckeditor/ckeditor.js') }}"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#karakter').keyup(function() {
                var len = this.value.length;
                if (len >= 200) {
                    this.value = this.value.substring(0, 200);
                }
                $('#hitung').text(200 - len);
            });
        });
    </script>
    <script>
        if ($('#panjangURL').length) {
            var input = document.getElementById('panjangURL');
            input.addEventListener("keyup", function(e) {
                if (input.value.length > 100) {
                    $('.notif-alert-url').text('Inputan anda melebihi batas maksimal');
                    $("#btn").attr("disabled", true);
                }
            });
            input.addEventListener("keydown", function(e) {
                if (input.value.length > 100) {
                    $('.notif-alert-url').empty();
                    $("#btn").attr("disabled", false);
                }
            });
        }

        if ($('#panjangJudul').length) {
            var input = document.getElementById('panjangJudul');
            input.addEventListener("keyup", function(e) {
                if (input.value.length > 100) {
                    $('.notif-alert-judul').text('Inputan anda melebihi batas maksimal');
                    $("#btn").attr("disabled", true);
                }
            });
            input.addEventListener("keydown", function(e) {
                if (input.value.length > 100) {
                    $('.notif-alert-judul').empty();
                    $("#btn").attr("disabled", false);
                }
            });
        }
    </script>
@stop
