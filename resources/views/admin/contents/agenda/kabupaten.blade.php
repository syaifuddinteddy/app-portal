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
    <link href="{{ URL::to('/engine/datatables.net-bs/css/dataTables.bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
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

                @if(session('msg_error') != null)
                    <div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h4><i class="icon fa fa-check"></i> Notifikasi!</h4>
                        {{session('msg_error')}}
                    </div>
                @endif
            <div class="box box-success">
                <div class="box-header with-border">
                    @if($submenuId == '11')
                        <h3 class="box-title">Data Agenda Kabupaten</h3>
                    @elseif($submenuId == '12')
                        <h3 class="box-title">Data Agenda Pemerintahan</h3>
                    @elseif($submenuId == '13')
                        <h3 class="box-title">Data Agenda Masyarakat</h3>
                    @endif
                    <div class="pull-right">
                        <a href="{{URL::route('agendaKabupatenAdd', $submenuId)}}"><button type="button" class="btn btn-success"><i class="fa fa-plus"></i> Tambah Data Agenda</button></a>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table id="tbAgenda" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th class="bg-blue">No</th>
                            <th class="bg-blue">Kegiatan</th>
                            <th class="bg-blue">Tempat</th>
                            <th class="bg-blue">Tanggal</th>
                            <th class="bg-blue">Waktu</th>
                            <th class="bg-blue">Aksi</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $no = 0;?>
                        @foreach($agenda as $idx => $agenda)
                        <?php $no++ ;?>
                        <tr>
                            <td>{{ $no }}</td>
                            <td>{{$agenda->nama_kegiatan}}</td>
                            <td>{{$agenda->tempat}}</td>
                            <td>{{$agenda->tgl_mulai}} s/d {{$agenda->tgl_akhir}}</td>
                            <td>{{$agenda->waktu}}</td>
                            <td align="center">
                                <a class="btn btn-small btn-warning" href="{{ URL::route('agendaKabupatenEdit', $agenda->id_agenda)}}"><div class="fa fa-pencil"></div></a>
                                <a class="btn btn-small btn-danger" href="{{ URL::route('agendaKabupatenDelete', $agenda->id_agenda) }}"><div class="fa fa-file"></div></a>
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.box-body -->
            </div>
        </div>

    </div>
@stop
@section('js')
    <script src="{{ URL::to('/engine/iCheck/icheck.min.js') }}" type="text/javascript"></script>
    <script src="{{ URL::to('/engine/fastclick/fastclick.min.js') }}"></script>
    <script src="{{ URL::to('/engine/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ URL::to('/engine/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>


    <!-- DataTables Load -->
    <script type="text/javascript">
        $(function () {
            $('#tbAgenda').DataTable()
        })
    </script>
@stop
