@extends('admin.layouts.master')
@section('title', 'Settings Page')
@push('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css"
          integrity="sha512-EZSUkJWTjzDlspOoPSpUFR0o0Xy7jdzW//6qhUkoZ9c4StFkVsp9fbbd0O06p9ELS3H486m4wmrCELjza4JEog=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <style>
        .settings-card {
            transition: all 0.3s ease;
            border: none;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        }

        .settings-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.15);
        }

        .settings-card .card-header {
            background: #f8f9fc;
            border-bottom: 2px solid #4e73df;
            padding: 1rem;
        }

        .settings-card .card-header h6 {
            color: #4e73df;
            font-weight: 600;
            margin: 0;
        }

        .settings-card .card-body {
            padding: 1.5rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-group label {
            font-weight: 600;
            color: #5a5c69;
            margin-bottom: 0.5rem;
        }

        .input-group-text {
            background-color: #f8f9fc;
            border-right: none;
        }

        .input-group .form-control {
            border-left: none;
        }

        .input-group .form-control:focus {
            border-color: #d1d3e2;
            box-shadow: none;
        }

        .btn-save {
            padding: 0.5rem 2rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .dropify-wrapper {
            border-radius: 0.35rem;
            border: 2px dashed #e3e6f0;
        }

        .dropify-wrapper:hover {
            background-color: #f8f9fc;
        }

        /* Social Media Colors */
        .bg-facebook {
            background: #1877f2 !important;
        }

        .bg-twitter {
            background: #1da1f2 !important;
        }

        .bg-instagram {
            background: linear-gradient(45deg, #f09433 0%, #e6683c 25%, #dc2743 50%, #cc2366 75%, #bc1888 100%) !important;
        }

        .bg-linkedin {
            background: #0a66c2 !important;
        }

        .bg-youtube {
            background: #ff0000 !important;
        }

        .bg-tiktok {
            background: #000000 !important;
        }

        /* Input Group Icons */
        .input-group-text {
            background-color: #4e73df !important;
            color: #ffffff !important;
            border: none;
            font-size: 0.9rem;
            min-width: 45px;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 0.375rem 0.75rem;
        }

        .input-group-text i {
            width: 16px;
            text-align: center;
            font-size: 1rem;
        }

        .input-group {
            display: flex;
            align-items: stretch;
        }

        .input-group .form-control {
            border: 1px solid #d1d3e2;
            padding: 0.375rem 0.75rem;
            height: calc(1.5em + 0.75rem + 2px);
        }

        .input-group textarea.form-control {
            height: auto;
            min-height: calc(1.5em + 0.75rem + 2px);
        }

        .input-group .form-control:focus {
            border-color: #4e73df;
            box-shadow: 0 0 0 0.2rem rgba(78, 115, 223, 0.15);
        }

        /* Card Header Icons */
        .card-header h6 i {
            color: #4e73df;
            width: 20px;
            text-align: center;
        }

        /* Social Media Icons */
        .social-icon {
            min-width: 45px;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 4px 0 0 4px;
        }

        .social-icon i {
            font-size: 1rem;
            color: #ffffff;
        }

        /* Dropify Customization */
        .dropify-wrapper {
            border: 2px dashed #4e73df;
            background-color: #f8f9fc;
        }

        .dropify-wrapper:hover {
            background-color: #eaecf4;
        }

        .dropify-wrapper .dropify-message p {
            color: #4e73df;
        }

        .dropify-wrapper .dropify-preview {
            background-color: #f8f9fc;
        }
    </style>
@endpush
@section('content')
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Settings Management</h1>
        </div>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <form action="{{ route('admin.settings.update') }}" method="post" enctype="multipart/form-data" id="settingsForm">
            @csrf
            @method('PUT')

            <div class="row">
                <input type="hidden" name="setting_id" value="{{ $getSetting->id }}">
                <!-- Site Identity Section -->
                <div class="col-lg-6 mb-4">
                    <div class="card settings-card h-100">
                        <div class="card-header">
                            <h6><i class="fas fa-fw fa-globe mr-2"></i>Site Identity</h6>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="site_logo">Site Logo</label>
                                <input type="file" class="dropify" id="site_logo" name="site_logo"
                                       data-allowed-file-extensions="png jpg jpeg" data-max-file-size="2M">
                                <br>
                                <br>
                                <img src="{{ asset($getSetting->site_logo) }}" style="width: 200px;  height: auto"
                                     class="img-thumbnail" alt="">

                                @error('site_logo')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="site_favicon">Site Favicon</label>
                                <input type="file" class="dropify" id="site_favicon" name="site_favicon"
                                       data-allowed-file-extensions="png jpg jpeg" data-max-file-size="1M">
                                <br>
                                <br>
                                <img src="{{ asset($getSetting->site_favicon) }}" style="width: 200px;  height: auto"
                                     class="img-thumbnail" alt="">
                                @error('site_favicon')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="site_name">Site Name<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="site_name"
                                       value="{{ old('site_name', $getSetting->site_name) }}" name="site_name"
                                       placeholder="Enter site name">
                                @error('site_name')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="meta_title">Meta Title<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="meta_title"
                                       value="{{ old('meta_title', $getSetting->meta_title) }}" name="meta_title"
                                       placeholder="Enter meta title">
                                @error('meta_title')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="meta_description">Meta Description<span class="text-danger">*</span></label>
                                <textarea class="form-control" id="meta_description" name="meta_description" rows="3"
                                          placeholder="Enter meta description">{{ old('meta_description', $getSetting->meta_description) }}</textarea>
                                @error('meta_description')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Contact Information Section -->
                <div class="col-lg-6 mb-4">
                    <div class="card settings-card h-100">
                        <div class="card-header">
                            <h6><i class="fas fa-fw fa-address-card mr-2"></i>Contact Information</h6>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="site_email">Site Email<span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="fas fa-envelope"></i>
                                        </span>
                                    </div>
                                    <input type="email" class="form-control" id="site_email"
                                           value="{{ old('site_email', $getSetting->site_email) }}" name="site_email"
                                           placeholder="Enter site email">
                                </div>
                                @error('site_email')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="site_phone">Site Phone<span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="fas fa-phone"></i>
                                        </span>
                                    </div>
                                    <input type="tel" class="form-control" id="site_phone"
                                           value="{{ old('site_phone', $getSetting->site_phone) }}" name="site_phone"
                                           placeholder="Enter site phone">
                                </div>
                                @error('site_phone')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="site_address">Site Address<span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="fas fa-map-marker-alt"></i>
                                        </span>
                                    </div>
                                    <textarea class="form-control" id="site_address" name="site_address" rows="2"
                                              placeholder="Enter site address">{{ old('site_address', $getSetting->site_address) }}</textarea>
                                </div>
                                @error('site_address')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="street">Street<span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="fas fa-road"></i>
                                        </span>
                                    </div>
                                    <input type="text" class="form-control" id="street"
                                           value="{{ old('street', $getSetting->street) }}" name="street"
                                           placeholder="Enter street address">
                                </div>
                                @error('street')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="city">City</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <i class="fas fa-city"></i>
                                                </span>
                                            </div>
                                            <input type="text" class="form-control" id="city"
                                                   value="{{ old('city', $getSetting->city) }}" name="city"
                                                   placeholder="Enter city">
                                        </div>
                                        @error('city')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="country">Country</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <i class="fas fa-flag"></i>
                                                </span>
                                            </div>
                                            <input type="text" class="form-control" id="country"
                                                   value="{{ old('country', $getSetting->country) }}" name="country"
                                                   placeholder="Enter country">
                                        </div>
                                        @error('country')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Social Media Links Section -->
                <div class="col-12 mb-4">
                    <div class="card settings-card">
                        <div class="card-header">
                            <h6><i class="fas fa-fw fa-share-alt mr-2"></i>Social Media Links</h6>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="facebook_link">Facebook</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text social-icon bg-facebook">
                                                    <i class="fab fa-facebook-f"></i>
                                                </span>
                                            </div>
                                            <input type="url" class="form-control" id="facebook_link"
                                                   value="{{ old('facebook_link', $getSetting->facebook_link) }}"
                                                   name="facebook_link" placeholder="Enter Facebook URL">
                                        </div>
                                        @error('facebook_link')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="twitter_link">Twitter</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text social-icon bg-twitter">
                                                    <i class="fab fa-twitter"></i>
                                                </span>
                                            </div>
                                            <input type="url" class="form-control" id="twitter_link"
                                                   value="{{ old('x_link', $getSetting->x_link) }}"
                                                   name="x_link" placeholder="Enter Twitter URL">
                                        </div>
                                        @error('x_link')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="instagram_link">Instagram</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text social-icon bg-instagram">
                                                    <i class="fab fa-instagram"></i>
                                                </span>
                                            </div>
                                            <input type="url" class="form-control" id="instagram_link"
                                                   value="{{ old('instagram_link', $getSetting->instagram_link) }}"
                                                   name="instagram_link" placeholder="Enter Instagram URL">
                                        </div>
                                        @error('instagram_link')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="linkedin_link">LinkedIn</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text social-icon bg-linkedin">
                                                    <i class="fab fa-linkedin-in"></i>
                                                </span>
                                            </div>
                                            <input type="url" class="form-control" id="linkedin_link"
                                                   value="{{ old('linkedin_link', $getSetting->linkedin_link) }}"
                                                   name="linkedin_link" placeholder="Enter LinkedIn URL">
                                        </div>
                                        @error('linkedin_link')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="youtube_link">YouTube</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text social-icon bg-youtube">
                                                    <i class="fab fa-youtube"></i>
                                                </span>
                                            </div>
                                            <input type="url" class="form-control" id="youtube_link"
                                                   value="{{ old('youtube_link', $getSetting->youtube_link) }}"
                                                   name="youtube_link" placeholder="Enter YouTube URL">
                                        </div>
                                        @error('youtube_link')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="tiktok_link">TikTok</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text social-icon bg-tiktok">
                                                    <i class="fab fa-tiktok"></i>
                                                </span>
                                            </div>
                                            <input type="url" class="form-control" id="tiktok_link"
                                                   value="{{ old('tiktok_link', $getSetting->tiktok_link) }}"
                                                   name="tiktok_link" placeholder="Enter TikTok URL">
                                        </div>
                                        @error('tiktok_link')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <input type="hidden" name="setting_id" value="{{ $getSetting->id }}">
            {{--            @can('update_settings') --}}
            <div class="form-group text-left mb-4">
                <button type="submit" class="btn btn-primary btn-save">
                    <i class="fas fa-save mr-2"></i> Save Settings
                </button>
            </div>
            {{--            @endcan --}}

        </form>
    </div>

    @push('js')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"
                integrity="sha512-8QFTrG0oeOiyWo/VM9Y8kgxdlCryqhIxVeRpWSezdRRAvarxVtwLnGroJgnVW9/XBRduxO/z1GblzPrMQoeuew=="
                crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script>
            $(document).ready(function () {
                // Initialize Dropify with custom messages
                $('.dropify').dropify({
                    messages: {
                        'default': 'Drag and drop a file here or click',
                        'replace': 'Drag and drop or click to replace',
                        'remove': 'Remove',
                        'error': 'Ooops, something wrong happened.'
                    },
                    error: {
                        'fileSize': 'The file size is too big ({{ config('app.max_file_size', 3) }}M max).',
                        'fileFormat': 'The file format is not allowed (only jpeg, png, jpg).'
                    }
                });

                // Add error handling for file input
                $('.dropify').on('dropify.error.fileSize', function (event, element) {
                    toastr.error('File size is too big. Maximum size is 3MB.');
                });

                $('.dropify').on('dropify.error.fileFormat', function (event, element) {
                    toastr.error('Invalid file format. Only jpeg, png, and jpg files are allowed.');
                });

                // Show loading state on form submit
                $('#settingsForm').on('submit', function () {
                    const submitBtn = $(this).find('button[type="submit"]');
                    submitBtn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i> Updating...');
                });
            });
        </script>
    @endpush
@endsection
