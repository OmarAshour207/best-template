@extends('site.first.layouts.app')

@section('content')

    <div class="page-title-area bg-12">
        <div class="container">
            <div class="page-title-content">
                <h2>{{ __('home.our_services') }}</h2>
                <ul>
                    <li>
                        <a href="{{ url('/') }}">
                            {{ __('home.home') }}
                        </a>
                    </li>
                    <li>{{ __('admin.pages') }}</li>
                    <li class="active">{{ __('home.our_services') }}</li>
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


    <section class="second-facility-area pt-100 pb-70">
        <div class="container">
            <div class="row">
                @foreach($services as $service)
                    <div class="col-lg-4 col-sm-6">
                        <div class="second-facility-item">
                            <img src="{{ $service->thumb_image }}" alt="Image">
                            <h3>{{ $service->title }}</h3>
                            <p>{{ Str::limit($service->description, 100) }}</p>
                            <a href="{{ url('/services/' . $service->slug) }}" class="read-more">
                                {{ __('home.read_more') }}
                                <i class="bx bx-plus"></i>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
            {{ $services->appends(request()->query())->links() }}
        </div>
    </section>


    <section class="emergency-area">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6">
                    <div class="emergency-content ptb-100">
                        <h2>{{ $contactUs->title }}</h2>
                        <p>{{ $contactUs->description }}</p>
                        <ul>
                            <li class="active">
                                <i class="bx bx-phone-call"></i>
                                <span>{{ __('home.call_us') }}</span>
                                <h3>{{ setting('phone') }}</h3>
                            </li>
                            <li>
                                <i class="bx bx-envelope"></i>
                                <span>{{ __('home.contact_us') }}</span>
                                <h3>
                                    <a href="mailto:{{ setting('email') }}">
                                        {{ setting('email') }}
                                    </a>
                                </h3>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-6 pr-0">
                    <div class="emergency-img" style="background-image: url('{{ $contactUs->page_image }}')"></div>
                </div>
            </div>
        </div>
        <div class="shape">
            <img src="{{ asset('site/part1/img/shape/emergency-shape.png') }}" alt="Image">
        </div>
    </section>


    <section class="our-work-area pt-100 pb-70">
        <div class="container">
            <div class="section-title">
                <h2>{{ __('admin.our_projects') }}</h2>
            </div>
            <div class="work-wrap owl-carousel owl-theme">
                @foreach($projects as $project)
                    <div class="single-work">
                        <img src="{{ $project->project_image }}" alt="Image">
                        <h3 class="work-title">
                            <i class="flaticon-cardiology"></i>
                            {{ $project->title }}
                        </h3>
                        <div class="work-content-wrap">
                            <div class="work-content">
                                <h3>{{ $project->title }}</h3>
                                <p>{{ $project->description }}</p>
                                <a href="{{ url('/projects/' . $project->slug) }}" class="read-more">
                                    {{ __('home.read_more') }}
                                    <i class="bx bx-plus"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="shape">
            <img src="{{ asset('site/part1/img/shape/work-shape.png') }}" alt="Image">
        </div>
    </section>


@endsection
