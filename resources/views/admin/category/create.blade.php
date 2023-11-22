@extends('admin.layouts.master')

@section('title','Create Category')



@section('content')
    <!-- MAIN CONTENT-->
    <div class="container-fluid">
        <i class="fa-solid fa-arrow-left text-primary fs-3" onclick="history.back()"></i>
        <div class="main-content d-flex flex-column justify-content-center">
            <div class="container-md d-flex flex-column justify-content-center">
                <div class="row">
                    <div class="col-3 offset-8">
                        <a href="{{route('category#list')}}"><button class="btn bg-dark text-white my-3">List</button></a>
                    </div>

                </div>
                <div class="col-lg-6 offset-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title">
                                <h3 class="text-center text-dark">Create your caregory</h3>
                            </div>
                            <hr>
                            <form action="{{route('category#create')}}" method="post" novalidate="novalidate">
                                @csrf
                                <div class="form-group">
                                    <label class="control-label mb-1">Name</label>
                                    <input id="cc-pament" name="categoryName" type="text" class="form-control
                                    @error('categoryName') is-invalid  @enderror" aria-required="true" aria-invalid="false" placeholder="Add new category" value="{{old('categoryName')}}" >
                                    @error('categoryName')
                                        <div class="invalid-feedback">{{$message}}</div>
                                    @enderror
                                </div>

                                <div>
                                    <button  type="submit" class="btn btn-lg btn-info btn-block text-white">
                                       Create<i class="fa-solid fa-circle-right text-white ms-2"></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
       </div>
    </div>

    <!-- END MAIN CONTENT-->
    <!-- END PAGE CONTAINER-->

@endsection
