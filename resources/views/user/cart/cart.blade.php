@extends('user.layout.master')

@section('title','Cart')

@section('user-content')
<!-- Cart Start -->
<div class="container-fluid" style="min-height:600px">
    <div class="row px-xl-5">
        <a href="{{route('user#home')}}"><i class="fa-solid fa-arrow-left"></i></a>
        <div class="col-lg-8 table-responsive mb-5">
            @if (count($cartList) == 0)
            <img src="{{asset('admin/img/empty_cart.png')}}" alt="">
            @else
            <table class="table table-light table-borderless table-hover text-center mb-0" id="dataTable">
                <thead class="thead-dark">
                    <tr>
                        <th>Products</th>
                        <th></th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                        <th>Remove</th>
                    </tr>
                </thead>
                <tbody class="align-middle">
                     @foreach ($cartList as $c)
                     <tr>
                        <input type="hidden" name="" id="userName" value="{{Auth::user()->name}}">
                        <input type="hidden" id="productId" class="productId"  value="{{$c->product_id}}">
                        <input type="hidden" id="userId" class="userId"  value="{{$c->user_id}}">
                        <input type="hidden" id="pId" value="{{$c->id}}">

                        <input type="hidden" value="{{$c->product_price}}" name="" id="productPrice">
                        <td class="align-middle">{{$c->product_name}}</td>
                        <td class="align-middle"><img src="{{asset('storage/'.$c->product_image)}}"style="width: 90px;"></td>
                        <td class="align-middle" >{{$c->product_price}}</td>
                        <td class="align-middle">
                            <div class="input-group quantity mx-auto" style="width: 100px;">
                                <div class="input-group-btn">
                                    <button class="btn btn-sm btn-warning btn-minus"  id="minusBtn">
                                    <i class="fa fa-minus"></i>
                                    </button>
                                </div>

                                <input type="text" class="form-control form-control-sm border-0 text-center qty" id="qty" value="{{$c->qty}}">
                                <div class="input-group-btn">
                                    <button class="btn btn-sm btn-warning btn-plus" id="plusBtn">
                                        <i class="fa fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                        </td>
                        <td class="align-middle total" id="total">{{$c->product_price * $c->qty}} kyats</td>
                        <td class="align-middle"><button class="btn btn-sm btn-danger btnRemove" ><i class="fa fa-times"></i></button></td>
                    </tr>

                     @endforeach
                </tbody>
            </table>
            @endif


        </div>
        <div class="col-lg-4">
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
                    <button type="button" class="btn btn-block btn-danger font-weight-bold my-3 py-3" id="clearBtn">Remove All</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Cart End -->
@endsection
@section('myScript')
<script>
     $('#orderBtn').click(function(){
           $random = Math.floor(Math.random()*10000001);
           $userName = $('#userName').val();
           $orderList = [];

           $('#dataTable tbody tr').each(function(index,row){
            $orderList.push({
                'user_id' : $(row).find('.userId').val(),
                    'product_id' : $(row).find('.productId').val(),
                    'qty' : $(row).find('.qty').val(),
                    'total' : $(row).find('.total').text().replace('kyats','')*1,
                'order_code' : 'multishop'+$userName+$random
            });
           })

           $.ajax({
            type : 'get',
            url : 'http://localhost:8000/user/ajax/order',
            data : Object.assign({}, $orderList),
            dataType : 'json',
            success : function(response){
                if(response.status == 'true'){
                    window.location.href = "http://localhost:8000/user/home";
                }
            }
           })
     })
    $(document).ready(function(){
        //plus button click function
        $('.btn-plus').click(function(){
            $parentNode = $(this).parents("tr");
            $price = $parentNode.find('#productPrice').val();
            $qty = Number($parentNode.find('#qty').val());
            $total = $price * $qty;
            $parentNode.find('#total').html($total+" kyats");
            summaryCalculation()
        })

        //minus button click button
        $('.btn-minus').click(function(){
            $parentNode = $(this).parents("tr");
            $price = $parentNode.find('#productPrice').val();
            $qty = Number($parentNode.find('#qty').val());
            $total = $price * $qty;
            $parentNode.find('#total').html($total+" kyats");
            summaryCalculation()
        })

        //remove btn click
        $('.btnRemove').click(function(){
            $parentNode = $(this).parents("tr");
            $parentNode.remove();
            summaryCalculation()
        })

        function summaryCalculation(){
            $totalPrice = 0;
            $('#dataTable tr').each(function(index,row){
                $totalPrice += Number($(row).find('#total').text().replace("kyats",""));
            });
            $('#subTotalPrice').html(`${$totalPrice} kyats`);
            $('#finalPrice').html(`${$totalPrice+3000} kyats`);
        }


        $('#clearBtn').click(function(){
            $.ajax({
            type : 'get',
            url : 'http://localhost:8000/user/ajax/clearCart',
           })
           $('#dataTable tbody tr').remove(),
            $('#subTotalPrice').remove(),
            $('#finalPrice').remove()
        })
        $('.btnRemove').click(function(){
            $parentNode = $(this).parents('tr');
            $productId = $parentNode.find('#productId').val()
            $pId = $parentNode.find("#pId").val();

            $.ajax({
                type : 'get',
                url: 'http://localhost:8000/user/ajax/remove/eachItem',
                data: {'productId' : $productId, 'pId' : $pId},
                dataType: 'json'
            })
            $parentNode.remove();
            summaryCalculation();
        })
    })
</script>

@endsection
