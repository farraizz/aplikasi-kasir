<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Product;
use App\Models\Transaction;

class ProductController extends Controller
{
        /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $role = User::where('role', 'manajer')->get();
        if(Auth::user()->role != 'kasir') {
            $product = Product::all();
            return view('manajer.product.manajer', [
                'product' => $product
            ]);
        }else {
            // return redirect('kasir');

            // meredirect ke home
            return redirect('home');
        }
    }

 

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $product = new Product;
        return view('manajer.product.addproduct', compact(
            'product'
        ));
    }

    public function store(Request $request) {
        $request->validate([
            'name'=> 'required',
            'image'=> 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'description'=> 'required',
            'qty'=> 'required',
            'price'=> 'required',
        ]);

        // $stock = Stock::where('pid', $product->id);
        // $stock->decrement('quantity', 1)
    
      $image = $request->image;
      $new_name_photo = date('s'.'i'.'H'.'d'.'m'.'Y')."_".$image->getClientOriginalName();
      $directory_upload = 'image/';
      $addData = Product::create([
          'name' => $request->name,
          'image' => $request->$directory_upload.$new_name_photo,
          'description' => $request->description,
          'qty' => $request->qty,
          'price' => $request->price,
          ]);

        if($addData){
            $image->move($directory_upload, $new_name_photo);
            // Alert::success('Success', 'Successfully');
            return redirect()->route('manajer.product.index');
        }
    }

     /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('manajer.product.edit', compact(
            'product'
        ));
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
        // $validated = $request->validate([
        //     'tahun' => 'required|int',
        //     'nominal' => 'required|int',
        // ]);
        $product = Product::findOrFail($id);
        $product->name = $request->name;
        $product->image = $request->image;
        $product->description = $request->description;
        $product->qty = $request->qty;
        $product->price = $request->price;
        $product->save();

        return redirect()->route('home')->with(['success' => 'Data Berhasil di Tambahkan']);
    }

     /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        
        return redirect('home');
    }
}

