@extends('layouts.manage')

@section('content')
    <div class="content">
        <h2>Edit Service</h2>
        <hr class="m-t-5">
    </div>

    <div class="columns">
        <div class="column">
            <form action="{{route('services.update', $service->id)}}" method="post" enctype="multipart/form-data">
                @method('PUT')
                @csrf

                <div class="columns">
                    <div class="column is-three-quarters">
                        <div class="field">
                            <label class="label"><small>Name:</small></label>
                            <div class="control has-icons-left has-icons-right">
                                <input id="name" type="text" class="input{{ $errors->has('name') ? ' is-danger' : '' }}" name="name" value="{{ old('name', $service->name) }}" placeholder="Name input" required autofocus>
                                <span class="icon is-small is-left">
                                    <i class="fa fa-edit"></i>
                                </span>
                                @if ($errors->has('name'))
                                    <span class="icon is-small is-right">
                                        <i class="fa fa-exclamation-triangle"></i>
                                    </span>
                                @endif
                            </div>
                            @if ($errors->has('name'))
                                <p class="help is-danger">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </p>
                            @endif
                        </div>

                        <div class="field">
                            <label class="label"><small>Alias:</small></label>
                            <div class="control has-icons-left has-icons-right">
                                <input id="name" type="text" class="input{{ $errors->has('alias') ? ' is-danger' : '' }}"
                                       name="alias" value="{{ old('alias', $service->alias) }}" placeholder="Auto-generate from title" autofocus>
                                <span class="icon is-small is-left">
                                    <i class="fa fa-link"></i>
                                </span>
                                @if ($errors->has('alias'))
                                    <span class="icon is-small is-right">
                                        <i class="fa fa-exclamation-triangle"></i>
                                    </span>
                                @endif
                            </div>
                            @if ($errors->has('alias'))
                                <p class="help is-danger">
                                    <strong>{{ $errors->first('alias') }}</strong>
                                </p>
                            @endif
                        </div>

                        <div class="field">
                            <label class="label"><small>Description:</small></label>
                            <div class="control has-icons-left has-icons-right">
                                <textarea name="description" class="form-control my-editor{{ $errors->has('description') ? ' is-danger' : '' }}">{!! old('description', $service->description) !!}</textarea>
                                @if ($errors->has('description'))
                                    <span class="icon is-small is-right">
                                        <i class="fa fa-exclamation-triangle"></i>
                                    </span>
                                @endif
                            </div>
                            @if ($errors->has('description'))
                                <p class="help is-danger">
                                    <strong>{{ $errors->first('description') }}</strong>
                                </p>
                            @endif
                        </div>

                        <div class="field m-t-30">
                            <p class="control">
                                <button type="submit" class="button is-marleq">
                                    <span class="icon">
                                        <i class="fa fa-edit"></i>
                                    </span>
                                    <span>Update Service</span>
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

                        <div class="field">
                            <label class="label"><small>Service Image:</small></label>
                            <div class="file has-name is-boxed is-marleq is-fullwidth">
                                <label class="file-label">
                                    <input class="file-input" type="file" ref="serviceimage" name="service_image" @change="onServiceImageChange">
                                    <span class="file-cta">
                                        <span class="file-icon">
                                            <i class="fa fa-upload"></i>
                                        </span>
                                        <span class="file-label has-text-centered">
                                            Upload...
                                        </span>
                                    </span>
                                    <span class="file-name" v-if="serviceImage" v-text="serviceImage"></span>
                                    <span class="file-name" v-if="!serviceImage">No image selected...</span>
                                </label>
                            </div>
                        </div>

                        <div class="field">
                            <label class="label"><small>Service image:</small></label>
                            @if($service->image)
                                <figure class="image">
                                    <img class="image" src="{{ URL::asset($service->image) }}">
                                </figure>
                            @else
                                <p>No image</p>
                            @endif
                        </div>
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
                isSwitchedFeatured: '{!! $service->featured !!}',
                serviceImage: ''
            },
            methods: {
                onServiceImageChange(file) {
                    if (!file.target.files[0].name.match(/.(jpg|jpeg|png|gif|svg)$/i)) {
                        console.warn('not an image');
                        file.target.value = null;
                        this.$emit('imageChanged', null);
                        return;
                    }
                    this.serviceImage = this.$refs.serviceimage.files[0].name;
                },
            }
        })
    </script>
@endsection