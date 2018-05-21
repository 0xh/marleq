@extends('layouts/app')

@section('content')
    <section class="hero hero-has-background is-marleq is-narrow">
        <div class="hero-body">
            <div class="columns is-centered">
                <div class="column is-two-thirds has-text-centered">
                    <h1 class="title m-b-50">
                        FIND AND BOOK YOUR CAREER COACH<br/>
                        AND ACHIEVE A DESIRABLE CAREER PROGRESS
                    </h1>
                    <h2 class="subtitle">
                        Our career experts will help you overcome all career related challenges.<br/>
                        We are all here to help you land a dream job.
                    </h2>
                </div>
            </div>
        </div>
    </section>

    <section class="section">
        <div class="container">
            <div class="columns is-centered is-mobile is-multiline">
                @foreach($coaches as $coach)
                    <div class="column is-one-third">
                        <div class="card is-shadowless">
                            @if($coach->picture_crop)
                                <div class="card-image has-text-centered">
                                    <img class="is-grayscale" src="{{ URL::asset($coach->picture_crop) }}" alt="" style="border-radius: 15px; width: 244px;">
                                </div>
                            @endif
                            <div class="card-content card-coach has-text-centered">
                                <div>
                                    <a href="{{ route('coach-show', $coach->alias) }}">
                                        <h3 class="homepage-mod-h3">{{ $coach->name }} {{ $coach->surname }}</h3>
                                    </a>
                                    <div class="m-b-15 has-text-centered">
                                        {!! $coach->biography !!}
                                    </div>
                                    <div>
                                        <a href="{{ route('coach-show', $coach->alias) }}" class=" button is-marleq has-text-weight-bold">
                                            <span>View Info</span>
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

@endsection