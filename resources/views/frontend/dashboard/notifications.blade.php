@extends('frontend.layouts.master')
@section('title', 'Notifications')
@section('content')
    <!-- Dashboard Start-->
    <div class="dashboard container">
        <!-- Sidebar -->
        @include('frontend.dashboard._sidebar')

        <!-- Main Content -->
        <div class="main-content">
            <div class="container">
                <h2 class="mb-4">Notifications</h2>

                <a href="">
                    <div class="notification alert alert-info">
                        <strong>Info!</strong> This is an informational notification.
                        <div class="float-right">
                            <button class="btn btn-danger btn-sm">Delete</button>
                        </div>
                    </div>
                </a>

                <a href="">
                    <div class="notification alert alert-warning">
                        <strong>Warning!</strong> This is a warning notification.
                        <div class="float-right">
                            <button class="btn btn-danger btn-sm">Delete</button>
                        </div>
                    </div>
                </a>

                <a href="">
                    <div class="notification alert alert-success">
                        <strong>Success!</strong> This is a success notification.
                        <div class="float-right">
                            <button class="btn btn-danger btn-sm">Delete</button>
                        </div>
                    </div>
                </a>

            </div>
        </div>
    </div>
    <!-- Dashboard End-->

@endsection