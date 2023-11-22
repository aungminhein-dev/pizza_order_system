@extends('admin.layouts.master')

@section('title', 'Edit Account')
<style>
    .image img {
        width: 215px;
        height: 220px;
    }
</style>

@section('content')

    <!-- /.container-fluid -->
    <!-- Outer Row -->
    <div class="container-md">
        <div class="row justify-content-center">
            <div class="offset-md-3"></div>

            <div class="col-md-6 card o-hidden border-0 shadow-lg my-5">
                <div class="p-1 pt-4 p-md-5">
                    <form class="user" action="{{ route('admin#update', Auth::user()->id) }}" method="post" enctype="multipart/form-data">
                        <h3 class="text-warning justify-content-center d-flex mb-3">
                            <div class="sidebar-brand-icon rotate-n-15">
                                <i class="fas fa-laugh-wink"></i>
                            </div>
                            Account Details</h3>
                        @csrf
                        <div class="image mb-2">
                            @if (Auth::user()->image == null)
                                <img class="img-thumbnail" src="{{ asset('admin/img/undraw_profile.svg') }}">
                            @else
                                <img class="img-thumbnail" src="{{ asset('storage/'.Auth::user()->image) }}"
                                    alt="">
                            @endif
                        </div>
                        @error('terms')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                        {{-- terms --}}
                        <div class="form-group">
                            <input type="file" name="image" id="" class="form-control @error('image') is-invalid @enderror">
                            @error('image')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                        </div>
                        @error('name')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                        <div class="form-group">
                            <input type="text"
                                class="form-control form-control-user @error('name') is-invalid
                        @enderror"
                                placeholder="Name" name="name" value="{{ old('name', Auth::user()->name) }}">
                        </div>
                        {{-- name --}}

                        @error('email')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                        <div class="form-group">
                            <input type="email"
                                class="form-control form-control-user @error('email') is-invalid
                        @enderror"
                                id="exampleInputEmail" placeholder="Email Address" name="email"
                                value="{{ old('email', Auth::user()->email) }}">
                        </div>
                        {{-- email --}}

                        @error('phone')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                        <div class="form-group">
                            <input type="text"
                                class="form-control form-control-user @error('phone') is-invalid
                        @enderror"
                                placeholder="Phone Number" name="phone" value="{{ old('phone', Auth::user()->phone) }}">
                        </div>
                        {{-- phone --}}

                        @error('address')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                        <div class="form-group">
                            <input type="text"
                                class="form-control form-control-user @error('address') is-invalid
                        @enderror"
                                placeholder="Address" name="address" value="{{ old('address', Auth::user()->address) }}">
                        </div>
                        {{-- address --}}
                        <div class="d-flex justify-content-between">
                            {{-- <div class="col-md-4 mb-4">
                                <select id="inputState" class="form-select disabled">
                                    <option selected class="fs-6">Admin</option>
                                    <option class="fs-6">User</option>
                                </select>
                            </div> --}}

                            @error('gender')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                            <div class="col-md-4 mb-4">
                                <select id="inputState" name="gender"
                                    class="form-select @error('gender') is-invalid
                            @enderror">

                                    <option value="male" class="fs-6"
                                       >Male</option>
                                    <option value="female" class="fs-6">
                                        Female</option>
                                </select>
                            </div>
                        </div>
                        {{-- confirm --}}

                        <button type="submit" class="btn btn-primary btn-user btn-block btn-sm">Change</button>
                    </form>
                    </div>
            </div>

            <div class=" offset-md-3"></div>
        </div>
    </div>
@endsection
