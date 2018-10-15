@extends('layouts/app')

@section('content')

    <section class="hero hero-has-background is-info is-narrow">
        <div class="hero-body">
            <div class="container has-text-left-desktop has-text-centered-mobile">
                <div class="columns">
                    @if($userTo->picture_crop)
                        <div class="column is-narrow">
                            <img src="{{ URL::asset($userTo->picture_crop) }}" alt="" class="is-grayscale m-b-10" style="overflow: hidden; width: 120px; border-radius: 15px;">
                        </div>
                    @endif
                    <div class="column">
                        <h1 class="title">
                            {{ $userTo->name }} {{ $userTo->surname }}
                        </h1>
                        @if($userTo->hasRole('user'))
                            <a class="button is-marleq is-inverted is-small" href="{{ URL::asset($userTo->document) }}" target="_blank">
                                <span class="icon">
                                    <i class="fa fa-file"></i>
                                </span>
                                <span>View CV</span>
                                <span class="icon">
                                    <i class="fa fa-angle-right"></i>
                                </span>
                            </a>
                        @endif
                        @if($userTo->hasRole('coach|country-manager'))
                            <h2 class="subtitle">
                                @if($userTo->level) {{ $userTo->level->name }} @endif
                                @if($userTo->hasRole('country-manager')) @if($userTo->level) & @endif Country Manager @endif from {{ $userTo->country }}
                            </h2>
                        @endif
                        <div class="tags m-t-20">
                            @foreach($userTo->countries as $country)
                                <span class="tag is-small is-white has-text-blue">{{ $country->name }}</span>
                            @endforeach
                        </div>
                    </div>
                    <div class="column has-text-right-desktop has-text-centered-mobile is-narrow">
                        <h1 class="title m-b-50">
                            <small>MESSAGES</small>
                        </h1>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section">
        <div class="container">
            <div class="columns is-centered is-mobile p-t-40 p-b-40">
                <div class="column is-full-mobile is-half-tablet is-two-thirds-desktop">

                    <div class="notification is-marleq m-b-40" v-show="messages.length === 0">
                        No messages...
                    </div>

                    <chat-log-component
                            :messages="messages"
                            :user-id="userId"
                            :user-to-id="userToId"
                            :user="user"
                            :user-to="userTo"
                    ></chat-log-component>

                    <chat-composer-component
                            v-on:messagesent="addMessage"
                            :is-loading="isLoading"
                    ></chat-composer-component>

                    @if ($user->hasRole('coach|country-manager'))
                        <div class="buttons has-addons is-centered m-t-40">
                            <a class="button is-marleq"
                               href="https://www.talkini.com/app/dashboard?guest_email={{ $userTo->email }}"
                               target="_blank">
                                <span class="icon">
                                    <i class="fa fa-video-camera"></i>
                                </span>
                                <span>Schedule a meeting</span>
                                <span class="icon">
                                    <i class="fa fa-arrow-right"></i>
                                </span>
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>

@endsection

@section('scripts')
<!-- receive notifications -->
<script>window.module = {};</script>
<script src="{{ asset('js/echo.js') }}"></script>
{{--<script src="https://js.pusher.com/4.1/pusher.min.js"></script>--}}

<script>
    window.Echo = new Echo({
        broadcaster: 'pusher',
        // key: '2be5b68e5f5a7f6d9ffe',
        key: '83a5d22c1628f7de5da7',
        cluster: 'eu',
        encrypted: true,
    });
</script>
<!-- receive notifications -->
<script>

    const app = new Vue({
        el: '#app',
        data: {
            messages: {!! $messages !!},
            userId: {!! $user->id !!},
            userToId: {!! $userTo->id !!},
            userAlias: '{!! $userTo->alias !!}',
            user: {!! $user !!},
            userTo: {!! $userTo !!},
            isLoading: false
        },
        methods: {
            addMessage(message) {
                messageToSend = {
                    message: message.message,
                    userToId: this.userToId,
                    userAlias: this.userAlias
                };
                this.isLoading = true;
                axios.post('/messages/send', messageToSend).then((message) => {
                    this.messages.push(message.data);
                    this.isLoading = false;
                });
            },
            updateScroll() {
                let element = document.getElementById("chat-window");
                element.scrollTop = element.scrollHeight;
            }
        },
        created() {
            Echo.private('user.{!! $userChannelId !!}')
                .listen('NewMessageNotification', (e) => {
                    this.messages.push(e.message);
                    axios.post('/messages/read', e.message).then((messageRead) => {
                        // console.log(messageRead);
                    });
                });
        },
        mounted() {
            this.updateScroll();
        },
        updated() {
            this.updateScroll();
        }
    });
</script>
@endsection
