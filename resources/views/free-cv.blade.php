@extends('layouts/app')

@section('content')
    <section class="hero hero-has-background is-marleq is-narrow">
        <div class="hero-body">
            <div class="columns is-centered">
                <div class="column is-two-thirds has-text-centered">
                    @if($resume)
                        @if($resume->status == 1)
                            <h1 class="title m-b-20">
                                Your CV Review
                            </h1>
                        @endif
                    @else
                        <h1 class="title m-b-50">
                            FREE CV REVIEW
                        </h1>
                    @endif
                    @if($resume)
                        @if($resume->status == 1)
                            <div class="content">
                                @for ($i = 0; $i < 5; $i++)
                                    @if($resume->rating <= $i)
                                        <span class="icon">
                                          <i class="fa fa-star"></i>
                                        </span>
                                    @else
                                        <span class="icon has-text-warning">
                                          <i class="fa fa-star"></i>
                                        </span>
                                    @endif
                                @endfor
                                <div class="m-t-10 has-text-weight-bold">
                                    @switch($resume->rating)
                                    @case(1)
                                    You have no professional experience. Consider doing an internship or a volunteering activity.
                                    @break
                                    @case(2)
                                    You need to improve your CV significantly.
                                    @break
                                    @case(3)
                                    Your CV is moderate. However, it does not stand out.
                                    @break
                                    @case(4)
                                    You need to improve your CV slightly.
                                    @break
                                    @case(5)
                                    Congratulations, your CV is great!
                                    @break
                                    @default
                                    No Rating yet...
                                    @endswitch
                                </div>
                            </div>
                        @endif
                    @else
                        <h2 class="subtitle">
                            Are you looking for an internship, a new job opportunity or a career progress?<br/>
                            Our experienced career coaches will help your CV stands out.
                        </h2>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <section class="section">
        <div class="container">
            <div class="columns is-centered">
                <div class="column is-full-mobile is-half-tablet @if($resume) is-two-thirds-desktop @else is-one-third-desktop @endif">
                    @if (session('success'))
                        <b-notification type="is-success">
                            {{ Session::get('success') }}
                        </b-notification>
                    @endif
                    @if (session('danger'))
                        <b-notification type="is-danger">
                            {{ Session::get('danger') }}
                        </b-notification>
                    @endif

                    @if(!$resume)
                        <form action="{{route('free-cv.store')}}" method="post" enctype="multipart/form-data">
                            @csrf

                            <div class="field">
                                <div class="file is-boxed is-medium has-name is-marleq is-centered">
                                    <label class="file-label">
                                        <input class="file-input" type="file" ref="document" name="document" @change="onDocumentChange">
                                        <span class="file-cta">
                                            <span class="file-icon">
                                                <i class="fa fa-upload"></i>
                                            </span>
                                            <span class="file-label">
                                                Select your CV
                                            </span>
                                        </span>
                                        <span class="file-name is-narrow" v-if="document" v-text="document"></span>
                                        <span class="file-name" v-if="!document"><small>No document selected...</small></span>
                                    </label>
                                </div>
                                @if ($errors->has('document'))
                                    <p class="help is-danger has-text-weight-bold has-text-centered">
                                        {{ $errors->first('document') }}
                                    </p>
                                @endif
                            </div>

                            <div class="field p-t-30 p-b-30">
                                <div class="has-text-centered">
                                    <p>Upload your CV and you will receive an insightful feedback on how to improve it.</p>
                                </div>
                            </div>

                            <div class="field">
                                <div class="buttons is-centered">
                                    <button type="submit" class="button is-success">
                                        <span class="icon">
                                            <i class="fa fa-envelope-square"></i>
                                        </span>
                                        <span>Send your CV</span>
                                    </button>
                                </div>
                            </div>
                        </form>
                    @endif

                    @if($resume)
                        <div class="content">
                            @if($resume->status == 0)
                                <div class="box has-text-centered">
                                    <h3 class="title has-text-marleq is-uppercase m-b-10" style="font-weight: 900;">
                                         Your CV is being<br/>reviewed
                                    </h3>
                                    <p><strong>Thanks for trusting us with your CV!</strong>
                                    </p>
                                    <p>You’ll soon be receiving feedback on layout, language and how well your resume communicates your skills and expertise.</p>
                                </div>
                            @endif

                            @foreach($resume->tips as $tip)
                                <h3><strong>{{ $tip->tipType->name }}:</strong> {{ $tip->content }}</h3>
                                <p class="notification is-light">
                                    <span class="has-text-marleq has-text-weight-bold">Tip #{{ $loop->index + 1 }}:</span>
                                    <span class="has-text-weight-light">
                                        {{ $tip->tipType->description }}
                                    </span>
                                </p>
                            @endforeach

                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <section class="hero hero-services is-narrow is-light">
        <div class="hero-body">
            <div class="container">
                <div class="has-text-centered">
                    <h1 class="title m-b-50 p-b-20 is-uppercase has-text-marleq">Our Services</h1>
                </div>
                <div class="columns is-multiline is-variable bd-klmn-columns is-7 is-narrow has-text-centered m-b-30">
                    @foreach($services as $service)
                        <div class="column is-one-quarter">
                            <div>
                                @if($service->image)
                                    <img src="{{ URL::asset($service->image) }}" style="width:70px;">
                                @endif
                                <a href="{{ route('service-show', $service->alias) }}"><h3 class="m-t-20 service-h3">{{ $service->name }}</h3></a>
                                <div class="has-text-weight-light">
                                    {!! $service->description !!}
                                </div>
                            </div>
                        </div>
                    @endforeach
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
                document: ''
            },
            methods: {
                onDocumentChange(file) {
                    if (!file.target.files[0].name.match(/.(pdf|doc|docx)$/i)) {
                        console.warn('not a valid document');
                        file.target.value = null;
                        this.$emit('documentChanged', null);
                        return;
                    }
                    this.document = this.$refs.document.files[0].name;
                }
            }
        })
    </script>
@endsection