@extends('layouts.manage')

@section('content')
    <nav class="level is-info">
        <!-- Left side -->
        <div class="level-left">
            <p class="title">Cost</p>
        </div>

        <!-- Right side -->
        <div class="level-right">
            <div class="level-item">
                <a class="button is-marleq" href="{{route('costs.edit', $cost->id)}}">
                    <span class="icon">
                        <i class="fa fa-edit"></i>
                    </span>
                    <span>Edit Cost</span>
                </a>
            </div>
        </div>
    </nav>

    <div class="content">
        <p>Service: {{ $cost->service->name }}</p>
        <p>Level: {{ $cost->level->name }}</p>
        <p>Price: {{ $cost->price }}</p>
        <p>Description: {!! $cost->description !!}</p>
    </div>
@endsection