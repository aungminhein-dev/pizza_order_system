@extends('user.layout.master')

@section('title','Order History')
@section('user-content')
<style>
    .spin{
        animation: spin 3s infinite;
    }
    @keyframes spin {
        0%{
            transform: none;
        }
        50%{
            transform: rotate(180deg);
            opacity: 0;
        }
        100%{
            transform: rotate(360deg);
            opacity: 1;
        }
    }
</style>
<!-- Cart Start -->
<div class="container-fluid" style="min-height:500px">
    <i class="fa-solid fa-arrow-left" onclick="history.back()"></i>

    <div class="row px-xl-5 px-md-2">

        <div class="col-lg-4 col-md-6 mb-5" >
           <div class="card shadow  p-3 mb-3">
            <p class="text-danger"><span class="text-muted">Order Code -</span>{{$orderCode->order_code}}</p>
            <p class="text-danger"><span class="text-muted">Sub Total - </span>{{$orderCode->total_price}} kyats</p>
            <p class="text-danger"><span class="text-muted">Delivery - </span>3000 kyats</p>
            <p class="text-danger"><span class="text-muted">Total -</span>{{$orderCode->total_price + 3000}} kyats <span class="text-warning">(Including delivery fee)</span></p>
            <p class="text-danger"><span class="text-muted">Date  </span>{{$orderCode->created_at->format('j-F-Y')}}</p>

            <div class="align-middle d-flex">
                <h6 class="text-muted me-3">Status  </h6>
                @if ($orderCode->status == 0)
                    <h6 class="text-warning"><i class="fa-solid fa-spinner spin"></i> Pending...</h6>
                @elseif($orderCode->status == 1)
                <h6 class=" text-success">Succeed!</h6>
                @elseif($orderCode->status == 2)
                <h6 class="text-danger">Failed<i class="fa-solid fa-circle-exclamation"></i></h6>
                @endif
            </div>
            <a href="{{route('user#sendmail',$orderCode->order_code)}}" class="btn btn-primary text-white">Send Invoice Via Email <i class="fa-regular fa-envelope"></i></a>
           </div>
        </div>
        <div class="col-lg-8">
            <table class="table table-light table-borderless table-hover text-center mb-0" id="dataTable">
                <thead class="thead-dark">
                    <tr>
                        <th>Date</th>
                        <th></th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody class="align-middle">
                    @foreach ($each_order as $o)
                       <tr>
                        <td class="align-middle">{{$o->created_at->format('j.F.Y')}}</td>
                        <td class="align-middle"><img width="100px" src="{{asset('storage/'.$o->p_image)}}" alt=""></td>
                        <td class="align-middle">{{$o->p_price}}</td>
                        <td class="align-middle">{{$o->qty}}</td>
                        <td class="align-middle">{{$o->total}}</td>
                       </tr>

                    @endforeach

                </tbody>
            </table>
            @if (session('success'))
            <span class=" ">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fa-solid fa-check me-2"></i><strong>{{ session('success') }}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                        aria-label="Close"></button>
                </div>
            </span>
        @endif
        @if (session('fail'))
        <span class=" ">
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fa-solid fa-check me-2"></i><strong>{{ session('fail') }}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert"
                    aria-label="Close"></button>
            </div>
        </span>
    @endif
        </div>


        {{-- <div class="col-lg-4">
            <h5 class=" text-uppercase mb-3"><span class="bg-dark p-1 text-white">Cart Summary</span></h5>
            <div class="bg-light p-30 mb-5">
                <div class="border-bottom pb-2">
                    <div class="d-flex justify-content-between mb-3">
                        <h6>Subtotal</h6>
                        <h6 id="subTotalPrice">{{$totalPrice}} kyats</h6>
                    </div>
                    <div class="d-flex justify-content-between">
                        <h6 class="font-weight-medium">Delivery</h6>
                        <h6 class="font-weight-medium">3000 kyats</h6>
                    </div>
                </div>
                <div class="pt-2">
                    <div class="d-flex justify-content-between mt-2">
                        <h5>Total</h5>
                        <h5 id="finalPrice">{{$totalPrice + 3000}} kyats</h5>
                    </div>
                    <button type="button" class="btn btn-block btn-warning font-weight-bold my-3 py-3" id="orderBtn">Proceed To Checkout</button>
                </div>
            </div>
        </div> --}}
    </div>
</div>
<!-- Cart End -->
@endsection
