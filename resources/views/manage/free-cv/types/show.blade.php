@extends('layouts.manage')

@section('content')
    <nav class="level is-info">
        <!-- Left side -->
        <div class="level-left">
            <p class="title">Tip Type</p>
        </div>

        <!-- Right side -->
        <div class="level-right">
            <div class="level-item">
                <a class="button is-marleq" href="{{route('tip-types.edit', $type->id)}}">
                    <span class="icon">
                        <i class="fa fa-edit"></i>
                    </span>
                    <span>Edit Type</span>
                </a>
            </div>
        </div>
    </nav>

    <div class="content">
        <p>
            {{ $type->name }}
        </p>
        <p>
            {{ $type->description }}
        </p>
    </div>
@endsection