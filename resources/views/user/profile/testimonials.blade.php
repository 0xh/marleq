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
                        <li class="is-active"><a href="{{ route('testimonial.index') }}">Testimonials</a></li>
                        @if(Auth::user()->hasRole('coach|country-manager'))
                            <li><a href="{{ route('cv-requests.index') }}">Free CV Requests</a></li>
                        @endif
                    </ul>
                </div>
            </nav>
        </div>
    </section>

    <section class="section">
        <div class="container">
            <div class="columns is-multiline">
                <div class="column is-half">
                    <form action="{{route('testimonial.store')}}" method="post">

                        @csrf

                        <div class="field">
                            <div class="control has-icons-left has-icons-right">
                                <textarea name="testimonial_content" class="form-control my-editor{{ $errors->has('testimonial_content') ? ' is-danger' : '' }}">{!! old('testimonial_content') !!}</textarea>
                                @if ($errors->has('testimonial_content'))
                                    <span class="icon is-small is-right">
                                    <i class="fa fa-exclamation-triangle"></i>
                                </span>
                                @endif
                            </div>
                            @if ($errors->has('testimonial_content'))
                                <p class="help is-danger">
                                    <strong>{{ $errors->first('testimonial_content') }}</strong>
                                </p>
                            @endif
                        </div>

                        <div class="field">
                            <p class="control">
                                <button type="submit" class="button is-marleq">
                                    <span class="icon">
                                        <i class="fa fa-comment"></i>
                                    </span>
                                    <span>Send Testimonial</span>
                                </button>
                            </p>
                        </div>
                    </form>
                </div>
                <div class="column is-half">
                    @if($testimonials)
                        <div class="content">
                            <h4 class="subtitle">Testimonials:</h4>
                            <ul>
                                @foreach($testimonials as $testimonial)
                                    <li>
                                        {!! $testimonial->content !!}
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
    <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>

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

    <script>
        let editor_config = {
            path_absolute : "/",
            selector: "textarea.my-editor",
            @if(Auth::user()->hasRole('administrator'))
            plugins: [
                "advlist autolink lists link image charmap print preview hr anchor pagebreak",
                "searchreplace wordcount visualblocks visualchars code fullscreen",
                "insertdatetime media nonbreaking save table contextmenu directionality",
                "emoticons template paste textcolor colorpicker textpattern"
            ],
            @endif
            toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link @if(Auth::user()->hasRole('administrator')) image media @endif",
            relative_urls: false,
            file_browser_callback : function(field_name, url, type, win) {
                let x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
                let y = window.innerHeight|| document.documentElement.clientHeight|| document.getElementsByTagName('body')[0].clientHeight;

                let cmsURL = editor_config.path_absolute + 'laravel-filemanager?field_name=' + field_name;
                if (type === 'image') {
                    cmsURL = cmsURL + "&type=Images";
                } else {
                    cmsURL = cmsURL + "&type=Files";
                }

                tinyMCE.activeEditor.windowManager.open({
                    file : cmsURL,
                    title : 'Filemanager',
                    width : x * 0.8,
                    height : y * 0.8,
                    resizable : "yes",
                    close_previous : "no"
                });
            }
        };

        tinymce.init(editor_config);
    </script>
@endsection