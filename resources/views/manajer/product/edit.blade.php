@extends('layouts.formanajer')

@section('content3')
<div class="col-md-12 py-4">
    <form action="{{route('product.update', $product->id)}}" method="POST">
        @csrf
        @method('put')
        <label for="form-control">Nama</label>
        <div class="mb-3">
            <input type="text" class="form-control" name="name" value="{{$product->name}}">
        </div>
        <label for="form-control">Gambar</label>
        <div class="mb-3">
            <input type="file" class="form-control" name="image" value="{{$product->image}}">
        </div>
        <label for="form-control">Description</label>
        <div class="mb-3">
            <input type="text" class="form-control" name="description" value="{{$product->description}}">
        </div>
        <label for="form-control">Qty</label>
        <div class="mb-3">
            <input type="number" class="form-control" name="qty" value="{{$product->qty}}">
        </div>
        <label for="form-control">Harga</label>
        <div class="mb-3">
            <input type="number" class="form-control" name="price" value="{{$product->price}}">
        </div>
        {{-- @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif --}}
        <button type="submit" class="btn btn-primary">Tambah</button>
    </form>
</div>
</div>
</div>
</div>
@endsection