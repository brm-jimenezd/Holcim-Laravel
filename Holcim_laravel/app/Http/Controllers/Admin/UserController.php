<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\User;
use Auth;
// use File;
// use Image;

class UserController extends Controller
{


  public function prueba(){
    return view('admin.users.index');
  }

    public function index(Request $request)
    {
        $users = User::orderBy('created_at', 'desc');
        //busqueda
        if($request->q && !empty($request->q)) {
          $users->where(function($query) use ($request) {
            $query->where('name', 'LIKE', '%'.$request->q.'%')->orWhere('description', 'LIKE', '%'.$request->q.'%');
          });
        }
        if($request->wt) { $users->withTrashed(); }
        // if(Auth::user()->role == 'Mod') {
        //   $users = $users->where('user_id', Auth::user()->id);
        // }
        $users = $users->paginate(30);

      return view('admin.users.index', compact('users'));
    }
    public function store($action, $content)
    {
      $user = new user;
      $user->user_id = Auth::user()->id;
      $user->name = $name;
      $user->email = $email;
      $user->role = $role;
      $user->active = $active;
      $user->save();
  
      return true;
    }

    public function edit($id)
    {
      $user = User::findOrFail($id);
      return view('admin.users.edit', compact('user'));
    }


    public function update(Request $request, $id)
    {
      $user = User::findOrFail($id);
      $validatedData = $request->validate([
        'name' => 'required|max:255',
      ]);
      
      $user->name = $request->name;
     
        if($user->password) {
            $user->password = Hash::make($request->password);
        }
        
      $user->email = $request->email;
      $user->role = $request->role;
      $user->active = ($request->active ? true : false);
   
      $user->save();
  
      app('App\Http\Controllers\Admin\LogController')->store('user updated id '.$user->id, $user);
      flash('Se guardo el registro con éxito.')->success();
      return redirect()->route('admin.users.index');
    }




    public function destroy($id)
  {
    $user = User::findOrFail($id);
    app('App\Http\Controllers\Admin\LogController')->store('user destroy id '.$user->id, $user);
    if($user->trashed() && Auth::user()->role == 'Admin') {
      $user->forceDelete();
    } else {
      $user->delete();
    }
    flash('Registro eliminado con éxito.')->error();
    return redirect()->route('admin.users.index');
  }
}
