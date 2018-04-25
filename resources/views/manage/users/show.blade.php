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
        <article class="media">
            <figure class="media-left m-l-5">
                <p class="image is-128x128" style="overflow: hidden;">
                    <img src="{{ URL::asset($pictureURL) }}" alt="">
                </p>
            </figure>
            <div class="media-content">
                <div class="content">
                    <span class="title"><small>{{ $user->name }}</small></span> <small>{{ $user->email }}</small>
                    <p>
                        <small>
                            <a href="{{ URL::asset($documentURL) }}" target="_blank">
                                <span class="icon">
                                    <i class="fa fa-file"></i>
                                </span>
                                <span>View CV</span>
                                <span class="icon">
                                    <i class="fa fa-angle-double-right"></i>
                                </span>
                            </a>
                        </small>
                    </p>
                    <p>
                        {{ $user->biography }}
                    </p>

                    <h3 class="subtitle">Roles:</h3>
                    <ul>
                        @foreach($user->roles as $role)
                            <li>
                                {{ $role->display_name }} <em class="m-l-15"><small>{{ $role->description }}</small></em>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </article>
    </div>
@endsection