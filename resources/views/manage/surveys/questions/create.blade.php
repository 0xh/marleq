@extends('layouts.manage')

@section('content')
    <div class="content">
        <h2>Create Question</h2>
        <hr class="m-t-5">
    </div>

    <div class="columns">
        <div class="column">
            <form action="{{route('questions.store')}}" method="post">

                @csrf

                <div class="field">
                    <label class="label"><small>Name:</small></label>
                    <div class="control has-icons-left has-icons-right">
                        <input id="name" type="text" class="input{{ $errors->has('name') ? ' is-danger' : '' }}" name="name" value="{{ old('name') }}" placeholder="Question input" required autofocus>
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
                            <select name="survey" required autofocus>
                                @foreach($surveys as $survey)
                                    <option value="{{ $survey->id }}">{{ $survey->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <span class="icon is-left">
                            <i class="fa fa-list-ol"></i>
                        </span>
                    </div>
                    @if ($errors->has('survey'))
                        <p class="help is-danger">
                            <strong>{{ $errors->first('survey') }}</strong>
                        </p>
                    @endif
                </div>

                <div class="field">
                    <p class="control">
                        <button type="submit" class="button is-marleq">
                            <span class="icon">
                                <i class="fa fa-folder"></i>
                            </span>
                            <span>Save Question</span>
                        </button>
                    </p>
                </div>
            </form>
        </div>
    </div>
@endsection