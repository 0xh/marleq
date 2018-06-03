@extends('layouts.manage')

@section('content')
    <!-- Main container -->
    <nav class="level is-info">
        <!-- Left side -->
        <div class="level-left">
            <p class="title">Manage Free CVs</p>
        </div>

        <!-- Right side -->
        <div class="level-right">
        </div>
    </nav>
    <hr class="m-t-5 m-b-30">
    <table class="table is-fullwidth is-striped is-hoverable is-narrow">
        <thead>
        <tr>
            <th></th>
            <th></th>
            <th>User</th>
            <th>Coach</th>
            <th>Rating</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @foreach($resumes as $resume)
            <tr>
                <td class="is-narrow">
                    <div class="field has-addons">
                        <p class="control">
                            <a class="is-small">
                                @if($resume->status == 0)
                                    <span class="icon is-small has-text-grey">
                                        <i class="fa fa-times"></i>
                                    </span>
                                @else
                                    <span class="icon is-small has-text-success">
                                        <i class="fa fa-check"></i>
                                    </span>
                                @endif
                            </a>
                        </p>
                    </div>
                </td>
                <td class="is-narrow">
                    <small>
                        <a href="{{ URL::asset($resume->document) }}" target="_blank">
                            <span class="icon">
                                <i class="fa fa-file"></i>
                            </span>
                            <span>View CV</span>
                        </a>
                    </small>
                </td>
                <td><small><strong><a href="{{ route('users.show', $resume->user_id) }}">{{ $resume->user->name }} {{$resume->user->surname}}</a></strong></small></td>
                <td>
                    @if($resume->coach_id)
                        <small><strong><a href="{{ route('users.show', $resume->coach_id) }}">{{ $resume->coach->name }} {{$resume->coach->surname}}</a></strong></small>
                    @endif
                </td>
                <td><small>{{ $resume->rating }}</small></td>
                <td class="has-text-right">
                    <a href="{{route('resumes.show', $resume->id)}}" class="button is-success is-small">
                        <span class="icon">
                            <i class="fa fa-id-card"></i>
                        </span>
                        <span>Show Request</span>
                    </a>
                    <a href="{{route('resumes.edit', $resume->id)}}" class="button is-marleq is-small">
                        <span class="icon">
                            <i class="fa fa-edit"></i>
                        </span>
                        <span>Edit</span>
                    </a>
                    <a class="button is-danger is-small" @click="deleteResume({{$resume->id}})">
                        <span class="icon">
                            <i class="fa fa-times"></i>
                        </span>
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{$resumes->links()}}
@endsection

@section('scripts')
    <script>
        let app = new Vue({
            el: '#app',
            data: {},
            methods: {
                deleteResume: function(id) {
                    let app = this;
                    axios.delete('/manage/resumes/' + id)
                        .then(function (response) {
                            location.reload()
                        })
                        .catch(function(){
                            console.log('Resume could not be deleted!')
                        })
                }
            }
        })
    </script>
@endsection