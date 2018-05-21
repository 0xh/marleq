@extends('layouts/app')

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
                    <div class="column is-narrow">
                        <img src="{{ URL::asset($user->picture_crop) }}" alt="" class="is-grayscale m-b-10" style="overflow: hidden; width: 70px; border-radius: 15px;">
                    </div>
                    <div class="column">
                        <h1 class="title">
                            {{ $user->name }} {{ $user->surname }}
                        </h1>
                        @if(Auth::user()->hasRole('coach|country-manager'))
                            <h2 class="subtitle">
                                {{ $user->level->name }} @if(Auth::user()->hasRole('country-manager')) & Country Manager @endif from {{ $user->country }}
                            </h2>
                        @endif
                        @if(Auth::user()->hasRole('user'))
                            <h2 class="subtitle">
                                Job Seeker from {{ $user->country }}
                            </h2>
                        @endif
                    </div>
                    <div class="column has-text-right-desktop has-text-centered-mobile is-narrow">
                        <a href="{{route('profile.edit', $user->alias)}}" class="button is-blue">
                            <span class="icon">
                                <i class="fa fa-edit"></i>
                            </span>
                            <span>Edit Profile</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Hero footer: will stick at the bottom -->
        <div class="hero-foot">
            <nav class="tabs is-boxed is-fullwidth">
                <div class="container">
                    <ul>
                        <li class="is-active"><a href="{{ route('user') }}">Overview</a></li>
                        <li><a>Reservations</a></li>
                        <li><a>Reviews</a></li>
                        <li><a>Testimonials</a></li>
                        <li><a>Billing</a></li>
                        <li><a>Settings</a></li>
                    </ul>
                </div>
            </nav>
        </div>
    </section>

    <section class="section">
        <div class="container">
            <div class="columns">
                <div class="column is-half">
                    <div class="columns is-multiline">
                        <div class="column is-full">
                            <h3 class="subtitle">Biography:</h3>
                            {!! $user->biography !!}
                        </div>
                        <div class="column is-two-thirds-desktop is-half-mobile">
                            <div class="content">
                                <h4 class="subtitle">Certification:</h4>
                                <ul>
                                    @foreach($certification as $certificate)
                                        <li>
                                            {{ $certificate }}
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <div class="column is-one-third-desktop is-half-mobile">
                            <div class="content">
                                <h4 class="subtitle">Languages:</h4>
                                <ul>
                                    @foreach($user->languages as $language)
                                        <li>
                                            {{ $language->name }}
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                @if(Auth::user()->hasRole('coach|country-manager'))
                    <div class="column is-half">
                        <div class="columns is-multiline">
                            <div class="column is-full">
                                <h3 class="subtitle">Countries:</h3>
                                <div class="tags">
                                    @foreach($user->countries as $country)
                                        <span class="tag is-marleq is-medium">
                                            {{ $country->name }}
                                        </span>
                                    @endforeach
                                </div>
                            </div>
                            <div class="column is-half">
                                <div class="content">
                                    <h4 class="subtitle">Specialties:</h4>
                                    <ul>
                                        @foreach($user->specialties as $specialty)
                                            <li>
                                                {{ $specialty->name }}
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                            <div class="column is-half">
                                <div class="content">
                                    <h4 class="subtitle">Services:</h4>
                                    <ul>
                                        @foreach($user->services as $service)
                                            <li>
                                                {{ $service->name }}
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
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