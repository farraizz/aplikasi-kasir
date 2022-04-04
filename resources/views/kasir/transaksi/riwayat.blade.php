@extends('layouts.template')

@section('content2')
    <div class="col-md-12">
        @if ($message = Session::get('error'))
        <div class="alert alert-danger">
            <strong>{{ $message }}</strong>
        </div>
         @endif

         @if ($message = Session::get('success'))
         <div class="alert alert-success">
             <strong>{{ $message }}</strong>
         </div>
          @endif
    <div class="card">
    <div class="card-body">
    {{-- <a class="btn btn-primary mb-3" href="{{url('kasir/meja/create')}}">Tambah</a> --}}
    <table class="table table-bordered table-responsive">
        
        <thead class="text-center">
            <th>ID</th>
            <th>User ID</th>
            <th>Meja ID</th>
            <th>Transaction ID</th>
            <th>Product ID</th>
            <th>Product Name</th>
            <th>Buy Price</th>
            <th>QTY</th>
            <th>Method</th>
            <th>Total Price</th>
            <th>Buy Date</th>
        </thead>
        <tbody>
            @if(count($transaksi)>0)
            @foreach($transaksi as $transaction)
            <tr>
                <td>{{$transaction->id}}</td>
                <td>{{$transaction->user_id}}</td>
                <td>{{$transaction->meja_id}}</td>
                <td>{{$transaction->transaction_id}}</td>
                <td>{{$transaction->product_id}}</td>
                <td>{{$transaction->product_name}}</td>
                <td>{{$transaction->buy_price}}</td>
                <td>{{$transaction->quantity}}</td>
                <td>{{$transaction->method}}</td>
                <td>{{$transaction->total_price}}</td>
                <td>{{$transaction->buy_date}}</td>
                {{-- <td>
                    <form action="{{ route('meja.update', $transaction->id) }}" method="POST">
                    @csrf
                    @method('put')
                    <button type="submit" class="btn btn-success">
                        Pulang
                    </button>
                    </form>
                </td> --}}
            </tr>
            @endforeach
        </tbody>
    </table>
    <div style="display: flex; justify-content: center;">
    {{$transaksi->links()}}
    </div>
    @else
    <p>No Posts Found</p>
    @endif
    </div>
    </div>
    </div>
@endsection
