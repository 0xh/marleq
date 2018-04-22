@extends('layouts.manage')

@section('content')
    <nav class="level is-info">
        <!-- Left side -->
        <div class="level-left">
            <p class="title">Role</p>
        </div>

        <!-- Right side -->
        <div class="level-right">
            <div class="level-item">
                <a class="button is-info" href="{{route('roles.edit', $role->id)}}">
                    <span class="icon">
                        <i class="fa fa-edit"></i>
                    </span>
                    <span>Edit Role</span>
                </a>
            </div>
        </div>
    </nav>

    <div class="content">
        <hr class="m-t-5">
        <p>
            <strong>Name:</strong> {{ $role->display_name }}
        </p>
        <p>
            <strong>Slug:</strong> {{ $role->name }}
        </p>
        <p>
            <strong>Description:</strong> {{ $role->description }}
        </p>
        <h4>Permissions:</h4>
        <ul>
            @foreach($role->permissions as $permission)
                <li>
                    {{ $permission->name }} <em class="m-l-15"><small>{{ $permission->description }}</small></em>
                </li>
            @endforeach
        </ul>
    </div>

@endsection