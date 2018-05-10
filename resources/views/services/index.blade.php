@extends('layouts/app')

@section('content')
    <section class="hero hero-has-background is-marleq is-narrow">
        <div class="hero-body">
            <div class="columns is-centered">
                <div class="column is-two-thirds has-text-centered">
                        <h1 class="title m-b-50">
                            SERVICES
                        </h1>
                        <h2 class="subtitle">
                            Our purpose is to help job seekers land their dream job. We truly believe this is possible.
                            We strive to inspire and motivate each of you by sharing outstanding career stories and advices.
                        </h2>
                </div>
            </div>
        </div>
    </section>

    <section class="section">
        <div class="container hero-services">
            <div class="columns is-multiline is-variable bd-klmn-columns is-7 is-narrow has-text-centered m-b-30">
                @foreach($featuredServices as $service)
                    <div class="column is-3 is-one-quarter has-text-centered">
                        <div class="media service-box">
                            <div class="media-left">
                                <img src="{{ URL::asset($service->image) }}" class="m-l-10" style="min-width:100px;">
                            </div>
                            <div class="media-content">
                                <a href="{{ route('service-show', $service->id) }}"><h2 class="homepage-mod-h2 p-r-20">{{ $service->name }}</h2></a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="has-text-centered">
                <div class="columns is-multiline is-narrow m-t-20">
                    @foreach($services as $service)
                        <div class="column is-one-quarter">
                            <div>
                                @if($service->image)
                                    <img src="{{ URL::asset($service->image) }}" style="width:120px;">
                                @endif
                                <a href="{{ route('service-show', $service->id) }}"><h3 class="m-t-20 homepage-mod-h3">{{ $service->name }}</h3></a>
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