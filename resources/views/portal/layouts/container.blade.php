<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>PORTAL RESMI - PEMKAB BOJONEGORO</title>
    <link rel="stylesheet" href="{{ URL::to('portal/css/bootstrap.min.css') }}"/>
    <link rel="stylesheet" href="{{ URL::to('portal/css/web.css') }}"/>
    <link rel="stylesheet" href="{{ URL::to('portal/css/owl.carousel.min.css') }}"/>
    <link rel="stylesheet" href="{{ URL::to('portal/css/owl.theme.green.min.css') }}"/>
    <link rel="stylesheet" href="{{ URL::to('portal/css/fontawesome/css/all.css') }}"/>


    @yield('css')
</head>

<body id="web">
    @include('portal.layouts.navbar')
    <div class="container-fluid">

        @yield('jumbotron')
    </div>
        @yield('content')
    <div class="container-fluid">
        @include('portal.layouts.footer')
    </div>

    <script src="{{ URL::to('portal/js/jquery.js') }}"></script>
    <script src="{{ URL::to('portal/js/popper.js') }}"></script>
    <script src="{{ URL::to('portal/js/bootstrap.min.js') }}"></script>
    <script src="{{ URL::to('portal/js/owl.carousel.min.js') }}"></script>
    <script src="{{ URL::to('portal/js/script.js') }}"></script>

    <script>
        const $dropdown = $(".dropdown");
        const $dropdownToggle = $(".dropdown-toggle");
        const $dropdownMenu = $(".dropdown-menu");
        const showClass = "show";

        $(window).on("load resize", function() {
            if (this.matchMedia("(min-width: 768px)").matches) {
                $dropdown.hover(
                    function() {
                        const $this = $(this);
                        $this.addClass(showClass);
                        $this.find($dropdownToggle).attr("aria-expanded", "true");
                        $this.find($dropdownMenu).addClass(showClass);
                    },
                    function() {
                        const $this = $(this);
                        $this.removeClass(showClass);
                        $this.find($dropdownToggle).attr("aria-expanded", "false");
                        $this.find($dropdownMenu).removeClass(showClass);
                    }
                );
            } else {
                $dropdown.off("mouseenter mouseleave");
            }
        });
    </script>

    @yield('js')
</body>
</html>
