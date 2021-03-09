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
            {{-- <div class="col-md-8">
                <div class="card-details">
                    <h3 class="title">Credit Card Details</h3>
                    <div class="row">

                    <div class="form-group col-sm-8">
                        <label for="card-number">Card Number</label>
                        <input id="card-number" type="text" class="form-control" placeholder="Card Number" aria-label="Card Holder" aria-describedby="basic-addon1">
                    </div>
                    <br>

                    <div class="form-group col-sm-8">
                        <label for="card-holder">Card Holder</label>
                        <input id="card-holder" type="text" class="form-control" placeholder="Card Holder" aria-label="Card Holder" aria-describedby="basic-addon1">
                    </div>
                    <br>

                    <div class="form-group col-sm-8">
                        <label for="cvc">CVC</label>
                        <input id="cvc" type="text" class="form-control" placeholder="CVC" aria-label="Card Holder" aria-describedby="basic-addon1">
                    </div>

                    <div class="form-group col-sm-8">
                        <label for="">Expiration Date</label>
                        <div class="input-group expiration-date">
                        <input type="text" class="form-control mr-2" placeholder="MM" aria-label="MM" aria-describedby="basic-addon1">
                        <input type="text" class="form-control" placeholder="YY" aria-label="YY" aria-describedby="basic-addon1">
                        </div>
                    </div>

                    <div class="form-group col-sm-8">
                        <button type="button" class="btn btn-primary btn-block">Proceed</button>
                    </div>
                    </div>
                </div>
            </div> --}}

            <div class="form-group">
                {{-- <label for="card-element">Credit or Debit card </label> --}}
                <form action="{{route('customerSubmit')}}" method="POST" id="payment-form">
                    @csrf
                    <div class="form-group col-md-12">
                        <label for="card-holder">Card Holder</label>
                        <input id="card-holder-name" type="text" class="form-control col-12" placeholder="Card Holder" aria-label="Card Holder" aria-describedby="basic-addon1">
                    </div>
                    <div id="card-element"></div>
                    <button type="submit" class="btn btn-primary btn-block" id="card-button">
                        Process Payment
                    </button>
                    <div id="card-errors" role="alert"></div>
                </form>
            </div>


            </div>

    </div>
</div>
<script src="https://js.stripe.com/v3/"></script>
<script>
    const cardHolderName = document.getElementById('card-holder-name');
    const cardButton = document.getElementById('card-button');

    const stripe = Stripe('pk_test_9Nq6jaOF8klXI941hDxbY9f700u8lnonq9');

    const elements = stripe.elements();
    const cardElement = elements.create('card', {
        hidePostalCode: true
    });

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

    // Handle form submission
    var form = document.getElementById('payment-form');
        form.addEventListener('submit', function(event) {
            event.preventDefault();
            // Disable the submit button to prevent repeated clicks
            document.getElementById('card-button').disabled = true;
            // var options = {
            // name: document.getElementById('name_on_card').value,
            // address_line1: document.getElementById('address').value,
            // address_city: document.getElementById('city').value,
            // address_state: document.getElementById('province').value,
            // address_zip: document.getElementById('postalcode').value
            // }

    stripe.createToken(cardElement).then(function(result) {
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