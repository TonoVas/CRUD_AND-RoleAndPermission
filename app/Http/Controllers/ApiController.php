<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Spatie\Permission\Models\Role;

class ApiController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth');
        $this->middleware(['permission:create user'],['only'=>['create','store']]);
        $this->middleware(['permission:read users'],['only'=>'index']);
        $this->middleware(['permission:update user'],['only'=>['edit','update']]);
        $this->middleware(['permission:delete user'],['only'=>'destroy']);
        $this->middleware(['permission:show user'],['only'=>'show']);
    }
    //mostrar usuarios
    public function index()
    {
        return User::all();

    }
    //mostrar productos
    public function getIndex(){
        return Product::all();
    }

    //registrar usuario
    public function register(Request $request){
        //dd($request->all());
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required|min:8',
          ]);
        $user = User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>$request->password
        ]);
        $user->roles()->attach(Role::where('name', 'usuario')->first());
        return response()->json($user);
    }

    //logearse el usuario
    public function login(Request $request) {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if (! $user || ! Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        return $user->createToken($request->email)->plainTextToken;
    }

    //crear para usuarios
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required|min:8',
          ]);
        $dato = new User();
        $dato->name=$request->name;
        $dato->email=$request->email;
        $dato->password=bcrypt($request->password);

        if($dato->save())
        {
            $dato->assignRole($request->rol);
            return response()->json($dato);
        }
    }
    //crear para productos
    public function postStore(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'desciption' => 'required',
          ]);
          $dato = new Product();
          $dato->name=$request->name;
          $dato->desciption=$request->desciption;
        if($dato->save())
        {
            return response()->json($dato);
        }
    }

    //mostrar usuario
    public function show(Request $request, $id)
    {
        $dato = User::find($id);
        return response()->json($dato);
    }

    //mostrar producto
    public function getShow(Request $request, $id)
    {
        $dato = Product::find($id);
        return response()->json($dato);
    }

    //eliminar para usuarios
    public function destroy($id)
    {
        $dato =  User::find($id);
        $dato->removeRole($dato->roles->implode('name',','));
        if($dato->delete())
        {
            return response()->json($dato);
        }

    }
    //eliminar para productos
    public function postDestroy($id)
    {
        $dato =  Product::find($id);
        if($dato->delete())
        {
            return response()->json($dato);
        }

    }

    //Actualizar dato del Usuario
    public function update(Request $request, $id)
    {
        //dd($request->all());
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required|min:8',
          ]);
        $dato = User::find($id);
        $dato->name = $request->name;
        $dato->email = $request->email;
        $dato->password = bcrypt($request->password);;

        $dato->syncRoles($request->rol);
        $dato->save();

        return response()->json($dato);
    }

    //actualizar dato del producto
    public function postUpdate(Request $request,$id)
    {

        $request->validate([
            'name' => 'required',
            'desciption' => 'required',
        ]);
        $dato = Product::find($id);
        $dato->name=$request->name;
        $dato->desciption=$request->desciption;

        if($dato->save())
        {
            return response()->json($dato);
        }
    }
}
