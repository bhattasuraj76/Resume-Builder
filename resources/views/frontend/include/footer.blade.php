    @section('footer')
    <!-- loader -->
    <div class="global-loader">
        <div class="loader"></div>
    </div>
    </body>

    <!-- scripts -->
    <script src="{{asset('public/backend/vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('public/backend/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('public/frontend/vendor/jquery-validate/js/jquery.validate.js')}}"></script>
    <script src="{{asset('public/frontend/js/sweetalert/js/sweetalert.min.js')}}"></script>
    <script src="{{asset('public/backend/js/main.js')}}"></script>

    <script>
        //attaching token to all ajax request
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        //global variables
        const BASE_URL = "{{ url('/') }}";
        const CSRF_TOKEN = $('input[name="_token"]').val();
    </script>

    <!-- import scripts form pages -->
    @yield('after-scripts')

    </body>

    </html>
    @endsection