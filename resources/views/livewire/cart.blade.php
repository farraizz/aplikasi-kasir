<div class="mt-3" style="width: 100%;
overflow-x: hidden;">
<div class="row">
    <div class="col-md-8">
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
                <div class="row">
                    <div class="col-md-6">
                    <h4 class="font-weight-bold">Product List</h4>
                    </div>
                    <div class="col-md-5 mb-3">
                    <input type="text" wire:model="search" class="form-control" name="" id="" style="margin: 0 " placeholder="search..">
                    </div>
                </div>
                <div class="row">
                    @forelse($product as $item)
                    <div class="col-md-4">
                        <div class="card mt-3">
                            <div class="card-body">
                                <img style="object-fit: cover; width:100%; height: 105px;" src="{{asset('image/'.$item->image)}}" alt="product" class="img-fluid">
                            </div>
                            <div class="card-footer" style="border-top: none">
                                <span class="text-left font-weight-bold mb-3" style="text-transform: capitalize;">{{$item->name}}</span>
                                @if($item->qty==0)
                                <span class="text-danger" style="position: absolute; right:10px; font-size: 13px;">stock habis</span>
                                @else
                                <span style="position: absolute; right:10px; font-size: 13px;">Qty: {{$item->qty}}</span>
                                @endif
                                <br>
                                <span style="font-size: 13px;">Rp. {{number_format($item['price'],2,',','.')}}</span>
                                @if($item->qty==0)
                                @else
                                <button wire:click="addItem({{$item->id}})" class="btn btn-primary btn-sm" style=" position: absolute;bottom:0;right:0">
                                    <i class="fa-solid fa-cart-plus"></i>
                                </button>
                                @endif
                            </div>
                        </div>
                    </div>
                    @empty
                    <h6>Sorry Not Product found</h6>
                    @endforelse
                    <div style="display: flex; justify-content: center;" class="mt-5">
                        {{ $product->links() }}
                    </div>
         
                </div>
            </div> 
        </div>
    </div>
    <!-- {{-- <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <h2 class="font-weight-bold">Cart</h2>
                <table class="table table-sm table-bordered table-striped table-hover">
                    <thead>
                        <th>No</th>
                        <th>Name</th>
                        <th>Qty</th>
                        <th>Price</th>
                    </thead>
                    <tbody>
                        @forelse ((array) session('cart') as $cart)
                            <tr>
                                <td>#</td>
                                <td>
                                    {{$cart['name']}}
                                </td>
                                <td><span wire:click="increaseItem('{{$cart['id']}}')" href="#" class="font-weight-bold text-secondary"style="font-size:18px; cursor: pointer;">+</span>
                                    {{$cart['quantity']}}
                                    <span wire:click="decreaseItem('{{$cart['id']}}')" href="#" class="font-weight-bold text-secondary" style="font-size:18px; cursor: pointer;">-</span>
                                    <span wire:click="removeItem('{{$cart['id']}}')" href="#" class="font-weight-bold text-secondary" style="font-size:18px; cursor: pointer;">x</span>
                                </td>
                                <td>Rp. {{number_format($cart['price'],2,',','.')}}</td>
                            </tr>
                        @empty
                            <td colspan="3"><h6 class="text-center"></h6>Empty Cart</td>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <h4>Cart Summary</h4>
                <h5 class="font-wiegth-bold">Sub Total : Rp. {{number_format($summary['sub_total']),2,',','.'}}</h5>
                <h5 class="font-wiegth-bold">Tax : Rp. {{number_format($summary['pajak']),2,',','.'}}</h5>
                <h5 class="font-wiegth-bold">Total : Rp. {{number_format($summary['total']),2,',','.'}}</h5>
            </div>
            <div class="mt-3">
                <button wire:click="enableTax" class="btn btn-success btn-block">ADD TAX</button>
                <button wire:click="disableTax" class="btn btn-success btn-block">Remove Tax</button>
            </div>
            <div class="mt-4">
                <button class="btn btn-success btn-block">Save Transaction</button>
            </div>
        </div>
    </div> --}} -->

    <div class="col-md-4 ">
        <div class="card">
            <div class="card-header" style="border-bottom: none">
            <h4 class="font-weight-bold">Kasir</h4>
            </div>
            <div class="card-body"style="display:block; height:400px; overflow: auto;">
                @forelse ((array) session('cart') as $cart)
                <div class="col-12">
                    <div class="card mt-3 card-sm">
                        <div class="card-body" style="padding:0 0 0 20px" >
                            <div class="row">
                            <div class="col-4">
                            <span style="text-transform:capitalize; font-weight:bolder; padding: 0 0 0 0; font-size:13px">
                                {{$cart['name']}}
                            </span>
                            </div>
                            
                            <div class="col-8">
                            <button class="btn btn-primary mx-2" style="padding: 2px 2px 2px 2px; margin:1px 1px 1px 1px" wire:click="increaseItem('{{$cart['id']}}')">
                            <i class="fa-solid fa-plus"></i>
                            </button>

                            <span class="qty">{{$cart['quantity']}}</span>

                            <button wire:click="decreaseItem('{{$cart['id']}}')" style="padding: 2px 2px 2px 2px; margin:1px 1px 1px 1px" href="#" class="btn btn-info mx-2"><i class="fa-solid fa-minus"></i></button>

                            <button class="btn btn-danger mx-2" style="padding: 2px 2px 2px 2px; margin:1px 1px 1px 1px" wire:click="removeItem('{{$cart['id']}}')">
                                <i class="fa-solid fa-trash-can"></i>
                            </button>

                            </div>
                            </div>
                            <p style="font-size: 14px">Rp. {{number_format($cart['price'],2,',','.')}}</p>
                        </div>
                    </div>
                </div>
                <style>
                    p{
                        color: rgb(105, 103, 103);
                        font-size: 15px
                    }
                </style>
                    @empty
                        <td colspan="3"><h6 class="text-center"></h6>Empty Cart</td>
                    @endforelse
                </div>
            <div class="card-footer bg-light" style="border-top: none">
                <p class="text-danger" style="font-size: 13px">
                    @if(session()->has('error'))
                    {{session('error')}}
                    @endif
                </p>
                <div class="mt-3">
                <div class="col-12 justify-content-end">
                    
                @if($grandTotal == 01)
                    <span class="font-weigth-bold">Total : 0</span>
                @else
                    <span class="font-weigth-bold">Total {{$selectMeja}} : {{number_format($grandTotal,2,',','.')}}</span>
                @endif
                </div>
                <br>
                
                <span style="font-size: 14px;">Pilih Pembayaran: 
                @forelse((array) session('payment') as $payment)
                <span style="font-size: 14px;">{{$payment['payment']}}</span>
                @empty
                <span style="font-size: 14px;"></span>
                @endforelse
                </span>

                @if($payment = session()->get('payment'))
                <select class="form-select form-select-sm" wire:model="selectMeja" aria-label=".form-select-sm example">
                    <option selected="" value="">Select Meja</option>
                    @forelse($cekmeja as $cek)
                    <option value="{{$cek->id}}">{{$cek->id}}</option>
                    @empty
                    @endforelse
                </select>
                @else
                @endif

                @if($payment = session()->get('payment'))
                @else
                <div class="form-check" style="font-size: 14px">
                    <input wire:model="selectPayment" value="cash" class="form-check-input sm" type="radio" name="payment" id="flexRadioDefault1">
                    <label class="form-check-label" for="flexRadioDefault1">
                        Cash
                    </label>
                  </div>
                  <div class="form-check" style="font-size: 14px;">
                    <input wire:model="selectPayment" value="midtrans" class="form-check-input" type="radio" name="payment" id="flexRadioDefault2">
                    <label class="form-check-label" for="flexRadioDefault2">
                        Online Payment
                    </label>
                  </div>
                @endif
                
                @if ($payment = session()->get('payment'))
                @else 
                <div class="form-check"> 
                    <button class="btn btn-success btn-md" wire:click="simpanPayment()">Simpan payment</button>
                </div>
                @endif

                @foreach ((array) session('payment') as $payment)
                @if ($payment['payment'] == 'midtrans')
                <a href="#" class="btn btn-success btn-block" id="pay-button">Save Transaction</a>
                @else
                <button class="btn btn-success btn-block" wire:click="saveTransaction()">Save Transaction</button>
                @endif
                <button class="btn btn-danger btn-block" type="submit" wire:click="cancelTransaction">Cancel</button>
                @endforeach
            </div>
            </div>
        </div>

        <form action="{{route('payOrder')}}" method="GET" id="payment-form">
        <input type="hidden" name="result-data" id="result-data" value=""></div>
        <input type="hidden" name="table-selected" id="table-selected" value="{{$selectMeja}}">
        </form>
    <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="SB-Mid-client-8WHoIxrwA-uCdVli"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script type="text/javascript">
        // For example trigger on button clicked, or any time you need
        document.getElementById('pay-button').onclick = function(){
            // Snaptoken acquired
            var resultType = document.getElementById('result-type');
            var resultData = document.getElementById('result-data');
            function changeResult(type,data) {
                $("#result-type").val(type);
                $("#result-data").val(JSON.stringify(data));
            }
            snap.pay('{{$snapToken}}', {
                onSuccess: function(result){
                    changeResult('success', result);
                    console.log(result.status_message);
                    console.log(result);
                    $("#payment-form").submit();
                },
                onPending: function(result){
                    changeResult('pending', result);
                    console.log(result.status_message);
                    $("#payment-form").submit();
                },
                onError: function(result){
                    changeResult('error', result);
                    console.log(result.status_message);
                    $("#payment-form").submit();
                },
            })
        }
    </script>
        

        {{-- <div class="card">
            <div class="card-body">
                <h4>Cart Summary</h4>
                <h5 class="font-wiegth-bold">Sub Total : Rp. {{number_format($summary['sub_total']),2,',','.'}}</h5>
                <h5 class="font-wiegth-bold">Tax : Rp. {{number_format($summary['pajak']),2,',','.'}}</h5>
                <h5 class="font-wiegth-bold">Total : Rp. {{number_format($summary['total']),2,',','.'}}</h5>
            </div>
            <div class="mt-3">
                <button wire:click="enableTax" class="btn btn-success btn-block">ADD TAX</button>
                <button wire:click="disableTax" class="btn btn-success btn-block">Remove Tax</button>
            </div>
            <div class="mt-4">
                @if ($selectPayment == 'midtrans')
                <button class="btn btn-success btn-block" id="pay-button">Save Transaction</button>
                @else
                <button class="btn btn-success btn-block" wire:click="saveTransaction()">Save Transaction</button>
                @endif
            </div>
        </div> --}}
    </div>
</div>
</div>