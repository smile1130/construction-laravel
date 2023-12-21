@extends('layout')
@section('no-content')
<title>Register - Constructor </title>

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
            @include('includes.flash.error')
            <div class="container text-center">
                <div class="page-title justify-content-center">
                    <h5 class="fw-bold"><i class="bi bi-person-plus"></i> Register</h5>
                </div>
            </div>
        </section>
        <form action="{{ route('post.register') }}" method="post">
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
                                <div class="row">
                                    <div class="col-12 col-md-6 col-lg-6">
                                        <div class="form-group">
                                            <label>Password</label>
                                            <input class="form-control" type="password" id="password" name="password"
                                                placeholder="Password">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 col-lg-6">
                                        <div class="form-group">
                                            <label>Password Repeat</label>
                                            <input class="form-control" type="password" id="password_confirmation"
                                                placeholder="Confirm Password" name="password_confirmation">
                                        </div>
                                    </div>
                                </div>
                                @error('password')
                                <p class="text-danger">{{ $errors->first('password') }}</p>
                                @enderror
                                <div class="row">
                                    <div class="col-12 col-md-12 col-lg-12">
                                        <div class="form-group">
                                            <label>Phone Number (Include National Number)</label>
                                            <input class="form-control" type="string" id="phonenum" name="phonenum"
                                                placeholder="15198821313">
                                        </div>
                                    </div>
                                </div>
                                @error('phonenum')
                                <p class="text-danger">{{ $errors->first('phonenum') }}</p>
                                @enderror
                                <div class="form-group d-flex justify-content-center">
                                    <button type="submit" class="btn btn-primary btn-sm">Signup</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6">
                            <div class="user-form-card">
                                <h2 class="mb-3">Congratulations!</h2>
                                <p>You have made the decision to register on <strong>Constructor<span style="color: var(--primary)">.L</span></strong>!</p>
                                <p>Please enter your selected username and password, phone number to begin starting on <strong>Constructor<span style="color: var(--primary)">.L</span></strong> via our Secure Platform.</p>
                                <p>We encourage you to record your unique login passphrase which will be generated.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </form>
    </section>
</body>
@stop
