<nav class="navbar navbar-expand-lg navbar-light pt-4">
    <a class="navbar-brand nav-brand" href="#">
        <img src="{{ URL::to('portal/assets/img/logo.png') }}" alt=""/>
        <span class="nav-text">
                    <span class="nav-text-site">WEBSITE RESMI</span>
                    <span class="nav-text-brand">PEMERINTAH KABUPATEN BOJONEGORO</span>
                </span>
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTop" aria-controls="navbarTop" aria-expanded="false" aria-label="Toggle navigation">
        <span class="fa fa-bars"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarTop">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item {{ (request()->is('beranda')) ? 'active' : '' }}">
                <a class="nav-link" href="{{ URL::to('beranda') }}">BERANDA
                    <span class="sr-only">(current)</span>
                </a>
            </li>
            <li class="nav-item dropdown {{ (request()->is('profile*')) ? 'active' : '' }}">
                <a class="nav-link" href="#" id="navbarDropdown2" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    PROFIL
                </a>

                <div class="dropdown-menu" style="width: 250px;" aria-labelledby="navbarDropdown2">

                    <div class="navbar-header">
                            <a class="nav-link" href="{{URL::route('portalProfilKabupaten')}}">Tentang Kabupaten</a></div>

                    <div class="navbar-header">
                            <a class="nav-link" href="{{URL::route('portalProfilPemerintahan')}}">Pemerintahan Kabupaten</a></div>


                </div>
            </li>
            <li class="nav-item {{ (request()->is('berita')) ? 'active' : '' }}">
                <a class="nav-link" href="{{ URL::to('berita') }}">BERITA</a>
            </li>
            <li class="nav-item {{ (request()->is('informasi')) ? 'active' : '' }}">
                <a class="nav-link" href="{{ URL::to('informasi') }}">INFORMASI</a>
            </li>
            <li class="nav-item {{ (request()->is('agenda')) ? 'active' : '' }}">
                <a class="nav-link" href="{{ URL::to('agenda') }}">AGENDA</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="http://kabbojonegoro.jdih.jatimprov.go.id/" target="_blank">REGULASI</a>
            </li>
            <li class="nav-item dropdown {{ (request()->is('media*')) ? 'active' : '' }}">
                <a class="nav-link" href="#" id="navbarDropdown3" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    MEDIA CENTER
                </a>

                <div class="dropdown-menu" style="width: 250px;" aria-labelledby="navbarDropdown3">

                    <div class="navbar-header">
                        <a class="nav-link" href="{{URL::route('galeriFoto')}}">Gallery Kota</a></div>

                    <div class="navbar-header">
                        <a class="nav-link" href="{{URL::route('galeriVideo')}}">Gallery Video</a></div>

                    <div class="navbar-header">
                        <a class="nav-link" href="{{URL::route('jonegorojengker')}}">Jonegoro Jengker</a></div>


                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link" href="#" id="navbarDropdown4" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    WEB GIS CITY
                </a>

                <div class="dropdown-menu" style="width: 250px;" aria-labelledby="navbarDropdown4">
                    <div class="navbar-header">
                        <a class="nav-link" href="{{URL::route('galeriFoto')}}">Gallery Kota</a></div>
                </div>
            </li>
        </ul>
    </div>
</nav>
