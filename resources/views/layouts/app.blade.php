<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'MARLEQ') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        @include('_includes.navigation.main')
        @yield('content')

        {{--FOOTER--}}

        <section class="hero hero-footer is-narrow is-blue">
            <div class="hero-body">
                <div class="container p-t-10">
                    <div class="columns is-centered is-multiline is-variable bd-klmn-columns is-8">
                        <div class="column is-4">
                            <img src="{{ url('/../images/marleq-logo-white.svg') }}" alt="">
                            <p class="p-l-5 p-t-10">Copyright 2018. MARLEQ LLC Estonia</p>
                        </div>
                        <div class="column is-3">
                            {{--<h2 class="homepage-mod-h2 p-b-10" style="color: #ffffff;">About us</h2>--}}
                            <a href="">Out Team</a><br />
                            <a href="">Events</a><br />
                            <a href="">Inspiration</a><br />
                            <a href="">Browse Career Coaches</a><br />
                            <a href="">Request a Service</a><br />
                        </div>
                        <div class="column is-3">
                            <a href="">Privacy Statement</a><br />
                            <a href="">Terms of Use</a><br />
                            <a href="">FAQ</a><br />
                            <a href="">Testimonials</a><br />
                            <a href="">Media coverage</a><br />
                        </div>
                        <div class="column is-2">
                            <p>
                                Germany, Berlin Office<br />
                                +49-(0)30-85767542<br />
                                info@marleq.com<br />
                                Maricistrase 23<br />
                                12047 Berlin
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    @yield('scripts')
</body>
</html>
