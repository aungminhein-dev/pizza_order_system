<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>MultiShop -  @yield('title')</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />


    <!-- Libraries Stylesheet -->
    <link href="{{asset('user/lib/animate/animate.min.css')}}" rel="stylesheet">
    <link href="{{asset('user/lib/owlcarousel/assets/owl.carousel.min.css')}}" rel="stylesheet">

    <link href="{{asset('user/css/style.css')}}" rel="stylesheet">
     <!-- CSS only -->
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <!-- Customized Bootstrap Stylesheet -->
    <style>
         @import url('https://fonts.googleapis.com/css2?family=Poppins&display=swap');
        *{
            font-family: 'Poppins', sans-serif;
        }
        .wrapper {
  width: 150px;
  height: 50px;
  position: relative;
  border-radius: 10px;
  display: flex;
  justify-content: center;
  align-items: center;
  overflow: hidden;
  z-index: 3;
  box-shadow: 10px 10px 15px  rgba(0,0,0,0.2);

}
.mystyle {
  display: flex;
  justify-content: center;
  align-items: center;
  font-size: 20px;
  position: absolute;
  top: 3px;
  left: 3px;
  bottom: 3px;
  right: 3px;
  background: rgb(21, 20, 20);
  border-radius: 10px;
  color:white;
  z-index: 9;

}
.wrapper::after{
  content : '';
  background: linear-gradient(100deg,rgb(208, 255, 0),rgb(0, 221, 255),rgb(128, 0, 128));
  width: 40px;
  height: 300px;
  position: absolute;
  z-index: 2;
  filter: brightness(1.5);
  animation : spin 2.5s linear infinite;
}
@keyframes spin {
  0% {
      transform: rotate(0deg);
  }
  100% {
      transform: rotate(360deg);
  }
}
    </style>
    {{-- toastr --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g==" crossorigin="anonymous" referrerpolicy="no-referrer"/>
</head>
<body>


    <!-- Navbar Start -->

            <nav class="navbar navbar-expand-lg bg-dark mb-5  sticky-top">
                <div class="container-fluid">
                  <a class="navbar-brand" href="{{route('user#home')}}">
                    <span class="h3 text-uppercase text-dark bg-light px-2">Multi</span>
                    <span class="h3 text-uppercase text-light bg-warning px-2 ml-n1">Shop</span></a>
                    <div class="d-lg-block d-sm-none">
                        <div class="wrapper">
                            <div class="mystyle text-muted" id="clock"></div>
                        </div>
                    </div>

                  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon text-danger"></span>
                  </button>
                  <div class="collapse navbar-collapse justify-content-end px-1 py-1" id="navbarNavDropdown">
                    <ul class="navbar-nav">
                      <li class="nav-item mx-1">
                        <a class="nav-link text-warning active" aria-current="page" href="{{route('user#home')}}"><i class="fa-solid fa-house"></i> Home</a>
                      </li>
                      <li class="nav-item mx-1">
                        <a class="nav-link text-warning" href="#">Features</a>
                      </li>
                      <li class="nav-item mx-1">
                        <a class="nav-link text-warning" href="#">Pricing</a>
                      </li> |
                      <li class="nav-item mx-1 dropdown ms-4">
                        <a class="nav-link text-muted dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                          {{Auth::user()->name}}
                            @if (Auth::user()->image == null)
                            @if (Auth::user()->gender == 'male')
                            <img class="img-profile"
                            src="{{ asset('admin/img/undraw_profile.svg') }}">
                            @else
                            <img class="img-profile"
                            src="{{ asset('admin/img/undraw_profile_1.svg') }}">
                            @endif
                         @else
                             <img class="img-profile"
                                 src="{{ asset('storage/' . Auth::user()->image) }}" alt="">
                         @endif
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li class="py-2">
                                  <a class="dropdown-item" type="button" href="{{route('user#info')}}">
                                      <i class="fa-solid fa-user me-1"></i> Profile
                                  </a>
                            </li>
                            <li class="py-2">
                                  <a class="dropdown-item" type="button"href="{{route('user#changePw')}}">
                                      <i class="fa-solid fa-key"  ></i> Password
                                  </a>
                            </li>
                            <li class="py-2">
                              <form action="{{route('logout')}}" class="d-block px-1" method="POST">
                              @csrf
                              <button class="btn btn-dark w-100 " type="submit">
                                  <i class="fa-solid fa-right-from-bracket" > </i>
                                   Log Out
                              </button>
                             </form>
                          </li>
                          </ul>
                      </li>
                    </ul>
                  </div>
                </div>
              </nav>

                {{-- <nav class="navbar navbar-expand-lg bg-dark navbar-dark  py-lg-0 px-0 ">
                    <a href="" class="text-decoration-none d-block d-lg-none">
                        <span class="h1 text-uppercase text-dark bg-light px-2">Multi</span>
                        <span class="h1 text-uppercase text-light bg-warning px-2 ml-n1">Shop</span>
                    </a>
                    <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                        <div class="navbar-nav mr-auto py-0">
                            <a href="" class="nav-item mx-1 nav-link text-warning active">Home</a>
                            <a href="cart.html" class="nav-item nav-link">My Cart</a>
                            <a href="contact.html" class="nav-item nav-link">Contact</a>
                        </div>

                        <div class="navbar-nav ml-auto py-0  d-lg-block">

                           </div>
                            <div class="btn-group">
                                <button type="button" class="btn btn-dark dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa-solid fa-caret-down"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end">
                                  <li class="py-2">
                                        <a class="dropdown-item" type="button" href="{{route('user#info')}}">
                                            <i class="fa-solid fa-user me-1"></i> Profile
                                        </a>
                                  </li>
                                  <li class="py-2">
                                        <a class="dropdown-item" type="button"href="{{route('user#changePw')}}">
                                            <i class="fa-solid fa-key"  ></i> Password
                                        </a>
                                  </li>
                                  <li class="py-2">
                                    <form action="{{route('logout')}}" class="d-block px-1" method="POST">
                                    @csrf
                                    <button class="btn btn-dark w-100 " type="submit">
                                        <i class="fa-solid fa-right-from-bracket" > </i>
                                         Log Out
                                    </button>
                                   </form>
                                </li>
                                </ul>
                              </div>

                        </div>

                    </div>
                </nav> --}}
            </div>
        </div>
    </div>
    <!-- Navbar End -->

    @yield('user-content')
    <!-- Breadcrumb Start -->

    <!-- Breadcrumb End -->





    <!-- Footer Start -->
    <div class="container-fluid bg-dark text-secondary mt-5 pt-3">
        <div class="row px-xl-5 pt-5">
            <div class="col-lg-4 col-md-12 mb-5 pr-3 pr-xl-5">
                <h5 class="text-secondary text-uppercase mb-4">Get In Touch</h5>
                <p class="mb-4">No dolore ipsum accusam no lorem. Invidunt sed clita kasd clita et et dolor sed dolor. Rebum tempor no vero est magna amet no</p>
                <p class="mb-2"><i class="fa fa-map-marker-alt text-warning mr-3"></i>123 Street, New York, USA</p>
                <p class="mb-2"><i class="fa fa-envelope text-warning mr-3"></i>info@example.com</p>
                <p class="mb-0"><i class="fa fa-phone-alt text-warning mr-3"></i>+012 345 67890</p>
            </div>
            <div class="col-lg-8 col-md-12">
                <div class="row">
                    <div class="col-md-4 mb-5">
                        <h5 class="text-secondary text-uppercase mb-4">Quick Shop</h5>
                        <div class="d-flex flex-column justify-content-start  my-footer">
                            <a class="text-secondary mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Home</a>
                            <a class="text-secondary mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Our Shop</a>
                            <a class="text-secondary mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Shop Detail</a>
                            <a class="text-secondary mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Shopping Cart</a>
                            <a class="text-secondary mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Checkout</a>
                            <a class="text-secondary" href="#"><i class="fa fa-angle-right mr-2"></i>Contact Us</a>
                        </div>
                    </div>
                    <div class="col-md-4 mb-5">
                        <h5 class="text-secondary text-uppercase mb-4">My Account</h5>
                        <div class="d-flex flex-column justify-content-start my-footer">
                            <a class="text-secondary mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Home</a>
                            <a class="text-secondary mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Our Shop</a>
                            <a class="text-secondary mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Shop Detail</a>
                            <a class="text-secondary mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Shopping Cart</a>
                            <a class="text-secondary mb-2" href="#"><i class="fa fa-angle-right mr-2"></i>Checkout</a>
                            <a class="text-secondary" href="#"><i class="fa fa-angle-right mr-2"></i>Contact Us</a>
                        </div>
                    </div>
                    <div class="col-md-4 mb-5">
                        <h5 class="text-secondary text-uppercase mb-4">Newsletter</h5>
                        <p>Duo stet tempor ipsum sit amet magna ipsum tempor est</p>
                        <form action="">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Your Email Address">
                                <div class="input-group-append">
                                    <button class="btn btn-warning">Sign Up</button>
                                </div>
                            </div>
                        </form>
                        <h6 class="text-secondary text-uppercase mt-4 mb-3">Follow Us</h6>
                        <div class="d-flex my-footer">
                            <a class="btn btn-warning btn-square mr-2" href="#"><i class="fab fa-twitter"></i></a>
                            <a class="btn btn-warning btn-square mr-2" href="#"><i class="fab fa-facebook-f"></i></a>
                            <a class="btn btn-warning btn-square mr-2" href="#"><i class="fab fa-linkedin-in"></i></a>
                            <a class="btn btn-warning btn-square" href="#"><i class="fab fa-instagram"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row border-top mx-xl-5 py-4" style="border-color: rgba(256, 256, 256, .1) !important;">
            <div class="col-md-6 px-xl-0">
                <p class="mb-md-0 text-center text-md-left text-secondary">
                    &copy; <a class="text-warning" href="#">Domain</a>. All Rights Reserved. Designed
                    by
                    <a class="text-warning" href="https://htmlcodex.com">HTML Codex</a>
                </p>
            </div>
            <div class="col-md-6 px-xl-0 text-center text-md-right">
                <img class="img-fluid" src="{{asset('user/img/payments.png')}}" alt="">
            </div>
        </div>
    </div>
    <!-- Footer End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-warning back-to-top"><i class="fa fa-angle-double-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="{{asset('user/lib/easing/easing.min.js')}}"></script>
    <script src="{{asset('user/lib/owlcarousel/owl.carousel.min.js')}}"></script>

    <!-- Contact Javascript File -->
    {{-- <script src="{{asset('user/mail/jqBootstrapValidation.min.js')}}"></script>
    <script src="{{asset('user/mail/contact.js')}}"></script> --}}

    <!-- Template Javascript -->
    <script src="{{asset('user/js/main.js')}}"></script>
     <!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
{{-- Jquery --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

{{-- toastr --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</body>

@yield('myScript')
<script>
    setInterval(()=>{
    let clock = document.querySelector("#clock")
   let date = new Date();

   let hours = date.getHours()
   let minutes = date.getMinutes()
   let day_night = 'AM'

   if(hours > 12){
    day_night = 'PM'
    hours = hours-12;
   }
   if(hours < 10){
    hours = "0"+ hours;
   }
   if(minutes < 10){
    minutes = "0"+ minutes;
   }
   clock.textContent = hours +":"+ minutes + "  "+ " " + day_night

})
  </script>
</html>
