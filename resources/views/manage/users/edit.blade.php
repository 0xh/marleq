@extends('layouts.manage')

@section('content')
    <div class="content">
        <h2>Edit User</h2>
        <hr class="m-t-5">
    </div>

    <div class="columns">
        <div class="column">
            <form action="{{route('users.update', $user->id)}}" method="post" enctype="multipart/form-data">
                @method('PUT')
                @csrf

                <div class="columns is-multiline">
                    <div class="column is-half">
                        <div class="field">
                            <figure class="media-left">
                                <p class="image" style="overflow: hidden; width: 193.7px;">
                                    <img src="{{ URL::asset($user->picture_crop) }}" alt="" style="image-rendering: crisp-edges;">
                                </p>
                            </figure>
                        </div>
                        <div class="field">
                            <div class="file has-name">
                                <label class="file-label">
                                    <input class="file-input" type="file" ref="image" name="picture" @change="onPictureChange">
                                    <span class="file-cta">
                                        <span class="file-icon">
                                            <i class="fa fa-upload"></i>
                                        </span>
                                        <span class="file-label">
                                            Choose a picture…
                                        </span>
                                    </span>
                                    <span class="file-name" v-if="picture" v-text="picture"></span>
                                </label>
                            </div>
                        </div>

                        <input type="hidden" name="picture_crop" :value="cropped" v-if="isCropped">

                        <div class="field">
                            <label class="label"><small>First name:</small></label>
                            <div class="control has-icons-left has-icons-right">
                                <input id="name" type="text" class="input{{ $errors->has('name') ? ' is-danger' : '' }}"
                                       name="name" value="{{ old('name', $user->name) }}" placeholder="First name input" required autofocus>
                                <span class="icon is-small is-left">
                                    <i class="fa fa-user"></i>
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
                            <label class="label"><small>Last name:</small></label>
                            <div class="control has-icons-left has-icons-right">
                                <input id="surname" type="text" class="input{{ $errors->has('surname') ? ' is-danger' : '' }}"
                                       name="surname" value="{{ old('surname', $user->surname) }}" placeholder="Last name input" required autofocus>
                                <span class="icon is-small is-left">
                                    <i class="fa fa-user"></i>
                                </span>
                                @if ($errors->has('surname'))
                                    <span class="icon is-small is-right">
                                        <i class="fa fa-exclamation-triangle"></i>
                                    </span>
                                @endif
                            </div>
                            @if ($errors->has('surname'))
                                <p class="help is-danger">
                                    <strong>{{ $errors->first('surname') }}</strong>
                                </p>
                            @endif
                        </div>

                        <div class="field">
                            <label class="label"><small>Alias:</small></label>
                            <div class="control has-icons-left has-icons-right">
                                <input id="alias" type="text" class="input{{ $errors->has('alias') ? ' is-danger' : '' }}"
                                       name="alias" value="{{ old('alias', $user->alias) }}" placeholder="Name input" required autofocus>
                                <span class="icon is-small is-left">
                                    <i class="fa fa-user"></i>
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
                            <label class="label"><small>Title:</small></label>
                            <div class="control has-icons-left has-icons-right">
                                <input id="title" type="text" class="input{{ $errors->has('title') ? ' is-danger' : '' }}"
                                       name="title" value="{{ old('title', $user->title) }}" placeholder="Name input" required autofocus>
                                <span class="icon is-small is-left">
                                    <i class="fa fa-user"></i>
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
                            <label class="label"><small>Email:</small></label>
                            <div class="control has-icons-left has-icons-right">
                                <input id="email" type="email" class="input{{ $errors->has('email') ? ' is-danger' : '' }}"
                                       name="email" value="{{ $user->email }}" placeholder="Email input" required autofocus>
                                <span class="icon is-small is-left">
                                    <i class="fa fa-envelope"></i>
                                </span>
                                @if ($errors->has('email'))
                                    <span class="icon is-small is-right">
                                        <i class="fa fa-exclamation-triangle"></i>
                                    </span>
                                @endif
                            </div>
                            @if ($errors->has('email'))
                                <p class="help is-danger">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </p>
                            @endif
                        </div>

                        <div class="field">
                            <label class="label"><small>Biography:</small></label>
                            <div class="control has-icons-left has-icons-right">
                                <textarea name="biography" class="form-control my-editor{{ $errors->has('biography') ? ' is-danger' : '' }}">{!! old('biography', $user->biography) !!}</textarea>
                                @if ($errors->has('biography'))
                                    <span class="icon is-small is-right">
                                        <i class="fa fa-exclamation-triangle"></i>
                                    </span>
                                @endif
                            </div>
                            @if ($errors->has('biography'))
                                <p class="help is-danger">
                                    <strong>{{ $errors->first('biography') }}</strong>
                                </p>
                            @endif
                        </div>

                        <div class="field">
                            <div class="file has-name">
                                <label class="file-label">
                                    <input class="file-input" type="file" ref="doc" name="document" @change="onDocumentChange">
                                    <span class="file-cta">
                                        <span class="file-icon">
                                            <i class="fa fa-upload"></i>
                                        </span>
                                        <span class="file-label">
                                            Choose a document…
                                        </span>
                                    </span>
                                    <span class="file-name" v-if="document" v-text="document"></span>
                                    <span class="file-name" v-if="!document">
                                        <small>
                                            <a href="{{ URL::asset($user->document) }}" target="_blank">
                                                <span class="icon">
                                                    <i class="fa fa-file"></i>
                                                </span>
                                                <span>View CV</span>
                                                <span class="icon">
                                                    <i class="fa fa-angle-double-right"></i>
                                                </span>
                                            </a>
                                        </small>
                                    </span>
                                </label>
                            </div>
                        </div>

                        <div class="field">
                            <h1 class="subtitle m-t-20 m-b-10">Languages:</h1>
                            <b-field>
                                <b-taginput
                                        v-model="langtags"
                                        :data="filteredLanguageTags"
                                        maxtags="10"
                                        autocomplete
                                        :allow-new="allownew"
                                        field="name"
                                        type="is-marleq"
                                        placeholder="Add a language"
                                @typing="getFilteredLanguageTags"
                                @add="addLanguageTagId"
                                @remove="removeLanguageTagId">
                                </b-taginput>
                            </b-field>
                            @if ($errors->has('language'))
                                <p class="help is-danger">
                                    <strong>{{ $errors->first('language') }}</strong>
                                </p>
                            @endif
                        </div>

                        <input type="hidden" name="language" :value="languages">

                        <div class="field">
                            <h1 class="subtitle m-t-20 m-b-10">Countries:</h1>
                                <b-field>
                                    <b-taginput
                                            v-model="tags"
                                            :data="filteredTags"
                                            maxtags="10"
                                            autocomplete
                                            :allow-new="allownew"
                                            field="name"
                                            type="is-marleq"
                                            placeholder="Add a country"
                                            @typing="getFilteredTags"
                                            @add="addTagId"
                                            @remove="removeTagId">
                                    </b-taginput>
                                </b-field>
                            @if ($errors->has('countries'))
                                <p class="help is-danger">
                                    <strong>{{ $errors->first('countries') }}</strong>
                                </p>
                            @endif
                        </div>

                        <input type="hidden" name="countries" :value="countries">

                        <div class="field">
                            <h1 class="subtitle m-t-20 m-b-10">Certification:</h1>
                                <b-field>
                                    <b-taginput
                                            v-model="certification"
                                            maxtags="10"
                                            type="is-marleq"
                                            placeholder="Add a certificate">
                                    </b-taginput>
                                </b-field>
                            @if ($errors->has('certification'))
                                <p class="help is-danger">
                                    <strong>{{ $errors->first('certification') }}</strong>
                                </p>
                            @endif
                        </div>

                        <input type="hidden" name="certification" :value="certification">

                        <div class="field">
                            <h1 class="subtitle m-t-20 m-b-10">Services:</h1>
                            <ul class="specialty-col">
                                @foreach($services as $service)
                                    <li><b-checkbox class="m-r-10" native-value="{{ $service->id }}" v-model="services">{{ $service->name }}</b-checkbox></li>
                                @endforeach
                            </ul>
                        </div>

                        <input type="hidden" name="services" :value="services">

                        <div class="field">
                            <h1 class="subtitle m-t-20 m-b-10">Specialties:</h1>
                            <ul class="specialty-col">
                                @foreach($specialties as $specialty)
                                    <li><b-checkbox class="m-r-10" native-value="{{ $specialty->id }}" v-model="specialties">{{ $specialty->name }}</b-checkbox></li>
                                @endforeach
                            </ul>
                        </div>

                        <input type="hidden" name="specialties" :value="specialties">

                    </div>

                    <div class="column is-half">
                        <div class="card p-b-15 p-t-10" style="-webkit-border-radius: 3px;-moz-border-radius: 3px;border-radius: 3px;">
                            <div class="column is-full">
                                <vue-croppie ref="croppieref" :enable-resize="false" :viewport="{ width: 400, height: 400, type: 'square' }" @result="result" @update="update"></vue-croppie>
                            </div>
                            <div class="column is-full has-text-centered">
                                {{--<img :src="cropped" alt="" class="rounded mx-auto d-block img-thumbnail">--}}
                                <b-tooltip :type="tooltipType" label="Please Crop the Image before Updating the Profile!" animated :always="isTooltip">
                                    <a class="button" @click="isCropped = true; crop()" :class="{ 'is-success': isCropped, 'is-marleq': !isCropped }" :disabled="isCropped">
                                        <span class="icon">
                                            <i class="fa fa-crop"></i>
                                        </span>
                                        <span>Crop Image</span>
                                    </a>
                                </b-tooltip>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="field">
                    <label class="label"><small>Level:</small></label>
                    <div class="control has-icons-left">
                        <div class="select">
                            <select name="level" required autofocus>
                                <option value="-1"{{ $user->level_id == '' ? 'selected' : '' }}></option>
                                @foreach($levels as $level)
                                    <option value="{{ $level->id }}" {{ $user->level_id == $level->id ? 'selected' : '' }}>{{ $level->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <span class="icon is-left">
                            <i class="fa fa-bars"></i>
                        </span>
                    </div>
                    @if ($errors->has('level'))
                        <p class="help is-danger">
                            <strong>{{ $errors->first('level') }}</strong>
                        </p>
                    @endif
                </div>

                <div class="field">
                    <label class="label"><small>Country:</small></label>
                    <div class="control has-icons-left">
                        <div class="select">
                            <select name="country" required autofocus>
                                @foreach($countries as $country)
                                    <option value="{{ $country->name }}" {{ $user->country == $country->name ? 'selected' : '' }}>{{ $country->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <span class="icon is-left">
                            <i class="fa fa-bars"></i>
                        </span>
                    </div>
                    @if ($errors->has('country'))
                        <p class="help is-danger">
                            <strong>{{ $errors->first('country') }}</strong>
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
                    <label class="label"><small>Status:</small></label>
                    <div class="control has-icons-left">
                        <div class="select">
                            <select name="status" required autofocus>
                                <option value="1" {{ $user->status == 1 ? 'selected' : '' }}>Published</option>
                                <option value="0" {{ $user->status == 0 ? 'selected' : '' }}>Unpublished</option>
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
                    <h1 class="subtitle m-t-20 m-b-10">Password:</h1>
                    <div class="field">
                        <b-radio name="passwordOptions" type="is-marleq" native-value="keep" v-model="passwordOptions">Do Not Change Password</b-radio>
                    </div>
                    <div class="field">
                        <b-radio name="passwordOptions" type="is-marleq" native-value="auto" v-model="passwordOptions">Auto-Generate Password</b-radio>
                    </div>
                    <div class="field">
                        <b-radio name="passwordOptions" type="is-marleq" native-value="manual" v-model="passwordOptions">Manually Set New Password</b-radio>
                    </div>
                </div>

                <div class="field" v-if="passwordOptions == 'manual'">
                    <p class="control has-icons-left">
                        <input id="password" type="password" class="input{{ $errors->has('password') ? ' is-danger' : '' }}" name="password" placeholder="Password" required>
                        <span class="icon is-small is-left">
                            <i class="fa fa-lock"></i>
                        </span>
                    </p>
                    @if ($errors->has('password'))
                        <p class="help is-danger">
                            <strong>{{ $errors->first('password') }}</strong>
                        </p>
                    @endif
                </div>

                <h1 class="subtitle m-t-20 m-b-10">Roles:</h1>
                <ul class="m-b-30">
                    @foreach($roles as $role)
                        <li class="m-b-10">
                            <b-checkbox class="m-r-10" type="is-marleq" native-value="{{ $role->id }}" v-model="roles">{{ $role->display_name }} <em class="m-l-15"><small>{{ $role->description }}</small></em></b-checkbox>
                        </li>
                    @endforeach
                </ul>

                <input type="hidden" name="roles" :value="roles">

                <div class="field m-t-30">
                    <p class="control">
                        <button type="submit" class="button is-marleq">
                            <span class="icon">
                                <i class="fa fa-edit"></i>
                            </span>
                            <span>Edit User</span>
                        </button>
                    </p>
                </div>
            </form>
        </div>
    </div>

@endsection

@section('scripts')
    <script>
        const data = {!! $countries !!};
        const datalang = {!! $languages !!};
        const app = new Vue({
            el: "#app",
            mounted() {
                // Upon mounting of the component, we accessed the .bind({...})
                // function to put an initial image on the canvas.
                this.$refs.croppieref.bind({
                    url: '{!! URL::asset($user->picture) !!}',
                });
                setTimeout(() => {
                    this.crop();
                }, 1000);
            },
            data: {
                picture: '',
                document: '',
                passwordOptions: 'keep',
                roles: {!! $user->roles->pluck('id') !!},
                specialties: {!!$user->specialties->pluck('id')!!},
                services: {!!$user->services->pluck('id')!!},
                cropped: null,
                isCropped: false,
                isTooltip: false,
                tooltipType: 'is-marleq',
                showCroppie: false,
                filteredTags: data,
                filteredLanguageTags: datalang,
                isSelectOnly: false,
                tags: {!! $user->countries !!},
                langtags: {!! $user->languages !!},
                countries: {!! $user->countries->pluck('id') !!},
                languages: {!! $user->languages->pluck('id') !!},
                certification: {!! $certification !!},
                allownew: false,
                isSwitchedFeatured: '{!! $user->featured !!}',
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
                    this.countries.push(option.id);
                },
                removeTagId(option) {
                    let index = this.countries.indexOf(option.id);
                    this.countries.splice(index, 1);
                },
                getFilteredLanguageTags(text) {
                    this.filteredLanguageTags = datalang.filter((option) => {
                        return option.name
                                .toString()
                                .toLowerCase()
                                .indexOf(text.toLowerCase()) >= 0
                    })
                },
                addLanguageTagId(option) {
                    this.languages.push(option.id);
                },
                removeLanguageTagId(option) {
                    let index = this.languages.indexOf(option.id);
                    this.languages.splice(index, 1);
                },
                success() {
                    this.$toast.open({
                        duration: 3000,
                        message: 'Image crop was Successful!',
                        type: 'is-success',
                        position: 'is-bottom'
                    })
                },
                onDocumentChange() {
                    this.document = this.$refs.doc.files[0].name;
                },
                onPictureChange(file) {
                    if (!file.target.files[0].name.match(/.(jpg|jpeg|png|gif)$/i)) {
                        console.warn('not an image');
                        file.target.value = null;
                        this.$emit('imageChanged', null);
                        return;
                    }
                    this.isCropped = false;
                    this.isTooltip = true;
                    this.tooltipType = 'is-warning';
                    this.picture = this.$refs.image.files[0].name;
                    let reader = new FileReader();
                    reader.readAsDataURL(file.target.files[0]);
                    reader.onload = () => {
                        this.dialog = true;
                        // bind the result of the file to croppie
                        this.$refs.croppieref.bind({
                            url: reader.result,
                        });
//                        file.target.value = null
                    };
                    reader.onerror = (error) => {
                        console.log('Error: ', error);
                    };
                },
                bind() {
                    let url = this.picture;
                    this.$refs.croppieRef.bind({
                        url: url,
                    });
                },
                crop() {
                    // Here we are getting the result via callback function
                    // and set the result to this.cropped which is being
                    // used to display the result above.
                    let options = {
                        format: 'jpeg'
                    };
                    this.$refs.croppieref.result(options, (output) => {
                        this.cropped = output;
                    });
                    if(this.isCropped === true) {
                        this.success();
                        this.isTooltip = false;
                        this.tooltipType = 'is-marleq';
                    }
                },
                result(output) {
                    this.cropped = output;
                },
                update(val) {
                    this.isCropped = false;
                }
            }
        })
    </script>

@endsection