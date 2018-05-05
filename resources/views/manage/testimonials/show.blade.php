@extends('layouts.manage')

@section('content')
    <nav class="level is-info">
        <!-- Left side -->
        <div class="level-left">
            <p class="title">Testimonial</p>
        </div>

        <!-- Right side -->
        <div class="level-right">
            <div class="level-item">
                <a class="button is-marleq" href="{{route('testimonials.edit', $testimonial->id)}}">
                    <span class="icon">
                        <i class="fa fa-edit"></i>
                    </span>
                    <span>Edit Testimonial</span>
                </a>
            </div>
        </div>
    </nav>

    <div class="content">
        <article class="media">
            @if($testimonial->user->picture_crop)
                <figure class="media-left">
                    <p class="image is-128x128">
                        <img class="image" src="{{ URL::asset($testimonial->user->picture_crop) }}">
                    </p>
                </figure>
            @else
                <span>No Image</span>
            @endif
            <div class="media-content">
                <div class="content">
                    <p>
                        <a class=" is-small">
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
                        <strong>{{ $testimonial->user->name }}</strong>
                        <br>
                        {!! $testimonial->content !!}
                    </p>
                </div>
            </div>
        </article>

    </div>
@endsection