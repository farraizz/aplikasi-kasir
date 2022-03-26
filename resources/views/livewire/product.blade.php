<div>
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <h2 class="mb-3 font-weight-bold">
                        Product List
                    </h2>
                    <table class="table table-bordered table-hover table-striped">
                        <thead>
                            <th>Nomor</th>  
                            <th>Name</th>
                            <th>Image</th>
                            <th>Description</th>
                            <th>Qty</th>
                            <th>Price</th>
                        </thead>
                        <tbody>
                            @foreach($products as $index=>$product)
                            <tr>
                                <td>{{$index + 1}}</td>
                                <td>{{$product->name}}</td>
                                <td><img src="{{asset('storage/image/'.$product->image)}}" width="20%" alt="product image" class="img-fluid"></td>
                                <td>{{$product->description}}</td>
                                <td>{{$product->qty}}</td>
                                <td>{{$product->price}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h2 class="mb-3 font-weight-bold">
                        Create Product
                    </h2>
                    <form wire:submit.prevent="store">
                        <div class="form-group">
                        <label for="">Name</label>
                        <input wire:model="name" type="text" class="form-control">
                        @error('name') <small class="text-danger">{{$message}}</small>@enderror
                        </div>

                        <div class="form-group">
                        <label for="">Image</label>
                        <div class="custom-file">
                            <input wire:model="image" type="file" class="custom-file-input form-control" id="customFile">
                            <label for="customFile" class='custom-file-label'>Choose Image</label>
                            @error('image') <small class="text-danger">{{$message}}</small>@enderror
                        </div>
                        @if($image)
                            <label for="mt-2">
                                Image Preview
                            </label>
                            <img src="{{$image->temporaryUrl()}}" class="img-fluid" alt="Preview Image">
                        @endif
                        </div>  

                        <div class="form-group">
                        <label for="">Description</label>
                        <textarea wire:model="description" class="form-control" type="text"></textarea>
                        @error('description') <small class="text-danger">{{$message}}</small>@enderror
                        </div>
                        
                        <div class="form-group">
                        <label for="">Qty</label>
                        <input wire:model="qty" type="number" class="form-control">
                        @error('qty') <small class="text-danger">{{$message}}</small>@enderror
                        </div>

                        <div class="form-group">
                        <label for="">Price</label>
                        <input wire:model="price" type="number" class="form-control">
                        @error('price') <small class="text-danger">{{$message}}</small>@enderror
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-block">Add Product</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card mt-3">
                <div class="card-body">
                    <h3>{{$name}}</h3>
                </div>
            </div>
        </div>
    </div>
</div>
