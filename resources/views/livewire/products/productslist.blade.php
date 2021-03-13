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
                                        <button class="btn btn-primary btn-xs" data-title="Edit" data-toggle="modal" data-target="#edit" >
                                        <i class="fa fa-pencil" aria-hidden="true"></i>
                                    </button>
                                    </p>
                                </td>

                                <td>
                                    <p data-placement="top" data-toggle="tooltip" title="Delete">
                                        <button class="btn btn-danger btn-xs" data-title="Delete" data-toggle="modal" data-target="#delete" >
                                            <i class="fa fa-trash" aria-hidden="true"></i>
                                        </button>
                                    </p>
                                </td>
                                </tr>
                            @endforeach

                        </tbody>
            </table>
            {{$products->links()}}

        
        </div>
        </div>
    </div>

