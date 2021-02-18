<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Spatie\Permission\Models\Role;

class UsersController extends Controller
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
        $dato = User::all();

        return view('crud.index', compact('dato'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $rol = Role::all()->pluck('name','id');
        return view('crud.create', compact('rol'));
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
            'email' => 'required',
            'password' => 'required|min:8|confirmed',
          ]);
        $dato = new User();
        $dato->name=$request->name;
        $dato->email=$request->email;
        $dato->password=bcrypt($request->password);

        if($dato->save())
        {
            $dato->assignRole($request->rol);
            return back()->with('success', 'Guardado con éxito');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $dato = User::find($id);
        $rol = Role::all()->pluck('name','id');
        return view('crud.show', compact('dato','rol'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,$id)
    {
        $dato = User::find($id);

        $rol = Role::all()->pluck('name','id');

        return view('crud.edit', compact('dato','rol'));
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
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required|min:8|confirmed',
          ]);
        $dato = User::find($id);
        $dato->name = $request->get('name');
        $dato->email = $request->get('email');
        $password = $request->get('password');

        $dato->password = Hash::make($password);

        $dato->syncRoles($request->rol);
        $dato->save();

        return back()->with('success', 'Actualizado éxitosamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $dato =  User::find($id);
        $dato->removeRole($dato->roles->implode('name',','));
        if($dato->delete())
        {
            return back()->with('success', 'Se elimino éxitosamente');
        }else{
            return response()->json(['mensaje'=>'error al eliminar el usuario']);
        }

    }

}
