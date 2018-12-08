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
        <nav class="level is-mobile">
            <div class="level-item has-text-centered">
                <div>
                    <p class="heading">Total</p>
                    <p class="title">{{ $total }}</p>
                </div>
            </div>
            <div class="level-item has-text-centered">
                <div>
                    <p class="heading">Reviewed</p>
                    <p class="title">{{ $reviewed }}</p>
                </div>
            </div>
            <div class="level-item has-text-centered">
                <div>
                    <p class="heading">Not Reviewed</p>
                    <p class="title">{{ $notReviewed }}</p>
                </div>
            </div>
            <div class="level-item has-text-centered">
                <div>
                    <p class="heading">Coaches</p>
                    <p class="title">{{ $coachesNumber }}</p>
                </div>
            </div>
        </nav>
    </section>

    <section class="section">
        <div class="container" style="column-count: 5;">
            @foreach($reviewedByCoaches as $name => $value)
                <div class="tags">
                    <span class="tag is-marleq">{{ $value }}</span>
                    <span class="tag">{{ $name }}</span>
                </div>
            @endforeach
        </div>
    </section>

    <section class="section">
        <div class="container">
            <div class="columns is-multiline">
                <div class="column">
                    <table class="table is-fullwidth is-striped is-hoverable is-narrow">
                        <thead>
                        <tr>
                            <th></th>
                            <th>User</th>
                            <th>Countries</th>
                            <th>Languages</th>
                            <th>Submitted</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($resumes as $resume)
                            <tr>
                                <td class="is-narrow">
                                    <div class="field has-addons">
                                        <p class="control">
                                            <a class="is-small">
                                                @if($resume->status == 1)
                                                    <span class="icon is-small has-text-success">
                                                        <i class="fa fa-check"></i>
                                                    </span>
                                                @endif
                                            </a>
                                        </p>
                                    </div>
                                </td>
                                <td class="is-narrow"><small><strong>{{ $resume->user->name }} {{$resume->user->surname}}</strong> from <strong>{{ $resume->user->country }}</strong></small></td>
                                <td>
                                    @foreach($resume->user->countries as $country)
                                        <small>{{ $loop->first ? '' : ', ' }}{{ $country->name }}</small>
                                    @endforeach
                                </td>
                                <td>
                                    @foreach($resume->user->languages as $language)
                                        <small>{{ $loop->first ? '' : ', ' }}{{ $language->name }}</small>
                                    @endforeach
                                </td>
                                <td>
                                    <small>{{$resume->created_at->diffForHumans()}}</small>
                                </td>
                                <td class="has-text-right">
                                    <a href="{{route('cv-requests.edit', $resume->id)}}" class="button is-marleq is-small">
                                        <span class="icon">
                                            <i class="fa fa-edit"></i>
                                        </span>
                                        <span>Review</span>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
    <script>
        let app = new Vue({
            el: '#app',
            data: {},
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