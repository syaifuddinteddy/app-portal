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
                    @if($submenuId == 11)
                        <h4 class="label-heading-white">AGENDA KABUPATEN</h4>
                    @elseif($submenuId == 12)
                        <h4 class="label-heading-white">AGENDA PEMERINTAHAN</h4>
                    @elseif($submenuId == 13)
                        <h4 class="label-heading-white">AGENDA MASYARAKAT</h4>
                    @endif
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
                    <h4>Daftar Agenda</h4>
                </div>
                <ul class="list-unstyled components">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ URL::route('agenda').'?&category=kabupaten' }}" >
                            Kabupaten
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ URL::route('agenda').'?&category=pemerintahan' }}" >
                            Pemerintahan
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ URL::route('agenda').'?&category=masyarakat' }}" >
                            Masyarakat
                        </a>
                    </li>
                </ul>
            </nav>
            <div id="content">
                <div class="container-small">
                    <div class="row">
                        <h2>{{ $agenda->nama_kegiatan }}</h2>
                        <div class="mt-3 w-100 h-50">{!! $agenda->keterangan_kegiatan !!}</div>
                        <table border="0">
                            <tr>
                                <td>Tempat</td>
                                <td>: {{ $agenda->tempat }}</td>
                            </tr>
                            <tr>
                                <td>Hari</td>
                                <td>: {{ $agenda->tgl_mulai }} s/d {{ $agenda->tgl_akhir }}</td>
                            </tr>
                            <tr>
                                <td>Waktu</td>
                                <td>: {{ $agenda->waktu }}</td>
                            </tr>
                        </table>
                    </div>
                    <div class="pull-right">
                        @if($submenuId == 11)
                            <a href="{{ URL::route('agenda').'?&category=kabupaten' }}"><button type="button" class="btn btn-success"> Kembali ke Daftar Agenda Kabupaten ..</button></a>
                        @elseif($submenuId == 12)
                            <a href="{{ URL::route('agenda').'?&category=pemerintahan' }}"><button type="button" class="btn btn-success"> Kembali ke Daftar Agenda Pemerintahan ..</button></a>
                        @elseif($submenuId == 13)
                            <a href="{{ URL::route('agenda').'?&category=masyarakat' }}"><button type="button" class="btn btn-success"> Kembali ke Daftar Agenda Masyarakat ..</button></a>
                        @endif
                    </div>
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



