
        @yield('css')

        <!-- App css -->
        <link href="{{ URL::asset('/css/bootstrap-dark.min.css')}}" id="bootstrap-dark" rel="stylesheet" type="text/css" />
        <link href="{{ URL::asset('/css/bootstrap.min.css')}}" id="bootstrap-light" rel="stylesheet" type="text/css" />
        <link href="{{ URL::asset('/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{ URL::asset('/css/app-rtl.min.css')}}" id="app-rtl" rel="stylesheet" type="text/css" />
        <link href="{{ URL::asset('/css/app-dark.min.css')}}" id="app-dark" rel="stylesheet" type="text/css" />
        <link href="{{ URL::asset('/css/app.min.css')}}" id="app-light" rel="stylesheet" type="text/css" />
        <link href="{{URL::asset('/libs/toastr/vendor/toastr.css')}}" rel="stylesheet" type="text/css">
        <link href="{{URL::asset('/libs/toastr/plugin/toastr.css')}}" rel="stylesheet" type="text/css">
