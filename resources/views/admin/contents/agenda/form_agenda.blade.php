@extends('admin.layouts.container')
@section('title', 'Agenda')
@if($submenuId == '11')
    @section('title_description', 'Kabupaten')
@elseif($submenuId == '12')
    @section('title_description', 'Pemerintahan')
@elseif($submenuId == '13')
    @section('title_description', 'Masyarakat')
@endif
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
                        @if($submenuId == '11')
                            <h3 class="box-title">Edit Data Agenda Kabupaten</h3>
                        @elseif($submenuId == '12')
                            <h3 class="box-title">Edit Data Agenda Pemerintahan</h3>
                        @elseif($submenuId == '13')
                            <h3 class="box-title">Edit Data Agenda Masyarakat</h3>
                        @endif
                  @else
                        @if($submenuId == '11')
                        <h3 class="box-title">Tambah Data Agenda Kabupaten</h3>
                        @elseif($submenuId == '12')
                        <h3 class="box-title">Tambah Data Agenda Pemerintahan</h3>
                        @elseif($submenuId == '13')
                        <h3 class="box-title">Tambah Data Agenda Masyarakat</h3>
                        @endif
                  @endif
                </div>
                <!-- /.box-header -->

                    @if($formType == 'edit')
                        <form action="{{ URL::route('agendaKabupatenUpdate') }}" method="POST">
                    @else
                        <form action="{{ URL::route('agendaKabupatenSave') }}" method="POST">
                    @endif

                        {{csrf_field()}}
                        <input type="hidden" name="id_agenda" value="{{ $agenda != null ? $agenda->id_agenda: '' }}">
                        <input type="hidden" name="id_submenu" value="{{ $submenuId }}">
                        <div class="box-body ">
                            <div class="form-horizontal col-md-9">
                                <div class="form-group">

                                    <label class="col-sm-4 control-label">Kegiatan :</label>

                                    <div class="col-sm-6">
                                        <input type="text" class="form-control" name="nama_kegiatan" value="{{ $agenda != null ? $agenda->nama_kegiatan : ''}}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Kegiatan Bahasa Inggris :</label>

                                    <div class="col-sm-6">
                                        <input type="text" class="form-control" name="nama_kegiatan_eng" value="{{ $agenda != null ? $agenda->nama_kegiatan_eng : ''}}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Keterangan Kegiatan :</label>

                                    <div class="col-sm-6">
                                        <textarea cols="12" class="form-control required valid" name="keterangan_kegiatan" rows="3" maxlength="400" aria-required="true" aria-invalid="false">{{ $agenda != null ? $agenda->keterangan_kegiatan : ""}}</textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Keterangan Kegiatan Bahasa Inggris :</label>

                                    <div class="col-sm-6">
                                        <textarea cols="12" class="form-control required valid" name="keterangan_kegiatan_eng" rows="3" maxlength="400" aria-required="true" aria-invalid="false">{{ $agenda != null ? $agenda->keterangan_kegiatan_eng : ''}}</textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Tempat :</label>

                                    <div class="col-sm-6">
                                        <input type="text" class="form-control" name="tempat" value="{{ $agenda != null ? $agenda->tempat : ''}}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Waktu :</label>

                                    <div class="col-sm-6">
                                        <input type="text" class="form-control" name="waktu" placeholder="14:00 S/D SELESAI" value="{{ $agenda != null ? $agenda->waktu : ''}}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Tanggal Mulai :</label>

                                    <div class="col-sm-6">
                                        <input type="date" id="tgl_mulai" name="tgl_mulai" class="form-control date-picker" value="{{ $agenda != null ? $agenda->tgl_mulai : ''}}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Tanggal Selesai :</label>

                                    <div class="col-sm-6">
                                        <input type="date" id="tgl_akhir" name="tgl_akhir" class="form-control date-picker" value="{{ $agenda != null ? $agenda->tgl_akhir : ''}}">
                                    </div>
                                </div>

                            </div>
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer ">
                            @if($submenuId == '11')
                                <a href="{{URL::route('agendaKabupaten')}}"><button type="button" class="btn btn-default">Cancel</button></a>
                            @elseif($submenuId == '12')
                                <a href="{{URL::route('agendaPemerintahan')}}"><button type="button" class="btn btn-default">Cancel</button></a>
                            @elseif($submenuId == '13')
                                <a href="{{URL::route('agendaMasyarakat')}}"><button type="button" class="btn btn-default">Cancel</button></a>
                            @endif
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
