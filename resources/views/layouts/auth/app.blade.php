<!DOCTYPE html>
<html lang="en">

<!-- Header -->
@include('layouts.auth.header')

<body>
<script src="{{ asset('vendor/mazer/static/js/initTheme.js') }}"></script>
<div id="auth">
    <div class="row h-100">
        <!-- Content -->
        @yield('content')
    </div>
</div>
{{--@include('layouts.auth.scripts')--}}
{{--@yield('custom-scripts')--}}
</body>
</html>
