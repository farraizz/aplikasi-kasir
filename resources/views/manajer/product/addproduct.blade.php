@extends('layouts.formanajer')

@section('content3')
<div class="col-md-12 py-4">
    <div class="card">
    <div class="card-body">
    <form action="/manajer" method="POST" enctype="multipart/form-data">
        @csrf
        <label for="form-control">Nama</label>
        <div class="mb-3">
            <input type="text" class="form-control" name="name">
        </div>

        <label for="image">Image</label>
        <div class="mb-3">
            <input type="file" class="form-control" name="image" id="image">
        </div>

        <label for="form-control">Description</label>
        <div class="mb-3">
            <input type="text" class="form-control" name="description">
        </div>
        <label for="form-control">Qty</label>
        <div class="mb-3">
            <input type="number" class="form-control" name="qty">
        </div>
        <label for="form-control">Harga</label>
        <div class="mb-3">
            <input type="number" class="form-control" name="price">
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
@endsection