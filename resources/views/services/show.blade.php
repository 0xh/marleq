@extends('layouts/app')

@section('content')
    <section class="hero hero-has-background is-marleq is-narrow">
        <div class="hero-body">
            <div class="columns is-centered">
                <div class="column is-two-thirds has-text-centered">
                    <h1 class="title m-b-50">
                        {{ $service->name }}
                    </h1>
                    <h2 class="subtitle">
                        {!! $service->description !!}
                    </h2>
                    <a class="is-marleq is-inverted is-rounded has-text-white subtitle" href="#">
                        <span>Book a Coach</span>
                        <span class="icon">
                            <i class="fa fa-angle-right"></i>
                        </span>
                    </a>
                    <p>
                        <small>Find a career coach that offers {{ $service->name }}</small>
                    </p>

                </div>
            </div>
        </div>
    </section>

    <section class="section">
        <div class="container hero-services m-t-40 m-b-40">
            <div class="pricing-table">
                <div class="columns is-centered">
                    @foreach($costs as $cost)
                        <div class="column is-one-third">
                            <div class="pricing-plan is-marleq @if($loop->index == 1) is-active is-success @endif">
                                <div class="plan-header">{{ $cost->level->name }}</div>
                                <div class="plan-price"><span class="plan-price-amount"><span class="plan-price-currency">&euro;</span>{{ $cost->price }}</span></div>
                                <div class="plan-items">
                                    {!! $cost->description !!}
                                </div>
                                <div class="plan-footer">
                                    <button class="button is-fullwidth">Choose a Coach</button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <section class="hero hero-service-coaches hero-has-background is-marleq is-narrow">
        <div class="hero-body">
            <div class="columns is-centered">
                <div class="column is-two-thirds has-text-centered">
                    <h1 class="title m-b-50">
                        Here are a few awesome career coaches who offer <br/><span>{{ $service->name }}</span> to get you started!
                    </h1>
                    <p class="m-t-35">
                        <a class="button is-marleq is-inverted is-rounded" href="#">
                            <span>See All {{ $service->name }} Coaches</span>
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </section>

    <section class="section">
        <div class="container">
            <div class="has-text-centered">
                <h1 class="homepage-mod-h2"></h1>
            </div>
            <div class="columns is-narrow m-t-40">
                @foreach($coaches as $coach)
                    <div class="column has-text-centered is-one-quarter">
                        <div class="card is-shadowless">
                            @if($coach->picture_crop)
                                <div class="card-image">
                                    <figure class="image is-square">
                                        <img class="is-grayscale" src="{{ URL::asset($coach->picture_crop) }}" style="border-radius: 15px;">
                                    </figure>
                                </div>
                            @endif
                            <div class="card-content card-coach p-l-0 p-r-0">
                                <div>
                                    <a href="{{ route('coach-show', $coach->id) }}">
                                        <h3 class="homepage-mod-h3">{{ $coach->name }}</h3>
                                    </a>
                                    <div class="m-b-15">
                                        {!! $coach->biography !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="section">
        <div class="container hero-services">
            <div class="has-text-centered">
                <h1 class="homepage-mod-h1">Services</h1>
            </div>
            <div class="columns is-multiline is-variable bd-klmn-columns is-7 is-narrow has-text-centered m-b-30">
                @foreach($featuredServices as $service)
                    <div class="column is-one-quarter">
                        <div>
                            @if($service->image)
                                <img src="{{ URL::asset($service->image) }}" style="width:70px;">
                            @endif
                            <a href="{{ route('service-show', $service->id) }}"><h3 class="m-t-20 service-h3">{{ $service->name }}</h3></a>
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
                                <a href="{{ route('service-show', $service->id) }}"><h3 class="m-t-20 service-h3">{{ $service->name }}</h3></a>
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