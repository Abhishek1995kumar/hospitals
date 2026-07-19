<!DOCTYPE html>
<html lang="en">
<head>
    <base href="../../../" />
    <title> @yield('title') </title>
    <meta charset="utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <link href="{{asset('backend/media/logos/favicon.png')}}" rel="shortcut icon" />

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
    <link href="{{asset('backend/plugins/global/plugins.bundle.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('backend/css/style.bundle.css')}}" rel="stylesheet" type="text/css" />
    @yield('style')
    <style>
		.justify-content {
			right !important;
		}
	</style>
</head>

<body id="kt_body" class="app-blank bgi-size-cover bgi-position-center bgi-no-repeat">
    <script>
        var defaultThemeMode = "light";
        var themeMode;
        if (document.documentElement) {
            if (document.documentElement.hasAttribute("data-theme-mode")) {
                themeMode = document.documentElement.getAttribute("data-theme-mode");
            } else {
                if (localStorage.getItem("data-theme") !== null) {
                    themeMode = localStorage.getItem("data-theme");
                } else {
                    themeMode = defaultThemeMode;
                }
            }
            if (themeMode === "system") {
                themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light";
            }
            document.documentElement.setAttribute("data-theme", themeMode);
        }
    </script>
    <div class="d-flex flex-column flex-root">
        <style>
            body {
                background-image: url('assets/media/logos/slider.jpg');
                background-size: cover;
                background-repeat: no-repeat;
                background-position: center center;
            }

            [data-theme="dark"] body {
                background-image: url('assets/media/logos/slider.jpg');
            }
        </style>
        <div class="d-flex flex-lg-row flex-column-fluid" style="justify-content: end !important;">
            <div class="d-flex p-12">
                @yield('content')
            </div>
        </div>
    </div>
    <script>
        var hostUrl = "assets/";
    </script>
    <script src="{{asset('backend/plugins/global/plugins.bundle.js')}}"></script>
    <script src="{{asset('backend/js/scripts.bundle.js')}}"></script>
    @yield('footer')
</body>

</html>