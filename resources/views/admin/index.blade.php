@extends('admin.layouts.master')
@section('title','Home')
@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
        </div>

        {{-- Reports row --}}

        <livewire:reports/>
        {{-- Reports row --}}


        {{-- Chart Table--}}
        <div class="row">

            <!-- Area Chart -->
            <div class="col-xl-6 col-lg-6">
                <div class="card shadow mb-4">
                    <!-- Card Body -->
                    <div class="card-body">

                        <h4>{{ $post_chart_options->options['chart_title'] }}</h4>
                        {!! $post_chart_options->renderHtml() !!}

                    </div>
                </div>
            </div>

            <div class="col-xl-6 col-lg-6">
                <div class="card shadow mb-4">
                    <!-- Card Body -->
                    <div class="card-body">

                        <h4>{{ $users_chart_options->options['chart_title'] }}</h4>
                        {!! $users_chart_options->renderHtml() !!}

                    </div>
                </div>
            </div>
        </div>
        {{-- Chart Table--}}
        <livewire:latest-posts-comments/>

        {{--  Posts && Comments row--}}

        {{--  Posts && Comments row--}}

    </div>
    <!-- /.container-fluid -->
@endsection

@push('js')
    {!! $post_chart_options->renderChartJsLibrary() !!}

    {!! $post_chart_options->renderJs() !!}
    {!! $users_chart_options->renderJs() !!}
@endpush