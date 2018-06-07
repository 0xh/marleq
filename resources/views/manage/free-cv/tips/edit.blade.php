@extends('layouts.manage')

@section('content')
    <div class="content">
        <h2>Edit Tip</h2>
        <hr class="m-t-5">
    </div>

    <div class="columns">
        <div class="column">
            <form action="{{route('tips.update', $tip->id)}}" method="post">
                @method('PUT')
                @csrf

                <div class="field">
                    <label class="label"><small>Name:</small></label>
                    <div class="control has-icons-left has-icons-right">
                        <input id="name" type="text" class="input{{ $errors->has('name') ? ' is-danger' : '' }}" name="name" value="{{ $tip->content }}" placeholder="Name input" required autofocus>
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
                    <label class="label"><small>Survey:</small></label>
                    <div class="control has-icons-left">
                        <div class="select is-fullwidth">
                            <select name="type" required autofocus>
                                @foreach($types as $type)
                                    <option value="{{ $type->id }}" {{ $tip->tip_type_id == $type->id ? 'selected' : '' }}>{{ $type->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <span class="icon is-left">
                            <i class="fa fa-tags"></i>
                        </span>
                    </div>
                    @if ($errors->has('type'))
                        <p class="help is-danger">
                            <strong>{{ $errors->first('type') }}</strong>
                        </p>
                    @endif
                </div>

                <div class="field m-t-30">
                    <p class="control">
                        <button type="submit" class="button is-marleq">
                            <span class="icon">
                                <i class="fa fa-edit"></i>
                            </span>
                            <span>Update Tip</span>
                        </button>
                    </p>
                </div>
            </form>
        </div>
    </div>

@endsection