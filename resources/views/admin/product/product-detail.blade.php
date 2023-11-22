@extends('admin.layouts.master')

@section('title', 'Account Details')
<style>

</style>

@section('content')

    <!-- Outer Row -->
    <div class="ms-2">
        <i class="fa-solid fa-arrow-left text-primary fs-3" onclick="history.back()"></i>
    </div>
    <div class="container-md ">
        <div class=" mb-3 ">
            <div class="">

                <div class="row my-2 border-0 justify-content-center ">

                    <div class="col-md-6 offest-1 shadow p-5 border-0 rounded">
                        <h2 class="text-warning  d-flex justify-content-center mb-lg-5">
                            <div class="sidebar-brand-icon rotate-n-15">
                                <i class="fas fa-laugh-wink"></i>
                            </div>
                            Product Details
                        </h2>

                        <div class="image mb-4 d-flex justify-content-center">
                            <img width="360px" src="{{ asset('storage/' . $details->image) }}" alt="" class=" rounded shadow">
                        </div>
                        <div class=" mb-lg-3 col-5  btn btn-secondary btn-sm text-white">
                            <i class="fa-brands fa-shopify"></i> {{ $details->name }}
                        </div>
                        <div class="row  justify-content-between m-0 p-0">
                            <div class="text-uppercase col-2  btn btn-danger btn-sm text-white">
                                {{ $details->category_name }}
                            </div>

                            <div class="  col-2  btn btn-success btn-sm text-white"><i class="fa-solid fa-truck-fast"></i>
                                {{ $details->waiting_time }}</div>

                            <div class=" col-3 btn btn-warning btn-sm text-black"><i class="fa-solid fa-dollar-sign"></i>
                                {{ $details->price }} kyats
                            </div>
                            <div class=" col-3 btn btn-dark btn-sm text-white"><span class="fs-6 "><i
                                        class="fa-solid fa-calendar"></i> {{ $details->created_at->format('j F') }}</h4>
                            </div>
                        </div>


                        <div class="my-3 text-muted"><i class="fa-solid fa-bookmark"></i>- {{ $details->description }}
                        </div>

                        <a href="{{ route('admin#editAccount') }}" class=" btn btn-primary col-3">
                            <i class="fa-solid fa-pen-to-square"></i> Edit
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
