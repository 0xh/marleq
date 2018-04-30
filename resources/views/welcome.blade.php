@extends('layouts/app')

@section('content')

    {{--MARLEQ INTRO--}}

    <section class="hero is-marleq is-medium">
        <div class="hero-body">
            <div class="columns is-centered">
                <div class="column is-three-quarters has-text-centered">
                    <h1 class="title m-b-50 has-text-weight-light">
                        FIND AND BOOK YOUR CAREER COACH, AND BUILD LOCAL OR INTERNATIONAL CAREER FASTER AND EASIER
                    </h1>
                    <h2 class="subtitle">
                        Are you facing a career challenge? You have come to the right place. We are team of professionals fully dedicated to your career progress.
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
                    Upload your CV, and our experienced career coach will quickly review your CV. <br />You will receive useful tips which parts of your CV to improve, free of charge.
                </h2>
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
                    <div class="column is-one-quarter">
                        <span>CV Review</span>
                    </div>
                    <div class="column is-one-quarter">
                        <span>LinkedIn Review</span>
                    </div>
                    <div class="column is-one-quarter">
                        <span>Cover Letter Review</span>
                    </div>
                    <div class="column is-one-quarter">
                        <span>New Job Search Strategy</span>
                    </div>
                </div>
                <div class="has-text-centered">
                    <b-collapse :open="false">
                        <div class="columns is-multiline is-narrow m-t-20">
                            <div class="column is-one-quarter">
                                <span>Interview Coaching</span>
                            </div>
                            <div class="column is-one-quarter">
                                <span>Negotiation Coaching</span>
                            </div>
                            <div class="column is-one-quarter">
                                <span>Leadership Coaching</span>
                            </div>
                            <div class="column is-one-quarter">
                                <span>Networking Coaching</span>
                            </div>
                            <div class="column is-one-quarter">
                                <span>New Position Coaching</span>
                            </div>
                            <div class="column is-one-quarter">
                                <span>HRM Coaching</span>
                            </div>
                            <div class="column is-one-quarter">
                                <span>Grow in my current role</span>
                            </div>
                            <div class="column is-one-quarter">
                                <span>Explore future career options</span>
                            </div>
                            <div class="column is-one-quarter">
                                <span>Return to work after an absence</span>
                            </div>
                            <div class="column is-one-quarter">
                                <span>Career Q&A</span>
                            </div>
                        </div>
                        <a class="button is-text" slot="trigger" style="text-decoration: inherit; color: #209cee;">
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
            <div class='carousel is-3 carousel-animated carousel-animate-slide' data-autoplay="true" data-delay="4000">
                <div class='carousel-container'>
                    <div class='carousel-item is-active'>
                        <figure class="image is-square"><img class="is-circle" src="http://marleq.com/wp-content/uploads/2018/03/igor-maric.jpg"></figure>
                        <div class="content has-text-centered m-t-20">
                            <h2 class="has-text-weight-bold">Igor</h2>
                            <p>12+ years of experience in design, and still getting inspired by the world and innovation.</p>
                            <p>Born, raised and educated as a designer, and (co)founded several design-related firms.</p>
                            <p>MSc in Digital Media Design in Germany</p>
                        </div>
                    </div>
                    <div class='carousel-item'>
                        <figure class="image is-square is-rounded"><img class="is-rounded" src="http://marleq.com/wp-content/uploads/2018/03/milo-radulovic.jpg"></figure>
                        <div class="content has-text-centered m-t-20">
                            <h2 class="has-text-weight-bold">Milo</h2>
                            <p>10+ years of experience in 15 organisations: from startups, consulting firms to NPO/NGO</p>
                            <p>Professional accomplishments: Montenegro, Lithuania, Slovenia and Sweden</p>
                            <p>MSc in Business Administration (Sweden)</p>
                        </div>
                    </div>
                    <div class='carousel-item'>
                        <figure class="image is-square"><img class="is-circle" src="https://cdn.comatch.com/wp-content/uploads/2017/04/Pascale-289x289.jpg"></figure>
                        <div class="content has-text-centered m-t-20">
                            <h2 class="has-text-weight-bold">Pascale</h2>
                            <p>Commercial due diligence for PE comapnies and strategy projects</p>
                            <p>6 years at Bain & Company</p>
                            <p>Business Administration, University of St. Gallen and HEC Paris and an MBA from Columbia Business School</p>
                        </div>
                    </div>
                    <div class='carousel-item'>
                        <figure class="image is-square"><img class="is-circle" src="http://marleq.com/wp-content/uploads/2018/03/jovana-minic.jpg"></figure>
                        <div class="content has-text-centered m-t-20">
                            <h2 class="has-text-weight-bold">Jovana</h2>
                            <p>10+ years of experience in 15 organisations: from startups, consulting firms to NPO/NGO</p>
                            <p>Professional accomplishments: Montenegro, Lithuania, Slovenia and Sweden</p>
                            <p>MSc in Business Administration (Sweden)</p>
                        </div>
                    </div>
                    <div class='carousel-item'>
                        <figure class="image is-square"><img class="is-circle" src="http://marleq.com/wp-content/uploads/2018/03/tina-radojkovic.jpg"></figure>
                        <div class="content has-text-centered m-t-20">
                            <h2 class="has-text-weight-bold">Tina</h2>
                            <p>Commercial due diligence for PE comapnies and strategy projects</p>
                            <p>6 years at Bain & Company</p>
                            <p>Business Administration, University of St. Gallen and HEC Paris and an MBA from Columbia Business School</p>
                        </div>
                    </div>
                    <div class='carousel-item'>
                        <figure class="image is-square"><img class="is-circle" src="http://marleq.com/wp-content/uploads/2018/03/doruntine-jakupi.jpg"></figure>
                        <div class="content has-text-centered m-t-20">
                            <h2 class="has-text-weight-bold">Doruntine</h2>
                            <p>12+ years of experience in design, and still getting inspired by the world and innovation.</p>
                            <p>Born, raised and educated as a designer, and (co)founded several design-related firms.</p>
                            <p>MSc in Digital Media Design in Germany</p>
                        </div>
                    </div>
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