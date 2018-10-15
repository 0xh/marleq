<nav class="container navbar is-transparent p-t-10 p-b-10">
    <div class="navbar-brand p-r-10">
        <a class="navbar-item" href="{{ url('/') }}">
            <img src="{{ URL::asset('images/marleq-logo-color.svg') }}" />
        </a>
        <a role="button" class="navbar-burger" data-target="navMenu" aria-label="menu" aria-expanded="false">
            <span aria-hidden="true"></span>
            <span aria-hidden="true"></span>
            <span aria-hidden="true"></span>
        </a>
    </div>

    <div class="navbar-menu" id="navMenu">
        <div class="navbar-start">
            <a class="navbar-item" href="{{ url('/find-a-coach') }}">
                Find a Coach
            </a>
            <a class="navbar-item" href="{{ url('/services') }}">
                Services
            </a>
            <a class="navbar-item" href="{{ url('/inspiration') }}">
                Inspiration
            </a>
            <a class="navbar-item" href="{{ url('/events') }}">
                Events
            </a>
            <a class="navbar-item" href="{{ url('/about-us') }}">
                About Us
            </a>
        </div>

        <div class="navbar-end">
            <div class="navbar-item">
                <div class="field is-grouped">
                    @if (Auth::guest())
                        <p class="control">
                            <a class="button is-marleq-dark" href="{{ route('register-coach')}}">
                                <span class="icon">
                                    <i class="fa fa-address-card"></i>
                                </span>
                                <span>Become a Coach</span>
                            </a>
                            <a class="button is-marleq" href="{{ route('register')}}">
                                <span class="icon">
                                    <i class="fa fa-user"></i>
                                </span>
                                <span>Sign up</span>
                            </a>
                            <a class="button is-light" href="{{ route('login')}}">
                                <span class="icon">
                                    <i class="fa fa-sign-in"></i>
                                </span>
                                <span>Login</span>
                            </a>
                        </p>
                    @endif
                    @if (Auth::user())
                        <div class="navbar-item has-dropdown is-hoverable">
                            @if(Auth::user()->free_cv == 2)
                                <b-tooltip label="Your CV review is ready!" type="is-success" position="is-left" always>
                                    <a class="navbar-link">
                                        {{ Auth::user()->name }} {{ Auth::user()->surname }}
                                    </a>
                                </b-tooltip>
                            @else
                                <a class="navbar-link">
                                    {{ Auth::user()->name }} {{ Auth::user()->surname }}
                                </a>
                            @endif

                            <div class="navbar-dropdown is-right">
                                @if(Auth::user()->hasRole('user|coach|country-manager'))
                                    @if(Auth::user()->free_cv >= 2)
                                        <a class="navbar-item" href="{{ route('free-cv.index') }}">
                                            <span class="icon">
                                                <i class="fa fa-clipboard"></i>
                                            </span>
                                            <span>CV Review</span>
                                        </a>
                                    @endif
                                    <a class="navbar-item" href="{{ route('user') }}">
                                        <span class="icon">
                                            <i class="fa fa-user-circle"></i>
                                        </span>
                                        <span>Profile</span>
                                    </a>
                                    <a class="navbar-item" href="{{ route('messages') }}">
                                    <span class="icon">
                                        <i class="fa fa-comments"></i>
                                    </span>
                                        <span>Messages</span>
                                    </a>
                                @endif
                                @if(Auth::user()->hasRole('superadministrator|administrator'))
                                    <a class="navbar-item" href="{{ route('users.show', Auth::user()->id) }}">
                                        <span class="icon">
                                            <i class="fa fa-user-circle"></i>
                                        </span>
                                        <span>Profile</span>
                                    </a>
                                    <a class="navbar-item" href="{{ route('manage.dashboard') }}">
                                        <span class="icon">
                                            <i class="fa fa-bars"></i>
                                        </span>
                                        <span>Dashboard</span>
                                    </a>
                                @endif
                                <hr class="navbar-divider">
                                <a class="navbar-item" href="{{ route('logout')}}"
                                    onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                                    <span class="icon">
                                        <i class="fa fa-sign-out"></i>
                                    </span>
                                    <span>Logout</span>
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</nav>