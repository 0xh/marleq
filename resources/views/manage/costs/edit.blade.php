@extends('layouts.manage')

@section('content')
    <div class="content">
        <h2>Edit Testimonial</h2>
        <hr class="m-t-5">
    </div>

    <div class="columns">
        <div class="column">
            <form action="{{route('costs.update', $cost->id)}}" method="post">
                @method('PUT')
                @csrf

                <div class="columns">
                    <div class="column is-three-quarters">
                        <div class="field">
                            <label class="label"><small>Price:</small></label>
                            <div class="control has-icons-left has-icons-right">
                                <input id="price" type="text" class="input{{ $errors->has('price') ? ' is-danger' : '' }}" name="price" value="{{ old('price', $cost->price) }}" placeholder="Price input" required autofocus>
                                <span class="icon is-small is-left">
                                    <i class="fa fa-euro"></i>
                                </span>
                                @if ($errors->has('price'))
                                    <span class="icon is-small is-right">
                                        <i class="fa fa-exclamation-triangle"></i>
                                    </span>
                                @endif
                            </div>
                            @if ($errors->has('price'))
                                <p class="help is-danger">
                                    <strong>{{ $errors->first('price') }}</strong>
                                </p>
                            @endif
                        </div>

                        <div class="field">
                            <label class="label"><small>What is included:</small></label>
                            <div class="control has-icons-left has-icons-right">
                                <textarea name="description" class="form-control my-editor{{ $errors->has('description') ? ' is-danger' : '' }}">{!! old('description', $cost->description) !!}</textarea>
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

                        <div class="field">
                            <p class="control">
                                <button type="submit" class="button is-marleq">
                            <span class="icon">
                                <i class="fa fa-dollar"></i>
                            </span>
                                    <span>Save Cost</span>
                                </button>
                            </p>
                        </div>
                    </div>

                    <div class="column is-one-quarter">
                        <div class="field">
                            <label class="label"><small>Service:</small></label>
                            <div class="control has-icons-left">
                                <div class="select is-fullwidth">
                                    <select name="service" required autofocus>
                                        @foreach($services as $service)
                                            <option value="{{ $service->id }}" {{ $cost->service_id == $service->id ? 'selected' : '' }}>{{ $service->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <span class="icon is-left">
                                    <i class="fa fa-space-shuttle"></i>
                                </span>
                            </div>
                            @if ($errors->has('service'))
                                <p class="help is-danger">
                                    <strong>{{ $errors->first('service') }}</strong>
                                </p>
                            @endif
                        </div>

                        <div class="field">
                            <label class="label"><small>Level:</small></label>
                            <div class="control has-icons-left">
                                <div class="select is-fullwidth">
                                    <select name="level" required autofocus>
                                        @foreach($levels as $level)
                                            <option value="{{ $level->id }}" {{ $cost->level_id == $level->id ? 'selected' : '' }}>{{ $level->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <span class="icon is-left">
                                    <i class="fa fa-folder"></i>
                                </span>
                            </div>
                            @if ($errors->has('level'))
                                <p class="help is-danger">
                                    <strong>{{ $errors->first('level') }}</strong>
                                </p>
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
                isSwitchedFeatured: '{!! $cost->featured !!}'
            }
        })
    </script>
@endsection