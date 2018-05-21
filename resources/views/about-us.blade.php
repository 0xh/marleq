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
                        ﻿We are here to help you land a dream job and build a successful career at home or abroad. We will
                        inspire you with successful stories and interviews with outstanding people, organize career related events,
                        give you career guidance and tips, and connect you with your career coach who will mentor your career success.<br/>
                        Our mission is to assist you achieve a desirable career progress. Reaching your career goals is faster and easier with right expert guidance and support.<br/>
                        We think you should love what you do. Our career coach will help you set specific goals, improve your performance, and move forward with a career you dream about<br/>
                    </h2>
                </div>
            </div>
        </div>
    </section>

    <section class="section">
        <div class="container">
            <div class="columns is-centered">
                @foreach($team as $member)
                    <div class="column is-full-mobile is-one-quarter-tablet is-one-quarter-desktop has-text-centered">
                        <div class="card is-shadowless">
                            <div class="card-image p-l-20 p-r-20 p-t-50">
                                <img src="{{ URL::asset($member->picture_crop) }}" alt="" class="is-grayscale is-square" style="border-radius: 15px;">
                            </div>
                            <div class="card-content">
                                <div class="content">
                                    <p class="homepage-mod-h3 is-4 m-b-10">{{ $member->name }} {{ $member->surname }}</p>
                                    <p>{{ $member->title }}</p>
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