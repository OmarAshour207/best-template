@extends('site.first.layouts.app')

@section('content')

    <div class="page-title-area bg-12">
        <div class="container">
            <div class="page-title-content">
                <h2>{{ __('home.latest_blog') }}</h2>
                <ul>
                    <li>
                        <a href="{{ url('/') }}">
                            {{ __('home.home') }}
                        </a>
                    </li>
                    <li>{{ __('admin.pages') }}</li>
                    <li class="active">{{ __('home.latest_blog') }}</li>
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


    <section class="blog-area pt-100 pb-70">
        <div class="container">
            <div class="section-title">
                <h2>{{ __('home.latest_blog') }}</h2>
            </div>
            <div class="row">
                @foreach($blogs as $blog)
                    <div class="col-lg-4 col-md-6">
                        <div class="single-blog">
                            <a href="{{ url('/blogs/' . $blog->slug) }}">
                                <img src="{{ $blog->blog_image }}" alt="Image">
                            </a>
                            <span>{{ date('d M Y', strtotime($blog->created_at)) }}</span>
                            <div class="blog-content">
                                <a href="{{ url('/blogs/' . $blog->slug) }}">
                                    <h3>{{ $blog->title }}</h3>
                                </a>
                                <a href="{{ url('/blogs/' . $blog->slug) }}" class="read-more">
                                    {{ __('home.read_more') }}
                                    <i class="bx bx-plus"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
                <div class="col-lg-12">
                    <div class="page-navigation-area">
                        <nav aria-label="Page navigation example text-center">
                            <ul class="pagination">
                                {{ $blogs->appends(request()->query())->links() }}
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>


@endsection
