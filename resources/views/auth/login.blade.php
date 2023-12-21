@extends('layout')
@section('no-content')
<title>Login - Constructor </title>

<body class="bg-dark">
    <div class="backdrop"></div>
    <section class="user-form-part">
        <section class="section mt-3">
            <div class="user-form-logo text-white fs-1 fw-bolder">Constructor<span style="color: var(--primary)">.L</span></div>
            <div class="container">
                <ul class="nav nav-tabs">
                    <li style="width:unset; border-radius:0px"><a href="{{route('login')}}" class="tab-link">Login</a></li>
                    <li style="width:unset"><a href="{{route('register')}}" class="tab-link">Sign up</a></li>
                </ul>
            </div>
            @include('includes.flash.success')
            @include('includes.flash.error')
            <div class="container text-center">
                <div class="page-title justify-content-center">
                    <h5 class="fw-bold"><i class="bi bi-person"></i> Login</h5>
                </div>
            </div>
        </section>

        <form action="{{route('post.login')}}" method="post">
            @csrf
            <section class="user-form-part pt-0">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6">
                            <div class="user-form-card">
                                <div class="form-group">
                                    <label>Username</label>
                                    <input id="name" name="name" class="form-control" placeholder="Lucas">
                                    @error('name')
                                    <p class="text-danger">{{ $errors->first('name') }}</p>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="password" id="password" name="password" class="form-control"
                                        placeholder="Password">
                                    @error('password')
                                    <p class="text-danger">{{ $errors->first('password') }}</p>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label>Session Time</label>
                                    <select class="form-select" aria-label="Session Time select">
                                        <option value="1" selected>10 minutes</option>
                                        <option value="2">30 minutes</option>
                                        <option value="2">60 minutes</option>
                                        <option value="2">128 minutes</option>
                                    </select>
                                </div>

                                <div class="form-group d-flex justify-content-center">
                                    <button type="submit" class="btn btn-primary btn-sm">login</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6">
                            <div class="user-form-card bg-secondary text-white">
                                <h2 class="mb-3 text-white h3">Welcome to Constructor<span style="color: var(--primary)">.L</span>!</h2>
                                <p>We are extremely proud to present to you the future of your life on our
                                    platform.<br> We have
                                    worked tirelessly to provide you a high quality shopping experience with the best
                                    quality vendors
                                    and the safety of your funds.<br> To begin your shopping experience, you may login
                                    or register
                                    with a new username and password combination. </p>
                                <p>- <strong>Thomas</strong> Team</p>
                            </div>
                            <div class="user-form-card">
                                <h3 class="mb-3">Account Recovery</h3>
                                Need help accessing your account? Enter your email address and we'll guide you through the recovery process.
                                <a href="#" class="link-danger">reset it here.</a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </form>
    </section>
</body>

@stop
