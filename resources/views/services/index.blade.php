@extends('layouts/app')

@section('content')
    <section class="hero hero-has-background is-marleq is-narrow">
        <div class="hero-body">
            <div class="columns is-centered">
                <div class="column is-two-thirds has-text-centered">
                        <h1 class="title m-b-50">
                            EXPLORE OUR CAREER COACHING SERVICES<br/>
                            AND BOOST YOUR CAREER
                        </h1>
                        <h2 class="subtitle">
                            Select the best fit career coaching service in order to handle your current career challenge.<br/>
                            Find and book the right career coach, gain new knowledge and skills, and achieve a desirable career.

                        </h2>
                </div>
            </div>
        </div>
    </section>

    <section class="section">
        <div class="container hero-services">
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
            </div>
        </div>
    </section>

@endsection