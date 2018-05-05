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
                            <label class="label"><small>Name:</small></label>
                            <div class="control has-icons-left has-icons-right">
                                <input id="name" type="text" class="input{{ $errors->has('name') ? ' is-danger' : '' }}"
                                       name="name" value="{{ $user->name }}" placeholder="Name input" required autofocus>
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
                                            placeholder="Add a tag"
                                            @typing="getFilteredTags"
                                            @add="addTagId"
                                            @remove="removeTagId">
                                    </b-taginput>
                                </b-field>
                        </div>

                        <input type="hidden" name="countries" :value="countries">

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
                isSelectOnly: false,
                tags: {!! $user->countries !!},
                countries: {!! $user->countries->pluck('id') !!},
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
                    this.countries.push(option.id);
                },
                removeTagId(option) {
                    let index = this.countries.indexOf(option.id);
                    this.countries.splice(index, 1);
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