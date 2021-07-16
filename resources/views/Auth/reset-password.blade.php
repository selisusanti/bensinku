<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- <meta name="csrf-token" content="{{ csrf_token() }}"> --}}

    
    <link rel="shortcut icon" href="{{ asset('media/favicons/favicon-im.png') }}">
    <link rel="icon" sizes="192x192" type="image/png" href="{{ asset('media/favicons/favicon-192x192.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('media/favicons/apple-touch-icon-180x180.png') }}">


    <!-- Fonts and Styles -->
    @yield('css_before')
    <!-- <link rel="stylesheet" id="css-main" href="https://fonts.googleapis.com/css?family=Nunito+Sans:300,400,400i,600,700"> -->
    <link rel="stylesheet" id="css-theme" href="{{ asset('css/dashmix.css') }}">

    @yield('css_after')
    <!-- Scripts -->
    {{--  <script>window.Laravel = {!! json_encode(['csrfToken' => csrf_token(),]) !!};</script>  --}}

    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>Login Bensinku</title>

    <link rel="stylesheet" href="{{ asset('/js/plugins/sweetalert2/sweetalert2.min.css') }}">
    <script src="{{ asset('js/dashmix.app.js') }}"></script>

    <!-- Laravel Scaffolding JS -->
    <script src="{{ asset('js/laravel.app.js') }}"></script>

    @yield('js_after')
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>


    <script src="{{ asset('/js/plugins/sweetalert2/sweetalert2.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/plugins/bootstrap-notify/bootstrap-notify.min.js') }}"></script>
    <script>jQuery(function(){ Dashmix.helpers(['notify']); });</script>

    <script src="{{ asset('/js/plugins/custom/utilities.js') }}" type="text/javascript"></script>
</head>
<body class="bg-img">
        <div id="page-container">

            <!-- Main Container -->
            <main id="main-container">

                <!-- Page Content -->
                <div class="bg-image" style="background-image: {{ ('media/photos/photo16@2x.jpg') }};">
                    <div class="row no-gutters justify-content-center bg-black-75">
                        <div class="hero-static col-sm-8 col-md-6 col-xl-4 d-flex align-items-center p-2 px-sm-0">
                            <!-- Reminder Block -->
                            <div class="block block-transparent block-rounded w-100 mb-0 overflow-hidden">
                                <div class="block-content block-content-full px-lg-5 px-xl-6 py-4 py-md-5 py-lg-6 bg-white">
                                    <!-- Header -->
                                    <div class="mb-2 text-center">
                                        <a class="link-fx text-warning font-w700 font-size-h1" href="index.html">
                                            <span class="text-dark">BENSINKU</span><span class="text-primary"></span>
                                        </a>
                                        <p class="text-uppercase font-w700 font-size-sm text-muted">Reset Password </p>
                                    </div>
                                    <!-- END Header -->

                                    <!-- Reminder Form -->
                                    <!-- jQuery Validation (.js-validation-reminder class is initialized in js/pages/op_auth_reminder.min.js which was auto compiled from _es6/pages/op_auth_reminder.js) -->
                                    <!-- For more info and examples you can check out https://github.com/jzaefferer/jquery-validation -->
                                    <form action="/auth/reset-password" method="post" id="login-form">
                                        @method('put')
                                        @csrf    
                                        <input type="hidden" name="email" id="email" value="{{ $detail->email }}">
                                        <div class="form-group">
                                            <input type="password" class="form-control" 
                                            id="password" 
                                            name="password" 
                                            placeholder="Password"
                                            required />
                                        </div>
                                        <div class="form-group">
                                            <input type="password" 
                                            class="form-control" 
                                            id="confirm-password" 
                                            name="confirm-password" 
                                            placeholder="Confirm Password"
                                            required />
                                            <div id="pass-error" class="row d-none">
                                                <div class="col-12">
                                                    <label class="col-sm-12 col-form-label text-danger">Password and confirm password must match!</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">

                                            <button type="submit" id="submitter" class="d-none"></button>
                                            <button type="button" onclick="validate();" class="btn btn-hero-primary btn-block">Submit</button>
                                        </div>
                                    </form>
                                    <!-- END Reminder Form -->
                                </div>
                            </div>
                            <!-- END Reminder Block -->
                        </div>
                    </div>
                </div>
                <!-- END Page Content -->

            </main>
            <!-- END Main Container -->
        </div>
        <!-- END Page Container -->


</body>


<script type="text/javascript">
    function validate(){
        if($('#password').val() != $('#confirm-password').val()){
            $('#pass-error').removeClass('d-none');
            return;
        }else{
            $('#pass-error').addClass('d-none');

            $('#submitter').click();
        }
    }
</script>


@if(Session::has('error'))

<script type="text/javascript">
    var errorLogin = {!! json_encode(Session::get('error')) !!};
    $(document).ready(function(){
        Dashmix.helpers('notify', {
            type: 'danger',
            icon: 'fa fa-times mr-1',
            message: errorLogin
        });
    });
</script>

@endif


@if(Session::has('success'))

<script type="text/javascript">
    var errorLogin = {!! json_encode(Session::get('success')) !!};

    $(document).ready(function(){
        Dashmix.helpers('notify', {
            type: 'success',
            icon: 'fa fa-check mr-1',
            message: errorLogin,
            allow_dismiss: true,
            timer: 15000
        });
    });
</script>
@endif

</html>
