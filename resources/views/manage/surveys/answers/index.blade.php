@extends('layouts.manage')

@section('content')
    <!-- Main container -->
    <nav class="level is-info">
        <!-- Left side -->
        <div class="level-left">
            <p class="title">Manage Answers</p>
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
        </div>
    </nav>
    <hr class="m-t-5 m-b-30">
    <table class="table is-fullwidth is-striped is-hoverable is-narrow">
        <thead>
        <tr>
            <th>Name</th>
            <th>Question</th>
            <th>Survey</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @foreach($answers as $answer)
            <tr>
                <td><small><strong><a href="{{ route('answers.show', $answer->id) }}">{{$answer->name}}</a></strong></small></td>
                <td><small><strong><a href="{{ route('questions.show', $answer->question_id) }}">{{$answer->question->name}}</a></strong></small></td>
                <td><small><strong><a href="{{ route('surveys.show', $answer->question->survey->id) }}">{{$answer->question->survey->name}}</a></strong></small></td>
                <td class="has-text-right">
                    <a href="{{route('answers.edit', $answer->id)}}" class="button is-marleq is-small">
                        <span class="icon">
                            <i class="fa fa-edit"></i>
                        </span>
                        <span>Edit</span>
                    </a>
                    <a class="button is-danger is-small" @click="deleteAnswer({{$answer->id}})">
                        <span class="icon">
                            <i class="fa fa-times"></i>
                        </span>
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{$answers->links()}}
@endsection

@section('scripts')
    <script>
        let app = new Vue({
            el: '#app',
            data: {},
            methods: {
                deleteAnswer: function(id) {
                    let app = this;
                    axios.delete('/manage/answers/' + id)
                        .then(function (response) {
                            location.reload()
                        })
                        .catch(function(){
                            console.log('Answer could not be deleted!')
                        })
                }
            }
        })
    </script>
@endsection