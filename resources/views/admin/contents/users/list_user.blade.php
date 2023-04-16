@extends('admin.layouts.container')
@section('title', 'Manajemen User')
@section('title_description', 'Daftar User')
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
                    <h3 class="box-title">Data Pegawai</h3>
                    <div class="pull-right">
                        <a href="{{URL::route('pegawaiAdd')}}"><button type="button" class="btn btn-success"><i class="fa fa-plus"></i> Tambah Pegawai</button></a>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table id="tbPegawai" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th class="bg-blue">NIP</th>
                            <th class="bg-blue">Nama Lengkap</th>
                            <th class="bg-blue">SKPD</th>
                            <th class="bg-blue">Kategori User</th>
                            <th class="bg-blue">User</th>
                            <th class="bg-blue">Aksi</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($pegawai as $idx => $pegawai)
                        <tr>
                            <td>{{$pegawai->nip}}</td>
                            <td>{{$pegawai->nama_lengkap}}</td>
                            <td>{{$pegawai->skpd}}</td>
                            <td>{{$pegawai->kategori_user}}</td>
                            <td>{{$pegawai->username}}</td>
                            <td align="center">
                                <a class="btn btn-small btn-warning" href="{{ URL::route('pegawaiEdit', $pegawai->id_pegawai)}}"><div class="fa fa-pencil"></div></a>
                                <a class="btn btn-small btn-danger" href="{{ URL::route('pegawaiDelete', $pegawai->id_pegawai) }}"><div class="fa fa-file"></div></a>
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
            $('#tbPegawai').DataTable()
        })
    </script>
@stop
