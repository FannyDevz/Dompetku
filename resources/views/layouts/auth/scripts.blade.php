<script src="{{ asset('vendor/mazer/static/js/components/dark.js') }}"></script>
<script src="{{ asset('vendor/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
<script src="{{ asset('vendor/mazer/compiled/js/app.js') }}"></script>
{{--<script src="{{ asset('vendor/mazer/extensions/apexcharts/apexcharts.min.js') }}"></script>--}}
{{--<script src="{{ asset('vendor/mazer/static/js/pages/dashboard.js') }}"></script>--}}
<script src="{{ asset('/sw.js') }}"></script>
<script>
    if ("serviceWorker" in navigator) {
        // Register a service worker hosted at the root of the
        // site using the default scope.
        navigator.serviceWorker.register("/sw.js").then(
            (registration) => {
                console.log("Service worker registration succeeded:", registration);
            },
            (error) => {
                console.error(`Service worker registration failed: ${error}`);
            },
        );
    } else {
        console.error("Service workers are not supported.");
    }
</script>
