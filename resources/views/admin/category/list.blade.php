@extends('admin.layouts.master')

@section('title', 'Category List')



@section('content')
    <!-- Page Heading -->
    <section>
        <div class="container">
            <div class="d-flex mb-3 align-items-center justify-content-between  p-0 px-lg-1">
                <form class="d-none d-sm-inline-block form-inline  my-2 my-md-0 mw-100 navbar-search">
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
                <div class="">
                    <a href="{{ route('category#createPage') }}">
                        <button class="btn btn-sm btn-primary shadow-sm">
                            <i class="zmdi zmdi-plus"></i>+ADD Category
                        </button>
                    </a>
                </div>
            </div>

            <div class="row ">
                @if (request('key') != null)
                    <div class="col-6">
                        <h4 class="text-muted">Result for <span class="text-danger fs-5">{{ request('key') }}</span></h4>
                    </div>
                @endif
            </div>

            <div class="row">
                @if (count($categories) != 0)
                  <div class="col-1"></div>
                      <div class="col-10">
                        <div class="table-responsive table-responsive-data card border-0 shadow-sm">
                            <table class="table table-data">
                                <thead>
                                    <tr>
                                        <th class="text-primary align-middle">ID</th>
                                        <th class="text-primary align-middle">Category</th>
                                        <th class="text-primary align-middle">Created at</th>
                                        <th class="text-primary align-middle"> <span class="">
                                            <h5 class="text-muted"><i class="fa-solid fa-gift text-primary"></i><span class="text-black">
                                                    {{ $categories->total() }}</span>
                                            </h5>
                                        </span></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($categories as $category)
                                        <tr class="tr-shadow">
                                            <td class="align-middle ">{{ $category->id }}</td>
                                            <td class="align-middle text-primary  ">{{ $category->name }}</td>
                                            <td class="align-middle ">{{ $category->created_at->format('j.F.Y') }}</td>
                                            <td class="align-middle ">
                                                <div class="table-data-feature">
                                                    <a href="{{ route('category#edit', $category->id) }}"
                                                        class="btn btn-primary btn-sm">
                                                        <i class="fa-regular fa-pen-to-square"></i>
                                                    </a>
                                                    <a href="{{ route('category#delete', $category->id) }}"
                                                        class="btn btn-danger btn-sm">
                                                        <i class="fa-solid fa-trash"></i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="spacer"></tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="mt-2 mx-2">
                                {{ $categories->appends(request()->query())->links() }}
                                @if (session('createdSuccess'))
                                <span class=" ">
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        <i class="fa-solid fa-check me-2"></i><strong>{{ session('createdSuccess') }}</strong>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                    </div>
                                </span>
                            @endif

                            @if (session('deletedSuccess'))
                                <span class=" ">
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <i class="fa-solid fa-check me-2"></i><strong>{{ session('deletedSuccess') }}</strong>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                    </div>
                                </span>
                            @endif

                            @if (session('updatedSuccess'))
                                <span class=" ">
                                    <div class="alert alert-primary alert-dismissible fade show" role="alert">
                                        <i class="fa-solid fa-check me-2"></i><strong>{{ session('updatedSuccess') }}</strong>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                    </div>
                                </span>
                            @endif
                            </div>
                        </div>
                        <div class="col-1"></div>
                    </div>
            </div>
            </div>

            @else
            <div class="">
                <img src="{{ asset('admin/img/not_found.jpg') }}" style="width: 350px">
                <h2 class="my-3">No category such <span class="text-danger">{{ request('key') }} </span> is added yet!</h2>
                <div class="col-3">
                    Click to create one!<a class="btn  btn-primary ms-2" href="{{ route('category#createPage') }}" class="">
                        <i class="fa-solid fa-plus"></i></a>
                </div>
                @endif
            </div>
        </div>

    </section>

    <!-- Content Row -->


@endsection
