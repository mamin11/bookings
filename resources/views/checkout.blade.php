@extends('layouts.dashboard')
@section('content')


@section('extra-js')
{{-- <script src="https://js.stripe.com/v3/"></script> --}}
{{-- <script>
        const cardHolderName = document.getElementById('card-holder-name');
    const cardButton = document.getElementById('card-button');

    const stripe = Stripe('pk_test_9Nq6jaOF8klXI941hDxbY9f700u8lnonq9');

    const elements = stripe.elements();
    const cardElement = elements.create('card');

    cardElement.mount('#card-element');

    cardButton.addEventListener('click', async (e) => {
        const { paymentMethod, error } = await stripe.createPaymentMethod(
            'card', cardElement, {
                billing_details: { name: cardHolderName.value }
            }
        );

        if (error) {
            // Display "error.message" to the user...
            console.error(error);
        } else {
            // The card has been verified successfully...
            console.log('success');
        }
    });
</script> --}}

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
                                <form action="{{route('customerSubmit')}}" method="POST" id="payment-form">
                                    @csrf
                                    <div class="pl-lg-4">
                                    <h4 class="heading-small text-muted mb-4">User information</h4>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                <label class="form-control-label" for="input-email">Email address</label>
                                                <input type="hidden" id="invoice_id" name="invoice_id"  class="form-control form-control-alternative" value="{{$invoice ? $invoice->id : ''}}">
                                                <input type="hidden"  name="customer_id"  class="form-control form-control-alternative" value="{{$customer ? $customer->user_id : ''}}">
                                                <input type="email" disabled id="card-holder-email"  class="form-control form-control-alternative" placeholder="{{$customer ? $customer->email : ''}}">
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
                                                <input id="card-holder-address" name="address" type="text" class="form-control form-control-alternative  @error('address') is-invalid @enderror"  placeholder="Address" value="{{$customer->getAddress() ? $customer->getAddress()->address : ''}}" required>
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
                                                <input type="text" name="city" id="card-holder-city" class="form-control form-control-alternative @error('city') is-invalid @enderror"  placeholder="City" value="{{$customer->getAddress() ? $customer->getAddress()->city : ''}}" required>
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
                                                <input type="text" name="country" id="card-holder-country"  class="form-control form-control-alternative @error('country') is-invalid @enderror"  placeholder="Country" value="{{$customer->getAddress() ? $customer->getAddress()->country : ''}}" required>
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
                                                <input type="text" id="card-holder-post-code" name="post_code" class="form-control form-control-alternative @error('post_code') is-invalid @enderror" placeholder="Post Code" value="{{$customer->getAddress() ? $customer->getAddress()->post_code : ''}}" required>
                                                </div>
                                                @error('post_code')
                                                    <span class="error text-danger" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <button type="submit" class="btn btn-primary btn-block btn-lg" id="card-button">
                                        Process Payment
                                    </button>
                                    <div id="card-errors" class="error text-danger text-center mt-4" role="alert"></div>
                                </form>
                            </div>
        
        
        
                        </div>
        
                </div>
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
    const cardButton = document.getElementById('card-button');

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
    var form = document.getElementById('payment-form');
        form.addEventListener('submit', function(event) {
            event.preventDefault();
            // Disable the submit button to prevent repeated clicks
            document.getElementById('card-button').disabled = true;
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
            document.getElementById('card-button').disabled = false;
        } else {
            // Send the token to your server
            stripeTokenHandler(result.token);
        }
        });
    });

    function stripeTokenHandler(token) {
        var form = document.getElementById('payment-form');
        var hiddenInput = document.createElement('input');
        hiddenInput.setAttribute('type', 'hidden');
        hiddenInput.setAttribute('name', 'stripeToken');
        hiddenInput.setAttribute('value', token.id);
        form.appendChild(hiddenInput);

        form.submit();
    }
</script>

@endsection