@extends('layouts.manage')

@section('content')
    <!-- Main container -->
    <nav class="level is-info">
        <!-- Left side -->
        <div class="level-left">
            <p class="title">Manage Languages</p>
        </div>

        <!-- Right side -->
        <div class="level-right">
            <div class="level-item">
                <a class="button is-success" href="{{route('languages.create')}}">
                    <span class="icon">
                        <i class="fa fa-plus-square"></i>
                    </span>
                    <span>New Language</span>
                </a>
            </div>
        </div>
    </nav>
    <hr class="m-t-5 m-b-30">
    <table class="table is-fullwidth is-striped is-hoverable is-narrow">
        <thead>
        <tr>
            <th>Name</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @foreach($languages as $language)
            <tr>
                <td><small><strong><a href="{{ route('languages.show', $language->id) }}">{{$language->name}}</a></strong></small></td>
                <td class="has-text-right">
                    <a href="{{route('languages.edit', $language->id)}}" class="button is-marleq is-small">
                        <span class="icon">
                            <i class="fa fa-edit"></i>
                        </span>
                        <span>Edit</span>
                    </a>
                    <a class="button is-danger is-small" @click="deleteLanguage({{$language->id}})">
                        <span class="icon">
                            <i class="fa fa-times"></i>
                        </span>
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{$languages->links()}}
@endsection

@section('scripts')
    <script>
        let app = new Vue({
            el: '#app',
            data: {},
            methods: {
                deleteLanguage: function(id) {
                    let app = this;
                    axios.delete('/manage/languages/' + id)
                        .then(function (response) {
                            location.reload()
                        })
                        .catch(function(){
                            console.log('Language could not be deleted!')
                        })
                }
            }
        })
    </script>
@endsection