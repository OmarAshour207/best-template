
<header class="header-area fixed-top">
    <div class="top-header-area">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-8 col-md-9 col-sm-6">
                    <ul class="header-content-left">
                        <li>
                            <a href="tel:{{ setting('phone') }}">
                                <i class="bx bx-phone-call"></i>
                                {{ __('home.call_us') }}: {{ setting('phone') }}
                            </a>
                        </li>
                        <li>
                            <a href="mailto:{{ setting('email') }}">
                                <i class="bx bxs-paper-plane"></i>
                                {{ __('home.email_contact') }}: {{ setting('email') }}
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="col-lg-4 col-md-3 col-sm-6">
                    <ul class="header-content-right">
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

    <div class="nav-area">
        <div class="navbar-area">

            <div class="mobile-nav">
                <a href="{{ url('/') }}" class="logo">
                    <img src="{{ getLogo() }}" alt="Logo">
                </a>
            </div>

            <div class="main-nav">
                <nav class="navbar navbar-expand-md navbar-light">
                    <div class="container">
                        <a class="navbar-brand" href="{{ url('/') }}">
                            <img src="{{ getLogo() }}" alt="Logo">
                        </a>
                        <div class="collapse navbar-collapse mean-menu" id="navbarSupportedContent">
                            <ul class="navbar-nav m-auto">
                                <li class="nav-item">
                                    <a href="{{ url('/') }}" class="nav-link {{ setActiveHome('') }}">
                                        {{ __('home.home') }}
                                    </a>
                                </li>
                                @foreach($pages as $page)
                                    <li class="nav-item">
                                        <a href="{{ url($page->slug) }}" class="nav-link {{ setActive($page->slug) }}">
                                            {{ $page->title }}
                                        </a>
                                    </li>
                                @endforeach

                                <li class="nav-item">
                                    <a href="#" class="nav-link dropdown-toggle">
                                        {{ __('admin.languages') }}
                                        <i class="bx bx-plus"></i>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li class="nav-item">
                                            <a href="{{ url('/lang/ar') }}" class="nav-link">
                                                العربيه
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="{{ url('/lang/en') }}" class="nav-link">
                                                {{ __('admin.en') }}
                                            </a>
                                        </li>
                                    </ul>
                                </li>

                            </ul>


                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </div>

</header>
