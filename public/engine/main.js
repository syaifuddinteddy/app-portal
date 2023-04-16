// JavaScript Document

require(["jquery", "jquery.ui", "jquery.migrate", "jquery.bootstrap", "noty", "engine/noty/themes/default", "engine/noty/layouts/top", "engine/noty/layouts/topCenter", "engine/noty/layouts/bottom", "engine/noty/layouts/bottomRight"], function($) {
	$(function() {
        var navbar = $('.navbar');
        var imgWidth = $('.brand img');
        var $root = $('html, body');

		$.fx.speeds._default = 200;
		if ((navigator.sayswho[0] == 'MSIE') && (navigator.sayswho[1] < 10)) {
			var n = noty({text:  "<p class=\"alert alert-danger\">Sorry, this site is not compatible with Internet Explorer 9 or below. Please use Internet Explorer 10, Firefox or Chrome. Thank you.</p>", layout: "topCenter", dismissQueue: true, type:"error"});
		}

        $root.find("a").each(function() {
            if ($(this).hasClass("anchor-point")) {
                $(this).click(function() {
                    var href = $.attr(this, 'href');
                    $root.animate({
                        scrollTop: $(href).offset().top
                    }, 800, function () {
                        window.location.hash = href;
                    });
                    return false;
                });
            }
        });
        $root.removeAttr("style");

        if ($(this).scrollTop() >= 70) {
            if (!navbar.hasClass('navbar-fixed-top')) {
                navbar.addClass('navbar-fixed-top animated fadeInDown');
                $('#navbar-collapse-1').css('margin-top', '0');
            }
            imgWidth.width('80');
        } else {
            if (navbar.hasClass('navbar-fixed-top')) {
                navbar.removeClass('navbar-fixed-top animated fadeInDown');
                $('#navbar-collapse-1').css('margin-top', '30px');
            }
            imgWidth.width('128');
        }

        $(window).on('scroll', function () {
            if ($(this).scrollTop() >= 70) {
                if (!navbar.hasClass('navbar-fixed-top')) {
                    navbar.addClass('navbar-fixed-top animated fadeInDown');
                    $('#navbar-collapse-1').css('margin-top', '0');
                }
                imgWidth.width('80');
            } else {
                if (navbar.hasClass('navbar-fixed-top')) {
                    navbar.removeClass('navbar-fixed-top animated fadeInDown');
                    $('#navbar-collapse-1').css('margin-top', '30px');

                }
                imgWidth.width('128');
            }
        });
	});
});