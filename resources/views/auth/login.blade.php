@extends('layouts.app')

@section('content')
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
                    </p>
                </div>

                {{--  <a class="button is-text" href="{{ route('password.request') }}">
                    <small>Forgot Your Password?</small>
                </a>  --}}
            </form>
        </div>
    </div>
</div>
@endsection
