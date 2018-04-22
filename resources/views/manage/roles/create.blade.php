@extends('layouts.manage')

@section('content')
    <div class="content">
        <h2>Create New Role</h2>
        <hr class="m-t-5">
    </div>

    <div class="columns">
        <div class="column">
            <form action="{{route('roles.store')}}" method="post">

                @csrf

                <div class="field">
                    <label class="label"><small>Name:</small></label>
                    <div class="control has-icons-right">
                        <input id="display_name" type="text" class="input{{ $errors->has('display_name') ? ' is-danger' : '' }}" name="display_name" value="{{ old('display_name') }}" placeholder="e.g Create Elections" required autofocus>
                        @if ($errors->has('display_name'))
                            <span class="icon is-small is-right">
                                <i class="fa fa-exclamation-triangle"></i>
                            </span>
                        @endif
                    </div>
                    @if ($errors->has('display_name'))
                        <p class="help is-danger">
                            <strong>{{ $errors->first('display_name') }}</strong>
                        </p>
                    @endif
                </div>

                <div class="field">
                    <label class="label"><small>Slug:</small></label>
                    <div class="control has-icons-right">
                        <input id="name" type="text" class="input" name="name" value="{{ old('name') }}" placeholder="e.g create-elections" required autofocus>
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
                    <label class="label"><small>Description:</small></label>
                    <div class="control">
                        <input id="description" type="text" class="input" name="description" value="{{ old('description') }}" placeholder="Description input" required autofocus>
                    </div>
                </div>

                <h1 class="subtitle m-t-20 m-b-10">Permissions:</h1>
                <ul class="m-b-30">
                    @foreach($permissions as $permission)
                        <li class="m-b-10">
                            <b-checkbox class="m-r-10" native-value="{{ $permission->id }}" v-model="permissions">{{ $permission->display_name }} <em class="m-l-15"><small>{{ $permission->description }}</small></em></b-checkbox>
                        </li>
                    @endforeach
                </ul>
                <input type="hidden" name="permissions" :value="permissions">

                <div class="field">
                    <p class="control">
                        <button type="submit" class="button is-primary">
                            <span>Create Role</span>
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
                permissions: []
            }
        })
    </script>
@endsection