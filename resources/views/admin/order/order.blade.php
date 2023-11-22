@extends('admin.layouts.master')

@section('title', 'Orders')
<style>
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
    .o-code {
        transition: 0.5s;
    }
    .table-responsive:hover .o-code {
        color: blue !important;
        display: block;
    }
</style>


@section('content')

    <!-- MAIN CONTENT-->
    <div class="container-fluid">
        <div class="">
            <a href="{{route('order#statusSort')}}"><i class="fa-solid fa-arrow-left"></i></a>
        </div>
            <div class="container-md ">
               <div class="row">
                    <div class="col-5 mb-4 d-flex">
                        <form action="{{route('order#statusSort')}}" method="get" class="d-flex">
                        <select id="inputStates" class="form-select" name="status">
                            <option selected class="fs-6" value=""@if(request('status')== '')  @endif>All</option>
                            <option class="fs-6" value="0"@if(request('status')== '0')selected  @endif>Pending...</option>
                            <option value="1"@if(request('status')== '1')selected  @endif>Accepted</option>
                            <option value="2"@if(request('status')== '2')selected  @endif>Denied</option>
                        </select>
                        <button type="submit" class="btn btn-sm btn-primary ">Change</button>
                    </form>
                    </div>
                    <div class="col-3 mb-4 ">
                    <form class="d-flex">
                        <input type="text" placeholder="Enter Order Code" class="form-control" name="key" id="">
                        <button type="submit" class="btn btn-primary "><i class="fa-solid fa-magnifying-glass"></i></button>
                    </form>
                    </div>
                  <div class="col-2">
                    <button class=" btn  bg-dark text-white">Total Orders- {{ $order->total()}}</button>
                  </div>
               </div>

            @if ($order->total() != 0)
            <div class="row">
                <div class="col-12 col-lg-10">
                    <div class="table-responsive card shadow-sm table-responsive-data">
                        <table class="table table-data">
                            <thead>
                                <tr>
                                    <th class="fs-6 "><span class="d-none d-lg-inline-block">User Name </span><i class="fa-solid fa-user ms-2"></i></th>
                                    <th class="fs-6">Order Code</th>
                                    <th class="fs-6">Total</th>
                                    <th class="fs-6">State</th>

                                   <th>Action</th>
                                    {{-- <th>Action</th> --}}
                                </tr>
                            </thead>
                            <tbody id="table">
                                @foreach ($order as $o)

                                    <tr class="tr-shadow pe-2">
                                        <input type="hidden" class="orderId" value="{{$o->id}}">
                                        <td class="align-middle">{{ $o->user_name }}</td>

                                        <td class="align-middle"><a class="text-warning o-code" href="{{route('order#details',$o->order_code)}}">{{ $o->order_code }}</a></td>
                                        <td class="align-middle">{{ $o->total_price }}</td>
                                        <td class="align-middle">
                                            @if ($o->status == 0)
                                                <h6 class="text-warning"><i class="fa-solid fa-spinner spin"></i> Pending...</h6>
                                            @elseif($o->status == 1)
                                            <h6 class=" text-success">Accepted!</h6>
                                            @elseif($o->status == 2)
                                            <h6 class="text-danger">Denied <i class="fa-solid fa-circle-exclamation"></i></h6>
                                            @endif
                                        </td>

                                        @if ($o->status == 0)
                                        <td>
                                            <div class="d-flex">
                                                <form action="{{route('order#accept')}}" method="post" class="mt-3 mx-1">
                                                    @csrf
                                                    <input type="hidden" name="totalPrice" value="{{$o->total_price}}">
                                                    <input type="hidden" name="orderCode" value="{{$o->order_code}}">
                                                    <input type="hidden" name="userName" value="{{$o->user_name}}">
                                                    <input type="hidden" name="id" value="{{$o->id}}">
                                                    <input type="hidden" name="statusAccept" value="1">
                                                    <button type="submit" class="btn btn-primary">Confirm</button>
                                                </form>
                                                <form action="{{route('order#deny',$o->id)}}" method="post" class="mt-3 mx-1">
                                                    @csrf
                                                    <input type="hidden" name="statusDeny" value="2">
                                                    <button type="submit" class="btn btn-warning">Deny</button>
                                                </form>
                                            </div>
                                        </td>
                                        @else
                                            <td></td>
                                        @endif
                                    </tr>

                                    <tr class="spacer"></tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="mt-2">
                        {{ $order->appends(request()->query())->links() }}
                    </div>
                    </div>

                </div>
            </div>
            @else
            <div class="row">
               <div class="col-2"> <i class="fa-solid fa-arrow-left" onclick="history.back()"></i></div>
                <div class="col-8 justify-content-center">
                    <img class="d-block w-100" src="{{asset('admin/img/inbox-zero.png')}}" alt="">
                </div>
                <div class="col-2"></div>
            </div>
            @endif
    </div>

    </div>

    <!-- END MAIN CONTENT-->
    <!-- END PAGE CONTAINER-->

@endsection
@section('myScript')
    <script>
        $(document).ready(function() {
            // $('#inputStates').change(function() {
            //     $headStatus = $('#inputStates').val();
            //     $.ajax({
            //         type: 'get',
            //         url: 'http://localhost:8000/order/ajax',
            //         data: {
            //             'headStatus': $headStatus
            //         },
            //         dataType: 'json',
            //         success: function(response) {
            //             $list = 0;
            //             for ($i = 0; $i < response.length; $i++) {
            //                 $months = ['Janurary','Februrary','March','April','May','June','July','August','September','October','November','December'];
            //                 $dbDate = new Date(response[$i].created_at);

            //                 $finalDate = $months[$dbDate.getMonth()]+'.'+$dbDate.getDate()+'.'+$dbDate.getFullYear();

            //                 if(response[$i].status == 0){
            //                    $message = `
            //                    <select  class="form-select choose-input" name="role">
            //                         <option class="fs-6" selected value="0">Pending...</option>
            //                         <option value="1" >Accepted</option>
            //                         <option value="2">Denied</option>
            //                     </select>`

            //                 }else if(response[$i] == 1){
            //                     $message = `
            //                    <select  class="form-select choose-input" name="role">
            //                         <option class="fs-6" value="0">Pending...</option>
            //                         <option value="1" selected >Accepted</option>
            //                         <option value="2">Denied</option>
            //                     </select>`

            //                 }else if(response[$i].status == 2){
            //                    $message =   $message = `
            //                    <select  class="form-select choose-input" name="role">
            //                         <option class="fs-6"  value="0">Pending...</option>
            //                         <option value="1" >Accepted</option>
            //                         <option value="2" selected >Denied</option>
            //                     </select>`
            //                 }
            //                 $list += `
            //             <tr class="tr-shadow pe-2">
            //                 <input type="hidden" class="orderId" value="${response[$i].id}">
            //                             <td class="">${response[$i].user_name}</td>
            //                             <td class="text-primary "> ${response[$i].order_code }</td>
            //                             <td class="">${response[$i].total_price}</td>
            //                             <td class="">${$message}
            //                             </td>
            //                             <td>${$finalDate}</td>

            //                         </tr>
            //                         <tr class="spacer"></tr>`
            //             }
            //             $('#table').html($list);
            //         }
            //     })

            // })

           $('.choose-input').change(function(){

            $currentStatus = $(this).val()
            $parentNode = $(this).parents('tr')
            // $statusValue = $('.choose-input').val(); not this too
            $statusValue = $parentNode.find('.choose-input').val();
            $orderId = $parentNode.find('.orderId').val();//take this
            // $orderId = $('.orderId').val() Not this one noobie
            $data =  {
                        'newStatus': $statusValue,
                        'orderId' : $orderId
                    }
            $.ajax({
                type: 'get',
                    url: 'http://localhost:8000/order/status/update',
                    data: $data,
                    dataType: 'json',
                })
            location.reload()
           })
        })
    </script>
@endsection
