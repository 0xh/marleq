@extends('layouts/app')

@section('content')
    <section class="hero hero-has-background is-marleq is-narrow">
        <div class="hero-body">
            <div class="columns is-centered">
                <div class="column is-two-thirds has-text-centered">
                    <h1 class="title m-b-50">
                        WE ARE TEAM OF PROFESSIONALS FULLY DEDICATED<br/>
                        TO MENTOR YOUR CAREER SUCCESS
                    </h1>
                    <h2 class="subtitle">
                        We think you should love what you do. We will help you to discover it, improve your performance, and move forward with a career you dream about.
                    </h2>
                </div>
            </div>
        </div>
    </section>

    <section class="section">
        <div class="container">
            <div class="has-text-centered">
                <h1 class="homepage-mod-h1 m-b-20 m-t-20">Founding Team</h1>
            </div>
            <div class="columns is-multiline is-centered">
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
            <div class="has-text-centered">
                <h1 class="homepage-mod-h1 m-b-20 m-t-100">Country Managers</h1>
            </div>
            <div class="columns is-multiline is-centered">
                @foreach($managers as $manager)
                    <div class="column is-full-mobile is-one-quarter-tablet is-one-fifth-desktop has-text-centered">
                        <div class="card is-shadowless">
                            <div class="card-image p-t-50">
                                <img src="{{ URL::asset($manager->picture_crop) }}" alt="" class="is-grayscale is-square" style="border-radius: 15px;">
                            </div>
                            <div class="card-content p-l-5 p-r-5">
                                <div class="content">
                                    <p class="homepage-mod-h3 is-4 m-b-10" style="font-size: 22px; line-height: 25px;">{{ $manager->name }} {{ $manager->surname }}</p>
                                    <p class="is-uppercase">{{ $manager->country }}</p>
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
                        JOIN OUR FAST GROWING TEAM
                    </h1>
                    <h2 class="subtitle">
                        We are looking for experienced HR/Recruitment/Career Coaching candidates, preferably with MBA in HR and/or Coach/HR certification.
                    </h2>
                    <h2 class="subtitle">
                        If you like what we do, share same values, and have ideas on how to grow our impact, let us know by sending a message to info@marleq.com.
                        We have several cooperation opportunities.
                    </h2>
                    <h2 class="subtitle">
                        Join our Team and become a Country Manager? <a class="has-text-marleq" href="{{ route('register-country-manager')}}" style="text-decoration: underline;">Register</a>
                    </h2>
                </div>
            </div>
        </div>
    </section>

@endsection