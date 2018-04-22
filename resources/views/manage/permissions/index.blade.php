@extends('layouts.manage')

@section('content')
    <!-- Main container -->
    <nav class="level is-info">
        <!-- Left side -->
        <div class="level-left">
            <p class="title">Manage Permissions</p>
        </div>

        <!-- Right side -->
        <div class="level-right">
            <div class="level-item">
                <a class="button is-success" href="{{route('permissions.create')}}">
                    <span class="icon">
                        <i class="fa fa-plus-circle"></i>
                    </span>
                    <span>New Permission</span>
                </a>
            </div>
        </div>
    </nav>
    <hr class="m-t-5 m-b-30">
    <table class="table is-fullwidth is-striped is-hoverable is-narrow">
        <thead>
        <tr>
            <th>Name</th>
            <th>Slug</th>
            <th>Description</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @foreach($permissions as $permission)
            <tr>
                <td><small><strong>{{ $permission->display_name }}</strong></small></td>
                <td><small>{{ $permission->name }}</small></td>
                <td><small>{{ $permission->description }}</small></td>
                <td>
                    <a href="{{route('permissions.edit', $permission->id)}}" class="button is-info is-small">
                        <span class="icon">
                            <i class="fa fa-edit"></i>
                        </span>
                        <span>Edit</span>
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
