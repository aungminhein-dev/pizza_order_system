@extends('layouts.master')
@section('title','Register Page')
@section('content')
<h3 class="" href="" >
    <span class="h3 text-uppercase text-dark bg-light px-2">Multi</span>
    <span class="h3 text-uppercase text-light bg-warning px-2 ml-n1">Shop</span>
</h3>
<div class="container">

    <div class="">
        <div class="px-5">
            <!-- Nested Row within Card Body -->
            <div class="row d-flex align-items-center " style="height: 90vh" >
                <div class="col-md-6 d-sm-none d-md-block">
                    <img class="w-100" src="{{asset('admin/img/login1.webp')}}" alt="">
                </div>
                <div class="col-lg-6 shadow ">
                    <div class="p-3">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
                        </div>
                        <form class="user" action="{{route('register')}}" method="post">
                            @csrf
                            @error('terms')
                                <small class="text-danger">{{$message}}</small>
                            @enderror
                            {{-- terms --}}

                            @error('name')
                                <small class="text-danger">{{$message}}</small>
                            @enderror
                            <div class="form-group">
                                    <input type="text" class="form-control form-control-user @error('name') is-invalid
                                @enderror"
                                    placeholder="Name" name="name" value="{{old('name')}}">
                            </div>
                            {{-- name --}}

                            @error('email')
                                <small class="text-danger">{{$message}}</small>
                            @enderror
                            <div class="form-group">
                                <input type="email" class="form-control form-control-user @error('email') is-invalid
                                @enderror" id="exampleInputEmail"
                                placeholder="Email Address" name="email" value="{{old('email')}}">
                            </div>
                            {{-- email --}}

                            @error('phone')
                                <small class="text-danger">{{$message}}</small>
                            @enderror
                            <div class="form-group">
                                    <input type="text" class="form-control form-control-user @error('phone') is-invalid
                                @enderror"
                                    placeholder="Phone Number" name="phone" value="{{old('phone')}}">
                            </div>
                            {{--phone --}}

                            @error('address')
                            <small class="text-danger">{{$message}}</small>
                         @enderror
                            <div class="form-group">
                                <input type="text" class="form-control form-control-user @error('address') is-invalid
                                @enderror"
                                placeholder="Address" name="address" value="{{old('address')}}">
                            </div>
                            {{-- address --}}
                            @error('gender')
                            <small class="text-danger">{{$message}}</small>
                         @enderror
                            <div class="col-md-7 mb-4">
                                <select id="inputState" class="form-select form-control" name="gender">
                                    <option value="">Chooser gender</option>
                                  <option value="male" class="fs-6">Male</option>
                                  <option value="female" class="fs-6" >Female</option>
                                </select>
                              </div>
                            @error('password')
                            <small class="text-danger">{{$message}}</small>
                         @enderror
                            <div class="form-group">
                                <input type="password" class="form-control form-control-user @error('password') is-invalid
                                @enderror"
                                    id="exampleInputPassword" placeholder="Password" name="password">
                            </div>
                            {{--password--}}

                            @error('password_confirmation')
                            <small class="text-danger">{{$message}}</small>
                             @enderror
                            <div class="form-group">
                                <input type="password" class="form-control form-control-user @error('password_confirmation') is-invalid
                                @enderror"
                                id="exampleRepeatPassword" placeholder="Confirm Password" name="password_confirmation">
                            </div>
                            {{-- confirm --}}

                            <button type="submit" class="btn btn-primary btn-user btn-block">Register</button>
                        </form>
                        <hr>
                            <p class="text-center">
                                Already have account?
                                <a href="{{route('auth#loginPage')}}">Sign In</a>
                            </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
