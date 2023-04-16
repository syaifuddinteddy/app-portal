@extends('portal.layouts.container')

@section('css')
    <link rel="stylesheet" href="{{ URL::to('portal/css/style.css') }}"/>
@endsection

@section('jumbotron')
<!-- START INFO -->
<div class="jumbotron jumbotron-fluid jumbotron-success mt-3 pt-4 pb-4">
    <div class="container-fluid text-white info-block">
        <div class="row">
            <div class="col-lg-12">
                <h4 class="label-heading-white">AGENDA {{ strtoupper($category) }}</h4>
                <h3 >KABUPATEN BOJONEGORO</h3>
            </div>
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="container-fluid py-0" >
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
                <ul class="news">
                    <li>
                        <div class="row">
                            @foreach($agendaList as $idx => $agenda)
                                <div class="col-md-8 col-8">
                                    <h4>
                                        <a href="{{ URL::route('agendaDetail', [$agenda->id_agenda, $agenda->id_submenu]) }}">{{ $agenda->nama_kegiatan }}</a>
                                    </h4>
                                    <span class="date">
                                    {{  date_format(date_create($agenda->tgl_mulai), 'd-m-Y') }}
                                    s/d
                                    {{  date_format(date_create($agenda->tgl_akhir), 'd-m-Y') }}  {{ $agenda->waktu }}
                                </span> <br>
                                    <div class="content-news">
                                        {{ $agenda->keterangan_kegiatan }}
                                    </div>
                                </div>
                            @endforeach
                        </div>

                    </li>

                </ul>

                <br>
                @if($agendaList != null)
                    {{ $agendaList->appends(['category' => $category])->render()}}
                @endif
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



