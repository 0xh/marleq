@extends('layouts.manage')

@section('content')
    <nav class="level is-info">
        <!-- Left side -->
        <div class="level-left">
            <p class="title">Tip</p>
        </div>

        <!-- Right side -->
        <div class="level-right">
            <div class="level-item">
                <a class="button is-success" href="{{route('tips.create')}}">
                    <span class="icon">
                        <i class="fa fa-plus-square"></i>
                    </span>
                    <span>New Tip</span>
                </a>
            </div>
            <div class="level-item">
                <a class="button is-marleq" href="{{route('tips.edit', $tip->id)}}">
                    <span class="icon">
                        <i class="fa fa-edit"></i>
                    </span>
                    <span>Edit Tip</span>
                </a>
            </div>
        </div>
    </nav>

    <div class="content">
        Type: {{ $tip->tipType->name }}<br/>
        Tip: {{ $tip->content }}
    </div>
@endsection