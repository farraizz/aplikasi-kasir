@extends('layouts.template')

@section('content2')
<div class="col-md-12 py-4">
    <div class="card">
    <div class="card-body">
    <form action="/manajer/meja" method="POST">
        @csrf
        <label for="form-control">Nomor Meja</label>
        <div class="mb-3">
            <input type="text" class="form-control" name="nomor_meja">
        </div>
        <button type="submit" class="btn btn-primary">Tambah</button>
    </form>
    </div>
    </div>
</div>
@endsection