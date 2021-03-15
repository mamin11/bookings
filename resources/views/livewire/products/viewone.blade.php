<div>
    <div class="container mt-5">
        <div class="row">
        <div class="col-md-6">
    
            @livewire('products.images', ['images' => $product->getImages()], key($product->product_id))
    
        </div>
        <div class="col-md-6">
    
            <h5>{{ $product->name }}</h5>
            <p class="mb-2 text-muted text-uppercase small">{{ $product->getCategory()->name }}</p>
            <ul class="rating">
                <div class="row">
                    <div class="col-6 m-0">
                        <i class="fas fa-star fa-sm text-primary"></i>
                        <i class="fas fa-star fa-sm text-primary"></i>
                        <i class="fas fa-star fa-sm text-primary"></i>
                        <i class="fas fa-star fa-sm text-primary"></i>
                        <i i class="far fa-star fa-sm text-primary"></i>
                    </div>
                </div>
            </ul>
            <p><span class="mr-1"><strong>£{{ $product->getTotalPrice() }}</strong></span></p>
            <p class="pt-1">Lorem ipsum dolor sit amet consectetur adipisicing elit. Numquam, sapiente illo. Sit
            error voluptas repellat rerum quidem, soluta enim perferendis voluptates laboriosam. Distinctio,
            officia quis dolore quos sapiente tempore alias.</p>
            <div class="table-responsive">
            <table class="table table-sm table-borderless mb-0">
                <tbody>
                <tr>
                    <th class="pl-0 w-25" scope="row"><strong>Category</strong></th>
                    <td>{{ $product->getCategory()->name }}</td>
                </tr>
                <tr>
                    <th class="pl-0 w-25" scope="row"><strong>Material</strong></th>
                    <td>{{ $product->getMaterial()->name }}</td>
                </tr>
                <tr>
                    <th class="pl-0 w-25" scope="row"><strong>Size</strong></th>
                    <td>{{ $product->getSize()->name }}</td>
                </tr>
                </tbody>
            </table>
            </div>
            <hr>

            <form action="/cart" method="POST">
                @csrf
                <input type="hidden" name="id" value="{{ $product->product_id }}">
                <input type="hidden" name="name" value="{{ $product->name }}">
                <input type="hidden" name="price" value="{{ $product->getTotalPrice() }}">
                <button type="submit" class="btn btn-primary btn-md mr-1 mb-2">Buy now</button>
                <button type="submit" class="btn btn-light btn-md mr-1 mb-2"><i
                class="fas fa-shopping-cart pr-2"></i>Add to cart</button>
            </form>
        </div>
        </div>
        {{-- container ends here  --}}

        {{-- similar products starts here  --}}
        <div class="container mt-5" style="margin-top: 200px !important;">
            <h1 class="text-center mt-5 mb-2">Similar Products</h1>
            <hr>
            <section class="text-center">
    
            <!-- Grid row -->
            <div class="row">
                @foreach ($similar as $product)
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
                        <span class="text-grey mr-1">£{{$product->getTotalPrice()}}</span>
                    </h6>

                    <div class="row">
                        <div class="col-12">
                            <div class="row">
                            <div class="col-12 text-center mt-2 cursor-pointer"><img class="add-to-cart-btn" src="https://img.icons8.com/pastel-glyph/34/000000/plus--v1.png"/></div>
                        </div>
                        </div>
                    </div>

                    </div>

                </div>
                <!-- Card -->

                </div>
                <!-- Grid column --> 
            @endforeach
                </div>
                <!-- Grid row -->

            </section>
        </div>
        {{-- similar products ends here  --}}

</div>
