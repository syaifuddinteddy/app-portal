@extends('admin.layouts.container')
@section('title', 'Manajemen Kategori')
@section('title_description', 'Form Kategori User')
@section('css')
    <link href="{{ URL::to('/engine/multiSelect/css/multi-select.css') }}" media="screen" rel="stylesheet" type="text/css">
    <link href="{{ URL::to('/engine/adminLTE/dist/css/AdminLTE.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::to('/engine/adminLTE/dist/css/skins/skin-red.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::to('/engine/iCheck/flat/blue.css') }}" rel="stylesheet" type="text/css" />

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
                        <h3 class="box-title">Edit Kategori::{{$dtKategori->kategori_user}}</h3>
                    @else
                        <h3 class="box-title">Tambah Kategori</h3>
                    @endif
                </div>


                @if($formType == 'edit')
                    <form action="{{ URL::route('kategoriUserUpdate') }}" method="POST">
                        <input type="hidden" name="id_kategori_user" value="{{$dtKategori->id_kategori_user}}">
                @else
                    <form action="{{ URL::route('kategoriUserSave') }}" method="POST">
                @endif
                {{csrf_field()}}
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="form-horizontal">
                        <div class="form-group" style="margin-right: 300px;">
                                <label for="inputEmail3" class=" col-md-2 control-label">Nama Kategori :</label>

                                <div class="col-md-8">
                                    @if(isset($dtKategori))
                                        <input type="text" class="form-control" name="kategori_user"
                                               value="{{$dtKategori->kategori_user}}"
                                               required>
                                    @else
                                    <input type="text" class="form-control" name="kategori_user"
                                           placeholder="Input Nama Kategori .."
                                           required>
                                    @endif
                                </div>

                        </div>

                        <div class="form-group" style="margin-right: 260px;">
                            <label class="control-label col-md-2 text-danger">Hak Akses Menu :</label>

                        </div>
                    </div>


                    <div class="col-md-12">
                    @if(isset($dtKategori))
                            @foreach($menu as $idx=>$dtMenu)
                                <div class="col-md-3">
                                    <!-- checkbox -->
                                    <div class="form-group">
                                        <input type="checkbox"  name="checkbox_menu[]"
                                               class="minimal-red"
                                               value="{{$dtMenu->id_menu}}"
                                            {{ in_array($dtMenu->id_menu, $dtHakAkses) == true ? 'checked': null }}>
                                        <b>{{$dtMenu->nm_menu}}</b><br>
                                        @foreach($subMenu as $idx=>$dtSubMenu)
                                            @if($dtSubMenu->id_parent == $dtMenu->id_menu)
                                                <input type="checkbox" id="checkbox_menu[]" name="checkbox_menu[]"
                                                       value="{{$dtSubMenu->id_menu}}"
                                                    {{ in_array($dtSubMenu->id_menu, $dtHakAkses) == true ? 'checked': null }}
                                                       class="minimal-red" style="margin-left: 20px;">
                                                {{$dtSubMenu->nm_menu}}<br>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                    @else
                        @foreach($menu as $idx=>$dtMenu)
                            <div class="col-md-3">
                            <!-- checkbox -->
                                <div class="form-group">
                                        <input type="checkbox"  name="checkbox_menu[]"
                                               class="minimal-red" value="{{$dtMenu->id_menu}}" >
                                        <b>{{$dtMenu->nm_menu}}</b><br>
                                        @foreach($subMenu as $idx=>$dtSubMenu)
                                            @if($dtSubMenu->id_parent == $dtMenu->id_menu)
                                                <input type="checkbox" id="checkbox_menu[]" name="checkbox_menu[]"
                                                       value="{{$dtSubMenu->id_menu}}"
                                                       class="minimal-red" style="margin-left: 20px;">
                                                {{$dtSubMenu->nm_menu}}<br>
                                            @endif
                                        @endforeach
                                </div>
                            </div>
                        @endforeach
                    @endif
                    </div>
                </div>

                <!-- /.box-body -->
                <div class="box-footer ">
                    <a href="{{URL::route('kategoriUser')}}"><button type="button" class="btn btn-default">Cancel</button></a>
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


@stop
