@extends('layouts.manage')

@section('content')
    <nav class="level is-info">
        <!-- Left side -->
        <div class="level-left">
            <p class="title">Tag</p>
        </div>

        <!-- Right side -->
        <div class="level-right">
            <div class="level-item">
                <a class="button is-success" href="{{route('tags.create')}}">
                    <span class="icon">
                        <i class="fa fa-plus-square"></i>
                    </span>
                    <span>New Tag</span>
                </a>
            </div>
            <div class="level-item">
                <a class="button is-marleq" href="{{route('tags.edit', $tag->id)}}">
                    <span class="icon">
                        <i class="fa fa-edit"></i>
                    </span>
                    <span>Edit Tag</span>
                </a>
            </div>
        </div>
    </nav>

    <div class="content">
    {{ $tag->name }}
    </div>
@endsection