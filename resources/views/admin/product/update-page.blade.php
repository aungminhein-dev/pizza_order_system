@extends('admin.layouts.master')

@section('title', 'Edit Account')
<style>
    .image img {
        width: 320px;
        height: 280px;
    }
</style>

@section('content')
    <!-- Outer Row -->
    <div class="container-md">
        <div class="row justify-content-center">
            <div class="col-md-5 card o-hidden border-0 shadow-lg my-5 justify-content-center">
                <div class="p-1 pt-4 p-md-5 card border-0 ">

                    <form class="user" action="{{ route('product#update' ) }}" method="post"
                        enctype="multipart/form-data">
                        <h3 class="text-warning justify-content-center d-flex mb-3">
                            <div class="sidebar-brand-icon rotate-n-15">
                                <i class="fas fa-laugh-wink"></i>
                            </div>
                            Account Details
                        </h3>
                        <input type="hidden" name="id" value="{{ $details->id}}">
                        @csrf
                        <div class="image mb-2">
                            <img src="{{ asset('storage/' . $details->image) }}" alt="">
                        </div>
                        @error('terms')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                        {{-- terms --}}
                        <div class="form-group">
                            <input type="file" name="image" id=""
                                class="form-control @error('image') is-invalid @enderror">
                            @error('image')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        @error('description')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                        <div class="form-group">
                            <textarea class="form-control  @error('description') is-invalid @enderror" id="textAreaExample1" rows="6"
                                placeholder="Description" name="description" value="">{{ old('description',$details->description) }}</textarea>
                        </div>

                        @error('name')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                        <div class="form-group">
                            <input type="text"
                                class="form-control form-control-user @error('name') is-invalid
                        @enderror"
                                placeholder="Name" name="name" value="{{ old('name', $details->name) }}">
                        </div>
                        {{-- name --}}

                        @error('waitingTime')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                        <div class="form-group">
                            <input type="text"
                                class="form-control form-control-user @error('waitingTime') is-invalid
                        @enderror"
                                id="exampleInputEmail" placeholder="Waiting Time" name="waitingTime"
                                value="{{ old('waitingTime', $details->waiting_time) }}">
                        </div>
                        {{-- email --}}

                        {{-- phone --}}

                        @error('price')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                        <div class="form-group">
                            <input type="text"
                                class="form-control form-control-user @error('price') is-invalid
                        @enderror"
                                placeholder="Price" name="price" value="{{ old('price', $details->price) }}">
                        </div>
                        {{-- address --}}
                        <div class="d-flex justify-content-between">
                            {{-- <div class="col-md-4 mb-4">
                                <select id="inputState" class="form-select disabled">
                                    <option selected class="fs-6">Admin</option>
                                    <option class="fs-6">User</option>
                                </select>
                            </div> --}}

                            @error('category')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                                <div class="col-md-7 mb-4 m-0 p-0">
                                    <select id="inputState"
                                        class="form-select @error('category')
                                        is-invalid
                                    @enderror"
                                        name="category">
                                        <option value="">Choose Category</option>
                                        @foreach ($category as $c)
                                            <option value="{{ $c->id }}" @if ($details->category_id == $c->id)
                                                selected @endif>{{$c->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                        </div>
                        {{-- confirm --}}

                        <button type="submit" class="btn btn-primary btn-user btn-block btn-sm">Change</button>
                    </form>
                </div>
            </div>


        </div>
    </div>
@endsection
