@extends('layouts.manage')

@section('content')
    <nav class="level is-info">
        <!-- Left side -->
        <div class="level-left">
            <p class="title">Specialty</p>
        </div>

        <!-- Right side -->
        <div class="level-right">
            <div class="level-item">
                <a class="button is-marleq" href="{{route('specialties.edit', $specialty->id)}}">
                    <span class="icon">
                        <i class="fa fa-edit"></i>
                    </span>
                    <span>Edit Specialty</span>
                </a>
            </div>
        </div>
    </nav>

    <div class="content">
        {{ $specialty->name }}
    </div>
@endsection