<div class="def-number-input number-input safari_only mb-0">
    <button wire:click='decreaseItems' class="minus"><i class="fa fa-minus" aria-hidden="true"></i></button>
    <input wire:model='quantity' disabled class="quantity" min="0" name="quantity" value="1" type="number">
    <button wire:click='increaseItems' class="plus"><i class="fa fa-plus" aria-hidden="true"></i></button>
</div>