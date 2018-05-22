@extends('layouts.manage')

@section('content')
    <nav class="level is-info">
        <!-- Left side -->
        <div class="level-left">
            <p class="title">Answer</p>
        </div>

        <!-- Right side -->
        <div class="level-right">
            <div class="level-item">
                <a class="button is-success" href="{{route('answers.create')}}">
                    <span class="icon">
                        <i class="fa fa-plus-square"></i>
                    </span>
                    <span>New Answer</span>
                </a>
            </div>
            <div class="level-item">
                <a class="button is-marleq" href="{{route('answers.edit', $answer->id)}}">
                    <span class="icon">
                        <i class="fa fa-edit"></i>
                    </span>
                    <span>Edit Answer</span>
                </a>
            </div>
        </div>
    </nav>

    <div class="content">
        Survey: {{ $answer->question->name }}<br/>
        Question: {{ $answer->name }}
    </div>
@endsection