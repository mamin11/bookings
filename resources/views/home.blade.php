@extends('layouts.home')
@section('content')

<div class="container-fluid">
  {{-- <h1 class=text-center>HERO SECTION</h1> ${3|rounded-top,rounded-right,rounded-bottom,rounded-left,rounded-circle,|} --}}
  <div class="row">
    {{-- <div class="col-12" style="background-image: url('img/hero-black.jpg'); height: 100vh;">
      <h1 class="float-left text-white" style="margin:500px ">Text goes here</h1>
    </div> --}}
  </div>
  <img src="{{asset('img/hero-text-white.jpg')}}" class="img-fluid" id="hero-image" alt="">
</div>

{{-- animation section --}}
<div class="container">
  <section class="sticky">
    <blockquote class="blockquote">Check out our portfolio to see our work<span class="span"></span></blockquote>
    <img class="blockimages" id="office" src="{{asset('img/portrait-4.jpg')}}">
    <img class="blockimages" id="portrait" src="{{asset('img/portrait-1.jpg')}}">
    <img class="blockimages" id="camera" src="{{asset('img/camera.png')}}">
    <div id="box"></div>
  </section>
</div>
{{-- animation section end  --}}


    <div class="container my-5">
      <!--Section: Block Content-->
        <section class="text-center">

          @if(session()->has('success-message'))
          <div class="text-center">
            <p class="text-center alert alert-success ">{{ session()->get('success-message') }}</p>
          </div>
          @endif

          @if(session()->has('danger-message'))
          <div class="text-center">
            <p class="text-center alert alert-danger ">{{ session()->get('danger-message') }}</p>
          </div>
          @endif

          <!-- Grid row -->
          <h2 class="text-center p-5">You Can Buy These</h2>
          <div class="row">

            @foreach ($products as $product)
                <!-- Grid column -->
                <div class="col-md-6 col-lg-3 mb-5">

                  <!-- Card -->
                  <div class="">

                    <div class="view zoom overlay z-depth-2 rounded">
                      <a href="{{route('viewone', ['id' => $product->product_id])}}">
                        <div class="mask">
                          <img class="img-fluid w-100"
                            src="{{ $product->getMainImage() ? $product->getMainImage() : 'https://via.placeholder.com/150x100' }}">
                          <div class="mask rgba-black-slight"></div>
                        </div>
                      </a>
                    </div>

                    <div class="pt-4">

                      <h5><a class="product-link" href="{{route('viewone', ['id' => $product->product_id])}}">{{ $product->name }}</a></h5>
                      <h6>
                        <span class="text-grey mr-1">£{{$product->price}}</span>
                      </h6>

                      <div class="row">
                        <div class="col-12">
                            <div class="row d-flex justify-content-center text-center">
                              <form action="/cart" method="POST">
                                @csrf
                                <input type="hidden" name="id" value="{{ $product->product_id }}">
                                <input type="hidden" name="name" value="{{ $product->name }}">
                                <input type="hidden" name="price" value="{{ $product->getTotalPrice() }}">
                                  <button type="submit" class="btn col-12 text-center mt-2 cursor-pointer"><img class="add-to-cart-btn" src="https://img.icons8.com/pastel-glyph/34/000000/plus--v1.png"/></button>
                              </form>
                          </div>
                        </div>
                      </div>

                    </div>

                  </div>
                  <!-- Card -->

                </div>
                <!-- Grid column --> 
            @endforeach

            <div class="container">
              <div class="row d-flex justify-content-center">
                <a href="{{route('shop')}}" class="btn btn-dark">Shop now</a>
              </div>
            </div>

          </div>
          <!-- Grid row -->

        </section>
        <!--Section: Block Content-->
    </div>

    {{-- register now call  --}}
    <div class="container my-5" style="margin-top: 100px !important" >
      <div class="row">
        <div class="col-md-5 " >
          <img src="{{asset('img/booking.png')}}"  class="img-fluid shadow-lg" alt="">
        </div>
        <div class="col-md-7 mt-5">
          @auth
            <h1 class="text-center display-4"> Book your appointments Now while there are spaces left</h1>

            <div class="row d-flex justify-content-center m-5">
              <a href="{{route('addBooking')}}" class="btn btn-dark">Book Now</a>
            </div>
              
          @endauth

          @guest
            <h1 class="text-center display-4">Register Now to Book your appointments</h1>

            <div class="row d-flex justify-content-center m-5">
              <a href="{{route('login')}}" class="btn btn-dark">Register</a>
            </div>
          @endguest

        </div>
      </div>
    </div>

    {{-- register now call end  --}}

    {{-- team section  --}}
    <!-- Section: Team v.2 -->
<div class="container text-center my-5" style="margin-top: 100px !important">

  <!-- Section heading -->
  <h2 class="h1-responsive font-weight-bold my-5">Meet Our Team</h2>

  <!-- Grid row -->
  <div class="row text-center">

    @foreach ($staff as $user)
      <!-- Grid column -->
      <div class="col-md-4 mb-md-0 mb-5">
        <div class="avatar mx-auto">
          <img src="{{$user->getStaffProfilePic()}}" class="rounded img-thumbnail z-depth-1-half" style="width: 200px; height: 200px;" alt="Sample avatar">
        </div>
        <h4 class="font-weight-bold dark-grey-text my-4">{{$user->name}}</h4>
        <h6 class="text-uppercase grey-text mb-3"><strong>Photographer</strong></h6>
        <!-- Facebook-->
        <a type="button" class="btn-floating btn-sm mx-1 mb-0 btn-fb">
          <i class="fab fa-facebook-f"></i>
        </a>
        <!--Dribbble -->
        <a type="button" class="btn-floating btn-sm mx-1 mb-0 btn-dribbble">
          <i class="fab fa-dribbble"></i>
        </a>
        <!-- Twitter -->
        <a type="button" class="btn-floating btn-sm mx-1 mb-0 btn-tw">
          <i class="fab fa-twitter"></i>
        </a>
      </div>
      <!-- Grid column -->
    @endforeach

  </div>
  <!-- Grid row -->

</div>
<!-- Section: Team v.2 -->
    {{-- team section end  --}}

@endsection

<script>
  // var tl = new TimelineMax({onUpdate:updatePercentage});
  // var tl2 = new TimelineMax();
  // const controller = new ScrollMagic.Controller();


</script>