@extends('layouts.manage')

@section('content')
    <!-- Main container -->
    <nav class="level is-info">
        <!-- Left side -->
        <div class="level-left">
            <p class="title">Manage Users</p>
        </div>

        <!-- Right side -->
        <div class="level-right">
            <div class="level-item">
                <a class="button is-success" href="{{route('users.create')}}">
                    <span class="icon">
                        <i class="fa fa-user-plus"></i>
                    </span>
                    <span>New User</span>
                </a>
            </div>
            <div class="level-item">
                <div class="field has-addons">
                    <p class="control">
                        <input class="input" type="text" placeholder="Find a user">
                    </p>
                    <p class="control">
                        <button class="button">
                            Search
                        </button>
                    </p>
                </div>
            </div>
        </div>
    </nav>
    <hr class="m-t-5 m-b-30">
    <table class="table is-fullwidth is-striped is-hoverable is-narrow">
        <thead>
        <tr>
            <th></th>
            <th></th>
            <th>Id</th>
            <th>Level</th>
            <th>Name</th>
            <th>Email</th>
            <th>Date created</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
            <tr>
                <td class="is-narrow">
                    <div class="field has-addons">
                        <p class="control">
                            <a class="is-small">
                                @if($user->status == 0)
                                    <span class="icon is-small has-text-danger">
                                        <i class="fa fa-times"></i>
                                    </span>
                                @else
                                    <span class="icon is-small has-text-success">
                                        <i class="fa fa-check"></i>
                                    </span>
                                @endif
                            </a>
                        </p>
                    </div>
                </td>
                <td class="is-narrow">
                    <div class="field has-addons">
                        <p class="control">
                            <a class="is-small">
                                <span class="icon is-small">
                                    @if($user->featured == 0)
                                        <span class="icon is-small has-text-grey">
                                            <i class="fa fa-star"></i>
                                        </span>
                                    @else
                                        <span class="icon is-small has-text-warning">
                                            <i class="fa fa-star"></i>
                                        </span>
                                    @endif
                                </span>
                            </a>
                        </p>
                    </div>
                </td>
                <td><small>{{ $user->id }}</small></td>
                <td><small>@if($user->level) {{ $user->level->name }} @endif</small></td>
                <td><small><strong><a href="{{ route('users.show', $user->id) }}">{{ $user->name }} {{ $user->surname }}</a></strong></small></td>
                <td><small>{{ $user->email }}</small></td>
                <td><small>{{ $user->created_at->format('j. M, Y. H:i:s') }}</small></td>
                <td>
                    <a href="{{route('users.edit', $user->id)}}" class="button is-marleq is-small">
                        <span class="icon">
                            <i class="fa fa-edit"></i>
                        </span>
                        <span>Edit</span>
                    </a>
                    <a class="button is-danger is-small" @click="deleteUser({{$user->id}})">
                        <span class="icon">
                            <i class="fa fa-times"></i>
                        </span>
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{$users->links()}}
@endsection

@section('scripts')
    <script>
        let app = new Vue({
            el: '#app',
            data: {},
            methods: {
                deleteUser: function(id) {
                    let app = this
                    axios.delete('/manage/users/' + id)
                        .then(function (response) {
                            location.reload()
                        })
                        .catch(function(){
                            console.log('User could not be deleted!')
                        })
                }
            }
        })
    </script>
@endsection