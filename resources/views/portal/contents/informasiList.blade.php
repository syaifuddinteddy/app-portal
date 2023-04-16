@extends('portal.layouts.container')

@section('css')
    <link rel="stylesheet" href="{{ URL::to('portal/css/style.css') }}"/>
@endsection

@section('jumbotron')

    <!-- START INFO -->
    <div class="jumbotron jumbotron-fluid jumbotron-success mt-0 pt-4">
        <div class="container-fluid text-white info-block">
            <div class="row">
                <div class="col-lg-12">
                    <h4 class="label-heading-white">INFORMASI</h4>
                    <h3 >KABUPATEN BOJONEGORO</h3>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('content')
<div class="container-fluid py-0"  >
        <div class="wrapper">
            <nav id="sidebar">
                <div class="sidebar-header" style="background: #254D32">
                    <h4>Daftar Informasi</h4>
                </div>
                <ul class="list-unstyled components">
                    @foreach($mn_informasi as $idx => $dtMenuInfo)
                        <li>
                            <a href="#pageSubmenu{{ $dtMenuInfo->nm_menu }}" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                                {{ $dtMenuInfo->nm_menu }}</a>
                            @if($dtMenuInfo->menu_dinamis && $dtMenuInfo->menu_dinamis->count() > 0)
                                <ul class="collapse list-unstyled" id="pageSubmenu{{ $dtMenuInfo->nm_menu }}">
                                    @foreach($dtMenuInfo->menu_dinamis as $subMenu)
                                        <li>
                                            <a class="nav-link" href="{{URL::route('informasi', '&id='.$subMenu->id_menu)}}">{{ $subMenu->nama_menu }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            @endif

                        </li>
                    @endforeach

                </ul>
            </nav>
            <div id="content">
                <div class="container-small">
                    @if($detailInformasi != null)
                        {!! $detailInformasi->narasi !!}
                    @endif
                </div>
            </div>
        </div>
</div>
@endsection

@section('js')
        <!-- Font Awesome JS -->
        <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
        <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
        <script type="text/javascript">
            $(document).ready(function () {
                $('#sidebarCollapse').on('click', function () {
                    $('#sidebar').toggleClass('active');
                });
            });
        </script>
@endsection



