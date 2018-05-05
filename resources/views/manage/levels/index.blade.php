@extends('layouts.manage')

@section('content')
    <!-- Main container -->
    <nav class="level is-info">
        <!-- Left side -->
        <div class="level-left">
            <p class="title">Manage Levels</p>
        </div>

        <!-- Right side -->
        <div class="level-right">
            <div class="level-item">
                <a class="button is-success" href="{{route('levels.create')}}">
                    <span class="icon">
                        <i class="fa fa-plus-square"></i>
                    </span>
                    <span>New Level</span>
                </a>
            </div>
        </div>
    </nav>
    <hr class="m-t-5 m-b-30">
    <table class="table is-fullwidth is-striped is-hoverable is-narrow">
        <thead>
        <tr>
            <th>Name</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @foreach($levels as $level)
            <tr>
                <td><small><strong><a href="{{ route('levels.show', $level->id) }}">{{$level->name}}</a></strong></small></td>
                <td class="has-text-right">
                    <a href="{{route('levels.edit', $level->id)}}" class="button is-marleq is-small">
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
    {{$levels->links()}}
@endsection