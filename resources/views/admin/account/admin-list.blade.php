@extends('admin.layouts.master')

@section('title', 'Admin List')
<style>
    .fl{
        display: flex;
        justify-content: space-between;
        padding: 0 10px 0 10px;
    }
</style>
@section('nav')
<form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
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

    @endsection
@section('content')

<div class="row mb-5 fl">
    <div class="col-3">
        <form class="form-inline mr-auto navbar-search">
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
    </div>

</div>
@if (count($admins) != 0)
<h3 class="text-muted ms-lg-5"><i class="fa-solid fa-user text-primary"></i><span class="text-black">
    {{ $admins->total() }}</span>
</h3>
@endif
    @if (request('key') == null)
   <div class="row">
    <div class="col-1"></div>
    <div class="col-10 table-responsive table-responsive-data2">
        <table class="table table-data2">
            <thead>
                <tr>
                    <th class="fs-6">Profile Picture</th>
                    <th class="fs-6 ">Name</th>
                    <th class="fs-6">Email</th>
                    <th class="fs-6">Joined at</th>
                    <th>Role Edit</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($admins as $a)
                    <tr class="tr-shadow pe-2 ">
                        <input type="hidden" name=""class="userId" value="{{$a->id}}">
                        <td class=" align-middle">
                            @if ($a->image == null)
                                @if ($a->gender == 'male')
                                    <img src="{{ asset('admin/img/undraw_profile.svg') }}" class="rounded-circle shadow-sm"
                                        alt="" width="80px" height="80px">
                                @else
                                    <img src="{{ asset('admin/img/undraw_profile_1.svg') }}"
                                        class="rounded-circle shadow-sm" alt="" width="80px" height="80px">
                                @endif
                            @else
                                <img src="{{ asset('storage/' . $a->image) }}" class="rounded-circle shadow-sm"
                                    alt="" width="80px" height="80px">
                            @endif
                        </td>

                        <td class="text-primary  align-middle">{{ $a->name }}</td>
                        <td class="text-muted align-middle">{{ $a->email }}</td>
                        <td class=" align-middle text-muted">{{ $a->created_at->format('j.F.Y') }}</td>
                        <td class="align-middle">
                            <select name="" id="" class="choose-input form-control">
                                <option value="">Select Role</option>
                                <option value="admin" @if ($a->role == 'admin') selected  @endif>Admin</option>
                                <option value="user" @if ($a->role == 'user') selected  @endif>User</option>
                            </select>
                        </td>
                        <td class="align-middle">
                            @if (Auth::user()->id != $a->id)
                                <a href="{{ route('admin#deleteAccount', $a->id) }}" class="btn btn-secondary btn-sm">
                                    <i class="fa-solid fa-trash-can"></i>
                                </a>
                                <a href="{{route('admin#editRole',$a->id)}}" class="btn btn-secondary btn-sm">
                                    <i class="fa-solid fa-users-gear"></i>
                                   </a>
                            @endif
                        </td>

                    </tr>
                    <tr class="spacer"></tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="col-1"></div>
   </div>
    <div class="mt-2">
    </div>
    @else
    <div class="row-md d-flex justify-content-center">
      <div class="">
        <img src="{{asset('admin/img/not_found.jpg')}}"width="600px">
        <div class="col-lg-8">
            @if (request('key') != null)
              <div class="">
                  <h4 class="text-muted text-center">Result for <span class="text-danger fs-1">{{ request('key') }}</span></h4>
              </div>
            @endif
            <h2 class="my-3 text-center">No admin found!</h2>
          </div>
      </div>
    </div>

    @endif
@endsection
@section('myScript')
    <script>
        $(document).ready(function() {
           $('.choose-input').change(function(){
            $currentStatus = $(this).val()
            $parentNode = $(this).parents('tr')
            $userRole = $parentNode.find('.choose-input').val()
            $userId = $parentNode.find('.userId').val()
            $data =  {
                        'userRole': $userRole,
                        'userId':$userId
                    }
                    if($userRole != null || $userRole != ""){
                        $.ajax({
                        type: 'get',
                        url: 'http://localhost:8000/admin_account/changeRole',
                        data: $data,
                        dataType: 'json',
                    })
                    }
          })
        })
    </script>
@endsection
