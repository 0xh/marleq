@if (session('success'))
    <div class="notification is-success hide-message">
        {{ Session::get('success') }}
    </div>
@endif
@if (session('danger'))
    <div class="notification is-danger hide-message">
        {{ Session::get('danger') }}
    </div>
@endif