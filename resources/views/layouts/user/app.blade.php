<!DOCTYPE html>
<html lang="en">

    <!-- Header -->
    @include('layouts.user.header')

    <body>
        <script src="{{ asset('vendor/mazer/static/js/initTheme.js') }}"></script>
        <div id="app">
            <!-- Sidebar -->
            @include('layouts.user.sidebar')

            <!-- Page title -->
            <div id="main">
                <div class="page-heading">
                    <div class="row">
                        <div class="col-6 col-md-6 order-md-1 order-first">
                            <h3>@yield('title')</h3>
                            @yield('breadcrumb')
                        </div>

                        <div class="col-6 col-md-6 order-md-2 order-last">
                            <nav class="float-end">
                                <header class="mb-3">
                                    <a href="#" class="burger-btn d-block d-xl-none">
                                        <i class="bi bi-justify fs-3"></i>
                                    </a>
                                </header>
{{--                                <form method="POST" action="{{ route('logout') }}">--}}
{{--                                    @csrf--}}
{{--                                    <a href="#" onclick="event.preventDefault(); this.closest('form').submit();">--}}
{{--                                        <i class="bi bi-door-closed"></i> Logout--}}
{{--                                    </a>--}}
{{--                                </form>--}}
                            </nav>
                        </div>
                    </div>
                </div>

                <!-- Content -->
                @yield('content')

                <!-- Footer -->
                @include('layouts.user.footer')
            </div>
        </div>
        @include('layouts.user.scripts')
        @yield('custom-scripts')
    </body>
</html>
