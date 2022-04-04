<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Product;
use Carbon\Carbon;
use Livewire\withPagination;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;
use App\Models\Meja;

class Cart extends Component
{
    use withPagination;
    protected $paginationTheme = 'bootstrap';

    public $tax ="0%";

    public $search;

    public $cashPayment;
    
    public $grandTotal;
    
    public $snapToken;

    public $selectPayment;

    public $selectMeja;
    
    

    public function updatingSearch()
    {
        //
    }

    public function pay_transaction()
    {
        if ($_GET['result-data']){
            $selectedMeja = $_GET['table-selected'];
            $current_status = json_decode($_GET['result-data'], true);
            date_default_timezone_set('Asia/Jakarta');
            $time = date("d-m-Y H:i:s");
            $cekmeja = Meja::where('id', (int)$selectedMeja)->first();
            
            // $cekmeja = Meja::where('currently_active', NULL)->get();

            $cart = session()->get('cart');
            $grandTotal = 0;
            $total = 0;

            foreach((array) session('cart') as $keranjang){
                $total += $keranjang['price'] * $keranjang['quantity'];
                $grandTotal = $total;
            }

            // if ($selectedMeja == 0){
            // return  redirect('kasir')->with('eror', "pesanan gagal meja penuh");
            if ($cekmeja!=NULL) {
                foreach((array) session('cart') as $ceks){
                    $tambahdata = Transaction::create(
                        [
                            'user_id' => Auth::user()->id,
                            'transaction_id' => $current_status['order_id'],
                            'product_id' => $ceks['id'],
                            'product_name' => $ceks['name'],
                            // 'customer_name' => 'Test',
                            'buy_price' => $ceks['price'],
                            'meja_id'   => (int)$selectedMeja,
                            'quantity' => $ceks['quantity'],
                            'method' => 'Midtrans',
                            'total_price' => $grandTotal,
                            'buy_date' => $time,
                        ]
                    );
                }
                    if ($tambahdata) {
                        // if ($selectedMeja == 0){
                        //     return  redirect('kasir')->with('eror', "pesanan gagal meja penuh");
                        // }
                        $produk = Product::findOrFail($ceks['id']);

                        // if($selectedMeja==){
                        //     return redirect()->route('kasir')->with('eror', "pesanan gagal meja penuh");
                        //  }

                        $cekmeja->update([
                            'currently_active'  => $current_status['order_id'],
                        ]);

                        session()->forget('cart');
                        session()->forget('payment');
                    return redirect()->route('kasir')->with('success', "pesanan berhasil di tambahkan di meja $cekmeja->nomor_meja");
                    }else {
                        $this->dispatchBrowserEvent('swal', [
                            'title' => 'Error',
                            'text' => 'Pembelian Gagal',
                            'icon' => 'error'
                        ]);
                        dd('gagal');
                    }
               }
                // $meja = Meja::where('id', $cekmeja->id)->first();
            }
        // }
            }
    

    public function render()
    {
        $cart = session('cart');
        $customer = session('customer');
        date_default_timezone_set('Asia/Jakarta');
        $filter = Transaction::orderBy('id', 'desc')->first(); 
        if (!empty($filter)) {
            $filterTransaction = $filter->id + rand();
        } else {
            $filterTransaction = 0 + rand();
        }
        $resi = "FaraPOS-".$filterTransaction;

        $this->grandTotal = 0;
        $total = 0;

        foreach((array) session('cart') as $details){
            $total += $details['price'] * $details['quantity'];
            $this->grandTotal = $total;
        }

        if ($this->grandTotal == 0) {
            $this->grandTotal = 1;

        }

        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = 'SB-Mid-server-w7AaPfJsU6WUpbfiSHEj4wf4';
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = false;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;

        $params = array(
            'transaction_details' => array(
                'order_id' => $resi,
                'gross_amount' => $this->grandTotal,
            ),
            // 'customer_details' => array(
            //     // 'first_name' => 'tes',
            //     'email' => 'fara@pos.com',
            //     'phone' => '0875656588',
            // ),
        );

        $this->snapToken = \Midtrans\Snap::getSnapToken($params);


        // foreach((array) session('customer') as $customers){
        //     $custo = $customers['name'];

        // }
        // if (empty(session('customer'))) {
        //     $custo = 'Guest';
        // }
        // $product = $this->search == '' ? Product::orderBy('name', 'asc')->get() : Product::where('name', 'like', "%$this->search%")->orderBy('name', 'asc')->get();
        $cekmeja = Meja::where('currently_active', NULL)->get();
        $product = Product::where('name', 'like', '%'.$this->search.'%')->orderBy('name', 'DESC')->paginate(6);
        return view('livewire.cart', compact('product','cekmeja'));
    }

    public function addItem($id){
        $product = Product::findOrFail($id);

        $cart = session()->get('cart', []);
            // dd($product->stok -1);
            if(isset($cart[$id])) {
                if($cart[$id]['stock'] - 1 < 0){
                    $this->dispatchBrowserEvent('swal', [
                            'title' => 'Failed',
                            'text' => 'Out of Stock',
                            'icon' => 'error'
                        ]);
                } else if($cart[$id]['stock'] - 1 >= 0){
                    $cartMin = $cart[$id]['stock'] - 1;
                    $cart[$id]['stock'] = $cartMin;
                    $cart[$id]['quantity']++;
                    session()->put('cart', $cart);
                } else {
                    $this->dispatchBrowserEvent('swal', [
                        'title' => 'Error',
                        'text' => 'Hubungi Developer',
                        'icon' => 'error'
                    ]);
                }

            } else {
                $cart[$id] = [
                    "id" => $id,
                    "name" => $product->name,
                    "quantity" => 1,
                    "price" => $product->price,
                    "description" => $product->description,
                    "photo" => $product->photo,
                    'stock' => $product->qty -1,
                ];
                session()->put('cart', $cart);
            }
        
    }

    public function enableTax(){
        $this -> tax = "+10%";
    }

    public function disableTax(){
        $this -> tax = "0%";
    }

    public function saveTransaction()
    {
        dd('pembayaran cash nanti');
    }

    public function cancelTransaction()
    {
        session()->forget('cart');
        session()->forget('payment');
        return redirect('home');
    }

    public function simpanPayment()
    {
        $payment = session()->get('payment');
        unset($payment);
        $payment[$this->selectPayment] = [
            "id" => 1,
            "payment" => $this->selectPayment,
        ];
        
        // $payment[$this->selectMeja] = [
        //     "id" => 1,
        //     "payment" => $this->selectMeja,
        // ];

        session()->put('payment', $payment);
        return redirect('kasir'
        );
    }

    
    public function increaseItem($id){
        $cart = session()->get('cart');

        if($cart[$id]['stock'] - 1 < 0){
            $this->dispatchBrowserEvent('swal', [
                'title' => 'Failed',
                'text' => 'Out of Stock',
                'icon' => 'error'
            ]);
        } else if($cart[$id]['stock'] - 1 >= 0){
            $cartMin = $cart[$id]['stock'] - 1;
            $cart[$id]['stock'] = $cartMin;
            $cart[$id]['quantity']++;
            session()->put('cart', $cart);
        } else {
            $this->dispatchBrowserEvent('swal', [
                'title' => 'Error',
                'text' => 'Hubungi Developer',
                'icon' => 'error'
            ]);
        }    
    }
    
        public function decreaseItem($id){
            $cart = session()->get('cart');

        if($cart[$id]['quantity'] - 1 <= 0){
            unset($cart[$id]);
            session()->put('cart', $cart);
        } else if ($cart[$id]['quantity'] - 1 >= 1){
            $stokPlus = $cart[$id]['stock'] + 1;
            $qtyMin = $cart[$id]['quantity'] - 1;
            $cart[$id]['stock'] = $stokPlus;
            $cart[$id]['quantity'] = $qtyMin;
            session()->put('cart', $cart);
        }    
        }

        public function removeItem($id){
            $cart = session()->get('cart');
            unset($cart[$id]);
            session()->put('cart', $cart);
        }

    }