@extends('user.layout.master')

@section('title', 'Home Page')
<style>
    .bg-dark[aria-current="page"] {
        background-color: black;
    }
    i {
        margin-top: 4px;
    }
</style>
@section('user-content')
    <!-- Shop Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <!-- Shop Sidebar Start -->
            <div class="col-lg-3 col-md-4">
                <div class="shadow">
                    <input type="hidden" name="" id="userId" value="{{ Auth::user()->id }}">
                    {{-- <input type="hidden" name="" id="productId" value="{{$produ->id}}"> --}}


                    <div class="bg-light p-4 mb-30">
                         <!-- Price Start -->
                    <h3 class="section-title position-relative text-uppercase mb-3 bg-dark p-2"><span class="text-warning">Filter
                        by
                        Category</span></h3>
                        <form>
                            <div class="d-flex align-items-center justify-content-between mb-3 ">
                                <label for="price-all" class="text-warning">Categories</label>
                                <span class="badge font-weight-normal  text-bg-warning">{{ count($categories) }}</span>
                            </div>

                            <hr>
                            <div class="d-flex align-items-center justify-content-between mb-3 ">
                                <a href="{{ route('user#home') }}"class="text-uppercase text-warning text-decoration-none">Show
                                    All</a>
                            </div>
                            @foreach ($categories as $c)
                                <div class="d-flex align-items-center justify-content-between mb-3">

                                    <a
                                        href="{{ route('user#filter', $c->id) }}"class="text-uppercase text-warning text-decoration-none">{{ $c->name }}</a>

                                </div>
                            @endforeach
                        </form>
                </div>
                </div>
                <!-- Price End -->

            </div>
            <!-- Shop Sidebar End -->
            <!-- Shop Product Start -->
            <div class="col-lg-9 col-md-8">
                <div class="row">
                    <div class="col-lg-3 mt-2 mt-md-3 mb-2">
                        <a href="{{ route('user#cartList') }}" class="btn p-2 btn-dark position-relative">
                            <i class="fa-solid fa-cart-shopping"></i>
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                {{ $cart->count() }}
                            </span>
                        </a>
                        <a href="{{ route('user#history') }}" class="btn btn-dark position-relative ms-2">
                            <i class="fa-solid fa-clock-rotate-left"></i> History
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                {{ $history->count() }}
                            </span>
                        </a>
                    </div>

                </div>
                <div class="row ">
                    {{-- <div class="col-12 pb-1">
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <div>
                                <button class="btn btn-sm btn-light"><i class="fa fa-th-large"></i></button>
                                <button class="btn btn-sm btn-light ml-2"><i class="fa fa-bars"></i></button>
                            </div>
                            <div class="">


                                <select name="sorting" id="sortingOption" class="form-control">
                                    <option value="">Sort By<i class="fa-solid fa-caret-down"></i></option>
                                    <option value="asc">Starting</option>
                                    <option value="desc">Latest</option>
                                </select>
                            </div>
                        </div>
                    </div> --}}

                    <span class="row" id="dataList">
                        @if (count($products) != 0)
                            @foreach ($products as $p)
                                <div class="col-lg-4 col-md-6 col-sm-4 pb-1">
                                    <div class="product-item bg-light mb-4 shadow rounded" id="myForm">
                                        <div class="product-img position-relative overflow-hidden">
                                            <img class="img-fluid w-100" src="{{ asset('storage/' . $p->image) }}"
                                                style="height: 300px;">
                                            <div class="product-action">
                                                {{-- <a id="addCartBtn" class="btn btn-dark position-relative">
                                                    <i class="fa-solid fa-cart-shopping"></i>
                                                </a> --}}
                                                <a class="btn btn-outline-dark btn-square rounded" href=""><i
                                                        class="far fa-heart"></i></a>
                                                <a class="btn btn-outline-dark btn-square rounded"
                                                    href="{{ route('userproducts#details', $p->id) }}">
                                                    <i class="fa-solid fa-circle-info"></i>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="py-2 px-3">
                                            <div class="d-flex align-items-center  justify-content-between mb-1">
                                                <div class="">
                                                    <a class="h6 text-decoration-none text-truncate"
                                                        href="">{{ $p->name }}</a>
                                                </div>
                                                <div class="">
                                                    <a href="" class="btn px-0">
                                                        <i class="fas fa-eye text-muted"></i>
                                                        <span class="badge text-muted border border-warning rounded-circle"
                                                            style="padding-bottom: 2px;">{{ $p->view_count }}</span>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="d-flex align-items-center justify-content-between mt-2">
                                                <h5>{{ $p->price }} kyats</h5>

                                                <div class="d-none d-lg-block">
                                                    <small class="fa fa-star text-warning mr-1"></small>
                                                    <small class="fa fa-star text-warning mr-1"></small>
                                                    <small class="fa fa-star text-warning mr-1"></small>
                                                    <small class="fa fa-star text-warning mr-1"></small>
                                                    <small class="fa fa-star text-warning mr-1"></small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="align-middle text-center">
                                <img src="{{ asset('user/img/nit_available.jpg') }}" min-width="400px" height="250px"
                                    alt="">
                                <h2 class="text-danger">No items is available for now!</h2>
                            </div>
                        @endif
                    </span>


                </div>
            </div>
            <!-- Shop Product End -->
        </div>
    </div>
    <div class="container-fluid py-5">
        <h2 class="section-title position-relative text-warning mx-xl-5 mb-4"><span class="bg-secondary p-2">#POPULAR NOW</span></h2>
        <div class="row px-xl-5">
            <div class="col">
                <div class="owl-carousel related-carousel">
                    @foreach ($trending as $l)
                        <div class="product-item bg-light mb-4 shadow rounded" id="myForm">
                            <div class="product-img position-relative overflow-hidden">
                                <img class="img-fluid w-100" src="{{ asset('storage/' . $l->image) }}"
                                    style="height: 300px;">
                                <div class="product-action">

                                    <a class="btn btn-outline-dark btn-square rounded btn-view" href=""><i
                                            class="far fa-heart"></i></a>
                                    <a class="btn btn-outline-dark btn-square rounded"
                                        href="{{ route('userproducts#details', $l->id) }}">
                                        <i class="fa-solid fa-circle-info"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="py-2 px-3">
                                <div class="d-flex align-items-center  justify-content-between mb-1">
                                    <div class="">
                                        <a class="h6 text-decoration-none text-truncate"
                                            href="">{{ $l->name }}</a>
                                    </div>
                                    <div class="">
                                        <h6><i class="fa-solid fa-eye"></i> {{ $l->view_count }}</h6>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center justify-content-between mt-2 parent">
                                    <h5>{{ $l->price }} kyats</h5>
                                    <div class="d-none d-lg-block">
                                        <small class="fa fa-star text-warning mr-1"></small>
                                        <small class="fa fa-star text-warning mr-1"></small>
                                        <small class="fa fa-star text-warning mr-1"></small>
                                        <small class="fa fa-star text-warning mr-1"></small>
                                        <small class="fa fa-star text-warning mr-1"></small>
                                    </div>

                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <!-- Shop End -->
@endsection

@section('myScript')
    <script>
        $(document).ready(function() {
            // $('#sortingOption').change(function() {
            //     $eventOption = $('#sortingOption').val()

            //     if ($eventOption == 'asc') {
            //         $.ajax({
            //             type: 'get',
            //             url: 'http://localhost:8000/user/ajax/pizza/list',
            //             data: {
            //                 'status': 'asc'
            //             },
            //             dataType: 'json',
            //             success: function(response) {
            //                 $list = "";
            //                 for ($i = 0; $i < response.length; $i++) {
            //                     $list += `<div class="col-lg-4 col-md-6 col-sm-4 pb-1">
        //                                     <div class="product-item bg-light mb-4 shadow rounded" id="myForm">
        //                         <div class="product-img position-relative overflow-hidden">
        //                             <img class="img-fluid w-100"
        //                                 src="{{ asset('storage/${response[$i].image}') }}"
        //                                 style="height: 300px;">
        //                             <div class="product-action">
        //                                 <a class="btn btn-outline-dark btn-square rounded" href=""><i
        //                                         class="fa fa-shopping-cart"></i></a>
        //                                 <a class="btn btn-outline-dark btn-square rounded" href=""><i
        //                                         class="far fa-heart"></i></a>
        //                                 <a class="btn btn-outline-dark btn-square rounded" href="">
        //                                     <i class="fa-solid fa-circle-info"></i>
        //                                 </a>
        //                             </div>
        //                         </div>
        //                         <div class="py-2 px-3">
        //                             <div class="d-flex align-items-center  justify-content-between mb-1">
        //                                 <div class="">
        //                                     <a class="h6 text-decoration-none text-truncate" href="">${response[$i].name}</a>
        //                                 </div>
        //                                 <div class="">
        //                                     <h6><i class="fa-solid fa-truck"></i>${response[$i].waiting_time}</h6>
        //                                 </div>
        //                             </div>
        //                             <div class="d-flex align-items-center justify-content-between mt-2">
        //                                 <h5>${response[$i].price} kyats</h5>
        //                                 <a href="" class="btn px-0">
        //                                     <i class="fas fa-heart text-warning"></i>
        //                                     <span class="badge text-warning border border-warning rounded-circle" style="padding-bottom: 2px;">0</span>
        //                                 </a>
        //                                 <div class="d-none d-lg-block">
        //                                     <small class="fa fa-star text-warning mr-1"></small>
        //                                     <small class="fa fa-star text-warning mr-1"></small>
        //                                     <small class="fa fa-star text-warning mr-1"></small>
        //                                     <small class="fa fa-star text-warning mr-1"></small>
        //                                     <small class="fa fa-star text-warning mr-1"></small>
        //                                 </div>
        //                             </div>
        //                         </div>
        //                     </div>
        //                                     </div>`
            //                 }
            //                 $('#dataList').html($list);

            //             }
            //         })
            //     } else if ($eventOption == 'desc') {
            //         $.ajax({
            //             type: 'get',
            //             url: 'http://localhost:8000/user/ajax/pizza/list',
            //             data: {
            //                 'status': 'desc'
            //             },
            //             dataType: 'json',
            //             success: function(response) {
            //                 $list = '';
            //                 for ($i = 0; $i < response.length; $i++) {
            //                     $list += `<div  class="col-lg-4 col-md-6 col-sm-4 pb-1">
        //                                     <div class="product-item bg-light mb-4 shadow rounded" id="myForm">
        //                         <div class="product-img position-relative overflow-hidden">
        //                             <img class="img-fluid w-100"
        //                                 src="{{ asset('storage/${response[$i].image}') }}"
        //                                 style="height: 300px;">
        //                             <div class="product-action">
        //                                 <a class="btn btn-outline-dark btn-square rounded" href=""><i
        //                                         class="fa fa-shopping-cart"></i></a>
        //                                 <a class="btn btn-outline-dark btn-square rounded" href=""><i
        //                                         class="far fa-heart"></i></a>
        //                                 <a class="btn btn-outline-dark btn-square rounded" href="">
        //                                     <i class="fa-solid fa-circle-info"></i>
        //                                 </a>
        //                             </div>
        //                         </div>
        //                         <div class="py-2 px-3">
        //                             <div class="d-flex align-items-center  justify-content-between mb-1">
        //                                 <div class="">
        //                                     <a class="h6 text-decoration-none text-truncate" href="">${response[$i].name}</a>
        //                                 </div>
        //                                 <div class="">
        //                                     <h6><i class="fa-solid fa-truck"></i>${response[$i].waiting_time}</h6>
        //                                 </div>
        //                             </div>
        //                             <div class="d-flex align-items-center justify-content-between mt-2">
        //                                 <h5>${response[$i].price} kyats</h5>
        //                                 <a href="" class="btn px-0">
        //                                     <i class="fas fa-heart text-warning"></i>
        //                                     <span class="badge text-warning border border-warning rounded-circle" style="padding-bottom: 2px;">0</span>
        //                                 </a>
        //                                 <div class="d-none d-lg-block">
        //                                     <small class="fa fa-star text-warning mr-1"></small>
        //                                     <small class="fa fa-star text-warning mr-1"></small>
        //                                     <small class="fa fa-star text-warning mr-1"></small>
        //                                     <small class="fa fa-star text-warning mr-1"></small>
        //                                     <small class="fa fa-star text-warning mr-1"></small>
        //                                 </div>
        //                             </div>
        //                         </div>
        //                     </div>
        //                   </div>`
            //                 }
            //                 $('#dataList').html($list);
            //             }
            //         })
            //     }
            // });
            $('#addCartBtn').click(function() {

                $source = {
                    'userId': $('#userId').val(),
                    'productId': $('#productId').val(),
                    'count': $('#orderCount').val(),
                };

                $.ajax({
                    type: 'get',
                    url: 'http://localhost:8000/user/ajax/cart',
                    data: $source,
                    dataType: 'json',
                    success: function(response) {
                        if (response.status == 'success') {
                            window.location.href = "http://localhost:8000/user/home";
                        }
                    }
                })
            })
        });
    </script>
@endsection
