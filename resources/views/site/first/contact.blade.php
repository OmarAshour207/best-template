@extends('site.first.layouts.app')

@section('content')


    <div class="page-title-area bg-11">
        <div class="container">
            <div class="page-title-content">
                <h2>{{ $page->title }}</h2>
                <ul>
                    <li>
                        <a href="{{ url('/') }}">
                            {{ __('home.home') }}
                        </a>
                    </li>
                    <li>{{ __('admin.pages') }}</li>
                    <li class="active">{{ $page->title }}</li>
                </ul>
            </div>
        </div>
        <div class="shape-1">
            <img src="{{ asset('site/part1/img/prevention/shape-1.png') }}" alt="Image">
        </div>
        <div class="shape-2">
            <img src="{{ asset('site/part1/img/prevention/shape-1.png') }}" alt="Image">
        </div>
        <div class="shape-3">
            <img src="{{ asset('site/part1/img/prevention/shape-1.png') }}" alt="Image">
        </div>
        <div class="shape-4">
            <img src="{{ asset('site/part1/img/prevention/shape-1.png') }}" alt="Image">
        </div>
    </div>


    <section class="contact-info-area">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 p-0">
                    <div class="single-contact-info">
                        <i class="bx bx-location-plus"></i>
                        <p>{{ setting(session('lang') . '_address') }}</p>
                        <span>{{ __('home.email') }}:
                            <a href="mailto:{{ setting('email') }}">
                                {{ setting('email') }}
                            </a>
                        </span>
                        <span>{{ __('home.phone') }}: {{ setting('phone') }}</span>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section class="main-contact-area contact ptb-100">
        <div class="container">
            <div class="section-title">
                <h2>{{ $page->title }}</h2>
                <p>{{ $page->description }}</p>
            </div>
            <div class="row align-items-center">
                <div class="col-lg-12">
                    <div class="contact-wrap contact-pages mb-0">
                        <div class="contact-form">
                            @if (session('success'))
                                <h3 class="alert alert-success"> {{ __('home.sent_successfully') }} </h3>
                            @endif
                            <form action="{{ route('send.contact') }}" method="post">
                                @csrf
                                @include('dashboard.partials._errors')
                                <div class="row">
                                    <div class="col-lg-6 col-sm-6">
                                        <label>{{ __('home.full_name') }}</label>
                                        <div class="form-group">
                                            <input type="text" name="name" class="form-control" required placeholder="{{ __('home.full_name') }}" value="{{ old('name') }}">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-sm-6">
                                        <label>{{ __('home.email') }}</label>
                                        <div class="form-group">
                                            <input type="email" name="email" class="form-control" required value="{{ old('email') }}" placeholder="{{ __('home.email_contact') }}">
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-sm-6">
                                        <label>{{ __('home.phone') }}</label>
                                        <div class="form-group">
                                            <input type="text" name="phone" value="{{ old('phone') }}" class="form-control" placeholder="Your Phone">
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <label>{{ __('admin.message') }}</label>
                                        <div class="form-group">
                                            <textarea name="message" class="form-control textarea-hight" cols="30" rows="5" required placeholder="{{ __('admin.message') }}">{{ old('message') }}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-sm-6">
                                        <div class="contact-num">
                                            <h3>{{ __('home.phone') }}</h3>
                                            <span><a href="tel:{{ setting('phone') }}">{{ setting('phone') }}</a></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-sm-6">
                                        <button type="submit" class="default-btn btn-two">
                                            {{ __('home.send') }}
                                        </button>
                                        <div id="msgSubmit" class="h3 text-center hidden"></div>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>



@endsection
