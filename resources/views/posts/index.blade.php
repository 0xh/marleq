@extends('layouts/app')

@section('content')
    <section class="hero is-marleq is-narrow">
        <div class="hero-body">
            <div class="columns is-centered">
                <div class="column is-two-thirds has-text-centered">
                    <h1 class="title m-b-50 has-text-weight-light">
                        <small>WE ARE TEAM OF PROFESSIONALS FULLY DEDICATED TO YOUR CAREER PROGRESS</small>
                    </h1>
                    <h2 class="subtitle">
                        We aim to bring closer job seekers to career coaches. Our goal is that job seekers find and
                        book right career coach, gain new knowledge and skills, and achieve desirable career.<br />
                        Among the 4 experienced co-founders, we have a common goal to help job seekers land their dream job.
                    </h2>
                </div>
            </div>
        </div>
    </section>

    <section class="section">
        <div class="container">
            <div class="columns is-centered is-mobile is-multiline">
                @foreach($inspiration->posts as $post)
                    <div class="column is-full-mobile is-one-third-tablet is-one-third-desktop">
                        <div class="card is-shadowless">
                            <div class="card-image">
                                <figure class="image is-4by3">
                                    <img src="{{ URL::asset($post->intro_image) }}" alt="">
                                </figure>
                            </div>
                            <div class="card-content">
                                <div class="content">
                                    <p class="title is-4">{{ $post->title }}</p>
                                    {!! $post->content !!}
                                    <p>
                                        <a href="{{ route('inspiration-show', $post->alias) }}">
                                            <span>Read more</span>
                                            <span class="icon">
                                                <i class="fa fa-angle-double-right"></i>
                                            </span>
                                        </a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

@endsection