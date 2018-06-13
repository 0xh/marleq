@extends('layouts/app')

@section('content')

    {{--MARLEQ INTRO--}}

    <section class="hero hero-intro is-marleq is-medium">
        <div class="hero-body">
            <div class="columns is-centered">
                <div class="column is-three-quarters has-text-centered">
                    <h1 class="title m-b-25">
                        FIND YOUR CAREER COACH AND <br />BUILD A SUCCESSFUL CAREER
                    </h1>
                    <h2 class="subtitle m-t-20">
                        ﻿We will help you land a dream job
                    </h2>
                    <p class="m-t-40 m-b-30">
                        <button class="button is-marleq is-medium is-uppercase is-inverted has-text-weight-semibold"
                                @click="isVideoModalActive = true">
                            <span class="icon">
                                <i class="fa fa-video-camera"></i>
                            </span>
                            <span>See how it works</span>
                        </button>
                    </p>
                    <p>
                        ﻿You are just one step closer to a desirable career.<br/>
                        <a class="has-text-white" href="{{ route('register')}}" style="text-decoration: underline;">Register</a>
                    </p>
                </div>
            </div>
        </div>
    </section>

    {{--FREE CV CHECK--}}

    <section class="hero hero-free-cv is-dark">
        <div class="hero-body">
            <div class="container has-text-centered p-t-50 p-b-50">
                <h1 class="title m-b-50">
                    GET YOUR CV CHECKED BY OUR CAREER EXPERTS <span>FOR FREE!</span>
                </h1>
                <h2 class="subtitle">
                    Upload your CV and you will receive an insightful feedback in order to improve it
                </h2>
                @if (Auth::user())
                    @if(Auth::user()->free_cv >= 1)
                        @if(Auth::user()->free_cv == 1)
                            <p class="m-t-35">
                                <a class="button is-marleq is-medium is-inverted is-rounded" href="{{ route('free-cv.index')}}">
                                    <span>Your CV is being reviewed</span>
                                </a>
                            </p>
                        @else
                            <p class="m-t-35">
                                <a class="button is-marleq is-medium is-inverted is-rounded" href="{{ route('free-cv.index')}}">
                                    <span>View Results</span>
                                </a>
                            </p>
                        @endif
                    @else
                        @if(Auth::user()->profile_completion < 4)
                            <b-tooltip label="Please complete your Profile information" type="is-danger" always>
                                <a class="button is-marleq is-medium is-inverted is-rounded" disabled>
                                    <span>Let's Start!</span>
                                </a>
                            </b-tooltip>
                        @else
                            <p class="m-t-35">
                                <a class="button is-marleq is-medium is-inverted is-rounded" href="{{ route('free-cv.index')}}">
                                    <span>Let's Start!</span>
                                </a>
                            </p>
                        @endif
                    @endif
                @else
                    <h2 class="subtitle">
                        <a href="{{ route('register')}}">
                        <span class="icon">
                            <i class="fa fa-user"></i>
                        </span>
                            <span class="has-text-weight-bold has-text-co">Sign Up Now</span>
                        </a>
                        <span> or</span>
                        <a href="{{ route('login')}}">
                            <span class="has-text-weight-bold has-text-co">Login</span>
                            <span class="icon">
                                <i class="fa fa-angle-double-right"></i>
                            </span>
                        </a>
                    </h2>
                @endif
            </div>
        </div>
    </section>

    {{--HOW IT WORKS--}}

    <section class="section hero-how-it-works">
        <div class="container p-b-50">
            <div class="has-text-centered">
                <h1 class="homepage-mod-h1">How it works</h1>
            </div>
            <div class="columns is-narrow has-text-centered">
                <div class="column">
                    <img src="{{ url('/../images/marleq-how-it-works-browse-career-coaches.svg') }}" alt="">
                    <h2 class="homepage-mod-h2">FIND YOUR CAREER COACH</h2>
                    <p>Find and book the right career coach</p>
                </div>
                <div class="column">
                    <img src="{{ url('/../images/marleq-how-it-works-gain-mentorship.svg') }}" alt="">
                    <h2 class="homepage-mod-h2">GAIN CAREER MENTORSHIP</h2>
                        <p>Gain new knowledge and skills</p>
                </div>
                <div class="column">
                    <img src="{{ url('/../images/marleq-how-it-works-land-your-dream-job.svg') }}" alt="">
                    <h2 class="homepage-mod-h2">LAND YOUR DREAM JOB</h2>
                        <p>Achieve desirable career progress</p>
                </div>
            </div>
        </div>
    </section>

    {{--SERVICES--}}

    <section class="hero hero-services is-narrow is-light">
        <div class="hero-body">
            <div class="container">
                <div class="has-text-centered">
                    <h1 class="homepage-mod-h1">Our Services</h1>
                </div>
                <div class="columns is-multiline is-variable bd-klmn-columns is-narrow has-text-centered m-b-30">
                    @foreach($featuredServices as $service)
                        <div class="column is-one-quarter">
                            <div>
                                @if($service->image)
                                    <img src="{{ URL::asset($service->image) }}" style="width:70px;">
                                @endif
                                <a href="{{ route('service-show', $service->alias) }}"><h3 class="m-t-20 service-h3">{{ $service->name }}</h3></a>
                                <div class="has-text-weight-light">
                                    {!! $service->description !!}
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="has-text-centered">
                    <b-collapse :open="false">
                        <div class="columns is-multiline is-narrow m-t-20">
                            @foreach($services as $service)
                                <div class="column is-one-quarter m-t-20">
                                    <div>
                                        @if($service->image)
                                            <img src="{{ URL::asset($service->image) }}" style="width:70px;">
                                        @endif
                                        <a href="{{ route('service-show', $service->alias) }}"><h3 class="m-t-20 service-h3">{{ $service->name }}</h3></a>
                                        <div class="has-text-weight-light">
                                            {!! $service->description !!}
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <a class="button is-text is-medium" slot="trigger" style="text-decoration: inherit;">
                            <span>Additional Coaching Services</span>
                            <span class="icon">
                                <i class="fa fa-angle-down has-text-marleq"></i>
                            </span>
                        </a>
                    </b-collapse>
                </div>
            </div>
        </div>
    </section>

    {{--OUR COACHES--}}

    <section class="section">
        <div class="container">
            <div class="has-text-centered">
                <h1 class="homepage-mod-h1">Our Coaches</h1>
            </div>
            <div class='carousel is-4 carousel-animated carousel-animate-slide' data-autoplay="true" data-delay="5000">
                <div class='carousel-container'>
                    @foreach($coaches as $coach)
                        <div class='carousel-item @if($loop->first) is-active @endif'>
                            @if($coach->picture_crop)
                                <figure class="image is-square"><img class="is-grayscale" src="{{ URL::asset($coach->picture_crop) }}" style="border-radius: 15px;"></figure>
                            @endif
                            <div class="has-text-centered m-t-20">
                                <a href="{{ route('coach-show', $coach->alias) }}">
                                    <h3 class="homepage-mod-h3">{{ $coach->name }} {{ $coach->surname }}</h3>
                                </a>
                                <div class="has-text-weight-light has-text-centered">
                                    {!! $coach->biography !!}
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="carousel-navigation is-centered">
                    <div class="carousel-nav-left">
                        <i class="fa fa-chevron-left" aria-hidden="true"></i>
                    </div>
                    <div class="carousel-nav-right">
                        <i class="fa fa-chevron-right" aria-hidden="true"></i>
                    </div>
                </div>
            </div>
            <div class="has-text-centered">
                <h1 class="homepage-mod-h1 m-t-50 m-b-50 p-t-20 p-b-20">Our Career Coaches have worked at</h1>
            </div>
            <div class="columns m-b-25">
                <div class="column">
                    <img src="{{ url('/../images/marleq-logos-001-google.svg') }}" alt="" class="is-grayscale p-t-30">
                </div>
                <div class="column">
                    <img src="{{ url('/../images/marleq-logos-002-linkedin.svg') }}" alt="" class="is-grayscale p-t-30">
                </div>
                <div class="column">
                    <img src="{{ url('/../images/marleq-logos-003-salesforce.svg') }}" alt="" class="is-grayscale">
                </div>
                <div class="column">
                    <img src="{{ url('/../images/marleq-logos-004-tata.svg') }}" alt="" class="is-grayscale p-t-30">
                </div>
                <div class="column">
                    <img src="{{ url('/../images/marleq-logos-005-telekom.svg') }}" alt="" class="is-grayscale p-t-30">
                </div>
                <div class="column">
                    <img src="{{ url('/../images/marleq-logos-006-xerox.svg') }}" alt="" class="is-grayscale p-t-30">
                </div>
                <div class="column">
                    <img src="{{ url('/../images/marleq-logos-007-ing.svg') }}" alt="" class="is-grayscale p-t-30">
                </div>
                <div class="column">
                    <img src="{{ url('/../images/marleq-logos-008-trivago.svg') }}" alt="" class="is-grayscale p-t-30">
                </div>
            </div>
        </div>
    </section>

    {{--FIND A COACH--}}

    <section class="hero hero-find-a-coach is-marleq">
        <div class="hero-body">
            <div class="container has-text-centered p-t-50 p-b-50">
                <h1 class="title m-b-40">
                    BOOKING THE RIGHT CAREER COACH<br />
                    FOR YOU WAS NEVER EASIER
                </h1>
                <h2 class="subtitle m-t-10 m-b-40">
                    ﻿Our coaches will help you gain new skills and mentor your career success
                </h2>
                <button class="button is-marleq is-medium is-inverted">
                    <span class="icon">
                        <i class="fa fa-search"></i>
                    </span>
                    <span>Find a Coach</span>
                </button>
            </div>
        </div>
    </section>

    {{--MARLEQ INSPIRATION--}}

    <section class="section">
        <div class="container">
            <div class="has-text-centered">
                <h1 class="homepage-mod-h1">More than Inspiration</h1>
            </div>
            <div class="columns is-narrow m-t-40">
                @foreach($inspiration->posts as $post)
                    <div class="column is-one-quarter">
                        <div class="card is-shadowless">
                            @if($post->intro_image)
                                <div class="card-image">
                                    <figure class="image is-4by3">
                                        <img src="{{ URL::asset($post->intro_image) }}" alt="" style="border-radius: 15px;">
                                    </figure>
                                </div>
                            @endif
                            <div class="card-content p-l-0 p-r-0">
                                <div>
                                    <h3 class="homepage-mod-h3">{{ $post->title }}</h3>
                                    <div class="m-b-15">
                                        {!! strip_tags(str_limit($post->content, 150)) !!}
                                    </div>
                                    <div>
                                        <a href="{{ route('inspiration-show', $post->alias) }}">
                                            <span>Read more</span>
                                            <span class="icon">
                                                <i class="fa fa-angle-right has-text-marleq"></i>
                                            </span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{--OUR APPROACH--}}

    <section class="hero hero-our-approach is-narrow is-marleq">
        <div class="hero-body">
            <div class="container p-b-50">
                <div class="has-text-centered">
                    <h1 class="homepage-mod-h1 m-b-50 has-text-white">Our Approach</h1>
                </div>
                <div class="columns is-centered m-b-10 has-text-centered bd-klmn-columns is-variable">
                    <div class="column">
                        <img src="{{ url('/../images/marleq-our-approach-professional.svg') }}" alt="" style="width:100px;">
                        <h2 class="homepage-mod-h2 has-text-white is-3 p-b-10">Professional</h2>
                        <p>You will work with a team of professionals fully dedicated to your career success.</p>
                    </div>
                    <div class="column">
                        <img src="{{ url('/../images/marleq-our-approach-superor-fast.svg') }}" alt="" style="width:100px;">
                        <h2 class="homepage-mod-h2 has-text-white is-3 p-b-10">Superior Fast</h2>
                        <p>Simple and easy to use tools will help you find and book your career coach within 24h.</p>
                    </div>
                    <div class="column">
                        <img src="{{ url('/../images/marleq-our-approach-outstanding.svg') }}" alt="" style="width:100px;">
                        <h2 class="homepage-mod-h2 has-text-white is-3 p-b-10">Outstanding</h2>
                        <p>Our coaches deliver valuable advices, as only best coaches meet our quality criteria.</p>
                    </div>
                    <div class="column">
                        <img src="{{ url('/../images/marleq-our-approach-results.svg') }}" alt="" style="width:100px;">
                        <h2 class="homepage-mod-h2 has-text-white is-3 p-b-10">Result-driven</h2>
                        <p>On average candidates need 6 months for a new job, our candidates need 1-2 months.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{--MARLEQ EVENTS--}}

    <section class="section">
        <div class="container">
            <div class="has-text-centered">
                <h1 class="homepage-mod-h1">Our Events</h1>
            </div>
            <div class="columns is-narrow m-t-40">
                @foreach($events->posts as $post)
                    <div class="column">
                        <div class="card is-shadowless">
                            @if($post->intro_image)
                                <div class="card-image">
                                    <figure class="image is-4by3">
                                        <img src="{{ URL::asset($post->intro_image) }}" alt="" style="border-radius: 15px;">
                                    </figure>
                                </div>
                            @endif
                            <div class="card-content p-l-0 p-r-0">
                                <div>
                                    <h3 class="homepage-mod-h3">{{ $post->title }}</h3>
                                    <div class="m-b-15">
                                        {!! strip_tags(str_limit($post->content, 150)) !!}
                                    </div>
                                    <div>
                                        <a href="{{ route('event-show', $post->alias) }}">
                                            <span>Read more</span>
                                            <span class="icon">
                                                <i class="fa fa-angle-right has-text-marleq"></i>
                                            </span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{--MARLEQ IN FIGURES--}}

    <section class="hero hero-in-figures is-narrow is-marleq p-b-10">
        <div class="hero-body p-b-50">
            <div class="container p-b-50">
                <div class="has-text-centered">
                    <h1 class="homepage-mod-h1 m-b-50 m-t-30 p-b-20 has-text-white">MARLEQ in figures</h1>
                </div>
                <nav class="level">
                    <div class="level-item has-text-centered">
                        <div>
                            <p class="heading">Faster to a new job</p>
                            <p class="title">3-6x</p>
                        </div>
                    </div>
                    <div class="level-item has-text-centered">
                        <div>
                            <p class="heading">Countries</p>
                            <p class="title">30+</p>
                        </div>
                    </div>
                    <div class="level-item has-text-centered">
                        <div>
                            <p class="heading">Events attendants</p>
                            <p class="title">1,500+</p>
                        </div>
                    </div>
                    <div class="level-item has-text-centered">
                        <div>
                            <p class="heading">Post views</p>
                            <p class="title">600,000+</p>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </section>

    {{--TESTIMONIALS--}}

    <section class="section">
        <div class="container p-b-20">
            <div class="has-text-centered">
                <h1 class="homepage-mod-h1 m-b-30">Testimonials</h1>
            </div>
            <div class='carousel is-3 carousel-animated carousel-animate-slide' data-autoplay="false" data-delay="5000">
                <div class='carousel-container'>
                    @foreach($testimonials as $testimonial)
                        <div class='carousel-item @if($loop->first) is-active @endif has-text-centered'>
                            <div class="has-text-centered m-t-20">
                                @if($testimonial->user->picture_crop)
                                    <img class="is-grayscale" src="{{ URL::asset($testimonial->user->picture_crop) }}" style="border-radius: 15px; width:100px;">
                                @endif
                                <h3 class="homepage-mod-h3">{{ $testimonial->user->name }}</h3>
                                <div>{!! str_limit($testimonial->content, 350) !!}</div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="carousel-navigation is-centered">
                    <div class="carousel-nav-left">
                        <i class="fa fa-chevron-left" aria-hidden="true"></i>
                    </div>
                    <div class="carousel-nav-right">
                        <i class="fa fa-chevron-right" aria-hidden="true"></i>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{--SOCIAL NETWORKS--}}

    <section class="hero is-narrow is-marleq">
        <div class="hero-body">
            <div class="container p-b-50">
                <div class="has-text-centered">
                    <h1 class="homepage-mod-h1 m-b-40 has-text-white">Get Social with Us</h1>
                </div>
                <div class="columns is-centered is-mobile m-b-10">
                    <div class="column is-centered is-full-mobile is-half-tablet is-one-third-desktop">
                        <div class="columns has-text-centered is-multiline">
                            <div class="column">
                                <a href="https://www.facebook.com/MARLEQcoach/" target="_blank">
                                    <span class="icon is-large">
                                        <i class="fa fa-facebook-f fa-3x has-text-white"></i>
                                    </span>
                                </a>
                            </div>
                            <div class="column">
                                <a href="https://www.instagram.com/_marleq_/" target="_blank">
                                    <span class="icon is-large">
                                        <i class="fa fa-instagram fa-3x has-text-white"></i>
                                    </span>
                                </a>
                            </div>
                            <div class="column">
                                <a href="https://www.linkedin.com/company/marleq/" target="_blank">
                                    <span class="icon is-large">
                                        <i class="fa fa-linkedin fa-3x has-text-white"></i>
                                    </span>
                                </a>
                            </div>
                            <div class="column">
                                <a href="https://vimeo.com/marleq" target="_blank">
                                    <span class="icon is-large">
                                        <i class="fa fa-vimeo fa-3x has-text-white"></i>
                                    </span>
                                </a>
                            </div>
                            <div class="column">
                                <a href="#">
                                    <span class="icon is-large">
                                        <i class="fa fa-youtube-play fa-3x has-text-white"></i>
                                    </span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{--MODAL OVERVIEW VIDEO--}}

    <template>
        <section>
            <b-modal :active.sync="isVideoModalActive">
                <iframe src="https://player.vimeo.com/video/269202769?autoplay=1&title=0&byline=0&portrait=0"
                        width="640" height="360" frameborder="0"
                        webkitallowfullscreen mozallowfullscreen allowfullscreen>
                </iframe>
            </b-modal>
        </section>
    </template>

@endsection

@section('scripts')
    <script>
        const app = new Vue({
            el: "#app",
            data: {
                isVideoModalActive: false,
                areServicesVisible: true
            }
        })
    </script>
@endsection