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
    <div class="row px-xl-5">
       <div class="col-2"></div>
        <div class="col-lg-8 table-responsive mb-5" >

            <table class="table table-light table-borderless table-hover text-center mb-0" id="dataTable">
                <thead class="thead-dark">
                    <tr>
                        <th>Date</th>
                        <th>Voucher Id</th>
                        <th>Total Price</th>
                        <th>Delivery Fee</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody class="align-middle">
                    @foreach ($order as $o)
                       <tr>
                        <td class="align-middle">{{$o->created_at->format('j.F.Y')}}</td>
                        <td class="align-middle"><a href="{{route('user#orderDetails',$o->order_code)}}">{{$o->order_code}}</a></td>
                        <td class="align-middle">{{$o->total_price}}</td>
                        <td class="align-middle">3000 kyats</td>
                        <td class="align-middle">
                            @if ($o->status == 0)
                                <h6 class="text-warning"><i class="fa-solid fa-spinner spin"></i> Pending...</h6>
                            @elseif($o->status == 1)
                            <h6 class=" text-success">Success!</h6>
                            @elseif($o->status == 2)
                            <h6 class="text-danger">Failed <i class="fa-solid fa-circle-exclamation"></i></h6>
                            @endif
                        </td>
                       </tr>
                    @endforeach

                </tbody>
            </table>
            <div class="mt-2">
                {{$order->links()}}
            </div>

        </div>
        <div class="col-2"></div>

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
