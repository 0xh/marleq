@extends('layouts.manage')

@section('content')
    <!-- Main container -->
    <nav class="level is-info">
        <!-- Left side -->
        <div class="level-left">
            <p class="title">Manage Posts</p>
        </div>

        <!-- Right side -->
        <div class="level-right">
            <div class="level-item">
                <a class="button is-success" href="{{route('posts.create')}}">
                    <span class="icon">
                        <i class="fa fa-plus-square"></i>
                    </span>
                    <span>New Post</span>
                </a>
            </div>
        </div>
    </nav>
    <hr class="m-t-5 m-b-30">
    <table class="table is-fullwidth is-striped is-hoverable is-narrow">
        <thead>
        <tr>
            <th><small>Status</small></th>
            <th><small>Title</small></th>
            <th><small>Images</small></th>
            <th><small>Author</small></th>
            <th><small>Date Created</small></th>
            <th><small>Hits</small></th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @foreach($posts as $post)
            <tr>
                <td>
                    <div class="field has-addons">
                        <p class="control">
                            <a class="button is-small">
                                @if($post->status == 1)
                                    <span class="icon is-small has-text-danger">
                                        <i class="fa fa-times"></i>
                                    </span>
                                @else
                                    <span class="icon is-small has-text-success">
                                        <i class="fa fa-check"></i>
                                    </span>
                                @endif
                            </a>
                        </p>
                        <p class="control">
                            <a class="button is-small">
                                <span class="icon is-small">
                                    @if($post->featured == 0)
                                        <span class="icon is-small">
                                            <i class="fa fa-star"></i>
                                        </span>
                                    @else
                                        <span class="icon is-small has-text-warning">
                                            <i class="fa fa-star"></i>
                                        </span>
                                    @endif
                                </span>
                            </a>
                        </p>
                    </div>
                </td>
                <td>
                    <a href="{{route('posts.edit', $post->id)}}"><small>{{$post->title}}</small></a><br />
                    <p class="has-text-weight-normal" style="font-size: 11px;">
                        (Alias: {{ $post->alias }})<br />
                        Category: {{ $post->category->name }}
                    </p>
                </td>
                <td>
                    @if($post->intro_image != '')
                        <span class="icon">
                            <i class="fa fa-image"></i>
                        </span>
                    @endif
                    @if($post->full_image != '')
                        <span class="icon">
                            <i class="fa fa-image"></i>
                        </span>
                    @endif
                </td>
                <td>
                    <a href="{{route('users.show', $post->user_id)}}">
                        <small>{{ $post->user->name }}</small>
                    </a>
                </td>
                <td>
                    <small>{{$post->created_at->format('j. M, Y.')}}</small>
                </td>
                <td>
                    <span class="tag is-marleq">{{ $post->hits }}</span>
                </td>
                <td class="has-text-right">
                    <a class="button is-danger is-small" @click="deletePost({{$post->id}})">
                        <span class="icon">
                            <i class="fa fa-times"></i>
                        </span>
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{$posts->links()}}
@endsection

@section('scripts')
    <script>
        let app = new Vue({
            el: '#app',
            data: {},
            methods: {
                deletePost: function(id) {
                    let app = this;
                    axios.delete('/manage/posts/' + id)
                        .then(function (response) {
                            location.reload()
                        })
                        .catch(function(){
                            console.log('Post could not be deleted!')
                        })
                }
            }
        })
    </script>
@endsection