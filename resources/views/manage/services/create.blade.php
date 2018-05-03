@extends('layouts.manage')

@section('content')
    <div class="content">
        <h2>Create Service</h2>
        <hr class="m-t-5">
    </div>

    <div class="columns">
        <div class="column">
            <form action="{{route('services.store')}}" method="post">

                @csrf

                <div class="field">
                    <label class="label"><small>Name:</small></label>
                    <div class="control has-icons-left has-icons-right">
                        <input id="name" type="text" class="input{{ $errors->has('name') ? ' is-danger' : '' }}" name="name" value="{{ old('name') }}" placeholder="Name input" required autofocus>
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
                    <p class="control">
                        <button type="submit" class="button is-marleq">
                            <span class="icon">
                                <i class="fa fa-space-shuttle"></i>
                            </span>
                            <span>Save Service</span>
                        </button>
                    </p>
                </div>
            </form>
        </div>
    </div>
@endsection