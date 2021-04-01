<div>
    <div class="container">
        <div class="row m-4">
            <div class="col-8">
                <div class="card  shadow ">
                    <div class="card-body">
                        <h5 class="card-title font-weight-bold text-uppercase">Notifications</h5>
                        <div class="form-group">
                            <div class="form-check" id="form-slider">
                                <label class="form-check-label" for="status"></label>
                                <label class="switch">
                                    <input type="checkbox" name="status" wire:click="$toggle('check')">
                                    <span class="slider round"></span>
                                </label>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        @if($check)
            <div class="row m-4">
                <div class="col-8">
                    <div class="card  shadow ">
                        <div class="card-body">
                            <h5 class="card-title font-weight-bold text-uppercase">Phone Number</h5>
                            <div class="form-group">
                                <label for="">Enter you number to Recieve SMS</label>
                                <input type="text"
                                wire:model='number'
                                class="form-control" name="number" id="" aria-describedby="helpId" placeholder="include code eg +44">
                                <small id="helpId" class="form-text text-muted">We will only message you about your bookings and orders </small>
                            </div>
                            <div class=" d-flex justify-content-center">
                                <button wire:click.prevent='addNumber' type="button" class="btn btn-dark">Add</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif

    </div>
</div>
