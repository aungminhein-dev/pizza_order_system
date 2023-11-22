@extends('user.layout.master')

@section('title', 'Feedbacks')


@section('user-content')



    <!-- Navbar Start -->
    @if (session('commented'))
    @endif
    <div class="container-fluid pb-5" style="min-height: 70vh">
        <div class="row px-xl-5">
            <a href="{{route('user#home')}}"><i class="fa-solid fa-arrow-left"></i></a>
                <div class="bg-light p-30">
                    <div class="row">
                        <div class="col-md-5">
                            <h4 class="mb-4">Leave a review</h4>
                            <small>Your email address will not be published. Required fields are marked *</small>
                            <div class="d-flex my-3">
                                <p class="mb-0 mr-2">Your Rating * :</p>
                                <input type="number" min="0" max= "5"class="form-control col-2" name="" id="">
                                <p> <i class="fa-solid fa-multiply text-muted mx-2 mt-2"></i> </p>
                                <p><i class="fa-solid fa-star fs-2 text-warning"></i></p>
                            </div>
                            <form action="{{ route('user#feedbacks') }}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="message">Your Review</label>
                                    <textarea id="message" cols="30" rows="5"
                                        class="form-control @error('feedback') is-invalid
                                            @enderror"
                                        name="feedback"></textarea>
                                    @error('feedback')
                                        <small class="invalid-feedback">
                                            {{ $message }}
                                        </small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <input type="hidden" name="currentName" value="{{Auth::user()->name}}">
                                    <input type="hidden" name="product" value="{{$list->name}}">
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
                        <div class="col-md-4 offset-1">

                            @foreach ($comments as $c)
                            <div class="row">
                                <h4 class="mb-4">Review for {{ $c->product }}</h4>
                                    <div class=" mb-4 shadow-sm">
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
                                            <p>{{ $c->feedback }}</p>
                                        </div>
                                    </div>
                            </div>
                            @endforeach
                        </div>

                        <div class="mt-2">
                            {{ $comments->appends(request()->query())->links() }}
                        </div>
                    </div>
                </div>
        </div>
    </div>
    </div>
    <!-- Shop Detail End -->

@endsection
