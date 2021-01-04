@extends('site.first.layouts.app')

@section('content')

    <div class="page-title-area bg-15">
        <div class="container">
            <div class="page-title-content">
                <h2>{{ __('home.about_us') }}</h2>
                <ul>
                    <li>
                        <a href="{{ url('/') }}">
                            {{ __('home.home') }}
                        </a>
                    </li>
                    <li>{{ __('admin.pages') }}</li>
                    <li class="active">{{ $aboutUs->title }}</li>
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

    <section class="about-area about-page pb-130">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="about-img">
                        <img src="{{ $aboutUs->page_image }}" alt="Image">
                        <div class="shape-1">
                            <img src="{{ asset('site/part1/img/about/shape-1.png') }}" alt="Image">
                        </div>
                        <div class="shape-2">
                            <img src="{{ asset('site/part1/img/about/shape-2.png') }}" alt="Image">
                        </div>
                        <div class="shape-3">
                            <img src="{{ asset('site/part1/img/about/shape-3.png') }}" alt="Image">
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="about-content">
                        <span class="top-title">{{ $aboutUs->title }}</span>
                        <p>
                            {{ $aboutUs->description }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="doctors-area pt-100 pb-70">
        <div class="container">
            <div class="section-title">
                <h2>{{ __('home.meet_team') }}</h2>
            </div>
            <div class="doctors-wrap owl-carousel owl-theme">
                @foreach($teamMembers as $teamMember)
                    <div class="single-doctor">
                        <img src="{{ $teamMember->member_image }}" alt="Image">
                        <h3>{{ $teamMember->name }}</h3>
                        <span class="top-title">{{ $teamMember->title }}</span>
                        <p>{{ $teamMember->description }}</p>
                        <ul>
                            <li>
                                <a href="#">
                                    <i class="bx bxl-facebook"></i>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="bx bxl-twitter"></i>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="bx bxl-pinterest-alt"></i>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="bx bxl-instagram"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="counter-area pt-100 pb-70">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-sm-6">
                    <div class="single-counter">
                        <i class="flaticon-tick"></i>
                        <h2>
                            <span class="odometer" data-count="{{ $services_count }}">00</span>
                            <span class="target">+</span>
                        </h2>
                        <p>{{ __('home.service') }}</p>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <div class="single-counter">
                        <i class="flaticon-trophy"></i>
                        <h2>
                            <span class="odometer" data-count="{{ $projects_count }}">00</span>
                            <span class="traget">+</span>
                        </h2>
                        <p>{{ __('home.project') }}</p>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-12">
                    <div class="single-counter">
                        <i class="flaticon-experience"></i>
                        <h2>
                            <span class="odometer" data-count="{{ $team_count }}">00</span>
                            <span class="traget">+</span>
                        </h2>
                        <p>{{ __('admin.team_members') }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="shape-wrap">
            <div class="shape-1">
                <img src="{{ asset('site/part1/img/shape/counter-shape.png') }}" alt="Image">
            </div>
            <div class="shape-2">
                <img src="{{ asset('site/part1/img/shape/counter-shape.png') }}" alt="Image">
            </div>
        </div>
    </section>

@endsection
