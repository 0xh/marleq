@extends('layouts.manage')

@section('content')
    <nav class="level is-info">
        <!-- Left side -->
        <div class="level-left">
            <p class="title">Service</p>
        </div>

        <!-- Right side -->
        <div class="level-right">
            <div class="level-item">
                <a class="button is-marleq" href="{{route('services.edit', $service->id)}}">
                    <span class="icon">
                        <i class="fa fa-edit"></i>
                    </span>
                    <span>Edit Service</span>
                </a>
            </div>
        </div>
    </nav>

    <div class="content">
        {{ $service->name }}
    </div>
@endsection