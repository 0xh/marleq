@extends('layouts.app')

@section('content')
<section class="hero is-info is-narrow">
    <div class="hero-body">
        <div class="columns is-centered">
            <div class="column is-two-thirds has-text-centered">
                <h1 class="title m-b-50 has-text-weight-light">
                    <small>SIMPLE AND EASY WAY TO REACH JOB SEEKERS FROM ALL OVER THE WORLD, AND MENTOR THEIR CAREER SUCCESS</small>
                </h1>
                <h2 class="subtitle">
                    Are you looking to expand your clients list? We are team of professionals fully dedicated to bring closer job seekers to career coaches.
                    Earn more money with a new revenue stream, and have a global reach with more international clients.
                </h2>
            </div>
        </div>
    </div>
</section>
<section class="section">
    <div class="container">
        <div class="columns is-centered is-mobile">
            <div class="column is-full-mobile is-half-tablet is-one-third-desktop">
                <h1 class="title"><small>Sign in</small></h1>
                <form method="POST" action="{{ route('login') }}">

                    @csrf

                    <div class="field">
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
                        <p class="control">
                            <label class="checkbox">
                                <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> <small>Remember Me</small>
                            </label>
                        </p>
                    </div>

                    <div class="field">
                        <p class="control">
                            <button type="submit" class="button is-primary">
                                Sign in
                            </button>
                            <a class="button is-text" href="{{ route('password.request') }}" style="text-decoration: inherit;">
                                <small>Forgot Your Password?</small>
                            </a>
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
