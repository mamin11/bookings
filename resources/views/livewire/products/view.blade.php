<div>
    {{-- d-flex justify-content-center --}}
    <div class="container-fluid">
        <div class="row">
            <div class="col-8 ">

                {{-- card starts here --}}
                <div class="card  shadow ">
                    {{-- card header starts here --}}
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h1 class="mb-3 text-center">Create Product</h1>
                            </div>

                            <div class="col-8">
                                <form>
                                    <div class="pl-lg-4">
                                        <div class="row mb-5">
                                            <div class="col-lg-12">
                                                <div class="form-group focused mb-4">
                                                    <input type="text" wire:model.lazy='productData.name' id="productname" name="productname"  class="form-control form-control-alternative mb-4 @error('productData.name') is-invalid @enderror " placeholder="Name" value="{{  '' }}" required>
                                                        @error('productData.name')
                                                            <span class="error text-danger" role="alert">
                                                                <strong>{{$message}}</strong><br>
                                                            </span>
                                                        @enderror
                                                    <input type="number" wire:model.lazy='productData.price'  id="productprice"  class="form-control form-control-alternative mb-4 @error('productData.price') is-invalid  @enderror " placeholder="Flat Price" value="{{ '' }}" required>
                                                        @error('productData.price')
                                                            <span class="error text-danger" role="alert">
                                                                <strong>{{$message}}</strong>
                                                            </span>
                                                        @enderror
                                                    <input type="number" wire:model.lazy='productData.quantity' wire:click='priceAdded' id="productquantity"  class="form-control form-control-alternative mb-4 @error('productData.quantity') is-invalid  @enderror " placeholder="Quanity" value="{{ '' }}" required>
                                                        @error('productData.quantity')
                                                            <span class="error text-danger" role="alert">
                                                                <strong>{{$message}}</strong>
                                                            </span>
                                                        @enderror
                                                </div>

                                                <div class="form-group focused mb-4">
                                                    <textarea style="width: 100%; height: 150px;" wire:model.lazy='productData.description' wire:click='priceAdded' id="productdescription" name="productdescription" rows="4" cols="50" class="form-control form-control-alternative @error('productData.description') is-invalid @enderror " placeholder="Description" value="{{ '' }}" required></textarea>
                                                </div>
                                                
                                                @error('productData.description')
                                                    <span class="error text-danger" role="alert">
                                                        <strong>{{$message}}</strong>
                                                    </span>
                                                @enderror

                                                <div class="form-group focused mb-4">
                                                    <select class="form-control  @error('productData.category') is-invalid  @enderror" wire:model.lazy='productData.category' wire:click='categorySelected' required>
                                                        <option selected>Select Catgory</option>
                                                            @foreach ($categories as $category)
                                                                <option name="productcategory{{$loop->index}}" id="{{$category->name}}{{$loop->index}}" value="{{$category->category_id}}">{{$category->name}}</option>
                                                            @endforeach
                                                    </select>

                                                    @error('productData.category')
                                                        <span class="error text-danger" role="alert">
                                                            <strong>{{$message}}</strong>
                                                        </span>
                                                    @enderror
                                                </div>

                                                <div class="form-group focused mb-4">
                                                    <select class="form-control  @error('productData.material') is-invalid  @enderror" wire:model.lazy='productData.material' wire:click='materialSelected' required>
                                                        <option selected>Select Material</option>
                                                        @foreach ($materials as $material)
                                                            <option name="productmaterial{{$loop->index}}" id="{{$material->name}}{{$loop->index}}"  value="{{$material->material_id}}">{{$material->name}}</option>
                                                        @endforeach
                                                    </select>

                                                        @error('productData.material')
                                                        <span class="error text-danger" role="alert">
                                                            <strong>{{$message}}</strong>
                                                        </span>
                                                    @enderror
                                                </div>

                                                <div class="form-group focused mb-4">
                                                    <select class="form-control  @error('productData.size') is-invalid  @enderror" wire:model.lazy='productData.size' wire:click='sizeSelected' required>
                                                        <option selected>Select Size</option>
                                                        @foreach ($sizes as $size)
                                                            <option name="productsize{{$loop->index}}" id="{{$size->name}}{{$loop->index}}"  value="{{$size->size_id}}">{{$size->name}}</option>
                                                        @endforeach
                                                    </select>

                                                    @error('productData.size')
                                                        <span class="error text-danger" role="alert">
                                                            <strong>{{$message}}</strong>
                                                        </span>
                                                    @enderror
                                                </div>

                                                
                                                <div class="form-group focused mb-4">
                                                    <div class="form-check">
                                                        <label class="form-check-label"><h1 class="heading-2">Images</h1></label><br>
                                                        <div class="form-group mb-4">
                                                            <input type="file" multiple wire:model='images' class="form-control-file" id="productImages" required>
                                                            @error('images') <span class="error">{{ $message }}</span> @enderror
                                                        </div>

                                                        <div class="text-center mt-4">
                                                            @if($images)
                                                                @foreach ($images as $image)
                                                                    <img src="{{ $image->temporaryUrl() }}" width="150px" height="150px" class="rounded img-thumbnail img-fluid mr-2" alt="placeholder images">
                                                                @endforeach
                                                            @else
                                                            <img src="https://via.placeholder.com/150" class="rounded img-fluid mr-2" alt="placeholder images">
                                                            <img src="https://via.placeholder.com/150" class="rounded img-fluid mr-2" alt="placeholder images">
                                                            <img src="https://via.placeholder.com/150" class="rounded img-fluid mr-2" alt="placeholder images">
                                                            <img src="https://via.placeholder.com/150" class="rounded img-fluid mr-2" alt="placeholder images">
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row d-flex justify-content-center mt-4">
                                                    <div class="col-lg-8">
                                                        <div class="form-group">
                                                                <button type="submit" wire:click.prevent="addProduct" class="btn btn-dark rounded-pill btn-block btn-lg">{{__('Add') }}</button>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="form-group">
                                                                <button wire:click.prevent="updatePreview" class="btn btn-success rounded-pill btn-block btn-lg">{{__('Update Preview') }}</button>
                                                        </div>
                                                    </div>
                                                    <div wire:loading>
                                                        <img class="img-fluid text-center" src="{{asset('img/loading.gif')}}"/>
                                                    </div>
                                                </div> 

                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>

                        </div>

                    </div>
                </div>
                {{-- card ends here --}}

    


            </div>


                {{-- *************** PRODUCT PREVIEW STARTS HERE ***************** --}}
                        <div class="col-sm">
                
                            {{-- card starts here --}}
                            <div class="card  shadow ">
                                {{-- card header starts here --}}
                                <div class="card-header bg-white border-0">
                                    <div class="row align-items-center">
                                        <div class="col-12" >
                                            <h1 class="mb-3 text-center">Product Preview</h1>
                                        </div>
            
                                        <div class="col-12">
                                            <form>
                                                <div class="pl-lg-4">
                                                    <div class="row mb-5">
                                                        <div class="col-lg-12">

                                                            <div class="form-group focused">
                                                                <div class=" container-fluid">
                                                                    @if($images)
                                                                        @foreach ($images as $image)
                                                                        @if($loop->index > 0)
                                                                        @else
                                                                            <img src="{{ $image->temporaryUrl() }}" class="rounded img-thumbnail img-fluid mr-2" alt="placeholder images">
                                                                        @endif
                                                                            @endforeach
                                                                    @else
                                                                    <img src="{{asset('img/wallpaper.jpg')}}" style="height: 500px" class="img-fluid img-fluid shadow-lg" alt="placeholder images">
                                                                    @endif
                                                                </div>
                                                            </div>



                                                                <h5 class=" mt-5">{{$productData['name'] ? $productData['name'] : 'Name Goes Here'}}</h5>
                                                                <p class="mb-2 text-muted text-uppercase small">{{ $selectedCategory ? $selectedCategory->name : 'Test Data'}}</p>
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
                                                                <p><span class="mr-1"><strong>£{{$productFinalPrice ? $productFinalPrice : '12.99'}}</strong></span></p>
                                                                <p class="pt-1">{{$productData['description'] ? $productData['description'] : 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Numquam, sapiente illo. Sit
                                                                error voluptas repellat rerum quidem, soluta enim perferendis voluptates laboriosam. Distinctio,
                                                                officia quis dolore quos sapiente tempore alias.'}}
                                                                </p>

                                                                <div class="table-responsive">
                                                                    <table class="table table-sm table-borderless mb-0">
                                                                        <tbody>
                                                                        <tr>
                                                                            <th class="pl-0 w-25" scope="row"><strong>Category</strong></th>
                                                                            <td>{{ $selectedCategory ? $selectedCategory->name : 'Select Category'}}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th class="pl-0 w-25" scope="row"><strong>Material</strong></th>
                                                                            <td>{{ $selectedMaterial ? $selectedMaterial->name : 'Select Material'}}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th class="pl-0 w-25" scope="row"><strong>Size</strong></th>
                                                                            <td>{{ $selectedSize ? $selectedSize->name : '8 x 10 (20x35 cm)'}}</td>
                                                                        </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </div>

                                                                <hr>
                                                                <button class="btn btn-primary btn-md mr-1 mb-2">Buy now</button>
                                                                <button class="btn btn-light btn-md ml-4 mr-1 mt-4 mb-2"><i class="fas fa-shopping-cart pr-2"></i>Add to cart</button>

                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
            
                                    </div>

            
                                </div>
                            </div>
                            {{-- card ends here --}}
                        </div>
                {{-- *************** PRODUCT PREVIEW ENDS HERE ***************** --}}


        </div>
    </div>
</div>
