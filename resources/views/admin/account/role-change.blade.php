@extends('admin.layouts.master')

@section('title', 'Edit Account')
<style>
    .image img {
        width: 215px;
        height: 220px;
    }
</style>

@section('content')
     <!-- Topbar -->

    <!-- /.container-fluid -->
    <!-- Outer Row -->
    <div class="container-md">
        <a href="{{route('admin#list')}}" class="btn btn-primary">Admin List</a>
        <div class="row justify-content-center">
            <div class="offset-md-3"></div>
            <div class="col-md-6 card o-hidden border-0 shadow-lg my-5">
                <div class="p-1 pt-4 p-md-5">
                    <form class="user" action="{{ route('admin#roleChange', $account->id) }}" method="post" enctype="multipart/form-data">
                        <h3 class="text-warning justify-content-center d-flex mb-3">
                            <div class="sidebar-brand-icon rotate-n-15">
                                <i class="fas fa-laugh-wink"></i>
                            </div>
                            Account Details</h3>
                        @csrf
                        <div class="image mb-2">
                            @if ($account->image == null)
                                @if ($account->gender == 'male')
                                <img class="img-thumbnail" src="{{ asset('admin/img/undraw_profile.svg') }}">
                                @else
                                <img class="img-thumbnail" src="{{ asset('admin/img/undraw_profile_1.svg') }}">
                                @endif
                            @else
                                <img class="img-thumbnail" src="{{ asset('storage/'.$account->image) }}"
                                    alt="">
                            @endif
                        </div>
                        @error('terms')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                        {{-- terms --}}

                        @error('name')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                        <div class="form-group">
                            <input type="text"
                                class="form-control form-control-user @error('name') is-invalid
                        @enderror" disabled
                                placeholder="Name" name="name" value="{{ old('name', $account->name) }}">
                        </div>
                        {{-- name --}}

                        @error('email')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                        <div class="form-group">
                            <input type="email"
                                class="form-control form-control-user @error('email') is-invalid
                        @enderror" disabled
                                id="exampleInputEmail" placeholder="Email Address" name="email"
                                value="{{ old('email', $account->email) }}">
                        </div>
                        {{-- email --}}

                        @error('phone')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                        <div class="form-group">
                            <input type="text"
                                class="form-control form-control-user @error('phone') is-invalid
                        @enderror" disabled
                                placeholder="Phone Number" name="phone" value="{{ old('phone', $account->phone) }}">
                        </div>
                        {{-- phone --}}

                        @error('address')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                        <div class="form-group">
                            <input type="text"
                                class="form-control form-control-user @error('address') is-invalid
                        @enderror" disabled
                                placeholder="Address" name="address" value="{{ old('address', $account->address) }}">
                        </div>
                        {{-- address --}}
                        <div class="d-flex justify-content-between">
                            <div class="col-md-4 mb-4">
                                <select id="inputState" class="form-select" name="role">
                                    <option selected class="fs-6" value="admin">Admin</option>
                                    <option class="fs-6" value="user">User</option>
                                </select>
                            </div>

                            @error('gender')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                            <div class="col-md-4 mb-4">
                                <select id="inputState" name="gender"
                                    class="form-select @error('gender') is-invalid
                            @enderror" disabled>

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
