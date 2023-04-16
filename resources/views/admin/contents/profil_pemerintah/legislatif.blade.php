@extends('admin.layouts.container')
@section('title', 'Profil Pemerintah')
@section('title_description', 'Legislatif')
@section('css')
    <link href="{{ URL::to('/engine/multiSelect/css/multi-select.css') }}" media="screen" rel="stylesheet" type="text/css">
    <link href="{{ URL::to('/engine/adminLTE/dist/css/AdminLTE.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::to('/engine/adminLTE/dist/css/skins/skin-green.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::to('/engine/iCheck/flat/blue.css') }}" rel="stylesheet" type="text/css" />
@stop
@section('body-class', 'skin-green')
@section('content')

  <div class="row">
      <div class="col-md-12">
          <div class="box box-success">
              <div class="box-header with-border">
                  <h3 class="box-title">Edit Profil Legislatif</h3>
              </div>
              
              <!-- /.box-header -->
              <div class="box-body pad">
                @foreach($profile as $p)
                <form class="form-horizontal" action="/profilSejarah/update" method="post">
                  {{ csrf_field() }}
                  <input type="hidden" name="id" value="9">
                        
                    <div class="box-body">
                    <div class="form-group">
                      <label class="col-sm-2 control-label">Judul</label>

                      <div class="col-sm-10">
                        <input type="text" name="judul" class="form-control" placeholder="Judul" value="{{ $p != null ? $p->judul : ''}}">
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="col-sm-2 control-label">Judul Bahasa Inggris</label>

                      <div class="col-sm-10">
                        <input type="text" name="judul_eng" class="form-control" placeholder="Judul Bahasa Inggris" value="{{ $p != null ? $p->judul_eng : ''}}">
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="editor1" class="col-sm-2 control-label">Narasi</label>

                      <div class="col-sm-10">
                        <textarea class="ckeditor form-control required" id="editor1" name="narasi" rows="10" cols="80">
                          {{$p->narasi}}
                        </textarea>
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="editor2" class="col-sm-2 control-label">Narasi Bahasa Inggris</label>

                      <div class="col-sm-10">
                        <textarea class="ckeditor form-control required" id="editor2" name="narasi_eng" rows="10" cols="80">
                          {{$p->narasi_eng}}
                        </textarea>
                      </div>
                    </div>

                  </div>
                  <!-- /.box-body -->
                  <div class="box-footer">
                    <button type="submit" class="btn btn-info pull-right">Submit</button>
                  </div>
                  <!-- /.box-footer -->
                  
                </form>
                @endforeach
              </div>
              <!-- /.box -->

          </div>
      </div>

  </div>

@stop
@section('js')
    <script src="{{ URL::to('/engine/iCheck/icheck.min.js') }}" type="text/javascript"></script>
    <script src="{{ URL::to('/engine/fastclick/fastclick.min.js') }}"></script>
    <script src="{{ URL::to('/engine/ckeditor/ckeditor.js') }}"></script>

@stop
