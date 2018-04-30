@extends('layouts/app')

@section('content')

    {{--MARLEQ INTRO--}}

    <section class="hero is-marleq is-medium">
        <div class="hero-body">
            <div class="columns is-centered">
                <div class="column is-three-quarters has-text-centered">
                    <h1 class="title m-b-50 has-text-weight-light">
                        FIND YOUR CAREER COACH, AND BUILD A SUCCESSFUL CAREER
                    </h1>
                    <h2 class="subtitle">
                        We are team of professionals fully dedicated to your career progress.<br />
                        Our experienced career coaches will help you gain new knowledge and skills, and land a dream job.
                    </h2>
                    <p class="m-t-50">
                        <button class="button is-marleq is-medium is-inverted is-rounded"
                                @click="isVideoModalActive = true">
                            <span class="icon">
                                <i class="fa fa-play-circle"></i>
                            </span>
                            <span>Tour Overview</span>
                        </button>
                    </p>
                </div>
            </div>
        </div>
    </section>

    {{--FREE CV CHECK--}}

    <section class="hero is-narrow is-dark">
        <div class="hero-body">
            <div class="container has-text-centered">
                <h1 class="title m-b-40 has-text-weight-light">
                    CHECK YOUR CV FOR FREE!
                </h1>
                <h2 class="subtitle">
                    Upload CV and our experienced career coach will quickly review it.<br />
                    You will receive an insightful feedback in order to improve in your CV.
                </h2>
                @if (Auth::user())
                    @if (Auth::user()->hasRole('administrator'))
                        <p class="m-t-35">
                            <a class="button is-marleq is-medium is-inverted is-rounded" href="#">
                                <span>Let's Start!</span>

                            </a>
                        </p>
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

    <section class="section">
        <div class="container">
            <div class="content has-text-centered">
                <h1>How it works</h1>
            </div>
            <div class="columns is-narrow">
                <div class="column">
                    <h2>FIND YOUR CAREER COACH</h2>
                    <p>Find and book right career coach</p>
                </div>
                <div class="column">
                    <h2>GAIN CAREER MENTORSHIP</h2>
                        <p>Gain new knowledge and skills</p>
                </div>
                <div class="column">
                    <h2>LAND YOUR DREAM JOB</h2>
                        <p>Achieve desirable career progress</p>
                </div>
            </div>
        </div>
    </section>

    {{--SERVICES--}}

    <section class="hero is-narrow is-light">
        <div class="hero-body">
            <div class="container">
                <div class="content has-text-centered">
                    <h1>Our Services</h1>
                </div>
                <div class="columns is-multiline is-narrow has-text-centered">
                    @foreach($featuredServices as $service)
                        <div class="column is-one-quarter has-text-centered">
                            <div class="content">
                                <img src="{{ $service->image }}" style="width:120px;">
                                <h3>{{ $service->name }}</h3>
                                <p>{{ $service->description }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="has-text-centered">
                    <b-collapse :open="false">
                        <div class="columns is-multiline is-narrow m-t-20">
                            @foreach($services as $service)
                                <div class="column is-one-fifth">
                                    <div class="content">
                                        <img src="{{ $service->image }}" style="width:120px;">
                                        <h4 class="m-t-20">{{ $service->name }}</h4>
                                        <p>{{ $service->description }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <a class="button is-text is-medium" slot="trigger" style="text-decoration: inherit;">
                            <span>Additional Coaching Services</span>
                            <span class="icon">
                                <i class="fa fa-angle-double-down"></i>
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
            <div class="content has-text-centered">
                <h1>Our Coaches</h1>
            </div>
            <div class='carousel is-4 carousel-animated carousel-animate-slide' data-autoplay="true" data-delay="5000">
                <div class='carousel-container'>
                    @foreach($coaches as $coach)
                        @if($loop->first)
                            <div class='carousel-item is-active'>
                        @else
                            <div class='carousel-item'>
                        @endif
                            <figure class="image is-square"><img class="is-grayscale" src="{{ URL::asset('storage/'. $coach->picture_crop) }}" style="border-radius: 8px;"></figure>
                            <div class="content has-text-centered m-t-20">
                                <h2 class="has-text-weight-bold">{{ $coach->name }}</h2>
                                <p>{{ $coach->biography }}</p>
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

    {{--FIND A COACH--}}

    <section class="hero is-narrow is-marleq">
        <div class="hero-body">
            <div class="container has-text-centered">
                <h1 class="title m-b-40 has-text-weight-light">
                    FIND AND BOOK RIGHT CAREER COACH, AND BUILD A SUCCESSFUL CAREER
                </h1>
                <h2 class="subtitle">
                    Our experienced and skilled career coaches and professionals can help you to improve your job search, CV, LinkedIn, and cover letter. <br />
                    They will prepare you for your next job interview, negotiation round, and answer all your career related questions. We are all here to help you land a dream job.
                </h2>
                <button class="button is-marleq is-medium is-inverted is-rounded"
                        @click="isVideoModalActive = true">
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
            <div class="content has-text-centered">
                <h1>MARLEQ Inspiration</h1>
            </div>
            <div class="columns is-narrow m-t-40">
                <div class="column">
                    <div class="card is-shadowless">
                        <div class="card-image">
                            <figure class="image is-4by3">
                                <img src="https://cdn.comatch.com/wp-content/uploads/2018/02/hands-people-woman-working-680x460.jpg" alt="">
                            </figure>
                        </div>
                        <div class="card-content">
                            <div class="content">
                                <p class="title is-4">Using Design Thinking to develop the products and services that clients really want</p>
                                <p>Customer demands can require innovative solutions. This is done through creative trial and error and quick assumption review using a…</p>
                                <a href="#">
                                    <span>Read more</span>
                                    <span class="icon">
                                        <i class="fa fa-angle-double-right"></i>
                                    </span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="column">
                    <div class="card is-shadowless">
                        <div class="card-image">
                            <figure class="image is-4by3">
                                <img src="https://cdn.comatch.com/wp-content/uploads/2018/02/hands-people-woman-working-680x460.jpg" alt="">
                            </figure>
                        </div>
                        <div class="card-content">
                            <div class="content">
                                <p class="title is-4">Using Design Thinking to develop the products and services that clients really want</p>
                                <p>Customer demands can require innovative solutions. This is done through creative trial and error and quick assumption review using a…</p>
                                <a href="#">
                                    <span>Read more</span>
                                    <span class="icon">
                                        <i class="fa fa-angle-double-right"></i>
                                    </span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="column">
                    <div class="card is-shadowless">
                        <div class="card-image">
                            <figure class="image is-4by3">
                                <img src="https://cdn.comatch.com/wp-content/uploads/2018/01/iStock-586694292-680x460.jpg" alt="">
                            </figure>
                        </div>
                        <div class="card-content">
                            <div class="content">
                                <p class="title is-4">Component identification for 3D printing – make or buy?</p>
                                <p>A food company wanted to reduce its maintenance costs for beverage bottlers by introducing additively manufactured replacement parts and fittings.…</p>
                                <a href="#">
                                    <span>Read more</span>
                                    <span class="icon">
                                        <i class="fa fa-angle-double-right"></i>
                                    </span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{--SOCIAL NETWORKS--}}

    <section class="hero is-narrow is-light">
        <div class="hero-body">
            <div class="container">
                <div class="content has-text-centered">
                    <h1>Follow us on:</h1>
                </div>
                <div class="columns has-text-centered">
                    <div class="column">
                        Facebook
                    </div>
                    <div class="column">
                        LinkedIn
                    </div>
                    <div class="column">
                        Instagram
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{--MODAL OVERVIEW VIDEO--}}

    <template>
        <section>
            <b-modal :active.sync="isVideoModalActive">
                <iframe src="https://player.vimeo.com/video/18222554?autoplay=1&title=0&byline=0&portrait=0"
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