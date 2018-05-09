@extends('layouts.app')

@section('content')
<section class="hero hero-has-background is-info is-narrow">
    <div class="hero-body">
        <div class="columns is-centered">
            <div class="column is-two-thirds has-text-centered">
                <h1 class="title m-b-50">
                    <small>LOGIN</small>
                </h1>
                <h2 class="subtitle">

                </h2>
                <h2 class="subtitle">
                    No profile yet? Go to <a class="" href="{{ route('register')}}" style="text-decoration: underline;">Registration</a>.
                </h2>
            </div>
        </div>
    </div>
</section>
<section class="section">
    <div class="container">
        <div class="columns is-centered is-mobile m-t-20 m-b-50">
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
                            <button type="submit" class="button is-marleq">
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
