@extends('layouts.manage')

@section('content')
    <!-- Main container -->
    <nav class="level is-info">
        <!-- Left side -->
        <div class="level-left">
            <p class="title">Manage Costs</p>
        </div>

        <!-- Right side -->
        <div class="level-right">
            <div class="level-item">
                <a class="button is-success" href="{{route('costs.create')}}">
                    <span class="icon">
                        <i class="fa fa-plus-square"></i>
                    </span>
                    <span>New Cost</span>
                </a>
            </div>
        </div>
    </nav>
    <hr class="m-t-5 m-b-30">
    <table class="table is-fullwidth is-striped is-hoverable is-narrow">
        <thead>
        <tr>
            <th>Service</th>
            <th>Coach Level</th>
            <th>Price</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @foreach($costs as $cost)
            <tr>
                <td>
                    <small><strong><a href="{{ route('services.show', $cost->service->id) }}">{{$cost->service->name}}</a></strong></small>
                </td>
                <td>
                    <small><strong><a href="{{ route('levels.show', $cost->level->id) }}">{{$cost->level->name}}</a></strong></small>
                </td>
                <td>
                    <strong>{{ $cost->price }}</strong>
                </td>
                <td class="has-text-right is-narrow">
                    <a href="{{route('costs.show', $cost->id)}}" class="button is-light is-small">
                        <span class="icon">
                            <i class="fa fa-eye"></i>
                        </span>
                        <span>View</span>
                    </a>
                    <a href="{{route('costs.edit', $cost->id)}}" class="button is-marleq is-small">
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
    {{$costs->links()}}
@endsection
