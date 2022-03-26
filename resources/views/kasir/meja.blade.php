@extends('layouts.template')

@section('content2')
    <div class="col-md-12">
    <div class="card">
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
    <div class="card-body">
    <table class="table table-bordered">
        
        <thead class="text-center">
            <th>ID Meja</th>
            <th>Nomor Meja</th>
            <th>Currently Activated</th>
            <th>Action</th>
        </thead>
        <tbody>
            @foreach($mejas as $index=>$mejas)
            <tr>
                <td>{{$mejas->id}}</td>
                <td>{{ $mejas->nomor_meja}}</td>
                <td>{{$mejas->currently_active}}</td>
                <td>
                    <form action="{{ route('meja.update', $mejas->id) }}" method="POST">
                    @csrf
                    @method('put')
                    <button type="submit" class="btn btn-success">
                        Pulang
                    </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    </div>
    </div>
    </div>
@endsection
