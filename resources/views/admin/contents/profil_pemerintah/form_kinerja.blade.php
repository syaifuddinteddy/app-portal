@extends('admin.layouts.container')
@section('title', 'Profil Pemerintah')
@section('title_description', 'Regulasi Kabupaten')
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
                      <h3 class="box-title">Edit Data Regulasi Kabupaten</h3>
                  @else
                      <h3 class="box-title">Tambah Data Regulasi Kabupaten</h3>
                  @endif
                </div>
                <!-- /.box-header -->

                    @if($formType == 'edit')
                        <form action="{{ URL::route('kinerjaPemerintahUpdate') }}" method="POST">
                    @else
                        <form action="{{ URL::route('kinerjaPemerintahSave') }}" method="POST">
                    @endif

                        {{csrf_field()}}
                        <input type="hidden" name="id_kinerja" value="{{ $kinerja != null ? $kinerja->id_kinerja: '' }}">
                        <div class="box-body ">
                            <div class="form-horizontal col-md-9">
                                <div class="form-group">

                                    <label class="col-sm-4 control-label">Nama Judul :</label>

                                    <div class="col-sm-6">
                                        <input type="text" class="form-control" name="judul" value="{{ $kinerja != null ? $kinerja->judul : ''}}">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Tahun :</label>

                                    <div class="col-sm-6">
                                        <select style="cursor:pointer;" class="form-control" id="tag_select" name="tahun">
                                            <?php 
                                                $year = date('Y');
                                                $min = 2012;
                                                $max = $year + 1;
                                                $selected = $kinerja != null ? $kinerja->tahun : '0';
                                                
                                                for( $i=$max; $i>=$min; $i-- ) {
                                                    if ( $i == $selected ) {
                                                        echo '<option value='.$i.' selected >'.$i.'</option>';
                                                    } else {
                                                        echo '<option value='.$i.'>'.$i.'</option>';
                                                    }
                                                }
                                            ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="editor2" class="col-sm-4 control-label">Narasi Regulasi</label>

                                    <div class="col-sm-6">
                                        <textarea class="ckeditor form-control required" id="editor" name="narasi" rows="10" cols="80">{{ $kinerja != null ? $kinerja->narasi : ''}}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer ">
                            <a href="{{URL::route('kinerjaPemerintah')}}"><button type="button" class="btn btn-default">Cancel</button></a>
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
