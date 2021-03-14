<div class="container-fluid">
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
        <div class="row">

            {{-- sort options on left start --}}
            <div class="col-3">
                <div class="row mt-3">

                    <div class="col-9">
                        <div class="form-group">
                            {{-- <label for="search">Search</label> --}}
                            <input type="text" name="search" class="form-control" id="search" wire:model='search' placeholder="search">

                        </div>
                    </div>
                    <div class="col-3">
                        <span class="input-group-btn">
                            <button class="btn btn-dark" type="button">
                                <i class="fa fa-search" aria-hidden="true"></i>
                            </button>
                        </span>
                    </div>

                </div>

                <div class="row mt-3 ">
                    <div class="col-11">
                        <div class="form-group">
                            <label class="float-left" for="category">Select Category:</label>
                            <select class="form-control" id="category" wire:model='category'>
                                <option >Select category</option>
                                @foreach ($categories as $category)
                                    <option name="{{$category->name}}" id="{{$category->category_id}}" value="{{$category->category_id}}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row mt-3 ">
                    <div class="col-11">
                        <div class="form-group">
                            <label class="float-left" for="material">Select Material:</label>
                            <select class="form-control" id="material" wire:model='material'>
                                <option >Select material</option>
                                @foreach ($materials as $material)
                                    <option name="{{$material->name}}" id="{{$material->material_id}}" value="{{$material->material_id}}">{{ $material->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row mt-3 ">
                    <div class="col-11">
                        <div class="form-group">
                            <label class="float-left" for="size">Select Size:</label>
                            <select class="form-control" id="size" wire:model='size'>
                                <option >Select size</option>
                                @foreach ($sizes as $size)
                                    <option name="{{$size->name}}" id="{{$size->size_id}}" value="{{$size->category_id}}">{{ $size->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row mt-3 ">
                    <div class="col-11">
                        <div class="form-group">
                            <label for="pricerange" class="form-label float-left">Price:(£{{$price}})</label>
                            <input type="range" class="form-control-range" wire:model='price' min="0" max="{{$maxPrice}}" id="pricerange">
                        </div>
                    </div>
                </div>

            </div>
            {{-- sort options on left end --}}

            <div class="col-9">
                <div class="row">
                    @if($products)
                        @foreach ($products as $product)
                        <div class="col-md-6 col-lg-3 mb-5 shadow-lg" >
                            <!-- Grid column -->

                            <!-- Card -->
                            <div class="" wire:key='{{$product->product_id}}'>

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
                    @else
                    <div class="col-12">
                        <h4 clas="text-center">Nothing found</h4>
                    </div>
                    @endif
                </div>
            </div>

            @if($products)
                <div class="container">
                <div class="row d-flex justify-content-center">
                    {{ $products->links() }}
                </div>
                </div>
            @endif

          </div>
          <!-- Grid row -->

        </section>
        <!--Section: Block Content-->
    </div>

