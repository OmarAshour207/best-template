@extends('site.first.layouts.app')

@section('content')

    <div class="page-title-area bg-12">
        <div class="container">
            <div class="page-title-content">
                <h2>{{ $teamMember->name }}</h2>
                <ul>
                    <li>
                        <a href="{{ url('/') }}">
                            {{ __('home.home') }}
                        </a>
                    </li>
                    <li>{{ __('admin.pages') }}</li>
                    <li class="active">{{ __('home.doctor_details') }}</li>
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


    <section class="doctors-details-area ptb-100">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <div class="doctors-sidebar">
                        <div class="doctors-img">
                            <img src="{{ $teamMember->member_image }}" alt="Image">
                            @php
                                $socialSites = ['facebook', 'twitter', 'instagram'];
                            @endphp
                            <ul>
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
                        <div class="availability">
                            <h3>
                                <i class="bx bx-time"></i>
                                {{ __('home.availability') }}
                            </h3>
                            <a href="{{ url('/') }}" class="default-btn mt-4">
                                {{ __('home.book_appointment') }}
                            </a>
                        </div>
                        <div class="client-area doctors-feedback">
                            <div class="client-wrap-two owl-carousel owl-theme">
                                @foreach($testimonials as $testimonial)
                                    <div class="single-client">
                                        <img src="{{ $testimonial->thumb_image }}" alt="img" style="height: 60px; width: 60px;">
                                        <p>{{ $testimonial->description }}</p>
                                        <ul>
                                            @for($i = 0;$i < $testimonial->stars;$i++)
                                                <li>
                                                    <i class="bx bxs-star"></i>
                                                </li>
                                            @endfor
                                        </ul>
                                        <h3>{{ $testimonial->name }}</h3>
                                        <span>{{ $testimonial->title }}</span>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="doctors-detailss">
                        <div class="doctors-history">
                            <h2>{{ $teamMember->name }}</h2>
                            <span>{{ $teamMember->title }}</span>
                            <p>{{ $teamMember->description }}</p>
                            <div class="row borders">
                                <div class="col-lg-3 pl-0">
                                    <div class="left-title">
                                        <h3>{{ __('admin.address') }}</h3>
                                    </div>
                                </div>
                                <div class="col-lg-9">
                                    <div class="right-title">
                                        <ul>
                                            <li>
                                                <i class="bx bxs-hand-right"></i>
                                                {{ setting(session('lang') . '_address') }}
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="row borders">
                                <div class="col-lg-3 pl-0">
                                    <div class="left-title">
                                        <h3>{{ __('home.phone') }}</h3>
                                    </div>
                                </div>
                                <div class="col-lg-9">
                                    <div class="right-title">
                                        <ul>
                                            <li>
                                                <i class="bx bxs-hand-right"></i>
                                                {{ setting('phone') }}
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="row borders">
                                <div class="col-lg-3 pl-0">
                                    <div class="left-title">
                                        <h3>{{ __('home.email_contact') }}</h3>
                                    </div>
                                </div>
                                <div class="col-lg-9">
                                    <div class="right-title">
                                        <ul>
                                            <li>
                                                <i class="bx bxs-hand-right"></i>
                                                <a href="mailto:{{ setting('email') }}">
                                                    {{ setting('email') }}
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="appointment-here-form">
                            <h2>{{ __('home.rate_this_doctor') }}</h2>
                            @if (session('success'))
                                <h3 class="alert alert-success"> {{ __('home.sent_successfully') }} </h3>
                            @endif
                            <form method="post" action="{{ route('rate.doctor', $teamMember->name) }}">
                                @csrf
                                @include('dashboard.partials._errors')
                                <div class="row">
                                    <div class="col-lg-12">
                                        <label>{{ __('home.select_stars') }}</label>
                                        <div class="form-group">
                                            <select name="stars">
                                                @for($i = 1; $i < 6;$i++)
                                                    <option value="{{ $i }}" {{ old('stars') == $i ? 'selected' : '' }}>
                                                        {{ $i }} {{ __('home.star') }}
                                                    </option>
                                                @endfor
                                            </select>
                                            <i class="flaticon-star"></i>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <label>{{ __('admin.description') }}</label>
                                        <div class="form-group">
                                            <textarea name="description" class="form-control" cols="30" rows="8" placeholder="{{ __('admin.description') }}">{{ old('description') }}</textarea>
                                            <i class="flaticon-edit"></i>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <button type="submit" class="default-btn">{{ __('home.send') }}</button>
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
