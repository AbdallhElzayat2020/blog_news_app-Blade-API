@extends('admin.layouts.master')
@section('title', 'Message Details')
@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3 text-gray-800">
                <i class="fas fa-envelope-open-text text-primary mr-2"></i>
                Message Details
            </h1>
            <div class="d-flex align-items-center">
                <!-- Status Badge -->
                <div class="mr-3">
                    @if($contact->status === 'active')
                        <span class="badge badge-success px-3 py-2">
                            <i class="fas fa-check-circle mr-1"></i> Read
                        </span>
                    @elseif($contact->status === 'inactive')
                        <span class="badge badge-warning px-3 py-2">
                            <i class="fas fa-clock mr-1"></i> Unread
                        </span>
                    @endif
                </div>
                <a href="{{ route('admin.contact.index') }}" class="btn btn-outline-primary">
                    <i class="fas fa-arrow-left mr-1"></i>
                    Back to Messages
                </a>
            </div>
        </div>

        <div class="card shadow-lg border-0 rounded-lg">
            <div class="card-header bg-gradient-primary text-white py-3">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">
                        <i class="fas fa-info-circle mr-2"></i>
                        Sender Information
                    </h5>
                    <div class="text-white-50">
                        <small>
                            <i class="fas fa-calendar-alt mr-1"></i>
                            {{ $contact->created_at->format('M d, Y H:i') }}
                        </small>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <!-- Sender Information -->
                    <div class="col-md-6">
                        <div class="card border-0 shadow-sm mb-4">
                            <div class="card-body">
                                <div class="d-flex align-items-center mb-3">
                                    <div class="icon-circle bg-primary text-white mr-3">
                                        <i class="fas fa-user"></i>
                                    </div>
                                    <h6 class="mb-0 text-primary">Sender Details</h6>
                                </div>

                                <div class="form-group">
                                    <label class="font-weight-bold text-gray-700">
                                        <i class="fas fa-user-tag text-primary mr-1"></i>
                                        Name
                                    </label>
                                    <input disabled type="text" class="form-control bg-light border-0 shadow-sm"
                                           value="{{ old('name', $contact->name) }}">
                                </div>

                                <div class="form-group">
                                    <label class="font-weight-bold text-gray-700">
                                        <i class="fas fa-envelope text-primary mr-1"></i>
                                        Email Address
                                    </label>
                                    <input disabled type="email" class="form-control bg-light border-0 shadow-sm"
                                           value="{{ old('email', $contact->email) }}">
                                </div>

                                <div class="form-group">
                                    <label class="font-weight-bold text-gray-700">
                                        <i class="fas fa-phone text-primary mr-1"></i>
                                        Phone Number
                                    </label>
                                    <input disabled type="tel" class="form-control bg-light border-0 shadow-sm"
                                           value="{{ old('phone', $contact->phone) }}">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Message Content -->
                    <div class="col-md-6">
                        <div class="card border-0 shadow-sm">
                            <div class="card-body">
                                <div class="d-flex align-items-center mb-3">
                                    <div class="icon-circle bg-success text-white mr-3">
                                        <i class="fas fa-envelope-open"></i>
                                    </div>
                                    <h6 class="mb-0 text-success">Message Content</h6>
                                </div>

                                <div class="form-group">
                                    <label class="font-weight-bold text-gray-700">
                                        <i class="fas fa-comment-alt text-success mr-1"></i>
                                        Message Text
                                    </label>
                                    <textarea disabled class="form-control bg-light border-0 shadow-sm"
                                              rows="8" style="resize: none;">{{ $contact->body }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="mt-4 pt-3 border-top">
                    <div class="d-flex justify-content-end">
                        <a href="#" data-toggle="modal" data-target="#delete_user_{{$contact->id}}"
                           class="btn btn-danger mx-1 btn-icon-split">
                            <span class="icon text-white">
                                <i class="fas fa-trash"></i>
                            </span>
                            <span class="text">Delete Message</span>
                        </a>

                        <a href="mailto:{{ $contact->email }}"
                           class="btn btn-primary mx-1 btn-icon-split">
                            <span class="icon text-white">
                                <i class="fas fa-reply"></i>
                            </span>
                            <span class="text">Reply</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('admin.contacts.delete')

    <style>
        .icon-circle {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .card {
            transition: all 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
        }

        .form-control:disabled {
            background-color: #f8f9fc !important;
            cursor: not-allowed;
        }

        .btn-icon-split {
            transition: all 0.3s ease;
        }

        .btn-icon-split:hover {
            transform: translateY(-2px);
        }

        .badge {
            font-size: 0.85rem;
            font-weight: 500;
        }

        .badge i {
            font-size: 0.9rem;
        }
    </style>
@endsection