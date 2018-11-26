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
                        <li><a href="{{ route('user') }}">Overview</a></li>
                        <li><a href="{{ route('testimonial.index') }}">Testimonials</a></li>
                        @if(Auth::user()->hasRole('coach|country-manager') and Auth::user()->status == 1)
                            <li><a href="{{ route('cv-requests.index') }}">Free CV Requests</a></li>
                            <li class="is-active"><a href="{{ route('card.index') }}">Business Card</a></li>
                        @endif
                    </ul>
                </div>
            </nav>
        </div>
    </section>

    <section class="section">
        <div class="container">
            <div class="columns is-multiline">
                <div class="column is-half">
                    <form action="{{route('card.store')}}" method="post">

                        @csrf

                        <div class="field">
                            <label class="label"><span class="has-text-marleq">*</span>Name:</label>
                            <div class="control has-icons-left has-icons-right">
                                <input id="name" type="text" class="input{{ $errors->has('name') ? ' is-danger' : '' }}"
                                       name="name" value="{{ old('surname', $user->name . ' ' . $user->surname) }}" placeholder="Your name" required autofocus>
                                <span class="icon is-small is-left">
                                    <i class="fa fa-user"></i>
                                </span>
                                @if ($errors->has('name'))
                                    <span class="icon is-small is-right">
                                        <i class="fa fa-exclamation-triangle"></i>
                                    </span>
                                @endif
                            </div>
                            @if ($errors->has('name'))
                                <p class="help is-danger">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </p>
                            @endif
                        </div>

                        <div class="field m-t-30">
                            <label class="label"><span class="has-text-marleq">*</span>Phone number:</label>
                            <div class="control has-icons-left has-icons-right">
                                <input id="phone" type="text" class="input{{ $errors->has('phone') ? ' is-danger' : '' }}"
                                       name="phone" value="{{ old('phone') }}" placeholder="e.g. +382 69 123 456" required>
                                <span class="icon is-small is-left">
                                    <i class="fa fa-mobile-phone"></i>
                                </span>
                                @if ($errors->has('phone'))
                                    <span class="icon is-small is-right">
                                        <i class="fa fa-exclamation-triangle"></i>
                                    </span>
                                @endif
                            </div>
                            @if ($errors->has('phone'))
                                <p class="help is-danger">
                                    <strong>{{ $errors->first('phone') }}</strong>
                                </p>
                            @endif
                        </div>

                        <div class="field m-t-30">
                            <label class="label"><span class="has-text-marleq">*</span>Email:</label>
                            <div class="control has-icons-left has-icons-right">
                                <input id="email" type="email" class="input{{ $errors->has('email') ? ' is-danger' : '' }}"
                                       name="email" value="{{ old('surname', $user->email) }}" placeholder="e.g. your.name@marleq.com" required>
                                <span class="icon is-small is-left">
                                    <i class="fa fa-envelope"></i>
                                </span>
                                @if ($errors->has('email'))
                                    <span class="icon is-small is-right">
                                        <i class="fa fa-exclamation-triangle"></i>
                                    </span>
                                @endif
                            </div>
                            @if ($errors->has('email'))
                                <p class="help is-danger">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </p>
                            @endif
                        </div>

                        <input type="hidden" name="title" value="{{ $title }}">
                        <input type="hidden" name="countrymanager" value="{{ $countryManager }}">

                        <div class="field m-t-30">
                            <p class="control">
                                <button type="submit" class="button is-marleq">
                                    <span class="icon">
                                        <i class="fa fa-id-card"></i>
                                    </span>
                                    <span>Create Business Card</span>
                                </button>
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')

@endsection