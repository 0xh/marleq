@if (session('success'))
    <div class="notification is-success">
        {{ Session::get('success') }}
    </div>
@endif
@if (session('danger'))
    <div class="notification is-danger">
        {{ Session::get('danger') }}
    </div>
@endif