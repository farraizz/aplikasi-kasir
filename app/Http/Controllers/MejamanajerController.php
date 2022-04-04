<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Meja;

class MejamanajerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mejass = Meja::all();
        return view('manajer.meja.mejamanajer', [
            'mejas' => $mejass
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $mejaa = new Meja;
        return view('manajer.meja.addmeja', compact(
            'mejaa'
        ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $mejaa = new Meja;

        $mejaa->nomor_meja = $request->nomor_meja;
        $mejaa->save();

        return redirect('manajer/meja');
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
        $mejaa = Meja::findOrFail($id);
        if ($mejaa -> currently_active == NULL){
        $mejaa -> delete();
        return redirect('manajer/meja');
        }else{
            return redirect('manajer/meja');
        }

    }
}
