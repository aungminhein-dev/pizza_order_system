@extends('layouts.master')

@section('title', 'Log In Page')




@section('content')
    <!-- Outer Row -->
    <h3 class="" href="" >
        <span class="h3 text-uppercase text-dark bg-light px-2">Multi</span>
        <span class="h3 text-uppercase text-light bg-warning px-2 ml-n1">Shop</span>
    </h3>
    <div class="container">


        <!-- Outer Row -->
           <div class="card border-0">
            <!-- Nested Row within Card Body -->
            <div class="row bg-white d-flex align-items-center " style="height: 90vh">
                <div class="col-md-6 d-sm-none d-md-block">
                    <img class="w-100" src="{{asset('admin/img/login.webp')}}" alt="">
                </div>
                <div class="col-lg-6" >
                    <div class="p-5 shadow">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                        </div>
                        <form class="user"action="{{ route('login') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <input type="email" value="{{ old('email') }}" name="email" placeholder="Email"
                                    class="form-control form-control-user @error('email') is-invalid @enderror"
                                    id="exampleInputEmail" aria-describedby="emailHelp">
                                @error('email')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <input type="password" value="{{ old('password') }}" name="password" placeholder="Password"
                                    class="form-control form-control-user @error('password') is-invalid  @enderror"
                                    id="exampleInputPassword">
                                @error('password')
                                    <small class="invalid-feedback">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <div class="custom-control custom-checkbox small">
                                    <input type="checkbox" class="custom-control-input" id="customCheck">
                                    <label class="custom-control-label" for="customCheck">Remember
                                        Me</label>
                                </div>
                            </div>
                            <button type="submit"class="btn btn-primary btn-user btn-block">Log In</button>
                        </form>
                        <hr>
                        <div class="text-center">
                            Don't have a account? <a href="{{ route('auth#registerPage') }}">Sign Up Here</a>
                        </div>
                       <div class="d-flex justify-content-between mt-3">
                        <a href="{{route('googleLogin')}}" class="btn btn-dark">
                            <i class="fa-brands fa-google fs-3"></i> Log in With Google</a>
                        <a href="{{route('facebookRedirect')}}" class="btn btn-primary">
                            <i class="fa-brands fa-facebook fs-3"></i> Log in with Facebook
                        </a>
                       </div>
                    </div>
                </div>
            </div>
        </div>


    </div>

@endsection
