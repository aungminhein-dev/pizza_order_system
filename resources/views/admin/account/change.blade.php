@extends('admin.layouts.master')

@section('title', 'Password Change')

@section('content')

    <div class="container pt-lg-5">

        <!-- Outer Row -->
        <div class="row justify-content-center p-1 p-lg-0">
            <div class="offset-sm-2 offset-md-3"></div>
            <div class="col-sm-8 col-lg-6 card o-hidden border-0 shadow-lg my-5">
                <div class="p-1 pt-4 p-md-5">
                    <div class="text-center">
                        <h1 class="h4 mb-3 mb-lg-0 text-gray-900 mb-2">Forgot Your Password?</h1>
                        <p class="mb-4 d-none d-md-block">We get it, stuff happens. Just enter your email address below
                            and we'll send you a link to reset your password!</p>
                    </div>
                    <form class="user" action="{{route('admin#changePassword')}}" method="post">
                        @csrf
                        <div class="form-group">
                            <input type="password" name="oldPassword" placeholder="Enter Old Password" class="form-control form-control-user @error('oldPassword') is-invalid @enderror"
                                id="exampleInputEmail" aria-describedby="emailHelp">
                                @error('oldPassword')
                                <small class="text-danger">{{$message}}</small>
                                @enderror
                        </div>

                        <div class="form-group">
                            <input type="password" name="newPassword" placeholder="Enter New Password" class="form-control form-control-user @error('newPassword') is-invalid  @enderror" id="exampleInputPassword" value="{{old('newPassword')}}">
                            @error('newPassword')
                                <small class="invalid-feedback">{{$message}}</small>
                            @enderror
                        </div>

                        <div class="form-group">
                            <input type="password" name="confirmPassword" placeholder="Confirm Your Password" class="form-control form-control-user @error('confirmPassword') is-invalid  @enderror" id="exampleInputPassword">
                            @error('confirmPassword')
                                <small class="invalid-feedback">{{$message}}</small>
                            @enderror
                        </div>

                        <button type="submit"class="btn btn-primary btn-user btn-block">Change</button>
                    </form>
                    <hr>
                    <div class="text-center text-danger">
                        @if (session('notMatched'))
                            {{session('notMatched')}}
                        @else
                        @endif
                        <a class="small" href="register.html">Try another way?</a>
                    </div>
                    <div class="text-center">
                        <a class="small" href="login.html">Already have an account? Login!</a>
                    </div>
                </div>
            </div>
            <div class="offset-sm-2 offset-md-3"></div>
        </div>
    </div>
    @if (session('matched'))
    <div class="alert alert-info alert-dismissible fade show">
       <h4 class="text-success"><i class="fa-solid fa-shield-halved"></i> {{session('matched')}}</h4>
       <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
@endsection
