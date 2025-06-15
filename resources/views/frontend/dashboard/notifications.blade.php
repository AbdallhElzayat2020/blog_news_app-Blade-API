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

                @forelse(auth()->user()->notifications as $notification)
                    <div class="notification alert alert-info d-flex justify-content-between align-items-center">
                        <div>
                            <strong>{{ $notification->data['post_title'] ?? 'Info' }}</strong> {{ $notification->data['comment'] ?? 'Notification' }}
                            <small class="d-block text-muted">{{ $notification->created_at->diffForHumans() }}</small>
                        </div>

                        <div class="d-flex align-items-center">
                            <a href="{{$notification->data['link']}}" class="btn btn-sm btn-primary mr-2"
                               title="View">
                                <i class="fa fa-eye"></i>
                            </a>

                            <form action="" method="POST">
                                @csrf
                                <input type="hidden" name="notification_id" value="{{ $notification->id }}">
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" title="Delete">
                                    <i class="fa fa-trash-alt"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                @empty
                    <div class="alert alert-info">
                        <strong>No notifications available.</strong>
                    </div>
                @endforelse

            </div>
        </div>
    </div>
    <!-- Dashboard End-->

@endsection