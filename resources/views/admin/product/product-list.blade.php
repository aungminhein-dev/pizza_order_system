@extends('admin.layouts.master')

@section('title', 'Category List')
<style>
    td {
        width: 100px;
        overflow: hidden;
    }

    td img {
        width: 100px;
        transition: 0.5s;
        z-index: 1;
    }

    td img:hover {
        transform: scale(1.2, 1.3);
    }
</style>


@section('content')

    <div class="d-sm-flex align-items-center justify-content-between mb-4 p-0 px-lg-1">
        <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-75 navbar-search">
            <div class="input-group">
                <input type="text" class="form-control bg-white border-3 small"
                    placeholder="Search for..."aria-label="Search" aria-describedby="basic-addon2" name="key">
                <div class="input-group-append">
                    <button class="btn btn-primary" type="submit">
                        <i class="fas fa-search fa-sm"></i>
                    </button>
                </div>
            </div>
        </form>

    @section('nav')
        <form class="form-inline mr-auto w-75 navbar-search">
            <div class="input-group">
                <input type="text" class="form-control bg-light border-1 small" placeholder="Search for..."
                    aria-label="Search" name="key" aria-describedby="basic-addon2">
                <div class="input-group-append">
                    <button class="btn btn-primary" type="submit">
                        <i class="fas fa-search fa-md"></i>
                    </button>
                </div>
            </div>
        </form>
    @endsection
    <div class="">
        <a href="{{ route('product#create') }}">
            <button class="btn btn-sm btn-primary shadow-sm">
                +ADD PRODUCTS
            </button>
        </a>
        <a href="{{ route('category#createPage') }}">
            <button class="btn btn-primary btn-sm">
                +CREATE NEW CATEGORY
            </button>
        </a>

    </div>
</div>

<div class="container-fluid">
    <div class="row">
        @if (session('deleteSuccess'))
            <div class="col-4 offset-8 ">
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="fa-solid fa-check me-2"></i><strong>{{ session('deleteSuccess') }}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        @endif
        @if (session('created'))
            <div class="col-4 offset-8">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fa-solid fa-check me-2"></i><strong>{{ session('created') }}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        @endif
        @if (session('updated'))
            <div class="col-4 offset-8">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fa-solid fa-check me-2"></i><strong>{{ session('updated') }}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>

            <div class="col"></div>
        @endif

        {{-- @if (session('deletedSuccess'))
            <div class="col-4 offset-8 ">
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="fa-solid fa-check me-2"></i><strong>{{ session('deletedSuccess') }}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        @endif

        @if (session('updatedSuccess'))
            <div class="col-4 offset-8 ">
                <div class="alert alert-primary alert-dismissible fade show" role="alert">
                    <i class="fa-solid fa-check me-2"></i><strong>{{ session('updatedSuccess') }}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>

        @endif
            --}}


        <div class="row">
            @if (request('key') != null)
                <div class="col-6">
                    <h4 class="text-muted">Result for <span class="text-danger">{{ request('key') }}</span></h4>
                </div>
            @endif
            @if (count($products) != 0)
                <div class="col-6">
                    <h3 class="text-muted"><i class="fa-solid fa-gift text-primary"></i><span class="text-black">
                            {{ $products->total() }}</span></h3>
                </div>
            @endif
        </div>

        @if (count($products) != 0)
        <div class="col-1"><i class="fa-solid fa-arrow-left" onclick="history.back()"></i></div>
         <div class="col-10">
            <div class="table-responsive table-responsive-data card shadow ">
                <table class="table table-data">
                    <thead>
                        <tr>
                            <th class="text-primary">Image</th>
                            <th class="text-primary ">Name</th>
                            {{-- <th class="text-primary">Waiting</th> --}}
                            <th class="text-primary">Category</th>
                            {{-- <th class="text-primary">Price</th> --}}
                            <th  class="text-primary">Views</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $p)
                            <tr class="tr-shadow ">

                                <td class=" align-middle"><img src="{{ asset('storage/' . $p->image) }}"
                                        alt=""></td>
                                <td class=" align-middle">{{ $p->name }}</td>
                                {{-- <td class=" align-middle">{{$p->waiting_time}}</td> --}}
                                <td class=" align-middle text-uppercase">{{ $p->category_name }}</td>
                                {{-- <td class=" align-middle">{{$p->price}}</td> --}}
                                <td class=" align-middle"><i class="fa-solid fa-eye"></i> {{ $p->view_count }}
                                </td>
                                <td class=" align-middle">
                                    <div class=" d-lg-flex">
                                        <a href="{{ route('product#details', $p->id) }}"
                                            class="btn btn-warning btn-sm mb-sm-1 d-block me-1">
                                            <i class="fa-solid fa-eye"></i>
                                        </a>
                                        <a href="{{ route('product#updatePage', $p->id) }}"
                                            class="btn btn-primary btn-sm mb-sm-1 d-block me-1">
                                            <i class="fa-regular fa-pen-to-square"></i>
                                        </a>
                                        <a href="{{ route('product#delete', $p->id) }}"
                                            class="btn btn-danger btn-sm mb-sm-1 d-block me-1">
                                            <i class="fa-solid fa-trash"></i>
                                        </a>

                                    </div>
                                </td>
                            </tr>
                            <tr class="spacer"></tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
            <div class="mt-2 px-2">
                    {{ $products->appends(request()->query())->links() }}
            </div>
         </div>



        <div class="col-1"></div>
        @else
            <div class="row-md">
                <img src="{{ asset('admin/img/not_found.jpg') }}"width="500px">
            </div>
            <h2 class="my-3">No item is added yet!</h2>
            Click to create one!<a href="{{ route('product#creates') }}" class="">
                <button class="btn btn-primary ms-2">
                    <i class="fa-solid fa-plus"></i>
                </button>
            </a>
        @endif
    </div>
</div>
<!-- Content Row -->


@endsection
