@extends('layouts.manage')

@section('content')
    <div class="content">
        <h2>Edit Free CV Request</h2>
        <hr class="m-t-5">
    </div>

    <div class="columns">
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

            <form action="{{route('resumes.update', $resume->id)}}" method="post">
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
                            1
                        </b-radio>
                        <b-radio v-model="rating"
                                 native-value="2">
                            2
                        </b-radio>
                        <b-radio v-model="rating"
                                 native-value="3">
                            3
                        </b-radio>
                        <b-radio v-model="rating"
                                 native-value="4">
                            4
                        </b-radio>
                        <b-radio v-model="rating"
                                 native-value="5">
                            5
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

@endsection

@section('scripts')
    <script>
        let app = new Vue({
            el: '#app',
            data: {
                tips: {!!$resume->tips->pluck('id')!!},
                rating: "{!! $resume->rating !!}"
            }
        })
    </script>
@endsection