@extends('layouts.app')

@section('content')
    <section class="hero hero-has-background is-info is-narrow">
        <div class="hero-body">
            <div class="columns is-centered">
                <div class="column is-two-thirds has-text-centered">
                    <h1 class="title">
                        <small>Forgot your password?</small>
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

                    <form method="POST" action="{{ route('password.email') }}">
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

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="button is-marleq">
                                    Send Password Reset Link
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection

