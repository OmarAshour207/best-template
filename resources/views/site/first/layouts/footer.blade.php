
<footer class="footer-top-area f-bg pt-100 pb-70">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-6">
                <div class="single-widget">
                    <a href="{{ url('/') }}">
                        <img src="{{ getLogo() }}" alt="Image">
                    </a>
                    <p>
                        @foreach($pages as $page)
                            @if ($page->slug == 'about')
                                {{ $page->description }}
                            @endif
                        @endforeach
                    </p>
                    <div class="social-area">
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
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="single-widget">
                    <h3>{{ __('home.useful_links') }}</h3>
                    <ul>
                        <li>
                            <a href="{{ url('/') }}">
                                {{ __('home.home') }}
                            </a>
                        </li>
                        @foreach($pages as $page)
                            <li>
                                <a href="{{ url($page->slug) }}">
                                    {{ $page->title }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="single-widget open-time">
                    <h3>{{ __('home.our_services') }}</h3>
                    <ul>
                        @foreach($services as $service)
                            <li>
                                <a href="{{ url('/services/' . $service->slug) }}">
                                    <span>{{ $service->title }}</span>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="single-widget contact">
                    <h3>{{ __('home.get_in') }} {{ __('home.touch') }} </h3>
                    <ul>
                        <li class="pl-0">
                            <a href="tel:{{ setting('phone') }}">
                                <i class="bx bx-phone-call"></i>
                                <span>{{ __('home.phone') }}:</span>
                                {{ __('home.phone') }}: {{ setting('phone') }}
                            </a>
                        </li>
                        <li class="pl-0">
                            <a href="maito:{{ setting('email') }}">
                                <i class="bx bx-envelope"></i>
                                <span>{{ __('home.email_contact') }}:</span>
                                {{ setting('email') }}
                            </a>
                        </li>
                        <li>
                            <i class="bx bx-location-plus"></i>
                            <span>{{ __('admin.address') }}:</span>
                            {{ setting(session('lang') . '_address') }}
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</footer>


<footer class="footer-bottom-area">
    <div class="container">
        <div class="copy-right">
            <p>Copyright @2020 4wee. Designed by <a href="https://envytheme.com/" target="blank">4wee</a></p>
        </div>
    </div>
</footer>
