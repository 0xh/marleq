@extends('layouts.manage')

@section('content')
    <nav class="level is-info">
        <!-- Left side -->
        <div class="level-left">
            <p class="title">Free CV Request</p>
        </div>

        <!-- Right side -->
        <div class="level-right">
            <div class="level-item">
                <a class="button is-marleq" href="{{route('resumes.edit', $resume->id)}}">
                    <span class="icon">
                        <i class="fa fa-edit"></i>
                    </span>
                    <span>Check CV</span>
                </a>
            </div>
        </div>
    </nav>

    <div class="columns m-t-40">
        @if($resume->user->picture_crop)
            <div class="column is-narrow">
                <img src="{{ URL::asset($resume->user->picture_crop) }}" alt="" class="is-grayscale m-b-10" style="overflow: hidden; width: 140px; border-radius: 15px;">
            </div>
        @endif
        <div class="column">
            <h1 class="title">
                <a class="is-small">
                    @if($resume->status == 0)
                        <span class="icon is-small has-text-grey">
                            <i class="fa fa-times"></i>
                        </span>
                    @else
                        <span class="icon is-small has-text-success">
                            <i class="fa fa-check"></i>
                        </span>
                    @endif
                </a>
                {{ $resume->user->name }} {{ $resume->user->surname }}
            </h1>
            <h2 class="subtitle">
                Job Seeker from {{ $resume->user->country }}
            </h2>
            <h2 class="subtitle">
                <a href="{{ URL::asset($resume->document) }}" target="_blank">
                    <span class="icon">
                        <i class="fa fa-file"></i>
                    </span>
                    <span>View CV</span>
                    <span class="icon">
                        <i class="fa fa-angle-right"></i>
                    </span>
                </a>
            </h2>
        </div>
    </div>

    <div class="content">
        @if($resume->coach_id)
            <p>Coach: <a href="{{ route('users.show', $resume->coach_id) }}">{{ $resume->coach->name }} {{$resume->coach->surname}}</a></p>
        @endif

        @if($resume->coach_id)
            <p>Rating: {{ $resume->rating }}</p>
        @endif

        <p></p>

        <div class="content">
            @foreach($resume->tips as $tip)
                <h3>{{ $tip->tipType->name }}</h3>
                <p>
                    {{ $tip->content }}
                </p>
            @endforeach
        </div>
    </div>
@endsection