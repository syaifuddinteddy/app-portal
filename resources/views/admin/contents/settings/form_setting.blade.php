@extends('admin.layouts.container')
@section('title', 'Setting')
@section('title_description', 'Edit Kontak Kami')
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
                    <h3 class="box-title">Form Edit Kontak Kami</h3>
                </div>

                <form method="POST" action="{{URL::route('dinasUpdate')}}">
                    {{csrf_field()}}
                    <input name="id_profile" value="{{$profile->id_profile}}" type="hidden">
                <div class="box-body">
                    <div class="col-md-12">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Nama Kantor :</label>
                                <input type="text" class="form-control" name="nama_dinas" value="{{$profile->nama_dinas}}" >
                            </div>
                        </div>


                    </div>

                    <div class="col-md-12">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Alamat :</label>
                                <textarea type="text" id="alamat" class="form-control" name="alamat">{{$profile->alamat}}</textarea>
                            </div>

                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Telepon :</label>
                                <textarea type="text" id="telepon" class="form-control" name="telp">{{$profile->telp}}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Email :</label>
                                <textarea type="text" id="email" class="form-control" name="email">{{$profile->email}}</textarea>
                            </div>

                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Fax :</label>
                                <textarea type="text" id="fax" class="form-control" name="fax">{{$profile->fax}}</textarea>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Facebook :</label>
                                <input type="text"  class="form-control" name="facebook" value="{{$profile->facebook}}">
                            </div>

                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Instagram :</label>
                                <input type="text" class="form-control" name="instagram" value="{{$profile->instagram}}">
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Twitter :</label>
                                <input type="text" class="form-control" name="twitter" value="{{$profile->twitter}}">
                            </div>

                        </div>


                    </div>

                    <div class="col-md-12">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Running Text :</label>
                                <textarea type="text" id="runningtext" class="form-control" name="running">{{$profile->running}}</textarea>
                            </div>
                        </div>
                    </div>

                </div>

                    <div class="box-footer ">
                        <a href="{{URL::route('dinas')}}"><button type="button" class="btn btn-default">Cancel</button></a>
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
    <script src="{{ URL::to('/engine/ckeditor/ckeditor.js') }}" type="text/javascript"></script>

    <script type="text/javascript">
        CKEDITOR.replace('alamat', {

            toolbarGroups: [
                {"name":"basicstyles","groups":["basicstyles"]},
                {"name":"document","groups":["mode"]},
            ],
            removeButtons: 'Save,Smiley,Flash,Styles,NewPage,CreateDiv',
            removePlugins: 'maximize,resize'
        });

        CKEDITOR.replace('telepon', {

            toolbarGroups: [
                {"name":"basicstyles","groups":["basicstyles"]},
                {"name":"document","groups":["mode"]},
            ],
            removeButtons: 'Save,Smiley,Flash,Styles,NewPage,CreateDiv',
            removePlugins: 'maximize,resize'
        });

        CKEDITOR.replace('fax', {

            toolbarGroups: [
                {"name":"basicstyles","groups":["basicstyles"]},
                {"name":"document","groups":["mode"]},
            ],
            removeButtons: 'Save,Smiley,Flash,Styles,NewPage,CreateDiv',
            removePlugins: 'maximize,resize'
        });

        CKEDITOR.replace('email', {

            toolbarGroups: [
                {"name":"basicstyles","groups":["basicstyles"]},
                {"name":"document","groups":["mode"]},
            ],
            removeButtons: 'Save,Smiley,Flash,Styles,NewPage,CreateDiv',
            removePlugins: 'maximize,resize'
        });

        CKEDITOR.replace('runningtext', {

            toolbarGroups: [
                {"name":"basicstyles","groups":["basicstyles"]},
                {"name":"document","groups":["mode"]},
            ],
            removeButtons: 'Save,Smiley,Flash,Styles,NewPage,CreateDiv',
            removePlugins: 'maximize,resize'
        });
    </script>
@stop
