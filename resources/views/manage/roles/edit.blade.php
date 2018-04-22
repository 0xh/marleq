@extends('layouts.manage')

@section('content')
    <div class="content">
        <h2>Edit Role</h2>
        <hr class="m-t-5">
    </div>

    <div class="columns">
        <div class="column">
            <form action="{{route('roles.update', $role->id)}}" method="post">
                @method('PUT')
                @csrf

                <div class="field">
                    <label class="label"><small>Name:</small></label>
                    <div class="control has-icons-right">
                        <input id="display_name" type="text" class="input{{ $errors->has('display_name') ? ' is-danger' : '' }}" name="display_name" value="{{ $role->display_name }}" placeholder="e.g Create Elections" required autofocus>
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
                        <input id="name" type="text" class="input" value="{{ $role->name }}" disabled>
                    </div>
                </div>

                <div class="field">
                    <label class="label"><small>Description:</small></label>
                    <div class="control">
                        <input id="description" type="text" class="input" name="description" value="{{ $role->description }}" placeholder="Description input" required autofocus>
                    </div>
                </div>

                <h1 class="subtitle m-t-20 m-b-10">Permissions:</h1>
                <ul class="m-b-30">
                    @foreach($permissions as $permission)
                        <li class="m-b-10">
                            <label class="checkbox">
                                <b-checkbox class="m-r-10" native-value="{{ $permission->id }}" v-model="permissions">
                                {{ $permission->display_name }} <em class="m-l-15"><small>{{ $permission->description }}</small></em>
                            </label>
                        </li>
                    @endforeach
                </ul>
                <input type="hidden" name="permissions" :value="permissions">

                <div class="field">
                    <p class="control">
                        <button type="submit" class="button is-primary">
                            <span>Edit Role</span>
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
                permissions: {!!$role->permissions->pluck('id')!!}
            }
        })
    </script>
@endsection