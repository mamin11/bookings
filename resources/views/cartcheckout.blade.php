@extends('layouts.home')
@section('content')


@section('extra-js')

@endsection



<div class="container">
    <div class="row mt-4 d-flex justify-content-center">

            <div class="container  d-flex justify-content-center">
                <div class="col-xl-9">
        
                        <div class="card  shadow ">
                            <div class="card-header bg-white border-0">
                                <div class="row align-items-center">
                                <div class="col-12">
                                    <h1 class="mb-0 text-center">CHECKOUT</h1>
                                </div>
                                </div>
                            </div>
                        
                            <div class="card-body">
                                <form action="{{route('cartcheckoutpost')}}" method="POST" id="payment-form-cart">
                                    @csrf
                                    <div class="pl-lg-4">
                                    <h4 class="heading-small text-muted mb-4">User information</h4>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                <label class="form-control-label" for="input-email">Email address</label>
                                                <input type="hidden" id="shipping" name="shipping"  class="form-control form-control-alternative" value="{{ $shipping ? $shipping : '' }}">
                                                <input type="hidden"  name="total"  class="form-control form-control-alternative" value="{{ $total ? $total : '' }}">
                                                <input type="email" disabled id="card-holder-email"  class="form-control form-control-alternative" placeholder="{{ Auth::user()->email ? Auth::user()->email : ''}}">
                                                </div>
                                                @error('email')
                                                    <span class="error text-danger" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="form-group focused">
                                                <label class="form-control-label" for="input-username">Name on Card</label>
                                                <input id="card-holder-name" name="name" type="text" class="form-control orm-control-alternative" placeholder="Card Holder Name" aria-label="Card Holder" aria-describedby="basic-addon1" required>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-12" id="card-element"></div>
                                        </div>

                                    </div>
                                    <hr class="my-4">
                                    <!-- Address -->
                                    <h4 class="heading-small text-muted mb-4">Contact information</h4>
                                    <div class="pl-lg-4">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group focused">
                                                <label class="form-control-label" for="card-holder-address">Address</label>
                                                <input id="card-holder-address" name="address" type="text" class="form-control form-control-alternative  @error('address') is-invalid @enderror"  placeholder="Address" value="{{Auth::user()->getAddress() ? Auth::user()->getAddress()->address : ''}}" required>
                                                </div>
                                                @error('address')
                                                    <span class="error text-danger" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-4">
                                                <div class="form-group focused">
                                                <label class="form-control-label" for="card-holder-city">City</label>
                                                <input type="text" name="city" id="card-holder-city" class="form-control form-control-alternative @error('city') is-invalid @enderror"  placeholder="City" value="{{Auth::user()->getAddress() ? Auth::user()->getAddress()->city : ''}}" required>
                                                </div>
                                                @error('city')
                                                    <span class="error text-danger" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-group focused">
                                                <label class="form-control-label" for="card-holder-country">Country</label>
                                                <input type="text" name="country" id="card-holder-country"  class="form-control form-control-alternative @error('country') is-invalid @enderror"  placeholder="Country" value="{{Auth::user()->getAddress() ? Auth::user()->getAddress()->country : ''}}" required>
                                                </div>
                                                @error('country')
                                                    <span class="error text-danger" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                <label class="form-control-label" for="card-holder-post-code">Postal code</label>
                                                <input type="text" id="card-holder-post-code" name="post_code" class="form-control form-control-alternative @error('post_code') is-invalid @enderror" placeholder="Post Code" value="{{Auth::user()->getAddress() ? Auth::user()->getAddress()->post_code : ''}}" required>
                                                </div>
                                                @error('post_code')
                                                    <span class="error text-danger" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <button type="submit" class="btn btn-dark btn-block btn-lg" id="card-button-pay">
                                        Process Payment
                                    </button>
                                    <div id="card-errors" class="error text-danger text-center mt-4" role="alert"></div>
                                    @if ($errors->any())
                                        <span class="error text-danger" role="alert">
                                            @foreach ($errors->all() as $error)
                                                <strong>{{ $error }}</strong>
                                            @endforeach
                                        </span>
                                    @endif


                                    @if(session()->has('success-message'))
                                        <div class="text-center">
                                        <p class="text-center alert alert-success ">{{ session()->get('success-message') }}</p>
                                        </div>
                                    @endif
                                </form>
                            </div>
        
        
        
                        </div>
        
                </div>

                        <!--Grid column ORDER DETAILS -->
                        <div class="col-lg-4 shadow-lg">
                    
                            <!-- Card -->
                            <div class="card mT-3">
                                <div class="card-body">
                        
                                    <h5 class="mb-3">The total amount of</h5>
                        
                                    <ul class="list-group list-group-flush">
                                    <li class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 pb-0">
                                        Products Price
                                        <span>£{{ $total ?( $total  ): '' }}</span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                        Shipping and packaging
                                        <span>£{{ $shipping ? $shipping : '' }}</span>
                                    </li>
                                    <li class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 mb-3">
                                        <div>
                                        <strong>The total amount of</strong>
                                        <strong>
                                            <p class="mb-0">(including VAT)</p>
                                        </strong>
                                        </div>
                                        <span><strong>£{{ $total ? ($total + $shipping) : '' }}</strong></span>
                                    </li>
                                    </ul>
                                                            
                                </div>
                            </div>
                            <!-- Card -->

                    </div>
                    <!--Grid column-->

                </div>
            </div>
            </div>
        </div>


            </div>

    </div>
</div>

<script src="https://js.stripe.com/v3/"></script>
<script>
    const cardHolderName = document.getElementById('card-holder-name');
    const cardHolderEmail = document.getElementById('card-holder-email');
    const cardHolderAddress = document.getElementById('card-holder-address');
    const cardHolderCity = document.getElementById('card-holder-city');
    const cardHolderCountry = document.getElementById('card-holder-country');
    const cardHolderPostcode = document.getElementById('card-holder-post-code');
    const cardButton = document.getElementById('card-button-pay');

    const stripe = Stripe('pk_test_9Nq6jaOF8klXI941hDxbY9f700u8lnonq9');

    const elements = stripe.elements();
    const cardElement = elements.create('card', {
        hidePostalCode: true
    });

    cardElement.mount('#card-element');

    //     // Handle real-time validation errors from the card Element.
    // cardButton.addEventListener('change', function(event) {
    // var displayError = document.getElementById('card-errors');
    //     if (event.error) {
    //         displayError.textContent = event.error.message;
    //     } else {
    //         displayError.textContent = '';
    //     }
    // });

    cardButton.addEventListener('click', async (e) => {
        const { paymentMethod, error } = await stripe.createPaymentMethod(
            'card', cardElement, {
                billing_details: { name: cardHolderName.value,  email: cardHolderEmail.value,  address: cardHolderAddress.value,  city: cardHolderCity.value,  country: cardHolderCountry.value,  zip: cardHolderPostCode.value, }
            }
        );

        if (error) {
            // Display "error.message" to the user...
            var errorElement = document.getElementById('card-errors');
            errorElement.textContent = error.message;
            // errorElement.textContent = result.error.message;
            console.error(error);
        } else {
            // The card has been verified successfully...
            console.log('success');
        }
    });

    // Handle form submission
    var form = document.getElementById('payment-form-cart');
        form.addEventListener('submit', function(event) {
            event.preventDefault();
            // Disable the submit button to prevent double clicks
            document.getElementById('card-button-pay').disabled = true;
            var options = {
            name: document.getElementById('card-holder-name').value,
            address_line1: document.getElementById('card-holder-address').value,
            address_city: document.getElementById('card-holder-city').value,
            address_country: document.getElementById('card-holder-country').value,
            address_zip: document.getElementById('card-holder-post-code').value
            }

    stripe.createToken(cardElement, options).then(function(result) {
        if (result.error) {
            // Inform the user if there was an error
            var errorElement = document.getElementById('card-errors');
            errorElement.textContent = result.error.message;
            // Enable the submit button
            document.getElementById('card-button-pay').disabled = false;
        } else {
            // Send the token to your server
            stripeTokenHandler(result.token);
        }
        });



    });

    function stripeTokenHandler(token) {
        var form = document.getElementById('payment-form-cart');
        var hiddenInput = document.createElement('input');
        hiddenInput.setAttribute('type', 'hidden');
        hiddenInput.setAttribute('name', 'stripeToken');
        hiddenInput.setAttribute('value', token.id);
        form.appendChild(hiddenInput);

        form.submit();
    }
</script>

@endsection