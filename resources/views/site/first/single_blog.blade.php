@extends('site.first.layouts.app')

@section('content')

    <div class="page-title-area bg-12">
        <div class="container">
            <div class="page-title-content">
                <h2>{{ $blog->title }}</h2>
                <ul>
                    <li>
                        <a href="{{ url('/') }}">
                            {{ __('home.home') }}
                        </a>
                    </li>
                    <li>{{ __('admin.pages') }}</li>
                    <li class="active">{{ __('home.blog_details') }}</li>
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

    <section class="blog-details-area ptb-100">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-12">
                    <div class="blog-details-desc">
                        <div class="article-image">
                            <img src="{{ $blog->blog_image }}" alt="image" style="width: 730px; height: 600px;">
                        </div>
                        <div class="article-content">
                            <div class="entry-meta">
                                <ul>
                                    <li>
                                        <span>{{ __('home.on') }}:</span>
                                        <a href="#">{{ date('M d Y', strtotime($blog->created_at)) }}</a>
                                    </li>
                                    <li>
                                        <span>{{ __('home.by') }}:</span>
                                        <a href="#">{{ $blog->author }}</a>
                                    </li>
                                </ul>
                            </div>
                            <h3>{{ $blog->title }}</h3>

                            {!! $blog->content !!}

                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12">
                    <aside class="widget-area" id="secondary">
                        <div class="widget widget_search">
                            <h3 class="widget-title">{{ __('home.search') }}</h3>
                            <div class="post-wrap">
                                <form class="search-form">
                                    <label>
                                        <span class="screen-reader-text">{{ __('home.search') }}:</span>
                                        <input type="search" class="search-field" placeholder="{{ __('home.search') }}">
                                    </label>
                                    <button type="submit"><i class='bx bx-search'></i></button>
                                </form>
                            </div>
                        </div>
                        <section class="widget widget-peru-posts-thumb">
                            <h3 class="widget-title">{{ __('home.latest_blog') }}</h3>
                            <div class="post-wrap">
                                @foreach($latest_blogs as $latest_blog)
                                    <article class="item">
                                        <a href="{{ url('/blogs/' . $latest_blog->slug) }}" class="thumb">
                                            <span class="fullimage cover" role="img" style="background-image: url('{{ $latest_blog->thumb_image }}'); height: 80px; width: 80px;"></span>
                                        </a>
                                        <div class="info">
                                            <time datetime="2020-06-30">{{ date('M d Y', strtotime($latest_blog->created_at)) }}</time>
                                            <h4 class="title usmall">
                                                <a href="{{ url('/blogs/' . $latest_blog->slug) }}">
                                                    {{ Str::limit($latest_blog->title, 40) }}
                                                </a>
                                            </h4>
                                        </div>
                                        <div class="clear"></div>
                                    </article>
                                @endforeach
                            </div>
                        </section>
                    </aside>
                </div>
            </div>
        </div>
    </section>

@endsection
