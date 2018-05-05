@extends('layouts.manage')

@section('content')
    <div class="content">
        <h2>Edit Testimonial</h2>
        <hr class="m-t-5">
    </div>

    <div class="columns">
        <div class="column">
            <form action="{{route('testimonials.update', $testimonial->id)}}" method="post">
                @method('PUT')
                @csrf

                <div class="columns">
                    <div class="column is-three-quarters">
                        <div class="field">
                            <label class="label"><small>Testimonial:</small></label>
                            <div class="control has-icons-left has-icons-right">
                                <textarea name="testimonial_content" class="form-control my-editor{{ $errors->has('testimonial_content') ? ' is-danger' : '' }}">{!! old('testimonial_content', $testimonial->content) !!}</textarea>
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
                                    <span>Update Testimonial</span>
                                </button>
                            </p>
                        </div>
                    </div>
                    <div class="column is-one-quarter">
                        <div class="field">
                            <label class="label"><small>Featured:</small></label>
                            <b-switch
                                    name="featured"
                                    v-model="isSwitchedFeatured"
                                    true-value="1"
                                    false-value="0">
                            </b-switch>
                        </div>
                        <input type="hidden" name="featured" :value="isSwitchedFeatured">
                    </div>

                </div>
            </form>
        </div>
    </div>

@endsection

@section('scripts')
    <script>
        let app = new Vue({
            el: "#app",
            data: {
                isSwitchedFeatured: '{!! $testimonial->featured !!}'
            }
        })
    </script>
@endsection