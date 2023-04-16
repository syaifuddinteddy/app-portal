// JavaScript Document
	var parts = window.location.search.substr(1).split("&");
	var $_GET = {};
	
	navigator.sayswho = (function(){
		var N = navigator.appName, ua= navigator.userAgent, tem;
		var M = ua.match(/(opera|chrome|safari|firefox|msie)\/?\s*(\.?\d+(\.\d+)*)/i);
		if(M && (tem = ua.match(/version\/([\.\d]+)/i))!= null) M[2]= tem[1];
		M = M? [M[1], M[2]]: [N, navigator.appVersion,'-?'];
		return M;
	})();

    function setExpiration(cookieLife){
        var today = new Date();
        var expr = new Date(today.getTime() + cookieLife * 24 * 60 * 60 * 1000);
        return  expr.toGMTString();
    }
	
	function setCookie(name, value, expires, path, domain, secure) {
        cookieStr = name + "=" + escape(value) + "; ";

        if(expires){
            expires = setExpiration(expires);
            cookieStr += "expires=" + expires + "; ";
        }
        if(path){
            cookieStr += "path=" + path + "; ";
        }
        if(domain){
            cookieStr += "domain=" + domain + "; ";
        }
        if(secure){
            cookieStr += "secure; ";
        }

        document.cookie = cookieStr;
	}
	
	function getCookie(name) {
		var i, x, y, array_cookies = document.cookie.split(";");

        for (i = 0; i < array_cookies.length; i++) {
			x = array_cookies[i].substr(0, array_cookies[i].indexOf("="));
			y = array_cookies[i].substr(array_cookies[i].indexOf("=") + 1);
			x = x.replace(/^\s+|\s+$/g,"");
            if (x == name) {
				return unescape(y);
			}
		}
	}	

	function eraseCookie(name) {
        var pathBits = location.pathname.split('/');
        var pathCurrent = ' path=';
        document.cookie = name + '=; expires=Thu, 01-Jan-1970 00:00:01 GMT;';

        for (var i = 0; i < pathBits.length; i++) {
            pathCurrent += ((pathCurrent.substr(-1) != '/') ? '/' : '') + pathBits[i];
            document.cookie = name + '=; expires=Thu, 01-Jan-1970 00:00:01 GMT;' + pathCurrent + ';';
        }
	}
	
	for (var i = 0; i < parts.length; i++) {
		var temp = parts[i].split("=");
		$_GET[decodeURIComponent(temp[0])] = decodeURIComponent(temp[1]);
	}
	
	require.config({
		baseUrl: basePath,
        waitSeconds: 333,
        skipDataMain: true,
		paths: {
			"app":'engine/main.min',
			"jquery": [
                'https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min',
                'engine/jquery/js/jquery-1.11.1.min'
            ],
			"jquery.ui": [
                'https://code.jquery.com/ui/1.11.4/jquery-ui.min',
                'https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.3/jquery-ui.min',
                'engine/jquery/js/jquery-ui.min'
            ],
			"jquery.bootstrap": [
                'https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.4/js/bootstrap.min',
                'engine/bootstrap/js/bootstrap.min'
            ],
            "moment": [
                'https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min',
                'engine/moment/moment.min'
            ],
            "holder": [
                'https://cdnjs.cloudflare.com/ajax/libs/holder/2.6.0/holder.min',
                'engine/holder'
            ],
            "raphael": [
                'https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.2/raphael-min',
                'engine/graphs/raphael-min'
            ],
			"morris": [
                'https://cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min',
                'engine/graphs/morris.min'
            ],
            "tinymce": 'engine/tinymce',
            "jquery.migrate": 'engine/jquery/js/jquery-migrate.min',
            "jquery.external": 'engine/jquery-external',
            "noty": 'engine/noty/jquery.noty',
            "bgiframe": 'engine/jquery-external/jquery.bgiframe-2.1.2',
            "flexigrid": 'engine/flexigrid/js/flexigrid.pack',
            "elfinder": 'engine/elfinder/js',
            "fullcalendar": 'engine/fullcalendar/fullcalendar.min',
            "minidaemon": 'engine/minidaemon',
            "skrollr" : 'engine/skrollr.min',
            "joint": 'engine/joint/joint.clean.min',
            "backbone": "engine/backbone/backbone.min",
            "underscore": 'engine/joint/lodash.min',
            "geometry": 'engine/joint/geometry.min',
            "vectorizer": 'engine/joint/vectorizer.min',
            "joint.shapes.org": 'engine/joint/plugins/joint.shapes.org.min'
        },
        shim: {
            "backbone": {
                deps: ['underscore', 'jquery'],
                exports: 'Backbone'
            },
            "joint.shapes.org": {
                deps: ["joint"]
            },
            joint: {
                deps: ['geometry', 'vectorizer', 'jquery', 'backbone'],
                exports: 'joint',
                init: function(geometry, vectorizer) {
                    this.g = geometry;
                    this.V = vectorizer;
                }
            },
            underscore: {
                exports: '_'
            },
            "jquery.ui": {
				deps: ["jquery"]
			},
			"jquery.bootstrap": {
				deps: ["jquery"]
			},
			"jquery.migrate": {
				deps: ["jquery"]
			},
			"jquery.flexigrid": {
				deps: ["jquery", "jquery.ui"]
			},
            "jquery.external/jquery.inview.min": {
                deps: ["jquery"]
            },
            "flexigrid": {
                deps: ["jquery"]  
            },
            "bootstro": {
                deps: ["jquery"]  
            },
            "tinymce/jquery.tinymce.min": {
                deps: ["jquery"]  
            },
			"noty": {
				deps: ["jquery"]
			},
			"engine/noty/themes/default": {
				deps: ["jquery", "noty"]
			},
			"engine/noty/layouts/inline": {
				deps: ["jquery", "noty", "engine/noty/themes/default"]
			},
			"engine/noty/layouts/top": {
				deps: ["jquery", "noty", "engine/noty/themes/default"]
			},
			"engine/noty/layouts/topRight": {
				deps: ["jquery", "noty", "engine/noty/themes/default", "engine/noty/layouts/top"]
			},
			"engine/noty/layouts/topCenter": {
				deps: ["jquery", "noty", "engine/noty/themes/default", "engine/noty/layouts/top"]
			},
			"engine/noty/layouts/bottom": {
				deps: ["jquery", "noty", "engine/noty/themes/default"]
			},
			"engine/noty/layouts/bottomRight": {
				deps: ["jquery", "noty", "engine/noty/themes/default", "engine/noty/layouts/bottom"]
			},
			"elfinder/elfinder.min": {
				deps: ["jquery", "jquery.ui"]
			},
			"jquery.external/jquery.nestedsortable": {
				deps: ["jquery", "jquery.ui"]
			},
			"jquery.external/jqueryui.timepicker.min": {
				deps: ["jquery", "jquery.ui"]
			},
			"jquery.external/jquery.validate.min": {
				deps: ["jquery"]
			},
			"jquery.external/jquery.metadata": {
				deps: ["jquery"]
			},
			"jquery.external/jquery.printthis": {
				deps: ["jquery"]
			},
			"jquery.external/jquery.fs.scroller.min": {
				deps: ["jquery"]
			},
			"moment": {
				deps: ["jquery", "jquery.ui"]
			},
			"fullcalendar": {
				deps: ["jquery", "jquery.ui", "moment"]
			},
			"raphael": {
				deps: ["jquery"]
			},
			"morris": {
				deps: ["jquery", "raphael"]
			}
		}
	});
	
	requirejs(["app"]);