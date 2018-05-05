@extends('layouts.manage')

@section('content')
    <!-- Main container -->
    <nav class="level is-info">
        <!-- Left side -->
        <div class="level-left">
            <p class="title">Manage Services</p>
        </div>

        <!-- Right side -->
        <div class="level-right">
            <div class="level-item">
                <a class="button is-success" href="{{route('services.create')}}">
                    <span class="icon">
                        <i class="fa fa-plus-square"></i>
                    </span>
                    <span>New Service</span>
                </a>
            </div>
        </div>
    </nav>
    <hr class="m-t-5 m-b-30">
    <table class="table is-fullwidth is-striped is-hoverable is-narrow">
        <thead>
        <tr>
            <th>Featured</th>
            <th>Image / Description</th>
            <th>Name</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @foreach($services as $service)
            <tr>
                <td class="is-narrow">
                    <div class="field has-addons">
                        <p class="control">
                            <a class="is-small">
                                <span class="icon is-small">
                                    @if($service->featured == 0)
                                        <span class="icon is-small has-text-grey">
                                            <i class="fa fa-star"></i>
                                        </span>
                                    @else
                                        <span class="icon is-small has-text-warning">
                                            <i class="fa fa-star"></i>
                                        </span>
                                    @endif
                                </span>
                            </a>
                        </p>
                    </div>
                </td>
                <td>
                    @if($service->image != '')
                        <span class="icon">
                            <i class="fa fa-image has-text-grey"></i>
                        </span>
                    @endif
                    @if($service->description != '')
                        <span class="icon">
                        <i class="fa fa-align-left has-text-grey"></i>
                    </span>
                    @endif
                </td>
                <td>
                    <small><strong><a href="{{ route('services.show', $service->id) }}">{{$service->name}}</a></strong></small>
                </td>
                <td class="has-text-right">
                    <a href="{{route('services.edit', $service->id)}}" class="button is-marleq is-small">
                        <span class="icon">
                            <i class="fa fa-edit"></i>
                        </span>
                        <span>Edit</span>
                    </a>
                    <a class="button is-danger is-small" @click="deleteService({{$service->id}})">
                        <span class="icon">
                            <i class="fa fa-times"></i>
                        </span>
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{$services->links()}}
@endsection

@section('scripts')
    <script>
        let app = new Vue({
            el: '#app',
            data: {},
            methods: {
                deleteService: function(id) {
                    let app = this;
                    axios.delete('/manage/services/' + id)
                        .then(function (response) {
                            location.reload()
                        })
                        .catch(function(){
                            console.log('Service could not be deleted!')
                        })
                }
            }
        })
    </script>
@endsection