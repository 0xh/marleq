@extends('layouts.app')

@section('content')
    <section class="hero hero-has-background is-info is-narrow">
        <div class="hero-body">
            <div class="columns is-centered">
                <div class="column is-two-thirds has-text-centered">
                    <h1 class="title">
                        <small>Reset your password</small>
                    </h1>
                </div>
            </div>
        </div>
    </section>
    <section class="section">
        <div class="container">
            <div class="columns is-centered is-mobile m-t-20 m-b-50">
                <div class="column is-full-mobile is-half-tablet is-one-third-desktop">
                    @if (session('status'))
                        <div class="notification is-success">
                            {{ session('status') }}
                        </div>
                    @endif

                        <form method="POST" action="{{ route('password.request') }}">
                            @csrf

                            <input type="hidden" name="token" value="{{ $token }}">

                            <div class="field">
                                <label class="label"><small>Email:</small></label>
                                <div class="control has-icons-left has-icons-right">
                                    <input id="email" type="email" class="input{{ $errors->has('email') ? ' is-danger' : '' }}" name="email" value="{{ $email or old('email') }}" placeholder="Email input" required autofocus>
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
                                <label class="label"><small>Password Confirmation:</small></label>
                                <p class="control has-icons-left">
                                    <input id="password-confirm" type="password" class="input{{ $errors->has('password_confirmation') ? ' is-danger' : '' }}" name="password_confirmation" placeholder="Password Confirmation" required>
                                    <span class="icon is-small is-left">
                                <i class="fa fa-lock"></i>
                            </span>
                                </p>
                                @if ($errors->has('password_confirmation'))
                                    <p class="help is-danger">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </p>
                                @endif
                            </div>

                            <div class="field">
                                <div class="control">
                                    <button type="submit" class="button is-marleq">
                                        Reset Password
                                    </button>
                                </div>
                            </div>
                        </form>
                </div>
            </div>
        </div>
    </section>
@endsection