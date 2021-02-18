<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(['permission:create user'],['only'=>['create','store']]);
        $this->middleware(['permission:read users'],['only'=>'index']);
        $this->middleware(['permission:update user'],['only'=>['edit','update']]);
        $this->middleware(['permission:delete user'],['only'=>'destroy']);
        $this->middleware(['permission:show user'],['only'=>'show']);
    }

    public function index()
    {
        $dato = Product::all();
        return view('product.index', compact('dato'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('product.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'desciption' => 'required',
          ]);
        $dato = new Product();
        $dato->name=$request->name;
        $dato->desciption=$request->desciption;

        $dato->save();
        return back()->with('success', 'Guardado con éxito');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $dato = Product::find($id);
        return view('product.show', compact('dato'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,$id)
    {
        $dato = Product::find($id);

        return view('product.edit', compact('dato'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'desciption' => 'required',
          ]);
        $dato = Product::find($id);
        $dato->name=$request->name;
        $dato->desciption=$request->desciption;

        $dato->save();

        return back()->with('success', 'Actualizado éxitosamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $dato = Product::find($id);
        if($dato->delete())
        {
            return back()->with('success', 'Se elimino éxitosamente');
        }else{
            return response()->json(['mensaje'=>'error al eliminar el usuario']);
        }
    }
}
