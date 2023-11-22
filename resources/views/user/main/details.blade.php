@extends('user.layout.master')

@section('title', 'Details')


@section('user-content')



    <!-- Navbar Start -->
    <div class="container-fluid mb-5">
        @if (session('commented'))
            <div class="col-4 offset-8">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fa-solid fa-check me-2"></i><strong>{{ session('commented') }}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        @endif
        <div class="row px-xl-5">
            <div class="col-lg-2 mt-lg-4">
                <div class="d-inline-flex align-items-center">
                    {{-- <a href="" class="btn px-0 ml-2">
                        <i class="fas fa-heart text-dark"></i>
                        <span class="badge text-dark border border-dark rounded-circle"
                            style="padding-bottom: 2px;">0</span>
                    </a> --}}
                        <i class="fa-solid fa-arrow-left me-3 text-muted" onclick="history.back()"></i>
                        <a href="{{route('user#cartList')}}" class="btn btn-dark position-relative">
                            <i class="fa-solid fa-cart-shopping"></i>
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                {{$cart->count()}}
                            </span>
                        </a>

                </div>
            </div>

        </div>
    </div>
    <!-- Navbar End -->

    <!-- Shop Detail Start -->
    <div class="container-fluid pb-5">
        <div class="row px-xl-5">
            <div class="col-lg-5 mb-30">
                <div class="">
                    <img class="w-100 h-100 shadow" src="{{ asset('storage/' . $products->image) }}" alt="Image">
                </div>
            </div>

            <div class="col-lg-7 h-auto mb-30">
                <div class="h-100  p-30">
                    <h3>{{ $products->name }}</h3>
                    <div class="d-flex mb-3">
                        <div class="text-warning mr-2">
                            <small class="fas fa-star"></small>
                            <small class="fas fa-star"></small>
                            <small class="fas fa-star"></small>
                            <small class="fas fa-star-half-alt"></small>
                            <small class="far fa-star"></small>
                        </div>
                        <small class="pt-1">{{ count($feedback) }} Reviews | <i class="fa-solid fa-eye text-muted"></i> {{$products->view_count}}</small>
                    </div>
                    {{-- hiddens --}}
                    <input type="hidden" value="{{ Auth::user()->id }}" id="userId">
                    <input type="hidden" value="{{ $products->id }}" id="productId">
                    {{-- hiddens --}}
                    <h3 class="font-weight-semi-bold mb-4">{{ $products->price }} Kyats</h3>
                    <p class="mb-4">{{ $products->description }}</p>
                    <div class="d-flex align-items-center mb-4 pt-2">
                        <div class="input-group quantity mr-3" style="width: 130px;">
                            <div class="input-group-btn">
                                <button class="btn btn-warning btn-minus">
                                    <i class="fa fa-minus"></i>
                                </button>
                            </div>
                            <input type="text" class="form-control  border-0 text-center" value="1" id="orderCount">
                            <div class="input-group-btn">
                                <button class="btn btn-warning btn-plus">
                                    <i class="fa fa-plus"></i>
                                </button>
                            </div>
                        </div>
                        <button type="button" class="btn btn-warning px-3" id="addCartBtn"><i
                                class="fa fa-shopping-cart mr-1"></i>
                            Add To Cart
                        </button>
                    </div>
                    <div class="d-flex pt-2">
                        <strong class="text-dark mr-2">Share on:</strong>
                        <div class="d-inline-flex">
                            <a class="text-dark px-2" href="">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a class="text-dark px-2" href="">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <a class="text-dark px-2" href="">
                                <i class="fab fa-linkedin-in"></i>
                            </a>
                            <a class="text-dark px-2" href="">
                                <i class="fab fa-pinterest"></i>
                            </a>
                        </div>

                    </div>
                    <a href="{{ route('user#write', $products->id) }}" class="btn btn-danger mt-3">Give a feedback</a>
                </div>
            </div>
        </div>
        <div class="row px-xl-5">
            <div class="col-2"></div>
            @if ($feedback->count()>1)
            <div class="col">
                <div class="owl-carousel related-carousel">
                    @foreach ($feedback as $c)
                    <div class="row" style="height: 250px">
                            <div class=" mb-4 shadow-sm">
                                <h4 class="mb-4">Review for {{ $c->product }}</h4>
                                <img src="{{ asset('admin/img/undraw_profile.svg') }}" alt="Image"
                                    class="img-fluid rounded" style="width: 45px; height:45px;">
                                <div class="">
                                    <h6>{{$c->user_name}}<small> - <i>{{$c->created_at->format('j.F.Y')}}</i></small></h6>
                                    <div class="text-warning mb-2">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star-half-alt"></i>
                                        <i class="far fa-star"></i>
                                    </div>
                                    <p>{{ Str::words($c->feedback,8, '...') }}</p>

                                </div>
                            </div>

                    </div>
                    @endforeach
                </div>
              </div>
            </div>
            @else
            <div class="col">
                @foreach ($feedback as $c)
                <div class="row" style="height: 250px">
                        <div class=" mb-4 shadow-sm">
                            <h4 class="mb-4">Review for {{ $c->product }}</h4>
                            <img src="{{ asset('admin/img/undraw_profile.svg') }}" alt="Image"
                                class="img-fluid rounded" style="width: 45px; height:45px;">
                            <div class="">
                                <h6>{{$c->user_name}}<small> - <i>{{$c->created_at->format('j.F.Y')}}</i></small></h6>
                                <div class="text-warning mb-2">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star-half-alt"></i>
                                    <i class="far fa-star"></i>
                                </div>
                                <p>{{ Str::words($c->feedback,8, '...') }}</p>

                            </div>
                        </div>

                </div>
                @endforeach
            </div>
            @endif
            <div class="col-4"></div>
        </div>
    </div>

</div>

{{-- <div class="mt-2">
    {{ $feedback->appends(request()->query())->links() }}
</div> --}}

    <!-- Products Start -->
    <div class="container-fluid py-5">
        <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">You May
                Also Like</span></h2>
        <div class="row px-xl-5">
            <div class="col">
                <div class="owl-carousel related-carousel">
                    @foreach ($productLists as $l)
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
    <!-- Products End -->

@endsection
@section('myScript')
    <script>
        $(document).ready(function() {
            toastr.options.positionClass = "toast-bottom-right";
            toastr.options.closeButton = true;
            toastr.options.progressBar = true;
            $('#addCartBtn').click(function() {
                toastr.success('An item is added to your cart!')


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
                            // window.location.href = "http://localhost:8000/user/home";
                        }
                    }
                })
            })
            $parentNode = $(this).parents(".parent");


                $view = {
                    'vc' : 1,
                    'productId': $('#productId').val(),
                }
                $.ajax({
                    type: 'get',
                    url: 'http://localhost:8000/user/ajax/viewCount',
                    data: $view,
                    dataType: 'json'
                })
        })

    </script>
@endsection
