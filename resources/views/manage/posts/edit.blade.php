@extends('layouts.manage')

@section('content')
    <div class="content">
        <h2>Edit Post</h2>
        <hr class="m-t-5">
    </div>

    <div class="columns">
        <div class="column">
            <form action="{{route('posts.update', $post->id)}}" method="post" enctype="multipart/form-data">
                @method('PUT')
                @csrf

                <div class="columns">
                    <div class="column is-three-quarters">
                        <div class="field">
                            <label class="label"><small>Title:</small></label>
                            <div class="control has-icons-left has-icons-right">
                                <input id="name" type="text" class="input{{ $errors->has('title') ? ' is-danger' : '' }}"
                                       name="title" value="{{ old('title', $post->title) }}" placeholder="Title input" required autofocus>
                                <span class="icon is-small is-left">
                                    <i class="fa fa-edit"></i>
                                </span>
                                @if ($errors->has('title'))
                                    <span class="icon is-small is-right">
                                        <i class="fa fa-exclamation-triangle"></i>
                                    </span>
                                @endif
                            </div>
                            @if ($errors->has('title'))
                                <p class="help is-danger">
                                    <strong>{{ $errors->first('title') }}</strong>
                                </p>
                            @endif
                        </div>

                        <div class="field">
                            <label class="label"><small>Alias:</small></label>
                            <div class="control has-icons-left has-icons-right">
                                <input id="name" type="text" class="input{{ $errors->has('alias') ? ' is-danger' : '' }}"
                                       name="alias" value="{{ old('alias', $post->alias) }}" placeholder="Auto-generate from title" autofocus>
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

                        <div class="columns">
                            <div class="column">
                                <div class="field">
                                    <label class="label"><small>Intro Image:</small></label>
                                    <div class="file has-name is-marleq">
                                        <label class="file-label">
                                            <input class="file-input" type="file" ref="introimage" name="intro_image" @change="onIntroImageChange">
                                            <span class="file-cta">
                                                <span class="file-icon">
                                                    <i class="fa fa-upload"></i>
                                                </span>
                                                <span class="file-label">
                                                    Upload...
                                                </span>
                                            </span>
                                            <span class="file-name is-narrow" v-if="introImage" v-text="introImage"></span>
                                            <span class="file-name" v-if="!introImage">No image selected...</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="column">
                                <div class="field">
                                    <label class="label"><small>Full Article Image:</small></label>
                                    <div class="file has-name is-marleq">
                                        <label class="file-label">
                                            <input class="file-input" type="file" ref="fullimage" name="full_image" @change="onFullImageChange">
                                            <span class="file-cta">
                                                <span class="file-icon">
                                                    <i class="fa fa-upload"></i>
                                                </span>
                                                <span class="file-label">
                                                    Upload...
                                                </span>
                                            </span>
                                            <span class="file-name" v-if="fullImage" v-text="fullImage"></span>
                                            <span class="file-name" v-if="!fullImage">No image selected...</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="field">
                            <label class="label"><small>Content:</small></label>
                            <div class="control has-icons-left has-icons-right">
                                <textarea id="article_content" type="text" class="textarea{{ $errors->has('article_content') ? ' is-danger' : '' }}"
                                          name="article_content" placeholder="Content input" autofocus>{{ old('article_content', $post->content) }}</textarea>
                                @if ($errors->has('article_content'))
                                    <span class="icon is-small is-right">
                                        <i class="fa fa-exclamation-triangle"></i>
                                    </span>
                                @endif
                            </div>
                            @if ($errors->has('article_content'))
                                <p class="help is-danger">
                                    <strong>{{ $errors->first('article_content') }}</strong>
                                </p>
                            @endif
                        </div>
                        <div class="field">
                            <label class="label"><small>Tags:</small></label>
                            <b-field>
                                <b-taginput
                                        v-model="tags"
                                        :data="filteredTags"
                                        maxtags="10"
                                        autocomplete
                                        :allow-new="allownew"
                                        field="name"
                                        type="is-marleq"
                                        placeholder="Add a tag"
                                @typing="getFilteredTags"
                                @add="addTagId"
                                @remove="removeTagId">
                                </b-taginput>
                            </b-field>
                        </div>
                        <input type="hidden" name="post_tags" :value="postTags">
                    </div>

                    <div class="column is-one-quarter">
                        <div class="field">
                            <label class="label">&nbsp;</label>
                            <p class="control">
                                <button type="submit" class="button is-success is-fullwidth">
                                    <span class="icon">
                                        <i class="fa fa-edit"></i>
                                    </span>
                                    <span>Update Post</span>
                                </button>

                            </p>
                        </div>

                        @if (Auth::user()->hasRole('administrator'))
                            <div class="field">
                                <label class="label"><small>&nbsp;</small></label>
                                <a class="button is-fullwidth {{ $errors->has('user') ? ' is-danger' : 'is-marleq' }}" @click="isUserModalActive = true">
                                    <span>Assign a User</span>
                                    <span class="icon is-small is-right">
                                        <i class="fa fa-user-circle-o"></i>
                                    </span>
                                </a>
                                @if ($errors->has('user'))
                                    <p class="help is-danger">
                                        <strong>{{ $errors->first('user') }}</strong>
                                    </p>
                                @endif
                            </div>
                            <input type="hidden" name="user" :value="user">
                        @endif

                        <div class="field">
                            <label class="label"><small>Status:</small></label>
                            <div class="control has-icons-left">
                                <div class="select is-fullwidth">
                                    <select name="status" required autofocus>
                                        <option value="0" {{ $post->status == 0 ? 'selected' : '' }}>Published</option>
                                        <option value="1" {{ $post->status == 1 ? 'selected' : '' }}>Unpublished</option>
                                    </select>
                                </div>
                                <span class="icon is-left">
                            <i class="fa fa-check-circle"></i>
                          </span>
                            </div>
                            @if ($errors->has('status'))
                                <p class="help is-danger">
                                    <strong>{{ $errors->first('status') }}</strong>
                                </p>
                            @endif
                        </div>

                        <div class="field">
                            <label class="label"><small>Category:</small></label>
                            <div class="control has-icons-left">
                                <div class="select is-fullwidth">
                                    <select name="category" required autofocus>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}" {{ $post->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <span class="icon is-left">
                                    <i class="fa fa-folder"></i>
                                  </span>
                            </div>
                            @if ($errors->has('category'))
                                <p class="help is-danger">
                                    <strong>{{ $errors->first('category') }}</strong>
                                </p>
                            @endif
                        </div>

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
                            <label class="label"><small>Access:</small></label>
                            <b-field>
                                <b-radio-button v-model="radioAccess"
                                                native-value="0"
                                                type="is-marleq">
                                    <span class="icon is-small is-right">
                                        <i class="fa fa-globe"></i>
                                    </span>
                                    <span>Public</span>
                                </b-radio-button>

                                <b-radio-button v-model="radioAccess"
                                                native-value="1"
                                                type="is-warning">
                                    <span class="icon is-small is-right">
                                        <i class="fa fa-user"></i>
                                    </span>
                                    <span>Private</span>
                                </b-radio-button>
                            </b-field>
                        </div>
                            
                        <input type="hidden" name="access" :value="radioAccess">

                        <div class="field">
                            <label class="label"><small>Intro Image:</small></label>
                            <figure class="image">
                                <img class="image" src="{{ URL::asset($post->intro_image) }}">
                            </figure>
                        </div>

                        <div class="field">
                            <label class="label"><small>Full Article Image:</small></label>
                            <figure class="image">
                                <img class="image" src="{{ URL::asset($post->full_image) }}">
                            </figure>
                        </div>

                    </div>
                </div>

                <div class="modal" :class="{ 'is-active': isUserModalActive }">
                    <div class="modal-background" @click="isUserModalActive = false"></div>
                    <div class="modal-card" style="width: auto">
                        <header class="modal-card-head">
                            <p class="modal-card-title">Assign a User</p>
                        </header>
                        <section class="modal-card-body">
                            <b-field>
                                <b-input placeholder="Search..."
                                         type="search"
                                         icon-pack="fa"
                                         icon="search"
                                         :loading="isLoading"
                                         v-model="searchTxt">
                                </b-input>
                            </b-field>
                            <div v-for="userInfo in userSearch">
                                <b-field>
                                    <b-radio :native-value="userInfo.id" v-model="selectedUser">@{{ userInfo.name }}</b-radio>
                                </b-field>
                            </div>
                            <div v-for="userInfo in users" v-if="searchTxt == ''">
                                <b-field>
                                    <b-radio :native-value="userInfo.id" v-model="selectedUser">@{{ userInfo.name }}</b-radio>
                                </b-field>
                            </div>
                        </section>
                        <footer class="modal-card-foot">
                            <a class="button" type="button" @click="isUserModalActive = false">Close</a>
                            <a class="button is-marleq" @click="saveUser">Save</a>
                        </footer>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection

@section('scripts')
    <script>
        const data = {!! $tags !!};
        let app = new Vue({
            el: '#app',
            data: {
                user: {!! $userId !!},
                users: {!! $users !!},
                isUserModalActive: false,
                userSearch: this.users,
                searchTxt: '',
                isLoading: false,
                selectedUser: {!! $userId !!},
                isSwitchedFeatured: '{!! $post->featured !!}',
                radioAccess: '{!! $post->access !!}',
                introImage: '',
                fullImage: '',
                filteredTags: data,
                isSelectOnly: false,
                tags: {!! $post->tags !!},
                postTags: {!! $post->tags->pluck('id') !!},
                allownew: false
            },
            methods: {
                getFilteredTags(text) {
                    this.filteredTags = data.filter((option) => {
                        return option.name
                                .toString()
                                .toLowerCase()
                                .indexOf(text.toLowerCase()) >= 0
                    })
                },
                addTagId(option) {
                    this.postTags.push(option.id);
                },
                removeTagId(option) {
                    let index = this.postTags.indexOf(option.id);
                    this.postTags.splice(index, 1);
                },
                cardModal() {
                    this.$modal.open({
                        parent: this,
                        component: ModalForm,
                        hasModalCard: true
                    })
                },
                saveUser() {
                    this.user = this.selectedUser;
                    this.isUserModalActive = false;
                },
                onIntroImageChange(file) {
                    if (!file.target.files[0].name.match(/.(jpg|jpeg|png|gif)$/i)) {
                        console.warn('not an image');
                        file.target.value = null;
                        this.$emit('imageChanged', null);
                        return;
                    }
                    this.introImage = this.$refs.introimage.files[0].name;
                },
                onFullImageChange(file) {
                    if (!file.target.files[0].name.match(/.(jpg|jpeg|png|gif)$/i)) {
                        console.warn('not an image');
                        file.target.value = null;
                        this.$emit('imageChanged', null);
                        return;
                    }
                    this.fullImage = this.$refs.fullimage.files[0].name;
                },
            },
            watch: {
                searchTxt: _.debounce(function () {
                    let thisModal = this;
                    this.userSearch = [];
                    this.isLoading = true;
                    this.users.find(function(element) {
                        if(element.name.toLowerCase().search(thisModal.searchTxt.toLowerCase()) > -1) {
                            thisModal.userSearch.push(element)
                        }
                    });
                    this.isLoading = false
                }, 1000)
            },
        })
    </script>
@endsection