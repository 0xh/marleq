@extends('layouts/app')

@section('content')
    <section class="hero hero-has-background is-marleq is-narrow">
        <div class="hero-body">
            <div class="columns is-centered">
                <div class="column is-two-thirds has-text-centered">
                    @if($posts->name == 'Inspiration')
                        <h1 class="title m-b-50">
                            WE SHARE WITH YOU VALUABLE CAREER TIPS<br/>
                            AND INSPIRING STORIES
                        </h1>
                        <h2 class="subtitle">
                            Our purpose is to help job seekers land their dream job. We truly believe this is possible.
                            We strive to inspire and motivate each of you by sharing outstanding career stories and advices.<br />
                            If these people below could build impressive careers, you can too.<br/>
                            Read carefully these articles and interviews, get inspired, work hard and smart, and achieve desirable career progress.
                        </h2>
                    @else
                        <h1 class="title m-b-50">
                            YOUR CAREER DEVELOPMENT IS THE CORE<br/>
                            OF OUR MISSION
                        </h1>
                        <h2 class="subtitle">
                            We have hosted dozens of career related events. MARLEQ has welcomed 18 speakers with more than 300 attendees in the last 6 months.
                            We continue to invite more outstanding people to share their inspiring career stories.<br />
                        </h2>
                        <h2 class="subtitle has-text-weight-bold">We are looking forward to seeing you at our events!</h2>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <section class="section">
        <div class="container">
            <div class="columns is-centered is-mobile is-multiline">
                @foreach($posts->posts as $post)
                    <div class="column is-one-quarter">
                        <div class="card is-shadowless">
                            @if($post->intro_image)
                                <div class="card-image">
                                    <figure class="image is-4by3">
                                        <img src="{{ URL::asset($post->intro_image) }}" alt="" style="border-radius: 15px;">
                                    </figure>
                                </div>
                            @endif
                            <div class="card-content p-l-0 p-r-0">
                                <div>
                                    <h3 class="homepage-mod-h3">{{ $post->title }}</h3>
                                    <div class="m-b-15">
                                        {!! str_limit($post->content, 150) !!}
                                    </div>
                                    <div>
                                        <a href="@if($post->category->name == 'Inspiration') {{ route('inspiration-show', $post->alias) }} @else {{ route('event-show', $post->alias) }} @endif" class="has-text-weight-bold">
                                            <span>Read more</span>
                                            <span class="icon">
                                                <i class="fa fa-angle-right has-text-marleq"></i>
                                            </span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

@endsection