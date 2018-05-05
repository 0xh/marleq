@extends('layouts.manage')

@section('content')
    <!-- Main container -->
    <nav class="level is-info">
        <!-- Left side -->
        <div class="level-left">
            <p class="title">Manage Testimonials</p>
        </div>

        <!-- Right side -->
        <div class="level-right">
            <div class="level-item">
                <a class="button is-success" href="{{route('testimonials.create')}}">
                    <span class="icon">
                        <i class="fa fa-plus-square"></i>
                    </span>
                    <span>New Testimonial</span>
                </a>
            </div>
        </div>
    </nav>
    <hr class="m-t-5 m-b-30">
    <table class="table is-fullwidth is-striped is-hoverable is-narrow">
        <thead>
        <tr>
            <th></th>
            <th>Testimonial</th>
            <th>User</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @foreach($testimonials as $testimonial)
            <tr>
                <td class="is-narrow">
                    <div class="field has-addons">
                        <p class="control">
                            <a class="is-small">
                                @if($testimonial->reviewed == 0)
                                    <span class="icon is-small has-text-grey">
                                        <i class="fa fa-times"></i>
                                    </span>
                                @else
                                    <span class="icon is-small has-text-success">
                                        <i class="fa fa-check"></i>
                                    </span>
                                @endif
                            </a>
                        </p>
                        <p class="control m-l-10">
                            <a class="is-small">
                                <span class="icon is-small">
                                    @if($testimonial->featured == 0)
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
                    <small><strong><a href="{{ route('testimonials.show', $testimonial->id) }}">{!! str_limit($testimonial->content, 100) !!}</a></strong></small>
                </td>
                <td class="is-narrow">
                    <small><strong><a href="{{ route('users.show', $testimonial->user->id) }}">{{$testimonial->user->name}}</a></strong></small>
                </td>
                <td class="has-text-right is-narrow">
                    <a href="{{route('testimonials.edit', $testimonial->id)}}" class="button is-marleq is-small">
                        <span class="icon">
                            <i class="fa fa-edit"></i>
                        </span>
                        <span>Edit</span>
                    </a>
                    <a class="button is-danger is-small" @click="deleteTestimonial({{$testimonial->id}})">
                        <span class="icon">
                            <i class="fa fa-times"></i>
                        </span>
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{$testimonials->links()}}
@endsection

@section('scripts')
    <script>
        let app = new Vue({
            el: '#app',
            data: {},
            methods: {
                deleteTestimonial: function(id) {
                    let app = this;
                    axios.delete('/manage/testimonials/' + id)
                        .then(function (response) {
                            location.reload()
                        })
                        .catch(function(){
                            console.log('Testimonial could not be deleted!')
                        })
                }
            }
        })
    </script>
@endsection