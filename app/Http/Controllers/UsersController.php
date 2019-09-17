<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Hash;
use App\User;

class UsersController extends Controller
{
    public function __construct(){
        $this->middleware('auth');

        $this->middleware(['permission:usuarios']);
      }

    public function index() {
      $users=\App\User::All();
      $allPermissions=Permission::All();
      return view('users.index', ['users' => $users, 'allPermissions'=>$allPermissions]);
    }

    public function create()
    {
        $allPermissions=Permission::All();
        return view('users.create', compact('allPermissions'));
    }

    public function store(Request $request) {
        $newUser=User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
        ]);
        $newUser->syncPermissions($request->permissions);
        return redirect()->route('users.index')->with('success','Usuario creado satisfactoriamente');

    }

    public function show(User $user)
    {
      return  view('users.show',compact('user'));
    }

    public function edit(User $user)
    {
      $allPermissions=Permission::All();
      return view('users.edit',compact('user', 'allPermissions'));
    }

    public function update(Request $request, User $user)
    {
      //$this->validate($request,[ 'name'=>'required', 'lastname'=>'required', 'email'=>'required', 'rfc'=>'required', 'fiscalname'=>'required', 'commercialname'=>'required', 'phone'=>'required']);
      //print_r($request->permissions);
      $user->syncPermissions($request->permissions);
      if($request['password'] && $request['password_confirmation']){
        $user->update([
          'name' => $request['name'],
          'password' => Hash::make($request['password']),
        ]);
      }
      if($request['name'] && !($request['password'])){
          $user->update([
              'name' => $request['name']
          ]);
      }
      return redirect()->route('users.index')->with('success','Registro actualizado satisfactoriamente');
    }

}
