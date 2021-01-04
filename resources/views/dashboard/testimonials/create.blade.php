@push('admin_scripts')
    <script type="text/javascript">
        var url = window.location.href;
        var path = url.split('/')[4];
        Dropzone.autoDiscover = false;
        $(document).ready(function () {
            $('#mainphoto').dropzone({
                url: '{{ route('upload.image') }}',
                paramName:'image',
                autoDiscover: false,
                uploadMultiple: false,
                maxFiles: 1,
                acceptedFiles: 'image/*',
                dictDefaultMessage: '{{ __('admin.upload_photo') }}',
                dictRemoveFile: '<button class="btn btn-danger"> <i class="fa fa-trash center"></i></button>',
                params: {
                    _token: '{{ csrf_token() }}',
                    path: path,
                    width: 100,
                    height: 100
                },
                addRemoveLinks: true,
                removedfile:function (file) {
                    var imageName = $('.image_name').val();
                    $.ajax({
                        dataType: 'json',
                        type: 'POST',
                        url: '{{ route('remove.image') }}',
                        data: {
                            _token: '{{ csrf_token() }}',
                            image: imageName,
                            path: path
                        }
                    });
                    var fmock;
                    return (fmock = file.previewElement) != null ? fmock.parentNode.removeChild(file.previewElement): void 0;
                },
                init: function () {
                    this.on("success", function (file, image) {
                        $('.image_name').val(image);
                    })
                }
            });
        });
    </script>
    <style type="text/css">

        .dropzone {
            width: 200px;
            height: 150px;
            min-height: 0px !important;
        }
    </style>
@endpush

@extends('dashboard.layouts.app')

@section('content')
    <div class="mdk-drawer-layout__content page">
        <div class="container-fluid page__heading-container">
            <div class="page__heading d-flex align-items-center">
                <div class="flex">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}"><i class="material-icons icon-20pt">home</i> {{ trans('admin.home') }} </a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ trans('admin.create') }}</li>
                        </ol>
                    </nav>
                    <h1 class="m-0"> {{ trans('admin.testimonials') }} </h1>
                </div>
            </div>
        </div>

        <div class="container-fluid page__container">

            <div class="card card-form__body card-body">
                <form method="post" action="{{ route('testimonials.store') }}" enctype="multipart/form-data">
                    @csrf
                    @include('dashboard.partials._errors')

                    @foreach(config('locales.languages') as $key => $value)
                        <div class="form-group">
                            <label for="name[{{ $key }}]"> {{ trans('admin.testimonials') }} / {{ trans('admin.'. $key .'_name') }}</label>
                            <input id="name[{{ $key }}]" name="name[{{ $key }}]" type="text" class="form-control" placeholder="{{ trans('admin.'. $key .'_name') }}" value="{{ old('name.' . $key) }}">
                        </div>
                    @endforeach


                @foreach(config('locales.languages') as $key => $value)
                        <div class="form-group">
                            <label for="title[{{ $key }}]"> {{ trans('admin.testimonials') }} / {{ trans('admin.'. $key .'_title') }}</label>
                            <input id="title[{{ $key }}]" name="title[{{ $key }}]" type="text" class="form-control" placeholder="{{ trans('admin.'. $key .'_title') }}" value="{{ old('title.' . $key) }}">
                        </div>
                    @endforeach

                    @foreach(config('locales.languages') as $key => $value)
                        <div class="form-group">
                            <label for="desc[{{ $key }}]"> {{ trans('admin.testimonials') }} / {{ trans('admin.'. $key .'_description') }}</label>
                            <textarea id="desc[{{ $key }}]" name="description[{{ $key }}]" rows="4" class="form-control" placeholder="{{ trans('admin.slider') }} / {{ trans('admin.'. $key .'_description') }}...">{{ old('body.' . $key) }}</textarea>
                        </div>
                    @endforeach

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="stars"> {{ __('admin.testimonials') }} / {{ __('home.select_stars') }}</label>
                                <select name="stars" id="stars" class="form-control select2">
                                    @for($i = 1;$i < 6;$i++)
                                        <option value="{{ $i }}" {{ old('stars') == $i ? 'selected' : '' }}> {{ $i }} {{ __('home.star') }}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="status"> {{ __('admin.testimonials') }} / {{ __('admin.status') }}</label>
                                <select name="status" id="status" class="form-control select2">
                                    @for($i = 0;$i < 2;$i++)
                                        <option value="{{ $i }}" {{ old('status') == $i ? 'selected' : '' }}> {{ $i == 0 ? __('admin.hidden') : __('admin.visible') }}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>
                    </div>

                    @foreach(config('locales.languages') as $key => $value)
                        <div class="form-group">
                            <label for="meta_tag[{{ $key }}]"> {{ trans('admin.testimonials') }} / {{ trans('admin.'. $key .'_meta_tag') }}</label>
                            <input id="meta_tag[{{ $key }}]" name="meta_tag[{{ $key }}]" type="text" class="form-control" placeholder="{{ trans('admin.'. $key .'_meta_tag') }}" value="{{ old('meta_tag.' . $key) }}">
                        </div>
                    @endforeach

                    <div class="form-group">
                        <input class="image_name" type="hidden" name="image" value="">
                    </div>
                    <div class="form-group">
                        <label> {{ __('admin.photo') }} </label>
                        <div class="dropzone" id="mainphoto"></div>
                    </div>

                    <div class="text-right mb-5">
                        <input type="submit" name="add" class="btn btn-success" value="{{ trans('admin.add') }}">
                    </div>
                </form>
            </div>
        </div>
        <!-- // END drawer-layout__content -->
    </div>
@endsection
