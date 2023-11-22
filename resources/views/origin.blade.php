<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">     {{-- Font Awesome --}}
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link rel="stylesheet" href="{{asset('my_css/style.css')}}">
    <title>MultiShop</title>
</head>
<body>
    <div class="my-container position-relative" id="animstion">
        <div class="hero p-5">
            <a class="navbar-brand position-absolute top-0 start-0 ms-2 mt-2" href="" >
                <span class="h3 text-uppercase text-dark bg-light px-2">Multi</span>
                <span class="h3 text-uppercase text-light bg-warning px-2 ml-n1">Shop</span>
            </a>

            <div class="hero-heading text-center">
                <h3 class="text-white fade-grow text-center">WELCOME! <i class="fa-solid fa-cart-shopping fade-show"></i></h3>
                <h4 class="text-white fade-show">MULTI SHOP</h4>
                <span class="text-white">Meet the world's new platform. The best place where u can buy the home made natural ice-pop and many kinds of stationary.</span>
                <h4 class="text-white">Lorem ipsum dolor sit amet consectetur adipisicing elit. Molestias, dolores.</h4>
            </div>
            <div class="hero-body">

            </div>
            <div class="hero-foot fade-grow text-center position-absolute bottom-0 start-0 ms-2 mb-3">
                <a href="{{route('auth#loginPage')}}" class="btn btn-dark">Login</a>
                <a href="{{route('auth#registerPage')}}" class="btn btn-dark">Register</a>
            </div>
            <div class="icons text-white d-flex position-absolute bottom-0 end-0 d-none d-lg-block">
                <h6 class="d-inline me-2"><i class="fa-solid fa-truck-fast text-primary"></i>Fast Delivery Service</h6>
                <h6 class="d-inline me-2"><i class="fa-solid fa-heart text-danger"></i>Caring about you</h6>
                <h6 class="d-inline me-2"><i class="fa-solid fa-dumpster-fire text-warning"></i>Trashes</h6>

            </div>
        </div>
    </div>

</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"
integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous">
</script>
</html>

