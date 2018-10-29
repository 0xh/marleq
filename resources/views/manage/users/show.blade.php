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
                <a class="button is-marleq" href="{{route('users.edit', $user->id)}}">
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
                    <img src="{{ URL::asset($user->picture_crop) }}" alt="">
                </p>
            </figure>
            <div class="media-content">
                <div class="content">
                    <span class="title">
                        <small>{{ $user->name }} {{ $user->surname }}</small>
                    </span>
                    <small>(
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
                        @if($user->level) {{ $user->level->name }} @endif
                    )</small>
                    <small>{{ $user->email }}</small>
                    <p>
                        <small>{{ $user->title }} from {{ $user->country }}</small>
                    </p>
                    <p>
                        <small>Social network URL: {{ $user->social_network }}</small>
                    </p>
                    @if($user->document)
                        <p>
                            <small>
                                <a href="{{ URL::asset($user->document) }}" target="_blank">
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
                    @endif
                    <p>
                        {!! $user->biography !!}
                    </p>

                    <h3 class="subtitle">Certification:</h3>
                    <ul>
                        @foreach($certification as $certificate)
                            <li>
                                {{ $certificate }}
                            </li>
                        @endforeach
                    </ul>

                    <h3 class="subtitle">Languages:</h3>
                    <ul>
                        @foreach($user->languages as $language)
                            <li>
                                {{ $language->name }}
                            </li>
                        @endforeach
                    </ul>

                    <h3 class="subtitle">Specialties:</h3>
                    <ul>
                        @foreach($user->specialties as $specialty)
                            <li>
                                {{ $specialty->name }}
                            </li>
                        @endforeach
                    </ul>

                    <h3 class="subtitle">Services:</h3>
                    <ul>
                        @foreach($user->services as $service)
                            <li>
                                {{ $service->name }}
                            </li>
                        @endforeach
                    </ul>

                    <h3 class="subtitle">Countries:</h3>
                    <ul>
                        @foreach($user->countries as $country)
                            <li>
                                {{ $country->name }}
                            </li>
                        @endforeach
                    </ul>

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