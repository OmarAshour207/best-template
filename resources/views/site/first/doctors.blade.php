@extends('site.first.layouts.app')

@section('content')

    <div class="page-title-area bg-12">
        <div class="container">
            <div class="page-title-content">
                <h2>{{ __('home.expert_doctors') }}</h2>
                <ul>
                    <li>
                        <a href="{{ url('/') }}">
                            {{ __('home.home') }}
                        </a>
                    </li>
                    <li>{{ __('admin.pages') }}</li>
                    <li class="active">{{ __('home.expert_doctors') }}</li>
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


    <section class="doctors-area-two ptb-100">
        <div class="container">
            <div class="section-title">
                <h2>{{ __('home.meet_team') }}</h2>
            </div>
            <div class="row">
                @foreach($teamMembers as $teamMember)
                    <div class="col-lg-4 col-sm-6">
                        <div class="single-doctor">
                            <a href="{{ url('/doctors/' . $teamMember->id . '/' . $teamMember->name) }}">
                                <img src="{{ $teamMember->member_image }}" alt="Image">
                            </a>
                            <a href="{{ url('/doctors/' . $teamMember->id . '/' . $teamMember->name) }}">
                                <h3>{{ $teamMember->name }}</h3>
                            </a>
                            <br>
                            <span class="top-title">{{ $teamMember->title }}</span>
                            <p>{{ $teamMember->description }}</p>
                            <a href="{{ url('/') }}" class="btn btn-primary">
                                {{ __('home.book_appointment') }}
                            </a>
                        </div>
                    </div>
                @endforeach
                <div class="col-lg-12">
                    <div class="page-navigation-area">
                        <nav aria-label="Page navigation example text-center">
                            <ul class="pagination">
                                {{ $teamMembers->appends(request()->query())->links() }}
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
