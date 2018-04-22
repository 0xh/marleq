@extends('layouts.manage')

@section('content')
    <nav class="level is-info">
        <!-- Left side -->
        <div class="level-left">
            <p class="title">Permission</p>
        </div>

        <!-- Right side -->
        <div class="level-right">
            <div class="level-item">
                <a class="button is-info" href="{{route('permissions.edit', $permission->id)}}">
                    <span class="icon">
                        <i class="fa fa-edit"></i>
                    </span>
                    <span>Edit Permission</span>
                </a>
            </div>
        </div>
    </nav>

    <div class="content">
        <hr class="m-t-5">
        <p>
            <strong>Name:</strong> {{ $permission->display_name }}
        </p>
        <p>
            <strong>Slug:</strong> {{ $permission->name }}
        </p>
        <p>
            <strong>Description:</strong> {{ $permission->description }}
        </p>
    </div>

@endsection