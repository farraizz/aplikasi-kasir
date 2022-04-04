@extends('layouts.formanajer')

@section('content3')
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
    <a class="btn btn-primary mb-3" href="{{url('manajer/mejamanajer/create')}}">Tambah</a>
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
                <td>
                @if($mejas->currently_active == null)
                <div class="col-10 bg-danger text-center text-light" style="border-radius: 25px">
                    Not Active
                </div>
                @else{{$mejas->currently_active}}
                @endif
                </td>
                <td>
                    <form action="{{ route('mejamanajer.update', $mejas->id) }}" method="POST">
                    @csrf
                    @method('put')
                    <button type="submit" class="btn btn-success">
                        Pulang
                    </button>
                    </form>
                </td>
                <td>
                    <form action="{{route('mejamanajer.destroy', $mejas->id)}}" method="POST">
                        @csrf
                        @method('delete')
                        <button class="btn btn-danger">Delete</button>
                    </form>
                </td>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    </div>
    </div>
    </div>
@endsection
