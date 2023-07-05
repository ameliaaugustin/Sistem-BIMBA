@extends('layouts.main')

@section('container')
    {{-- <div class="row justify-content-center">
        <div class="col lg-5">
            <main class="form-signin w-100 m-auto">
                <form action="{{ route('saveregist') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <img class="mb-4" src="../assets/brand/bootstrap-logo.svg" alt="" width="72" height="57">
                    <h1 class="h3 mb-3 fw-normal text-center">Registration Form</h1>
                    <div class="form-floating mb-3">
                        <input type="text" name="fullname" class="form-control @error('fullname') is-invalid @enderror"
                            id="fullname" placeholder="fullname">
                        <label for="fullname">Fullname</label>
                        @error('fullname')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" name="username" class="form-control @error('username') is-invalid @enderror"
                            id="username" placeholder="username">
                        <label for="username">Username</label>
                        @error('username')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-floating mb-3">
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                            id="email" placeholder="email">
                        <label for="email">Email address</label>
                        @error('email')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-floating">
                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                            id="floatingPassword" placeholder="Password">
                        <label for="floatingPassword">Password</label>
                        @error('password')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="checkbox mb-3">

                    </div>
                    <button class="w-100 btn btn-lg btn-primary" type="submit">Register</button>
                </form>
                <small class="d-block text-center mt-4">Have an Account? <a href="/login">Please Login!</a></small>
            </main>
        </div>
    </div> --}}

    <body>
        <div class="login-page d-flex align-items-center bg-gray-100">
            <div class="container mb-3">
                <div class="row">
                    <div class="col-md-6 mx-auto">
                        @if (session()->has('success'))
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif

                        <div class="card">
                            <div class="card-body p-5">
                                <header class="text-center mb-5">
                                    <h1 class="text-xxl text-gray-400 text-uppercase">BIMBA<strong class="text-primary">
                                            RAINBOW KIDS</strong></h1>
                                    <p class="text-gray-500 fw-light">Silahkan Isi Form Register Akun Terlebih Dahulu</p>
                                </header>
                                <form class="register-form" method="POST" action="{{ route('saveregist') }}">
                                    @csrf
                                    <div class="row">
                                        <div class="col-lg-8 mx-auto">
                                            <div class="form-group mb-3">
                                                <label for="fullname">Fullname </label>
                                                <input class="form-control @error('fullname') is-invalid @enderror "
                                                    type="text" name="fullname" required value="{{ old('fullname') }}"">
                                                @error('fullname')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                            <div class="form-group mb-3">
                                                <label for="username">Username </label>
                                                <input class="form-control @error('username') is-invalid @enderror"
                                                    type="text" name="username" required value="{{ old('username') }}">
                                                @error('username')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                            <div class="form-group mb-3">
                                                <label>Email Address</label>
                                                <input class="form-control @error('email') is-invalid @enderror"
                                                    type="email" name="email" required value="{{ old('email') }}">
                                                @error('email')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                            <div class="form-group mb-4">
                                                <label>Password</label>
                                                <input class="form-control @error('password') is-invalid @enderror"
                                                    type="password" name="password" required">
                                                @error('password')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>

                                        </div>
                                        <div class="col-12 text-center">
                                            <button class="btn btn-primary mb-3" id="login"
                                                type="submit">Register</button><br><span
                                                class="text-xs text-gray-500">Already have an account? </span><a
                                                class="text-xs text-paleBlue ms-1" href="/login">Login</a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script>
            // ------------------------------------------------------- //
            //   Inject SVG Sprite - 
            //   see more here 
            //   https://css-tricks.com/ajaxing-svg-sprite/
            // ------------------------------------------------------ //
            function injectSvgSprite(path) {

                var ajax = new XMLHttpRequest();
                ajax.open("GET", path, true);
                ajax.send();
                ajax.onload = function(e) {
                    var div = document.createElement("div");
                    div.className = 'd-none';
                    div.innerHTML = ajax.responseText;
                    document.body.insertBefore(div, document.body.childNodes[0]);
                }
            }
            // this is set to BootstrapTemple website as you cannot 
            // inject local SVG sprite (using only 'icons/orion-svg-sprite.svg' path)
            // while using file:// protocol
            // pls don't forget to change to your domain :)
            injectSvgSprite('https://bootstraptemple.com/files/icons/orion-svg-sprite.svg');
        </script>
    </body>
@endsection
