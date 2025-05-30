<!DOCTYPE html>
<html lang="en">

{{-- head --}}
@include('frontend.layouts.head')
{{-- head --}}

<body>

    {{-- header --}}
    @include('frontend.layouts.header')
    {{-- header --}}


    @yield('content')


    {{-- footer --}}
    @include('frontend.layouts.footer')
    {{-- footer --}}


    {{-- Back to Top  --}}
    <a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>
    {{-- Back to Top  --}}

    {{-- scripts --}}
    @include('frontend.layouts.scripts')
    {{-- scripts --}}
</body>

</html>
