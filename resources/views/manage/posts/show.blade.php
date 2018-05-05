@extends('layouts.manage')

@section('content')
    <nav class="level is-info">
        <!-- Left side -->
        <div class="level-left">
            <p class="title">Post</p>
        </div>

        <!-- Right side -->
        <div class="level-right">
            <div class="level-item">
                <a class="button is-marleq" href="{{route('posts.edit', $post->id)}}">
                    <span class="icon">
                        <i class="fa fa-edit"></i>
                    </span>
                    <span>Edit Post</span>
                </a>
            </div>
        </div>
    </nav>

    <div class="content">
        <div class="columns">
            <div class="column">
                @if($post->intro_image)
                    <img class="image" src="{{ URL::asset($post->intro_image) }}">
                    <span>Intro Image</span>
                @else
                    <span>No Intro Image</span>
                @endif
            </div>
            <div class="column">
                @if($post->full_image)
                    <img class="image" src="{{ URL::asset($post->full_image) }}">
                    <span>Full Image</span>
                @else
                    <span>No Full Image</span>
                @endif
            </div>
        </div>
        <h2>{{ $post->title }}</h2>
        <p>Alias: {{ $post->alias }}</p>
        <p>
            <span><strong>Category:</strong> {{ $post->category->name }}</span>
            <span><strong>Featured:</strong> {{ $post->featured }}</span>
            <span><strong>Status:</strong> {{ $post->status }}</span>
            <span><strong>Access:</strong> {{ $post->access }}</span>
            <span><strong>Hits:</strong> {{ $post->hits }}</span>
            <span><strong>Date Created:</strong> {{$post->created_at->format('j. M, Y.')}}</span>
            <span><strong>User:</strong>
                <a href="{{route('users.show', $post->user_id)}}">
                    {{ $post->user->name }}
                </a>
            </span>
            <span><strong>ID:</strong> {{ $post->id }}</span>
        </p>
        <p>{!! $post->content !!}</p>
        <ul>
            @foreach($post->tags as $tag)
                <li>
                    <span>{{ $tag->name }}</span>
                </li>
            @endforeach
        </ul>
    </div>
@endsection