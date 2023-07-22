@extends('layouts.main')

@section('container')

    <body>
        <div class="login-page d-flex align-items-center bg-gray-100">
            <div class="container mb-3">
                <div class="row">
                    <div class="col-md-6 mx-auto">
                        <div class="card">
                            <div class="card-body p-5">
                                <header class="text-center mb-5">
                                    <h1 class="text-xxl text-gray-400 text-uppercase">BIMBA<strong class="text-primary">
                                            Rainbow Kids</strong></h1>
                                    <p class="text-gray-500 fw-light">Please Login</p>
                                </header>
                                <form class="login-form" method="POST" action="{{ route('loginAuth') }}">
                                    @csrf
                                    <div class="row">
                                        <div class="col-lg-7 mx-auto">
                                            <div class="form-group mb-3">
                                                <label for="username">Username</label>
                                                <input class="form-control @error('username') is-invalid @enderror"
                                                    id="username" type="text" name="username" autocomplete="off"
                                                    placeholder="Username" required>
                                                @error('username')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                            <div class="form-group mb-4">
                                                <label for="password">Password</label>
                                                <input class="form-control @error('password') is-invalid @enderror"
                                                    id="password" type="password" name="password" placeholder="Password"
                                                    required>
                                                @error('password')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-12 text-center">
                                            <button class="btn btn-primary mb-3" id="login"
                                                type="submit">Login</button><br>
                                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                                {{ __('Forgot Your Password?') }}
                                            </a>
                                            <br><span class="text-xs mb-0 text-gray-500">Do not have an account? </span><a
                                                class="text-xs text-paleBlue ms-1" href="/register"> Register</a>
                                            <!-- This should be submit button but I replaced it with <a> for demo purposes-->
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
