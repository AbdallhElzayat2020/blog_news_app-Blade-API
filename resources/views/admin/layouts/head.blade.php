<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>@yield('title_admin')</title>

    <!-- Custom fonts for this template-->
    <link href="{{asset('Dashboard/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
    <link
            href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
            rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{asset('Dashboard/css/sb-admin-2.min.css')}}" rel="stylesheet">

    {{--  fileInput Plugine  --}}
    <link rel="stylesheet" href="{{asset('vendor/fileinput/css/fileinput.min.css')}}">

    {{-- summernote Plugine --}}

    <link rel="stylesheet" href="{{asset('vendor/summernote/summernote-bs4.min.css')}}">
    @livewireStyles

    @stack('css')
</head>