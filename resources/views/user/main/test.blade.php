@extends('user.layout.master')

@section('title','Details')


@section('user-content')
<div class="">
    <span>{{asset('storage/'. $product->name)}}</span>
</div>

                        <div class="" id="tab-pane-3">
                            <div class="row">
                               @foreach ($feedback as $c)
                               <div class="col-md-6">
                                <h4 class="mb-4">Review for</h4>
                                <div class="media mb-4">
                                    <img src="" alt="Image" class="img-fluid mr-3 mt-1" style="width: 45px;">
                                    <div class="media-body">
                                        <h6>John Doe<small> - <i>01 Jan 2045</i></small></h6>
                                        <div class="text-warning mb-2">
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star-half-alt"></i>
                                            <i class="far fa-star"></i>
                                        </div>
                                        <p>{{$c->feedback}}</p>
                                    </div>
                                </div>
                            </div>
                               @endforeach
                                <div class="col-md-6">
                                    <h4 class="mb-4">Leave a review</h4>
                                    <small>Your email address will not be published. Required fields are marked *</small>
                                    <div class="d-flex my-3">
                                        <p class="mb-0 mr-2">Your Rating * :</p>
                                        <div class="text-warning">
                                            <i class="far fa-star"></i>
                                            <i class="far fa-star"></i>
                                            <i class="far fa-star"></i>
                                            <i class="far fa-star"></i>
                                            <i class="far fa-star"></i>
                                        </div>
                                    </div>
                                    <form action="{{route('user#feedbacks')}}" method="post">
                                        @csrf
                                        <div class="form-group">
                                            <label for="message">Your Review</label>
                                            <textarea id="message" cols="30" rows="5" class="form-control @error('feedback') is-invalid
                                            @enderror" name="feedback"></textarea>
                                            @error('feedback')
                                            <small class="invalid-feedback">
                                                {{$message}}

                                            </small>
                                            @enderror
                                        </div>
                                     <div class="form-group">
                                            <label for="email">Your Email</label>
                                            <input type="email" class="form-control" name="email" id="email">
                                        </div>
                                        <div class="form-group mb-0">
                                            <input type="submit" value="Leave Your Review" class="btn btn-warning px-3">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Shop Detail End -->

@endsection
