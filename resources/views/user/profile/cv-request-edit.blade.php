@extends('layouts/app')

@section('content')

    <section class="hero hero-has-background is-marleq is-narrow">
        <!-- Hero head: will stick at the top -->
        <div class="hero-head">
            <div class="container">
                <nav class="level m-t-10">
                    <!-- Left side -->
                    <div class="level-left">

                    </div>
                    <!-- Right side -->
                    <div class="level-right">

                    </div>
                </nav>
            </div>
        </div>

        <!-- Hero content: will be in the middle -->
        <div class="hero-body">
            <div class="container has-text-left-desktop has-text-centered-mobile">
                <div class="columns">
                    @if($user->picture_crop)
                        <div class="column is-narrow">
                            <img src="{{ URL::asset($user->picture_crop) }}" alt="" class="is-grayscale m-b-10" style="overflow: hidden; width: 70px; border-radius: 15px;">
                        </div>
                    @endif
                    <div class="column">
                        <h1 class="title">
                            {{ $user->name }} {{ $user->surname }}
                        </h1>
                        @if(Auth::user()->hasRole('coach|country-manager'))
                            <h2 class="subtitle">
                                @if($user->level) {{ $user->level->name }} @endif @if(Auth::user()->hasRole('country-manager')) @if($user->level) & @endif Country Manager @endif from {{ $user->country }}
                            </h2>
                        @endif
                        @if(Auth::user()->hasRole('user'))
                            <h2 class="subtitle">
                                Job Seeker from {{ $user->country }}
                            </h2>
                        @endif
                    </div>
                    <div class="column has-text-right-desktop has-text-centered-mobile is-narrow">
                        <a href="{{route('profile.edit', $user->alias)}}" class="button is-marleq is-inverted">
                            <span class="icon">
                                <i class="fa fa-edit"></i>
                            </span>
                            <span>Edit Profile</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Hero footer: will stick at the bottom -->
        <div class="hero-foot">
            <nav class="tabs is-boxed">
                <div class="container">
                    <ul>
                        <li><a href="{{ route('user') }}">Overview</a></li>
                        <li><a href="{{ route('testimonial.index') }}">Testimonials</a></li>
                        @if(Auth::user()->hasRole('coach|country-manager') and Auth::user()->status == 1)
                            <li class="is-active"><a href="{{ route('cv-requests.index') }}">Free CV Requests</a></li>
                            <li><a href="{{ route('card.index') }}">Business Card</a></li>
                        @endif
                    </ul>
                </div>
            </nav>
        </div>
    </section>

    <section class="section">
        <div class="container">
            <div class="columns is-multiline">
                <div class="column">
                    <div class="columns">
                        @if($resume->user->picture_crop)
                            <div class="column is-narrow">
                                <img src="{{ URL::asset($resume->user->picture_crop) }}" alt="" class="is-grayscale m-b-10" style="overflow: hidden; width: 140px; border-radius: 15px;">
                            </div>
                        @endif
                        <div class="column">
                            <h1 class="title">
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

                    <form action="{{route('cv-requests.update', $resume->id)}}" method="post">
                        @method('PUT')
                        @csrf

                        @foreach($tipTypes as $type)
                            <h2 class="subtitle">{{ $type->name }}</h2>
                            <ul class="m-b-30">
                                @foreach($type->tips->all() as $tip)
                                    <li class="m-b-10">
                                        <b-checkbox class="m-r-10" type="is-marleq" native-value="{{ $tip->id }}" v-model="tips">{{ $tip->content }}</b-checkbox>
                                    </li>
                                @endforeach
                            </ul>
                        @endforeach

                        <input type="hidden" name="tips" :value="tips">

                        <div class="field m-t-30">
                            <div class="block">
                                <b-radio v-model="rating"
                                         native-value="1">
                                    1 - Poor
                                </b-radio>
                                <b-radio v-model="rating"
                                         native-value="2">
                                    2 - Fair
                                </b-radio>
                                <b-radio v-model="rating"
                                         native-value="3">
                                    3 - Good
                                </b-radio>
                                <b-radio v-model="rating"
                                         native-value="4">
                                    4 - Very Good
                                </b-radio>
                                <b-radio v-model="rating"
                                         native-value="5">
                                    5 - Excellent
                                </b-radio>
                            </div>
                        </div>

                        <input type="hidden" name="rating" :value="rating">

                        <div class="field m-t-30">
                            <p class="control">
                                <button type="submit" class="button is-marleq">
                                    <span class="icon">
                                        <i class="fa fa-edit"></i>
                                    </span>
                                    <span>Update Resume Request</span>
                                </button>
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
    <script>
        let app = new Vue({
            el: '#app',
            data: {
                tips: {!!$resume->tips->pluck('id')!!},
                rating: "{!! $resume->rating !!}"
            },
            mounted: function () {
                @if (session('success'))
                    this.$toast.open({
                    duration: 5000,
                    message: '{!! Session::get('success') !!}',
                    type: 'is-success'
                });
                @endif
            }
        })
    </script>
@endsection