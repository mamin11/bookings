<div>
    {{-- d-flex justify-content-center --}}
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm vertical-divider">

                {{-- card starts here --}}
                <div class="card  shadow ">
                    {{-- card header starts here --}}
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <div class="col-12">
                                <h1 class="mb-3 text-center">Product Categories</h1>
                            </div>

                            <div class="col-12">
                                <form>
                                    <div class="pl-lg-4">
                                        <div class="row mb-5">
                                            <div class="col-lg-12">
                                                <div class="form-group focused">
                                                    <input type="text" wire:model.lazy='categoryForm.name' id="categoryname"  class="form-control form-control-alternative @error('categoryForm.name') is-invalid @enderror " placeholder="Category name" value="">
                                                    <input type="number" wire:model.lazy='categoryForm.extra_cost' id="categoryextraprice"  class="form-control form-control-alternative @error('categoryForm.extra_cost') is-invalid @enderror " placeholder="Extra Price" value="">
                                                </div>

                                                @error('categoryForm.name')
                                                    <span class="error text-danger" role="alert">
                                                        <strong>{{ $message }}</strong><br>
                                                    </span>
                                                @enderror

                                                @error('categoryForm.extra_cost')
                                                    <span class="error text-danger" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>

                        </div>
                        
                        
                            {{-- button starts here --}}
                            <div class="row d-flex justify-content-center">
                                <div class="col-lg-8">
                                    <div class="form-group">
                                        <button type="submit" wire:click.prevent="addCategory" class="btn btn-dark rounded-pill btn-block btn-lg">{{__('Add') }}</button>
                                    </div>
                                </div>
                            </div>
                            {{-- button ends here --}}

                    </div>
                    {{-- card header ends here --}}
                
                    <div class="card-body">
                        <ul class="list-group list-group">
                            @if(count($productCategories))
                                @foreach ($productCategories as $item)
                                    <li id="category{{$item->category_id}}"  class="list-group-item">{{$item->name}}
                                        <div class="pull-right">
                                        <span id="badge" class="badge" style="float:left;">Extra: £{{$item->extra_cost}}</span>
                                        @if($categoryConfirmingID === $item->category_id)
                                            <span id="badge" class="badge cursor-pointer" wire:click="deleteCategory({{$item->category_id}})" style="color: red; float: right;">Sure?</span>
                                        @else
                                            <i class="fa fa-trash cursor-pointer" wire:click="confirmDelete({{$item->category_id}})" style="color: red; float: right;"></i>
                                        @endif
                                            <i class="fa fa-pen cursor-pointer" wire:click="updateCategpry({{$item->category_id}})"  style="color: black; padding-right: 10px; float: right;"></i>
                                        </div>
                                    </li>
                                @endforeach
                                
                            @else
                            <span id="badge" class="badge" style="float:center;">Nothing found</span>
                            @endif
                        </ul>
                    </div>
                </div>
                {{-- card ends here --}}

            </div>

            {{-- *************** MATERIALS ***************** --}}
            <div class="col-sm vertical-divider">
                
                {{-- card starts here --}}
                <div class="card  shadow ">
                    {{-- card header starts here --}}
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <div class="col-12">
                                <h1 class="mb-3 text-center">Product Materials</h1>
                            </div>

                            <div class="col-12">
                                <form>
                                    <div class="pl-lg-4">
                                        <div class="row mb-5">
                                            <div class="col-lg-12">
                                                <div class="form-group focused">
                                                    <input type="text" id="productmaterial" wire:model.lazy='materialForm.name' class="form-control form-control-alternative @error('materialForm.name') is-invalid @enderror " placeholder="Product Material" value="">
                                                    <input type="number" id="materialextraprice" wire:model.lazy='materialForm.extra_price_on_product' class="form-control form-control-alternative @error('materialForm.extra_price_on_product') is-invalid @enderror " placeholder="Extra Price" value="">
                                                </div>

                                                @error('materialForm.name')
                                                    <span class="error text-danger" role="alert">
                                                        <strong>{{ $message }}</strong><br>
                                                    </span>
                                                @enderror

                                                @error('materialForm.extra_price_on_product')
                                                    <span class="error text-danger" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>

                        </div>
                        
                        
                            {{-- button starts here --}}
                            <div class="row d-flex justify-content-center">
                                <div class="col-lg-8">
                                    <div class="form-group">
                                        <button type="submit" wire:click.prevent="addMaterial" class="btn btn-dark rounded-pill btn-block btn-lg">{{__('Add') }}</button>
                                    </div>
                                </div>
                            </div>
                            {{-- button ends here --}}

                    </div>
                    {{-- card header ends here --}}
                
                    <div class="card-body">
                        <ul class="list-group list-group">
                            @if(count($productMaterials))
                                @foreach ($productMaterials as $item)
                                    <li id="material{{$item->material_id}}"  class="list-group-item">{{$item->name}}
                                        <div class="pull-right">
                                        <span id="badge" class="badge" style="float:left;">Extra: £{{$item->extra_price_on_product}}</span>
                                        @if($materialConfirmingID === $item->material_id)
                                            <span id="badge" class="badge cursor-pointer" wire:click="deleteMaterial({{$item->material_id}})" style="color: red; float: right;">Sure?</span>
                                        @else
                                            <i class="fa fa-trash cursor-pointer" wire:click="confirmDeleteMaterial({{$item->material_id}})" style="color: red; float: right;"></i>
                                        @endif
                                            <i class="fa fa-pen cursor-pointer" wire:click="updateMaterial({{$item->material_id}})"  style="color: black; padding-right: 10px; float: right;"></i>
                                        </div>
                                    </li>
                                @endforeach
                                
                            @else
                            <span id="badge" class="badge" style="float:center;">Nothing found</span>
                            @endif
                        </ul>
                    </div>
                </div>
                {{-- card ends here --}}
            </div>
            {{-- *************** MATERIALS ***************** --}}

            {{-- *************** SIZES ***************** --}}
            <div class="col-sm">
                
                {{-- card starts here --}}
                <div class="card  shadow ">
                    {{-- card header starts here --}}
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <div class="col-12">
                                <h1 class="mb-3 text-center">Product Sizes</h1>
                            </div>

                            <div class="col-12">
                                <form>
                                    <div class="pl-lg-4">
                                        <div class="row mb-5">
                                            <div class="col-lg-12">
                                                <div class="form-group focused">
                                                    <input type="text" id="productsize" wire:model.lazy='sizeForm.name' class="form-control form-control-alternative @error('sizeForm.name') is-invalid @enderror  " placeholder="Product Size" value="">
                                                    <input type="number" id="sizeextraprice" wire:model.lazy='sizeForm.extra_price_on_product' class="form-control form-control-alternative @error('sizeForm.extra_price_on_product') is-invalid @enderror  " placeholder="Extra Price" value="">
                                                </div>

                                                @error('sizeForm.name')
                                                    <span class="error text-danger" role="alert">
                                                        <strong>{{ $message }}</strong><br>
                                                    </span>
                                                @enderror

                                                @error('sizeForm.extra_price_on_product')
                                                    <span class="error text-danger" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>

                        </div>
                        
                        
                            {{-- button starts here --}}
                            <div class="row d-flex justify-content-center">
                                <div class="col-lg-8">
                                    <div class="form-group">
                                        <button type="submit" wire:click.prevent="addSize" class="btn btn-dark rounded-pill btn-block btn-lg">{{__('Add') }}</button>
                                    </div>
                                </div>
                            </div>
                            {{-- button ends here --}}

                    </div>
                    {{-- card header ends here --}}
                
                    <div class="card-body">
                        <ul class="list-group list-group">
                            @if(count($productSizes))
                                @foreach ($productSizes as $item)
                                    <li id="size{{$item->size_id}}"  class="list-group-item">{{$item->name}}
                                        <div class="pull-right">
                                        <span id="badge" class="badge" style="float:left;">Extra: £{{$item->extra_price_on_product}}</span>
                                        @if($sizeConfirmingID === $item->size_id)
                                            <span id="badge" class="badge cursor-pointer" wire:click="deleteSize({{$item->size_id}})" style="color: red; float: right;">Sure?</span>
                                        @else
                                            <i class="fa fa-trash cursor-pointer" wire:click="confirmDeleteSize({{$item->size_id}})" style="color: red; float: right;"></i>
                                        @endif
                                            <i class="fa fa-pen cursor-pointer" wire:click="updateSize({{$item->size_id}})"  style="color: black; padding-right: 10px; float: right;"></i>
                                        </div>
                                    </li>
                                @endforeach
                                
                            @else
                            <span id="badge" class="badge" style="float:center;">Nothing found</span>
                            @endif
                        </ul>
                    </div>
                </div>
                {{-- card ends here --}}
            </div>
            {{-- *************** SIZES ***************** --}}
        </div>
    </div>
</div>
