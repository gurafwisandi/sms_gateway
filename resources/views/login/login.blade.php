<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Login | Lembaga Pendidikan MA Ma'arif 9 Kotagajah</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesdesign" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ URL::asset('assets/images/logo_sekolah.png') }}">

    <!-- Bootstrap Css -->
    <link href="{{ URL::asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{ URL::asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{ URL::asset('assets/css/app.min.css') }}" rel="stylesheet" type="text/css" />

</head>

<body class="bg-primary bg-pattern">
    <div class="home-btn d-none d-sm-block">
    </div>

    <div class="account-pages my-5 pt-sm-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="text-center mb-5">
                        <a href="#" class="logo"><img src="{{ URL::asset('assets/images/logo_sekolah.png') }}"
                                height="130" alt="logo"></a>
                    </div>
                </div>
            </div>
            <!-- end row -->

            <div class="row justify-content-center">
                <div class="col-xl-5 col-sm-8">
                    <div class="card">
                        <div class="card-body p-4">
                            <div class="p-2">
                                <h5 class="mb-5 text-center">Lembaga Pendidikan <br>MA Ma'arif 9 <br>Kotagajah.</h5>
                                @if (count($errors) > 0)
                                    <div class="alert alert-danger" role="alert">
                                        Login Gagal!
                                    </div>
                                @endif
                                @if (session()->has('loginError'))
                                    <div class="alert alert-danger" role="alert">
                                        Login Gagal!
                                    </div>
                                @endif
                                <form class="needs-validation" action="{{ route('login.proses') }}" method="POST"
                                    novalidate>
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group form-group-custom mb-4">
                                                <input type="text" name="email" class="form-control" id="email"
                                                    autocomplete="off" required>
                                                <label for="email">Email</label>
                                            </div>
                                            <div class="form-group form-group-custom mb-4">
                                                <input type="password" name="password" class="form-control"
                                                    autocomplete="off" id="userpassword" required>
                                                <label for="userpassword">Password</label>
                                            </div>
                                            <div class="mt-4">
                                                <button class="btn btn-success btn-block waves-effect waves-light"
                                                    type="submit">Log In</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end row -->
        </div>
    </div>
    <!-- end Account pages -->

    <!-- JAVASCRIPT -->
    <script src="{{ asset('assets/libs/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/libs/metismenu/metisMenu.min.js') }}"></script>
    <script src="{{ asset('assets/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('assets/libs/node-waves/waves.min.js') }}"></script>
    <script src="{{ asset('assets/js/app.js') }}"></script>
    <script src="{{ asset('assets/bundle.js') }}"></script>
</body>

</html>
