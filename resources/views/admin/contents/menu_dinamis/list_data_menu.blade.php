@extends('admin.layouts.container')
@section('title', 'Manajemen Konten')
@section('title_description', 'Daftar Data Konten')
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
                    <h3 class="box-title">Data Konten Menu :: {{$dtContent[0]->menu_utama}}</h3>
                    <div class="pull-right">
                        <a href="{{URL::route('menuDinamisAdd', $dtContent[0]->menu_utama)}}"><button type="button" class="btn btn-success"><i class="fa fa-plus"></i> Tambah Konten</button></a>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table id="tbContent" class="table table-bordered table-striped table-hover">
                        <thead>
                        <tr>
                            <th class="bg-blue ">Nama Menu</th>
                            <th class="bg-blue col-md-1">Status</th>
                            <th class="bg-blue">Aksi</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($dtContent as $idx => $dtContent_item)
                            <tr>
                                <td>{{$dtContent_item->nama_menu}}</td>
                                <td class="text-center">
                                    @if($dtContent_item->status == 1)
                                        <span class="badge bg-green"><i class="fa fa-warning"></i> Aktif</span>
                                    @else
                                        <span class="badge bg-red"><i class="fa fa-warning"></i> Tidak Aktif</span>
                                    @endif
                                </td>

                                <td align="center">
                                    <a class="btn btn-small btn-warning" href="{{ URL::route('menuDinamisEdit', $dtContent_item->id_menu)}}"><div class="fa fa-pencil"></div></a>
                                    <a class="btn btn-small btn-danger" href="{{ URL::route('menuDinamisDelete', $dtContent_item->id_menu) }}"><div class="fa fa-trash"></div></a>
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
            $('#tbContent').DataTable({
                "ordering": false
            })
        })
    </script>
@stop
