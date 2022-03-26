@extends('layouts.formanajer')
@section('content3')
<div class="col-md-12">
    <div class="card">
    <div class="card-body">
    <a class="btn btn-primary mt-3" href="{{url('manajer/create')}}">Tambah</a>
    <table class="table table-bordered">
        <thead class="text-center">
            <th>ID</th>
            <th>User ID</th>
            <th>Table ID</th>
            <th>Transaction ID</th>
            <th>Product ID</th>
            <th>Product Name</th>
            <th>Customer Name</th>
            <th>Buy Price</th>
            <th>Quantity</th>
            <th>Method</th>
            <th>Total Price</th>
            <th>Status</th>
            <th>Buy Date</th>
            <th colspan="2">Action</th>
        </thead>
        <tbody>
            @foreach($product as $index=>$product)
            <tr>
                <td>{{$product->name}}</td>
                <td class="text-center"><img src="{{asset('image/'.$product->image)}}" width="30%" alt="product image"></td>
                <td>{{$product->description}}</td>
                <td>{{$product->qty}}</td>
                <td>{{$product->price}}</td>
                <td><a class="btn btn-primary" href="{{route ('manajer.edit', $product->id) }}">Edit</a></td>
                <td>
                    <form action="{{route('manajer.destroy', $product->id)}}" method="POST">
                        @csrf
                        @method('delete')
                        <button class="btn btn-danger">Delete</button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    </div>
    </div>
    </div> 
@endsection