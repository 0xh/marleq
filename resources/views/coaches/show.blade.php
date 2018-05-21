@extends('layouts/app')

@section('content')
    <section class="hero hero-has-background is-marleq is-narrow">
        <div class="hero-body">
            <div class="columns is-centered">
                <div class="column is-two-thirds has-text-centered">
                    <img src="{{ URL::asset($coach->picture_crop) }}" alt="" class="is-grayscale m-b-10" style="overflow: hidden; width: 120px; border-radius: 15px;">
                    <p>@if($coach->level) {{ $coach->level->name }} @endif</p>
                    <h1 class="title m-b-10">
                        {{ $coach->name }} {{ $coach->surname }}
                    </h1>
                    <p class="p-b-5">Countries:</p>
                    @foreach($coach->countries as $country)
                         <span class="tag is-white has-text-blue">{{ $country->name }}</span>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <section class="section">
        <div class="container">
            <article class="media">
                <figure class="media-left m-l-5">

                </figure>
                <div>
                    <div class="has-text-centered">
                        {!! $coach->biography !!}
                    </div>

                    <div class="columns p-t-40 p-b-40">
                        <div class="column">
                            <h3 class="subtitle">Specialties:</h3>
                            <div class="tags">
                                @foreach($coach->specialties as $specialty)
                                    <span class="tag is-medium is-marleq">{{ $specialty->name }}</span>
                                @endforeach
                            </div>
                        </div>
                        <div class="column">
                            <h3 class="subtitle">Services:</h3>
                            <div class="tags">
                                @foreach($coach->services as $service)
                                    <span class="tag is-medium is-marleq">{{ $service->name }}</span>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </article>
        </div>
    </section>

@endsection