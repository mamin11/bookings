<div class="container">
	<div class="col">
		<h2 class="text-center m-4">All Products</h2>
	</div>
    
    

        <div class="row mb-4">

            <div class="col-5">
                    <div class="form-group">
                    <select class="form-control" id="paginatedNum" wire:model='paginateNum'>
                        <option value="10">10</option>
                        <option value="20">20</option>
                        <option value="30">30</option>
                        <option value="40">40</option>
                        <option value="50">50</option>
                    </select>
                    </div>
            </div>

            <div class="col-5">
                <div class="form-group">
                    <div class="input-group">
                        <input type="text" wire:model='search' class="  search-query form-control" placeholder="Search" />
                        <span class="input-group-btn">
                            <button class="btn btn-danger" type="button">
                                <i class="fa fa-search" aria-hidden="true"></i>
                            </button>
                        </span>
                    </div>
                </div>
            </div>
        </div>


		<div class="row">
            <div class="col-md-12">

            
    @if(count($products) > 0)            
    <table id="datatable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Material</th>
                                <th>Category</th>
                                <th>Size</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                            </tr>
                        </thead>

                        <tfoot>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Material</th>
                            <th>Category</th>
                            <th>Size</th>
                                <th>Edit</th>
                                <th>Delete</th>
                        </tr>
                        </tfoot>


                        <tbody>
                                @foreach ($products as $product)
                                    <tr>
                                        <td>{{$product->name}}</td>
                                        <td>{{$product->description}}</td>
                                        <td>{{$product->price}}</td>
                                        <td>{{$product->quantity}}</td>
                                        <td>{{$product->getMaterial() ? $product->getMaterial()->name : ''}}</td>
                                        <td>{{$product->getCategory() ? $product->getCategory()->name : ''}}</td>
                                        <td>{{$product->getSize() ? $product->getSize()->name : ''}}</td>
                                        <td>
                                        <p data-placement="top" data-toggle="tooltip" title="Edit">
                                            <button class="btn btn-primary btn-xs" wire:click='edit({{$product->product_id}})' >
                                            <i class="fa fa-pencil" aria-hidden="true"></i>
                                        </button>
                                        </p>
                                    </td>

                                    <td>
                                        <p data-placement="top" data-toggle="tooltip" title="Delete">
                                            <button name="product{{$product->product_id}}" id="{{$product->product_id}}" class="btn btn-danger btn-xs" data-title="Delete"  data-toggle="modal" data-target="#delete{{$product->product_id}}" >
                                                <i class="fa fa-trash" aria-hidden="true"></i>
                                            </button>
                                        </p>
                                    </td>
                                    </tr>

                                                {{-- delete modal --}}
                                            <div class="modal fade" id="delete{{$product->product_id}}" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="far fa-times-circle"></i></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="alert alert-danger"><i class="fas fa-exclamation-triangle"></i> Are you sure you want to delete this Product?</div>
                                                        </div>
                                                        <div class="text-center mb-2 ">
                                                            <button  name="product{{$product->product_id}}" id="{{$product->product_id}}" class="btn btn-success mr-3" wire:click='delete({{$product->product_id}})' ><i class="fas fa-thumbs-up"></i> Yes</button>
                                                            <button type="button" class="btn btn-danger mr-3" data-dismiss="modal"><i class="fas fa-power-off"></i> No</button>
                                                        </div>
                                                        <div class="text-center" wire:loading>
                                                            <img class="img-fluid text-center" src="{{asset('img/loading.gif')}}"/>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            {{-- delete modal end  --}}
                                @endforeach
                                
                            </tbody>
                        </table>
                        @else
                        <div class="container text-center">
                            <img src="https://img.icons8.com/color/68/000000/lonely.png"/> Nothing found
                        </div>                            
                        @endif
            {{$products->links()}}



        
        </div>
        </div>
    </div>

