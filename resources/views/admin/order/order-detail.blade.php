@extends('admin.layouts.master')

@section('title', 'Order Details')
<style>
    .image{
        height: auto;
    }
    .image img{
        width: 100%;
        height: 100%;
    }
    .spin {
        animation: spin 3s infinite;
    }

    @keyframes spin {
        0% {
            transform: none;
        }

        50% {
            transform: rotate(180deg);
            opacity: 0;
        }

        100% {
            transform: rotate(360deg);
            opacity: 1;
        }
    }
</style>

@section('content')


        <!-- Outer Row -->
<div class="container-md">
    <i class="fa-solid fa-arrow-left text-primary fs-3" onclick="history.back()"></i>
    <h3 class="text-warning justify-content-center d-flex">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        Order Details
    </h3>

      <div class="row">

        <div class="col-lg-4 col-md-6" >
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
                 <h6 class=" text-success">Accepted!</h6>
                 @elseif($orderCode->status == 2)
                 <h6 class="text-danger">Failed<i class="fa-solid fa-circle-exclamation"></i></h6>
                 @endif
             </div>
             @if ($orderCode->status == 0)
             <div class="d-flex">
                <form action="{{route('order#accept')}}" method="post" class="mt-3 mx-1">
                    @csrf
                    <input type="hidden" name="totalPrice" value="{{$order->total_price}}">
                    <input type="hidden" name="orderCode" value="{{$order->order_code}}">
                    <input type="hidden" name="userName" value="{{$order->user_name}}">
                    <input type="hidden" name="id" value="{{$order->id}}">
                    <input type="hidden" name="statusAccept" value="1">
                    <button type="submit" class="btn btn-primary">Confirm</button>
                </form>
                <form action="{{route('order#deny',$order->id)}}" method="post" class="mt-3 mx-1">
                    @csrf
                    <input type="hidden" name="statusDeny" value="2">
                    <button type="submit" class="btn btn-warning">Deny</button>
                </form>
            </div>j
             @endif
            </div>
         </div>
        <div class="col-lg-8  ">
        <table class="table shadow-lg table-light  table-hover text-center mb-0" id="dataTable">
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
        </div>

      </div>
    </div>

    </div>
</div>
@endsection
