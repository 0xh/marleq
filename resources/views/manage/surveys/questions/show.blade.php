@extends('layouts.manage')

@section('content')
    <nav class="level is-info">
        <!-- Left side -->
        <div class="level-left">
            <p class="title">Question</p>
        </div>

        <!-- Right side -->
        <div class="level-right">
            <div class="level-item">
                <a class="button is-success" href="{{route('questions.create')}}">
                    <span class="icon">
                        <i class="fa fa-plus-square"></i>
                    </span>
                    <span>New Question</span>
                </a>
            </div>
            <div class="level-item">
                <a class="button is-marleq" href="{{route('questions.edit', $question->id)}}">
                    <span class="icon">
                        <i class="fa fa-edit"></i>
                    </span>
                    <span>Edit Question</span>
                </a>
            </div>
        </div>
    </nav>

    <div class="content">
        Survey: {{ $question->survey->name }}<br/>
        Question: {{ $question->name }}
    </div>
@endsection