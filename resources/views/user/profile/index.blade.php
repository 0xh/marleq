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
                    @if($user->picture_crop)
                        <div class="column is-narrow">
                            <img src="{{ URL::asset($user->picture_crop) }}" alt="" class="is-grayscale m-b-10" style="overflow: hidden; width: 70px; border-radius: 15px;">
                        </div>
                    @endif
                    <div class="column">
                        <h1 class="title">
                            {{ $user->name }} {{ $user->surname }}
                        </h1>
                        @if(Auth::user()->hasRole('coach|country-manager'))
                            <h2 class="subtitle">
                                @if($user->level) {{ $user->level->name }} @endif @if(Auth::user()->hasRole('country-manager')) @if($user->level) & @endif Country Manager @endif from {{ $user->country }}
                            </h2>
                        @endif
                        @if(Auth::user()->hasRole('user'))
                            <h2 class="subtitle">
                                Job Seeker from {{ $user->country }}
                            </h2>
                        @endif
                    </div>
                    <div class="column has-text-right-desktop has-text-centered-mobile is-narrow">
                        <a href="{{route('profile.edit', $user->alias)}}" class="button is-marleq is-inverted">
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
            <nav class="tabs is-boxed">
                <div class="container">
                    <ul>
                        <li class="is-active"><a href="{{ route('user') }}">Overview</a></li>
                        <li><a href="{{ route('testimonial.index') }}">Testimonials</a></li>
                        @if(Auth::user()->hasRole('coach|country-manager') and Auth::user()->status == 1)
                            <li><a href="{{ route('cv-requests.index') }}">Free CV Requests</a></li>
                        @endif
                    </ul>
                </div>
            </nav>
        </div>
    </section>

    <section class="section">
        <div class="container">
            <div class="columns is-multiline">
                @if((Auth::user()->hasRole('coach|country-manager') and $user->profile_completion < 6) or (Auth::user()->hasRole('user') and $user->profile_completion < 4))
                    <div class="column is-full m-b-40">
                        <ul class="steps is-narrow is-medium is-centered has-content-centered">
                            <li class="steps-segment @if($user->profile_completion == 0) is-active has-gaps @endif">
                                <a hef=#" class="has-text-dark">
                                  <span class="steps-marker">
                                    <span class="icon">
                                      <i class="fa fa-user"></i>
                                    </span>
                                  </span>
                                    <div class="steps-content">
                                        <p class="heading">User Account</p>
                                    </div>
                                </a>
                            </li>
                            <li class="steps-segment @if($user->profile_completion == 1) is-active has-gaps @elseif($user->profile_completion < 1) has-gaps @endif">
                                <a hef=#" class="has-text-dark">
                                  <span class="steps-marker @if($user->profile_completion == 0) is-warning @endif">
                                    <span class="icon">
                                      <i class="fa fa-pencil-square"></i>
                                    </span>
                                  </span>
                                    <div class="steps-content">
                                        <p class="heading">Short biography</p>
                                    </div>
                                </a>
                            </li>
                            <li class="steps-segment @if($user->profile_completion == 2) is-active has-gaps @elseif($user->profile_completion < 2) has-gaps @endif">
                                <a hef=#" class="has-text-dark">
                                  <span class="steps-marker @if($user->profile_completion == 1) is-warning @endif">
                                    <span class="icon">
                                      <i class="fa fa-globe"></i>
                                    </span>
                                  </span>
                                    <div class="steps-content">
                                        <p class="heading">Countries</p>
                                    </div>
                                </a>
                            </li>
                            <li class="steps-segment @if($user->profile_completion == 3) is-active has-gaps @elseif($user->profile_completion < 3) has-gaps @endif">
                                <a hef=#" class="has-text-dark">
                                  <span class="steps-marker @if($user->profile_completion == 2) is-warning @endif">
                                    <span class="icon">
                                      <i class="fa fa-language"></i>
                                    </span>
                                  </span>
                                    <div class="steps-content">
                                        <p class="heading">Languages</p>
                                    </div>
                                </a>
                            </li>
                            <li class="steps-segment @if($user->profile_completion == 4) is-active has-gaps @elseif($user->profile_completion < 4) has-gaps @endif">
                                <a hef=#" class="has-text-dark">
                                  <span class="steps-marker @if($user->profile_completion == 3) is-warning @endif">
                                    <span class="icon">
                                      <i class="fa fa-file-text"></i>
                                    </span>
                                  </span>
                                    <div class="steps-content">
                                        <p class="heading">CV or Resume</p>
                                    </div>
                                </a>
                            </li>
                            @if(Auth::user()->hasRole('coach|country-manager'))
                                <li class="steps-segment @if($user->profile_completion == 5) is-active has-gaps @elseif($user->profile_completion < 5) has-gaps @endif">
                                    <a href="#" class="has-text-dark">
                                      <span class="steps-marker @if($user->profile_completion == 4) is-warning @endif">
                                        <span class="icon">
                                          <i class="fa fa-user-circle-o"></i>
                                        </span>
                                      </span>
                                        <div class="steps-content">
                                            <p class="heading">Coach Information</p>
                                        </div>
                                    </a>
                                </li>
                                <li class="steps-segment">
                                    <span class="steps-marker is-hollow @if($user->status == 1) is-marleq @endif">
                                      <span class="icon">
                                        <i class="fa fa-check"></i>
                                      </span>
                                    </span>
                                    <div class="steps-content">
                                        <p class="heading">Admin Confirmation</p>
                                    </div>
                                </li>
                            @endif
                            @if(Auth::user()->hasRole('user'))
                                <li class="steps-segment">
                                    <span class="steps-marker is-hollow">
                                      <span class="icon">
                                        <i class="fa fa-check"></i>
                                      </span>
                                    </span>
                                    <div class="steps-content">
                                        <p class="heading">Completed</p>
                                    </div>
                                </li>
                            @endif
                        </ul>
                    </div>
                @endif
                <div class="column is-half">
                    <div class="columns is-multiline">
                        @if(Auth::user()->hasRole('coach|country-manager'))
                            @if(!$user->social_network)
                                <article class="column is-full message is-warning">
                                    <div class="message-body">
                                        Please fill in your social network field, it will help us verify your account.
                                    </div>
                                </article>
                            @endif
                        @endif

                        @if($user->biography)
                            <div class="column is-full">
                                <h3 class="subtitle">Short biography:</h3>
                                {!! $user->biography !!}
                            </div>
                        @endif

                        @if($user->document)
                            <div class="column is-full">
                                <a href="{{ URL::asset($user->document) }}" target="_blank">
                                    <span class="icon">
                                        <i class="fa fa-file"></i>
                                    </span>
                                    <span>View CV</span>
                                    <span class="icon">
                                        <i class="fa fa-angle-double-right"></i>
                                    </span>
                                </a>
                            </div>
                        @endif
                        @if($user->certification)
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
                        @endif
                        @if(count($user->languages) > 0)
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
                        @endif
                    </div>
                </div>

                <div class="column is-half">
                    <div class="columns is-multiline">
                        @if(count($user->countries) > 0)
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
                        @endif
                        @if(Auth::user()->hasRole('coach|country-manager'))
                            @if(count($user->specialties) > 0)
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
                            @endif
                            @if(count($user->services) > 0)
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
                            @endif
                        @endif
                    </div>
                </div>
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