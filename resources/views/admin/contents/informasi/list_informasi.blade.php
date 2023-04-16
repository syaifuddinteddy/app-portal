@extends('admin.layouts.container')
@section('title', 'Manajemen Konten')
@section('title_description', 'Daftar Data Informasi Terkini')
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
                    <h3 class="box-title">Data Informasi Terkini</h3>
                    <div class="pull-right">
                        <a href="{{URL::Route('informasiTerkiniAdd')}}"><button type="button" class="btn btn-success"><i class="fa fa-plus"></i> Tambah Informasi</button></a>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table id="tbInformasi" class="table table-bordered table-striped table-hover">
                        <thead>
                        <tr>
                            <th class="bg-blue" style="width: 10px;">No</th>
                            <th class="bg-blue">Informasi Terkini</th>
                            <th class="bg-blue">Tempat</th>
                            <th class="bg-blue">Tanggal</th>
                            <th class="bg-blue">Waktu</th>
                            <th class="bg-blue" style="width: 100px;">Aksi</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($informasi as $idx => $informasi_item)
                            <tr>
                                <td>{{$idx + 1}}</td>
                                <td>{{$informasi_item->nama_informasi_terkini}}</td>
                                <td>{{$informasi_item->tempat}}</td>
                                <td>{{$informasi_item->tgl_mulai.' s/d '.$informasi_item->tgl_akhir}}</td>
                                <td>{{$informasi_item->waktu}}</td>

                                <td align="center">
                                    <a class="btn btn-small btn-warning" href="{{ URL::route('informasiTerkiniEdit', $informasi_item->id_informasi_terkini)}}"><div class="fa fa-pencil"></div></a>
                                    <a class="btn btn-small btn-danger" href="{{ URL::route('informasiTerkiniDelete', $informasi_item->id_informasi_terkini) }}"><div class="fa fa-trash"></div></a>
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
            $('#tbInformasi').DataTable({
                "ordering": false
            })
        })
    </script>
@stop
