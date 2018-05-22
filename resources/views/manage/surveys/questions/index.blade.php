@extends('layouts.manage')

@section('content')
    <!-- Main container -->
    <nav class="level is-info">
        <!-- Left side -->
        <div class="level-left">
            <p class="title">Manage Questions</p>
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
        </div>
    </nav>
    <hr class="m-t-5 m-b-30">
    <table class="table is-fullwidth is-striped is-hoverable is-narrow">
        <thead>
        <tr>
            <th>Name</th>
            <th>Survey</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @foreach($questions as $question)
            <tr>
                <td><small><strong><a href="{{ route('questions.show', $question->id) }}">{{$question->name}}</a></strong></small></td>
                <td><small><strong><a href="{{ route('surveys.show', $question->survey_id) }}">{{$question->survey->name}}</a></strong></small></td>
                <td class="has-text-right">
                    <a href="{{route('questions.edit', $question->id)}}" class="button is-marleq is-small">
                        <span class="icon">
                            <i class="fa fa-edit"></i>
                        </span>
                        <span>Edit</span>
                    </a>
                    <a class="button is-danger is-small" @click="deleteQuestion({{$question->id}})">
                        <span class="icon">
                            <i class="fa fa-times"></i>
                        </span>
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{$questions->links()}}
@endsection

@section('scripts')
    <script>
        let app = new Vue({
            el: '#app',
            data: {},
            methods: {
                deleteQuestion: function(id) {
                    let app = this;
                    axios.delete('/manage/questions/' + id)
                        .then(function (response) {
                            location.reload()
                        })
                        .catch(function(){
                            console.log('Question could not be deleted!')
                        })
                }
            }
        })
    </script>
@endsection