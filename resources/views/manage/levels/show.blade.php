@extends('layouts.manage')

@section('content')
    <nav class="level is-info">
        <!-- Left side -->
        <div class="level-left">
            <p class="title">Level</p>
        </div>

        <!-- Right side -->
        <div class="level-right">
            <div class="level-item">
                <a class="button is-success" href="{{route('levels.create')}}">
                    <span class="icon">
                        <i class="fa fa-plus-square"></i>
                    </span>
                    <span>New Level</span>
                </a>
            </div>
            <div class="level-item">
                <a class="button is-marleq" href="{{route('levels.edit', $level->id)}}">
                    <span class="icon">
                        <i class="fa fa-edit"></i>
                    </span>
                    <span>Edit Level</span>
                </a>
            </div>
        </div>
    </nav>

    <div class="content">
    {{ $level->name }}
    </div>
@endsection