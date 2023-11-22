@extends('user.layout.master')

@section('title', 'Password Change')

@section('user-content')
    <div class="container">
        <i class="fa-solid fa-arrow-left text-warning fs-3" onclick="history.back()"></i>

        <!-- Outer Row -->
        <div class="row justify-content-center p-1 p-lg-0">
            <div class="offset-sm-2 offset-md-3"></div>
            <div class="col-sm-8 col-lg-6 card o-hidden border-0 shadow-lg my-5">
                <div class="p-1 pt-4 p-md-5">
                    <div class="text-center">
                        <h1 class="h4 mb-3 mb-lg-0 text-gray-900 mb-4">Change Password</h1>
                        <p class="mb-4 d-none d-md-block">Feeling unsecure about your informations? Type your old password and create a new strong password!</p>
                    </div>
                    <form class="user" action="{{route('user#changePassword')}}" method="post">
                        @csrf
                        <div class="form-group">
                            <input type="password" name="oldPassword" placeholder="Enter Old Password" class="form-control form-control-user @error('oldPassword') is-invalid @enderror rounded"
                                id="exampleInputEmail" aria-describedby="emailHelp">
                                @error('oldPassword')
                                <small class="text-danger">{{$message}}</small>
                                @enderror
                        </div>

                        <div class="form-group">
                            <input type="password" name="newPassword" placeholder="Enter New Password" class="form-control form-control-user @error('newPassword') is-invalid  @enderror rounded" id="exampleInputPassword" value="{{old('newPassword')}}">
                            @error('newPassword')
                                <small class="invalid-feedback">{{$message}}</small>
                            @enderror
                        </div>

                        <div class="form-group">
                            <input type="password" name="confirmPassword" placeholder="Confirm Your Password" class="form-control form-control-user @error('confirmPassword') is-invalid  @enderror rounded" id="exampleInputPassword">
                            @error('confirmPassword')
                                <small class="invalid-feedback">{{$message}}</small>
                            @enderror
                        </div>

                        <button type="submit"class="btn btn-warning btn-user btn-block">Change</button>
                    </form>
                    <hr>
                    <div class="text-center text-danger">
                        @if (session('notMatched'))
                        <div class="alert alert-danger alert-dismissible fade show">
                            <h4 class="text-danger"><i class="fa-solid fa-shield-halved"></i> {{session('notMatched')}}</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
                        @if (session('matched'))
                            <div class="alert alert-info alert-dismissible fade show">
                            <h4 class="text-success"><i class="fa-solid fa-shield-halved"></i> {{session('matched')}}</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
                    </div>
                </div>

            </div>

            <div class="offset-sm-2 offset-md-3"></div>

        </div>
    </div>

@endsection
