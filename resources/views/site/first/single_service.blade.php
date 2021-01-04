@extends('site.first.layouts.app')

@section('content')

    <div class="page-title-area bg-12">
        <div class="container">
            <div class="page-title-content">
                <h2>{{ $service->title }}</h2>
                <ul>
                    <li>
                        <a href="{{ url('/') }}">
                            {{ __('home.home') }}
                        </a>
                    </li>
                    <li>{{ __('admin.pages') }}</li>
                    <li class="active">{{ __('home.service_details') }}</li>
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


    <section class="services-details-area ptb-100">
        <div class="container">
            <div class="scrives-item-2 mt-4 ">
                <div class="row align-items-center">
                    <div class="col-lg-4">
                        <div class="services-img">
                            <img src="{{ $service->service_image }}" alt="Image">
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <h3>{{ $service->title }}</h3>
                        <p>
                            {{ $service->description }}
                        </p>
                    </div>
                </div>
            </div>
            <div class="scrives-item-3 mt-4">
                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <div class="social">
                            <ul class="social-link">

                                @php
                                    $socialSites = ['facebook', 'twitter', 'instagram'];
                                @endphp

                                @for($i = 0; $i < count($socialSites); $i++)
                                    @if(setting($socialSites[$i]) != '')
                                        <li>
                                            <a href="{{ setting($socialSites[$i]) }}">
                                                <i class="bx bxl-{{ $socialSites[$i] }}"></i>
                                            </a>
                                        </li>
                                    @endif
                                @endfor
                            </ul>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>

@endsection
