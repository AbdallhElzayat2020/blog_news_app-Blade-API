@extends('admin.layouts.master')
@section('title', 'Notifications')

@push('css')
    <style>
        .notifications-bg {
            min-height: 100vh;
            background: linear-gradient(135deg, #e3eafc 0%, #f8f9fc 100%);
            padding: 40px 0;
        }

        .notifications-card {
            background: #fff;
            border-radius: 1.25rem;
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.10);
            max-width: 700px;
            margin: 0 auto;
            padding: 2.5rem 2rem 2rem 2rem;
        }

        .notifications-title {
            font-size: 2.2rem;
            font-weight: 800;
            color: #224abe;
            margin-bottom: 2rem;
            letter-spacing: 1px;
            text-align: center;
        }

        .notification-item {
            display: flex;
            align-items: flex-start;
            background: linear-gradient(90deg, #f8f9fc 60%, #e3eafc 100%);
            border-radius: 0.75rem;
            box-shadow: 0 2px 8px rgba(34, 74, 190, 0.06);
            margin-bottom: 1.2rem;
            padding: 1.25rem 1.5rem;
            transition: box-shadow 0.2s;
            position: relative;
        }

        .notification-item.unread {
            border-left: 5px solid #4e73df;
            background: linear-gradient(90deg, #e3eafc 60%, #f8f9fc 100%);
        }

        .notification-icon {
            font-size: 1.7rem;
            color: #4e73df;
            margin-right: 1.2rem;
            margin-top: 0.2rem;
        }

        .notification-content {
            flex: 1;
        }

        .notification-title {
            font-weight: 700;
            color: #224abe;
            font-size: 1.1rem;
            margin-bottom: 0.2rem;
        }

        .notification-message {
            color: #5a5c69;
            font-size: 1rem;
            margin-bottom: 0.3rem;
        }

        .notification-time {
            color: #858796;
            font-size: 0.92rem;
        }

        .notification-actions {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
            margin-left: 1.2rem;
        }

        .notification-actions .btn {
            border-radius: 0.5rem;
            font-size: 0.95rem;
            font-weight: 600;
            padding: 0.4rem 1rem;
            transition: background 0.2s, color 0.2s;
        }

        .notification-actions .btn-primary {
            background: #4e73df;
            color: #fff;
            border: none;
        }

        .notification-actions .btn-primary:hover {
            background: #224abe;
        }

        .notification-actions .btn-danger {
            background: #e74a3b;
            color: #fff;
            border: none;
        }

        .notification-actions .btn-danger:hover {
            background: #be2617;
        }

        @media (max-width: 600px) {
            .notifications-card {
                padding: 1rem 0.5rem;
            }

            .notification-item {
                flex-direction: column;
                align-items: flex-start;
                padding: 1rem 0.7rem;
            }

            .notification-actions {
                flex-direction: row;
                margin-left: 0;
                margin-top: 0.7rem;
            }
        }
    </style>
@endpush

@section('content')
    <div class="notifications-bg">
        <div class="notifications-card">
            <div class="notifications-title">
                <i class="fas fa-bell"></i> Notifications
            </div>

            {{-- Example notifications loop --}}
            @forelse($notifications as $notification)
                {{--            <div class="notification-item {{ $notification->unread() ? 'unread' : '' }}">--}}
                {{--                <div class="notification-icon">--}}
                {{--                    <i class="fas fa-info-circle"></i>--}}
                {{--                </div>--}}
                {{--                <div class="notification-content">--}}
                {{--                    <div class="notification-title">--}}
                {{--                        {{ $notification->data['title'] ?? 'Notification' }}--}}
                {{--                    </div>--}}
                {{--                    <div class="notification-message">--}}
                {{--                        {{ $notification->data['message'] ?? '' }}--}}
                {{--                    </div>--}}
                {{--                    <div class="notification-time">--}}
                {{--                        {{ $notification->created_at->diffForHumans() }}--}}
                {{--                    </div>--}}
                {{--                </div>--}}
                {{--                <div class="notification-actions">--}}
                {{--                    <a href="" class="btn btn-primary" title="View">--}}
                {{--                        <i class="fa fa-eye"></i>--}}
                {{--                    </a>--}}
                {{--                    <form action="{{ route('admin.notifications.destroy', $notification->id) }}" method="POST" style="display:inline;">--}}
                {{--                        @csrf--}}
                {{--                        @method('DELETE')--}}
                {{--                        <button type="submit" class="btn btn-danger" title="Delete">--}}
                {{--                            <i class="fa fa-trash-alt"></i>--}}
                {{--                        </button>--}}
                {{--                    </form>--}}
                {{--                </div>--}}
                {{--            </div>--}}
            @empty
                <div class="alert alert-info text-center">
                    <strong>No notifications available.</strong>
                </div>
            @endforelse
        </div>
    </div>
@endsection