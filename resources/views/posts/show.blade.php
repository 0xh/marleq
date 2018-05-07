@extends('layouts/app')

@section('content')
    <section class="hero is-marleq is-medium" style="background: url({{ URL::asset($post->full_image) }}) no-repeat center center; background-size: cover;">
        <div class="hero-body">

        </div>
    </section>

    <section class="section">
        <div class="container">
            <div class="columns">
                <div class="column is-three-quarters">
                    <div class="content">
                        <h1 class="has-text-weight-light">
                            {{ $post->title }}
                        </h1>
                        {!! $post->content !!}
                    </div>
                    <div class="tags">
                        @foreach($post->tags as $tag)
                            <span class="tag is-marleq">{{ $tag->name }}</span>
                        @endforeach
                    </div>
                </div>
                <div class="column is-one-quarter">
                    <img src="{{ URL::asset($post->user->picture_crop) }}" alt="">
                    <p class="has-text-centered">{{ $post->user->name }}</p>
                    {!! $post->user->biography !!}
                    <div class="content has-text-centered">
                        <a class="button is-marleq" href="#">Get in contact</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection