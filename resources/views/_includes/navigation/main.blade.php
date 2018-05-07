<nav class="container navbar is-transparent">
    <div class="navbar-brand">
        <a class="navbar-item" href="{{ url('/') }}">
            <img src="{{ URL::asset('images/logo.png') }}" />
        </a>
        <a role="button" class="navbar-burger" data-target="navMenu" aria-label="menu" aria-expanded="false">
            <span aria-hidden="true"></span>
            <span aria-hidden="true"></span>
            <span aria-hidden="true"></span>
        </a>
    </div>

    <div class="navbar-menu" id="navMenu">
        <div class="navbar-start">

            <a class="navbar-item" href="{{ url('/') }}">
                Home
            </a>
            <a class="navbar-item" href="{{ url('/about-us') }}">
                About Us
            </a>
            <a class="navbar-item" href="{{ url('/inspiration') }}">
                Inspiration
            </a>
            <a class="navbar-item" href="{{ url('/events') }}">
                Events
            </a>
            <a class="navbar-item" href="{{ url('/') }}">
                Find a Coach
            </a>
        </div>

        <div class="navbar-end">
            <div class="navbar-item">
                <div class="field is-grouped">
                    @if (Auth::guest())
                        <p class="control">
                            <a class="button is-info" href="{{ route('register')}}">
                                <span class="icon">
                                    <i class="fa fa-user"></i>
                                </span>
                                <span>Become a Coach</span>
                            </a>
                            <a class="button is-info is-success" href="{{ route('login')}}">
                                <span class="icon">
                                    <i class="fa fa-sign-in"></i>
                                </span>
                                <span>Sign in</span>
                            </a>
                        </p>
                    @endif
                    @if (Auth::user())
                        <div class="navbar-item has-dropdown is-hoverable">
                            <a class="navbar-link" href="#">
                                {{ Auth::user()->name }}
                            </a>
                            <div class="navbar-dropdown is-right">
                                @if (Auth::user()->hasRole('user'))
                                    <a class="navbar-item" href="#">
                                        <span class="icon">
                                            <i class="fa fa-user-circle"></i>
                                        </span>
                                        <span>Profile</span>
                                    </a>
                                @endif
                                @if (Auth::user()->hasRole('superadministrator|administrator'))
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