<!-- JavaScript Libraries -->
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('frontend/lib/easing/easing.min.js') }}"></script>
<script src="{{ asset('frontend/lib/slick/slick.min.js') }}"></script>

<!-- Template Javascript -->
<script src="{{ asset('frontend/js/main.js') }}"></script>

{{--  fileInput Plugine  --}}
<script src="{{asset('vendor/fileinput/js/fileinput.min.js')}}"></script>
<script src="{{asset('vendor/fileinput/themes/fa5/theme.min.js')}}"></script>

{{-- summernote Plugine --}}
<script src="{{asset('vendor/summernote/summernote-bs4.min.js')}}"></script>

@stack('scripts')
