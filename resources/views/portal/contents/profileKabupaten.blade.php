@extends('portal.layouts.container')

@section('css')
    <link rel="stylesheet" href="{{ URL::to('portal/css/style.css') }}"/>
@endsection

@section('content')
@section('jumbotron')
    <!-- START INFO -->
    <div class="jumbotron jumbotron-fluid jumbotron-success mt-3 pt-4 pb-4">
        <div class="container-fluid text-white info-block">
            <div class="row">
                <div class="col-lg-12">
                    <h4 class="label-heading-white">PROFILE</h4>
                    <h3 >KABUPATEN BOJONEGORO</h3>
                </div>
            </div>
        </div>
    </div>
@endsection

    <div class="container-fluid py-0" >
        <div class="wrapper">
            <nav id="sidebar">
                <div class="sidebar-header" style="background: #254D32">
                    <h4>Daftar Menu</h4>
                </div>
                <ul class="list-unstyled components">
                    @foreach($profileKabupaten as $idx=>$profile)
                    <li class="nav-item">
                        <a class="nav-link" href="{{ URL::route('portalProfilKabupaten').'?&category='.$profile->id_submenu }}" >
                            {{$profile->judul}}
                        </a>
                    </li>
                    @endforeach
                </ul>
            </nav>
            <div id="content">
                <div class="container-small">
                    <ul class="news">
                        <li>
                            <div class="row">
                                @foreach($narasi as $idx => $narasiData)
                                    <div class="col-md-8 col-8">
                                        <h4>{{$narasiData->judul}}</h4>
                                        <div class="content-news">
                                            {!! $narasiData->narasi !!}
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <!-- Font Awesome JS -->
    <script type="text/javascript">
        $(document).ready(function () {
            $('#sidebarCollapse').on('click', function () {
                $('#sidebar').toggleClass('active');
            });
        });
    </script>
@endsection



