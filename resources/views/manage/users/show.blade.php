@extends('layouts.manage')

@section('content')
    <nav class="level is-info">
        <!-- Left side -->
        <div class="level-left">
            <p class="title">User Profile</p>
        </div>

        <!-- Right side -->
        <div class="level-right">
            <div class="level-item">
                <a class="button is-info" href="{{route('users.edit', $user->id)}}">
                    <span class="icon">
                        <i class="fa fa-edit"></i>
                    </span>
                    <span>Edit User</span>
                </a>
            </div>
        </div>
    </nav>

    <div class="content">
        <hr class="m-t-5">
        <p>
            <strong>Id:</strong> {{ $user->id }}
        </p>
        <p>
            <strong>Name:</strong> {{ $user->name }}
        </p>
        <p>
            <strong>Email:</strong> {{ $user->email }}
        </p>
        <h1 class="subtitle">Roles:</h1>
        <ul>
            @foreach($user->roles as $role)
                <li>
                    {{ $role->display_name }} <em class="m-l-15"><small>{{ $role->description }}</small></em>
                </li>
            @endforeach
        </ul>
    </div>
@endsection