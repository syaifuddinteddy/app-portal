@extends('admin.layouts.container')
@section('title', 'Manajemen Media')
@section('title_description', 'Daftar Konten Video')
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
                    <h3 class="box-title">Daftar Video</h3>
                    <div class="pull-right">
                        <a href="{{URL::route('galleryVideoAdd')}}"><button type="button" class="btn btn-success">
                                <i class="fa fa-plus"></i> Tambah Video</button></a>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table id="tbVideo" class="table table-bordered table-striped table-hover">
                        <thead>
                        <tr>
                            <th class="bg-blue">Judul Video</th>
                            <th class="bg-blue">URL</th>
                            <th class="bg-blue">Cuplikan Video</th>
                            <th class="bg-blue">Status</th>
                            <th class="bg-blue">Aksi</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($video as $idx => $video_item)
                            <tr>
                                <td class="col-md-4 ">{{$video_item->judul_video}}</td>
                                <td class="col-md-2"><a href="{{$video_item->url}}">{{$video_item->url}}</a></td>
                                <td class="col-md-3">
                                    <iframe width="300" height="150" src="{{str_replace("watch?v=","embed/", $video_item->url)}}"
                                            frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                            allowfullscreen></iframe>
                                </td>
                                <td class="col-md-1">
                                    @if($video_item->status == 1)
                                        <span class="badge bg-green"><i class="fa fa-warning"></i> Aktif</span>
                                    @else
                                        <span class="badge bg-red"><i class="fa fa-warning"></i> Tidak Aktif</span>
                                    @endif
                                </td>

                                <td class="col-md-2 text-center">
                                    <a class="btn btn-small btn-warning" href="{{ URL::route('galleryVideoEdit', $video_item->id_video)}}"><div class="fa fa-pencil"></div></a>
                                    <a class="btn btn-small btn-danger" href="{{ URL::route('galleryVideoDelete', $video_item->id_video) }}"><div class="fa fa-trash"></div></a>
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
            $('#tbVideo').DataTable({
                "ordering": false
            })
        })
    </script>
@stop
