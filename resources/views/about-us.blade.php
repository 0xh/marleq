@extends('layouts/app')

@section('content')
    <section class="hero hero-has-background is-marleq is-narrow">
        <div class="hero-body">
            <div class="columns is-centered">
                <div class="column is-two-thirds has-text-centered">
                    <h1 class="title m-b-50">
                        WE ARE TEAM OF PROFESSIONALS FULLY DEDICATED<br/>
                        TO YOUR CAREER PROGRESS
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
            <div class="columns is-centered is-mobile">
                @foreach($team as $member)
                    <div class="column is-full-mobile is-one-third-tablet is-one-third-desktop has-text-centered">
                        <div class="card is-shadowless">
                            <div class="card-image p-l-50 p-r-50 p-t-50">
                                <img src="{{ URL::asset($member->picture_crop) }}" alt="" class="is-grayscale is-square" style="border-radius: 8px;">
                            </div>
                            <div class="card-content">
                                <div class="content">
                                    <p class="title is-4 m-b-10">{{ $member->name }}</p>
                                    {!! $member->biography !!}
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="hero is-light is-narrow">
        <div class="hero-body">
            <div class="columns is-centered p-b-30">
                <div class="column is-two-thirds has-text-centered">
                    <h1 class="homepage-mod-h2 m-b-50">
                        WORK WITH US
                    </h1>
                    <h2 class="subtitle">
                        We are always seeking for outstanding candidates. If you like what we do, share same values,
                        and have ideas of how to grow our impact, let us know. We have several cooperation opportunities.<br />
                    </h2>
                    <h2 class="subtitle">
                        Join our fast growing team and send your email (CV) to info@marleq.com.
                    </h2>
                </div>
            </div>
        </div>
    </section>

@endsection