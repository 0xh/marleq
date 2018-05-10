@extends('layouts.app')

@section('content')
<section class="hero hero-has-background is-info is-narrow">
    <div class="hero-body">
        <div class="columns is-centered">
            <div class="column is-two-thirds has-text-centered">
                <h1 class="title m-b-50">
                    SIMPLE AND EASY WAY TO REACH JOB SEEKERS<br/> FROM ALL OVER THE WORLD
                    AND MENTOR THEIR CAREER SUCCESS
                </h1>
                <h2 class="subtitle">
                    Are you looking to expand your clients list?<br/>
                    We are team of professionals fully dedicated to bring closer job seekers to career coaches.<br/>
                    Earn more money with a new revenue stream and have a global reach with more international clients.
                </h2>
            </div>
        </div>
    </div>
</section>
<section class="section">
    <div class="container">
        <div class="columns is-centered is-mobile m-t-20 m-b-50">
            <div class="column is-full-mobile is-half-tablet is-one-third-desktop">
                <form method="POST" action="{{ route('register') }}">

                    @csrf

                    <div class="field">
                        <label class="label"><small>Name:</small></label>
                        <div class="control has-icons-left has-icons-right">
                            <input id="name" type="text" class="input{{ $errors->has('name') ? ' is-danger' : '' }}" name="name" value="{{ old('name') }}" placeholder="Name input" required autofocus>
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

                    <div class="field">
                        <label class="label"><small>Email:</small></label>
                        <div class="control has-icons-left has-icons-right">
                            <input id="email" type="email" class="input{{ $errors->has('email') ? ' is-danger' : '' }}" name="email" value="{{ old('email') }}" placeholder="Email input" required autofocus>
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

                    <div class="field">
                        <label class="label"><small>Password:</small></label>
                        <p class="control has-icons-left">
                            <input id="password" type="password" class="input{{ $errors->has('password') ? ' is-danger' : '' }}" name="password" placeholder="Password" required>
                            <span class="icon is-small is-left">
                                <i class="fa fa-lock"></i>
                            </span>
                        </p>
                        @if ($errors->has('password'))
                            <p class="help is-danger">
                                <strong>{{ $errors->first('password') }}</strong>
                            </p>
                        @endif
                    </div>

                    <div class="field">
                        <label class="label"><small>Confirm Password:</small></label>
                        <p class="control has-icons-left">
                            <input id="password-confirm" type="password" class="input" name="password_confirmation" placeholder="Confirm Password" required>
                            <span class="icon is-small is-left">
                                <i class="fa fa-lock"></i>
                            </span>
                        </p>
                    </div>

                    <div class="field m-t-30">
                        <p class="control">
                            <button type="submit" class="button is-marleq">
                                Register
                            </button>
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
