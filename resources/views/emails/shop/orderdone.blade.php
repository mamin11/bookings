@component('mail::message')
# Your Order will be delivered soon

This is to verify that your order is on its way:

<div  class="container">
Please find the order details below
</div>

<div class="col-10">
<div class="list-group-item" style="font-size: large">
<span class=""> <b>Order No:</b> {{ $order->order_number }} </span><br>
<span class=""> <b>Total Items:</b> {{ $order->getTotalItems() }} </span><br>
</div>
</div>

<div class="row">    
<div class="col-lg-8 shadow-lg">
    
<div class="card wish-list mb-3">
<div class="card-body">
    
<h5 class="mb-4 text-center">Items in your order</h5>
@foreach ($order->getOrderDetails() as $item)
<div class="row mb-4">
<div class="col-md-5 col-lg-3 col-xl-3">
<div class="view zoom overlay z-depth-1 rounded mb-3 mb-md-0">
<img class="img-fluid w-100" src="{{ $item->getProduct()->getMainImage() ? $item->getProduct()->getMainImage() : 'https://via.placeholder.com/150x100' }}" alt="Sample">
</div>
</div>
<div class="col-md-7 col-lg-9 col-xl-9">
<div>
<div class="d-flex justify-content-between">
<div>
<h5>{{ $item->getProduct() ? $item->getProduct()->name : '' }}</h5>
<p class="mb-3 text-muted text-uppercase small">{{  $item->getProduct() ? $item->getProduct()->getCategory()->name : '' }}</p>
<p class="mb-2 text-muted text-uppercase small">{{ $item->getProduct() ? $item->getProduct()->getMaterial()->name : ''}}</p>
<p class="mb-3 text-muted text-uppercase small">{{$item->getProduct() ? $item->getProduct()->getSize()->name : '' }}</p>
</div>

</div>

</div>
</div>
</div>
<hr class="mb-4">      
@endforeach
</div>
</div>
    
    
</div>
    
</div>

Thanks,<br>
{{ config('app.name') }}
@endcomponent
