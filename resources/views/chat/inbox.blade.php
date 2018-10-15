@extends('layouts/app')

@section('content')

    <section class="hero hero-has-background is-info is-narrow">
        <div class="hero-body">
            <div class="columns is-centered">
                <div class="column is-two-thirds has-text-centered">
                    <h1 class="title">
                        <small>INBOX</small>
                    </h1>
                </div>
            </div>
        </div>
    </section>

    <section class="section">
        <div class="container">
            <div class="columns is-centered is-mobile p-t-40 p-b-40">
                <div class="column is-full-mobile is-half-tablet is-half-desktop">

                    @if ( ! count($messages))
                    <div class="notification is-marleq m-b-40">
                        No messages...
                    </div>
                    @endif

                    @foreach ($messages as $message)
                        <div class="box">
                            <article class="media">
                                <figure class="media-left">
                                    <p class="image is-48x48">
                                        <img class="is-grayscale" style="border-radius: 5px;"
                                             src="{{ $message->usersTo->picture_crop }}">
                                    </p>
                                </figure>
                                <div class="media-content">
                                    <div class="content">
                                        <p>
                                            <strong>{{ $message->usersTo->name }} {{ $message->usersTo->surname }}</strong>
                                            <br/><small>@if ($message->usersTo->level) {{ $message->usersTo->level->name }} @endif from {{ $message->usersTo->country }}</small><br/>
                                        </p>
                                    </div>
                                </div>
                                <figure class="media-right">
                                    <a href="{{ route('chat', $message->usersTo->alias) }}" class="button is-marleq is-inverted">
                                        @if ($message->new_message)
                                            <span class="icon">
                                                <i class="fa fa-envelope has-text-danger"></i>
                                            </span>
                                        @else
                                            <span class="icon">
                                                <i class="fa fa-envelope"></i>
                                            </span>
                                        @endif
                                        <span>View Messages</span>
                                    </a>
                                </figure>
                            </article>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
    </section>

@endsection

@section('scripts')
@endsection
