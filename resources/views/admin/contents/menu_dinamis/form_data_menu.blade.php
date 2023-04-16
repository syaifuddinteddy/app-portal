@extends('admin.layouts.container')
@section('title', 'Manajemen Konten')
@section('title_description', 'Tambah Data Konten')
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

                @if($content != null)
                    <div class="box-header with-border">
                        <h3 class="box-title">Edit Data Menu::{{$content->nama_menu}}</h3>
                    </div>

                @else
                    <div class="box-header with-border">
                        <h3 class="box-title">Form Add Data Menu :: {{$slug}}</h3>
                    </div>
                @endif


                @if($content != null)
                    <form action="{{URL::route('menuDinamisUpdate')}}" method="POST">
                        <input type="hidden" name="id_menu" value="{{$content->id_menu}}">
                        @else
                            <form action="{{URL::route('menuDinamisSave')}}" method="POST">
                                @endif

                                {{csrf_field()}}
                                <div class="box-body">
                                    <div class="form-horizontal col-md-9">

                                        <div class="form-group">
                                            <label class="col-sm-4 control-label">Menu Induk</label>

                                            <div class="col-sm-6">
                                                <input type="text" class="form-control"
                                                       name="menu_utama"
                                                       value="{{$slug}}" readonly>
                                            </div>
                                        </div>

                                        @if($content != null)
                                            <div class="form-group">
                                                <label class="col-sm-4 control-label">Status Menu</label>
                                                <div class="col-sm-6">
                                                    <select class="form-control" name="status">

                                                        <option value="{{$content->status}}" selected>{{ $content->status == 1 ? 'Aktif' : 'Tidak Aktif' }}</option>
                                                        <option value="{{ $content->status == 1 ? 2 : 1 }}">{{ $content->status == 1 ? 'Tidak Aktif' : 'Aktif' }}</option>

                                                    </select>
                                                </div>
                                            </div>
                                        @endif

                                        <div class="form-group">
                                            <label class="col-sm-4 control-label">Nama Menu</label>

                                            <div class="col-sm-6">
                                                <input type="text" class="form-control"
                                                       name="nama_menu"
                                                       value="{{$content != null ? $content->nama_menu : ''}}">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-sm-4 control-label">Nama Menu Bahasa Inggris</label>

                                            <div class="col-sm-6">
                                                <input type="text" class="form-control"
                                                       name="nama_menu_eng"
                                                       value="{{$content != null ? $content->nama_menu_eng : ''}}">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-sm-4 control-label">Judul Narasi</label>

                                            <div class="col-sm-6">
                                                <input type="text" class="form-control"
                                                       name="judul"
                                                       value="{{$content != null ? $content->judul : ''}}">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-sm-4 control-label">Judul Narasi Bahasa Inggris</label>

                                            <div class="col-sm-6">
                                                <input type="text" class="form-control"
                                                       name="judul_eng"
                                                       value="{{$content != null ? $content->judul : ''}}">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-sm-4 control-label">Narasi</label>

                                            <div class="col-md-8">
                                                <textarea class="ckeditor form-control required" id="f_narasi" type="text" name="narasi">
                                                    {{$content != null ? $content->narasi : ''}}
                                                </textarea>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-sm-4 control-label">Narasi Bahasa Inggris</label>

                                            <div class="col-md-8">
                                                <textarea class="ckeditor form-control required" id="f_narasi_eng" type="text" name="narasi_eng">
                                                    {{$content != null ? $content->narasi_eng : ''}}
                                                </textarea>
                                            </div>
                                        </div>






                                    </div>

                                </div>

                                <div class="box-footer ">
                                    <a href="{{URL::route('menuDinamis', $slug)}}"><button type="button" class="btn btn-default">Cancel</button></a>
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
@stop
