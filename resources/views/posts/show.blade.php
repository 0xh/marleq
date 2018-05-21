@extends('layouts/app')

@section('content')
    <section class="hero is-marleq is-medium p-b-30 p-t-30" style="background: url({{ URL::asset($post->full_image) }}) no-repeat center center; background-size: cover;">
        <div class="hero-body">

        </div>
    </section>

    <section class="section">
        <div class="container">
            <div class="columns">
                <div class="column">
                    <div class="content">
                        <h1 class="has-text-weight-light m-b-30">
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
                @if($post->category->name == 'Inspiration')
                    <div class="column is-one-quarter">
                        <div class="card hero-has-background" style="border-radius: 15px;">
                            <div class="card-content">
                                <div class="media">
                                    <div class="media-left">
                                        <figure class="image is-48x48">
                                            <img class="is-grayscale" src="{{ URL::asset($post->user->picture_crop) }}" alt="" style="border-radius: 15px;">
                                        </figure>
                                    </div>
                                    <div>
                                        <p class="title is-4 has-text-white"><small>{{ $post->user->name }} {{ $post->user->surname }}</small></p>
                                        <p class="subtitle is-6 has-text-white">{{ $post->user->level->name }}</p>
                                    </div>
                                </div>

                                <div class="content has-text-centered has-text-white p-t-20 p-b-10">
                                    {!! $post->user->biography !!}
                                    <a class="button is-marleq is-small is-rounded is-inverted m-t-10" href="{{ route('coach-show', $post->user->alias) }}">Get in contact</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </section>

@endsection