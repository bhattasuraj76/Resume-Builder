    @section('footer')
    <!-- loader -->
    <div class="global-loader">
        <div class="loader"></div>
    </div>
    </body>

    <!-- scripts -->
    <script src="{{asset('public/vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('public/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('public/vendor/jquery-validate/jquery.validate.min.js')}}"></script>
    <script src="{{asset('public/vendor/jquery-smart-wizard/js/jquery.smartWizard.js')}}"></script>
    <script src="{{asset('public/vendor/bootstrap-datepicker/js/bootstrap-datepicker.min.js')}}"></script>
    <script src="{{asset('public/vendor/sweetalert/sweetalert.min.js')}}"></script>
    <script src="{{asset('public/client/js/main.js')}}"></script>

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
        const IS_USER_AUTH = "{{auth()->check()}}";
        
    </script>

    <!-- import scripts form pages -->
    @yield('after-scripts')

    </body>

    </html>
    @endsection