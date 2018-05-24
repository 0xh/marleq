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
                        Our career coaches will help you overcome all career related challenges.<br/>
                        Reaching your career goals is easier with right expert guidance and support.
                    </h2>
                </div>
            </div>
        </div>
    </section>

    <section class="section">
        <div class="container">
            <div class="columns is-centered is-multiline">
                @foreach($coaches as $coach)
                    <div class="column is-half">
                        <div class="box" style="border-radius: 15px;">
                            <div class="columns has-text-centered-mobile">
                                @if($coach->picture_crop)
                                    <div class="column is-narrow">
                                        <a href="{{ route('coach-show', $coach->alias) }}">
                                            <img src="{{ URL::asset($coach->picture_crop) }}" alt="" class="is-grayscale m-b-10" style="overflow: hidden; width: 220px; border-radius: 15px;">
                                        </a>
                                    </div>
                                @endif
                                <div class="column">
                                    <a href="{{ route('coach-show', $coach->alias) }}">
                                        <h1 class="title has-text-weight-bold has-text-marleq">
                                            <small>{{ $coach->name }} {{ $coach->surname }}</small>
                                        </h1>
                                    </a>
                                    @if($coach->hasRole('coach|country-manager'))
                                        <h2 class="subtitle m-b-10">
                                            <small>@if($coach->level) {{ $coach->level->name }} @endif from {{ $coach->country }}</small>
                                        </h2>
                                    @endif
                                    <div class="has-text-left-desktop has-text-centered-mobile has-text-grey">
                                        <small>{!! $coach->biography !!}</small>
                                    </div>
                                    <div class="tags m-t-20">
                                        @foreach($coach->countries as $country)
                                            <span class="tag is-small is-marleq">{{ $country->name }}</span>
                                        @endforeach
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