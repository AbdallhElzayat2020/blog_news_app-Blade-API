<head>
    <meta charset="utf-8"/>
    <title>@yield('title')</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <meta content="Bootstrap News Template - Free HTML Templates" name="keywords"/>
    <meta content="Bootstrap News Template - Free HTML Templates" name="description"/>

    <!-- Favicon -->
    <link href="{{asset('Frontend/img/favicon.ico')}}" rel="icon"/>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,600&display=swap" rel="stylesheet"/>

    <!-- CSS Libraries -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet"/>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet"/>
    <link href="{{ asset('frontend/lib/slick/slick.css') }}" rel="stylesheet"/>
    <link href="{{ asset('frontend/lib/slick/slick-theme.css') }}" rel="stylesheet"/>

    {{--  fileInput Plugine  --}}
    <link rel="stylesheet" href="{{asset('vendor/fileinput/css/fileinput.min.css')}}">

    {{-- summernote Plugine --}}

    <link rel="stylesheet" href="{{asset('vendor/summernote/summernote-bs4.min.css')}}">

    <!-- Template Stylesheet -->
    <link href="{{ asset('frontend/css/style.css') }}" rel="stylesheet"/>
    @stack('styles')
</head>
