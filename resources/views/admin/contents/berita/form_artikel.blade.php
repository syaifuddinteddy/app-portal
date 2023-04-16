@extends('admin.layouts.container')
@section('title', 'Berita')
@section('title_description', 'Artikel')
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
                      <h3 class="box-title">Edit Data Artikel</h3>
                  @else
                      <h3 class="box-title">Tambah Data Artikel</h3>
                  @endif
                </div>
                <!-- /.box-header -->

                    @if($formType == 'edit')
                        <form action="{{ URL::route('artikelUpdate') }}" method="POST" enctype="multipart/form-data">
                    @else
                        <form action="{{ URL::route('artikelSave') }}" method="POST" enctype="multipart/form-data">
                    @endif

                        {{csrf_field()}}
                        <input type="hidden" name="id_berita" value="{{ $berita != null ? $berita->id_berita: '' }}">
                        <div class="box-body ">
                            <div class="form-horizontal col-md-9">
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Tanggal Posting :</label>

                                    <div class="col-sm-6">
                                        <input type="date" id="tgl_berita" name="tgl_berita" class="form-control date-picker" value="{{ $berita != null ? date('Y-m-d',strtotime($berita->tgl_berita)) : ''}}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Judul :</label>

                                    <div class="col-sm-6">
                                        <input type="text" class="form-control" name="judul" value="{{ $berita != null ? $berita->judul : ''}}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Judul Berbahasa Inggris :</label>

                                    <div class="col-sm-6">
                                        <input type="text" class="form-control" name="judul_eng" value="{{ $berita != null ? $berita->judul_eng : ''}}">
                                    </div>
                                </div>>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Status :</label>

                                    <div class="col-sm-6">
                                        <select class="form-control" name="status">
                                            @if( $berita != null )
                                                <option value="{{ $berita->status }}" selected>{{ $berita->status == 1 ? 'Tampilkan' : 'Tidak ditampilkan' }}</option>
                                                <option value="{{ $berita->status == 1 ? 0 : 1 }}">{{ $berita->status == 1 ? 'Tidak ditampilkan' : 'Tampilkan' }}</option>
                                            @else
                                                <option value="1">Tampilkan</option>
                                                <option value="0" selected>Tidak ditampilkan</option>
                                            @endif

                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="editor" class="col-sm-4 control-label">Narasi :</label>

                                    <div class="col-sm-6">
                                        <textarea class="ckeditor form-control required" id="editor" name="narasi" rows="10" cols="80">{{ $berita != null ? $berita->narasi : ''}}</textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="editor2" class="col-sm-4 control-label">Narasi Berbahasa Inggris :</label>

                                    <div class="col-sm-6">
                                        <textarea class="ckeditor form-control required" id="editor2" name="narasi_eng" rows="10" cols="80">{{ $berita != null ? $berita->narasi_eng : ''}}</textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Gambar Artikel :</label>

                                    <div class="col-sm-6">
                                        @if($berita!=null)
                                            <img src="{{ URL::to('storage/uploads/berita/'.$berita->file)}}" style="width: 600px; height: 150px; align-content: center;">
                                            <input type="hidden" name="fileName" type="hidden" value="{{$berita->file}}">
                                            </br>
                                        @endif
                                        <input type="file"  name="file" >
                                        <p class="help-block">Pilih Gambar.</p>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer ">
                            <a href="{{URL::route('artikel')}}"><button type="button" class="btn btn-default">Cancel</button></a>
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
