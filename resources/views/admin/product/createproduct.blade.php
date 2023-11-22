@extends('admin.layouts.master')

@section('title', 'Create Category')



@section('content')
    <!-- MAIN CONTENT-->
    <div class="container-fluid">
        <i class="fa-solid fa-arrow-left text-primary fs-3" onclick="history.back()"></i>
        <div class="main-content d-flex flex-column justify-content-center">
            <div class="container-md d-flex flex-column justify-content-center">

                <div class="row">
                    <div class="col-3 offset-8">
                        <a href="{{ route('product#list') }}"><button class="btn bg-dark text-white my-3">Product
                            List</button></a>
                    </div>
                </div>
                <div class="col-lg-5 offset-3 pb-4">
                    <div class="card border-0">
                        <div class="card-body p-5">
                            <div class="card-title">
                                <h4 class="text-center">Create a new Product</h4>
                            </div>
                            <hr>
                            <form class="user" action="{{ route('product#creates') }}" enctype="multipart/form-data"
                                method="post">
                                @csrf
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
                                    @enderror"
                                        placeholder="Product name" name="name" value="{{ old('name') }}">
                                </div>
                                {{-- name --}}

                                {{-- @error('')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                                <div class="form-group">
                                    <input type="text"
                                        class="form-control form-control-user @error('category') is-invalid
                                    @enderror"
                                        id="exampleInputEmail" placeholder="Category" name="category">
                                </div> --}}


                                {{-- email --}}
                                @error('waitingTime')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                                <div class="form-group">
                                    <input type="text"
                                        class="form-control form-control-user @error('waitingTime') is-invalid
                                    @enderror"
                                        placeholder="Waiting Time" name="waitingTime" value="{{ old('waitingTime') }}">
                                </div>

                                @error('price')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                                <div class="form-group">
                                    <input type="number"
                                        class="form-control form-control-user @error('price') is-invalid
                                    @enderror"
                                        placeholder="Price" name="price" value="{{ old('price') }}">
                                </div>
                                {{-- phone --}}

                                @error('description')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                                <div class="form-group">
                                    <textarea class="form-control  @error('description') is-invalid @enderror" id="textAreaExample1" rows="4"
                                        placeholder="Description" name="description" value="">{{ old('description') }}</textarea>
                                </div>
                                {{-- address --}}

                                @error('category')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                                <div class="col-md-7 mb-4 m-0 p-0">
                                    <option value="">Choose Category</option>
                                    <select id="inputState"
                                        class="form-select @error('category')
                                        is-invalid
                                    @enderror"
                                        name="category" value="{{ old('category') }}">
                                        @foreach ($categories as $c)
                                            <option value="{{ $c->id }}">{{ $c->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                {{-- confirm --}}
                                <div class="form-group">
                                    <input type="file" name="image" id=""
                                        class="form-control @error('image') is-invalid @enderror">
                                    @error('image')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <button type="submit" class="btn btn-primary btn-user btn-block">Create</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- END MAIN CONTENT-->
    <!-- END PAGE CONTAINER-->

@endsection
