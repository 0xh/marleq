@extends('layouts/app')

@section('og-title', $coach->name . ' ' . $coach->surname)
@section('og-image', URL::asset($coach->picture_crop))
@section('og-description', strip_tags($coach->biography))

@section('content')
    <section class="hero hero-has-background is-marleq is-narrow">
        <!-- Hero head: will stick at the top -->
        <div class="hero-head">
            <div class="container">
                <nav class="level m-t-10">
                    <!-- Left side -->
                    <div class="level-left">

                    </div>
                    <!-- Right side -->
                    <div class="level-right">

                    </div>
                </nav>
            </div>
        </div>

        <!-- Hero content: will be in the middle -->
        <div class="hero-body">
            <div class="container has-text-left-desktop has-text-centered-mobile">
                <div class="columns">
                    @if($coach->picture_crop)
                        <div class="column is-narrow">
                            <img src="{{ URL::asset($coach->picture_crop) }}" alt="" class="is-grayscale m-b-10" style="overflow: hidden; width: 250px; border-radius: 15px;">
                        </div>
                    @endif
                    <div class="column">
                        <h1 class="title">
                            {{ $coach->name }} {{ $coach->surname }}
                        </h1>
                        @if($coach->hasRole('coach|country-manager'))
                            <h2 class="subtitle">
                                @if($coach->level) {{ $coach->level->name }} @endif
                                @if($coach->hasRole('country-manager')) @if($coach->level) & @endif Country Manager @endif from {{ $coach->country }}
                            </h2>
                        @endif
                        <div class="has-text-left-desktop has-text-centered-mobile">
                            {!! $coach->biography !!}
                        </div>
                        <div class="tags m-t-20">
                            @foreach($coach->countries as $country)
                                <span class="tag is-small is-white has-text-blue">{{ $country->name }}</span>
                            @endforeach
                        </div>
                    </div>
                    <div class="column has-text-right-desktop has-text-centered-mobile is-narrow">
                        <a href="{{ route('chat', $coach->alias) }}" class="button is-medium is-marleq is-inverted">
                            <span class="icon">
                                <i class="fa fa-envelope"></i>
                            </span>
                            <span>Send a Message</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

        <section class="section">
        <div class="container">
            <article class="media">
                <div>
                    <div class="columns p-t-40 p-b-40">
                        <div class="column">
                            @if(count($coach->specialties) > 0)
                                <h3 class="subtitle">Specialties:</h3>
                                <div class="tags">
                                    @foreach($coach->specialties as $specialty)
                                        <span class="tag is-medium is-marleq">{{ $specialty->name }}</span>
                                    @endforeach
                                </div>
                            @endif
                            @if($coach->certification)
                                <h3 class="subtitle">Certification:</h3>
                                <div class="tags">
                                    @foreach($certification as $certificate)
                                        <span class="tag is-medium is-marleq">{{ $certificate }}</span>
                                    @endforeach
                                </div>
                            @endif
                            @if(count($coach->languages) > 0)
                                <h3 class="subtitle">Languages:</h3>
                                <div class="tags">
                                    @foreach($coach->languages as $language)
                                        <span class="tag is-medium is-marleq">{{ $language->name }}</span>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                        <div class="column">
                            @foreach($costs as $cost)
                                <section>
                                    <b-collapse class="card collapse" @if($loop->index == 0) :open="true" @else :open="false" @endif >
                                        <div slot="trigger" slot-scope="props" class="card-header">
                                            <p class="card-header-title has-text-marleq">
                                                {{ $cost->service->name }}
                                            </p>
                                            <a class="card-header-icon">
                                                <span class="icon">
                                                    <i class="fa" :class="props.open ? 'fa-caret-up' : 'fa-caret-down'"></i>
                                                </span>
                                            </a>
                                        </div>
                                        <div class="card-content">
                                            <div class="content">
                                                <p class="has-text-weight-bold">What's included:</p>
                                                {!! $cost->description !!}
                                            </div>
                                        </div>
                                        <footer class="card-footer">

                                        </footer>
                                    </b-collapse>
                                </section>
                            @endforeach
                        </div>
                    </div>
                </div>
            </article>
        </div>
    </section>

@endsection

@section('scripts')
    <script>
        let app = new Vue({
            el: '#app',
            data: {},
            methods: {}
        })
    </script>
@endsection