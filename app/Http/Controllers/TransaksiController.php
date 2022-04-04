<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Transaction;

use App\Models\User;

use Illuminate\Support\Facades\Auth;




class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $transaksi = Transaction::where('user_id')->get();
        // $transaksi1 = Auth::user()->get();
        // $user = User::where('id', $id)->first();
        // $transaksi = Transaction::where('user_id', $id)->select('user_id')->groupBy('user_id')->orderBy('user_id', 'DESC')->get();
        // return view('admin.customers.show', compact('customer', 'orders'));
        // $user = Auth::user())->get();
        $transaksi = Transaction::select('user_id', 'id', 'meja_id', 'transaction_id', 'product_id', 'product_name', 'buy_price', 'quantity', 'method', 'total_price', 'buy_date')->where('user_id', Auth::user()->id)->orderBy('user_id', 'DESC')->paginate(5);
        // $transaksi->withPath('kasir.transaksi.riwayat');
        return view('kasir.transaksi.riwayat', compact('transaksi'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // $userId = Auth::user()->id;
        // $data['data'] = DB::table('publications')->where('user_id', $userId)->get();        
        // return view('kasir.transaksi.riwayat',$data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
