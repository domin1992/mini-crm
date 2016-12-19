<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Libraries\AvailableControllers;

use App\User;
use App\Permission;

use Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $users = User::all();

      return view('user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $controllers = AvailableControllers::getControllers();

      return view('user.create', ['controllers' => $controllers]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $user = new User;
      $user->firstname = $request->input('firstname');
      $user->lastname = $request->input('lastname');
      $user->email = $request->input('email');
      $user->password = Hash::make($request->input('password'));
      if($request->input('admin') == 'on')
        $user->admin = 1;
      else
        $user->admin = 0;

      $user->save();

      if($user->admin == 0){
        foreach(AvailableControllers::getControllers() as $index => $controller){
          if($request->input($controller['name']) == 'on'){
            $permission = new Permission;
            $permission->user_id = $user->id;
            $permission->controller = $controller['name'];
            $permission->save();
          }
        }
      }

      return redirect('/user');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $user = User::find($id);
      $controllers = AvailableControllers::getControllers();
      $userControllers = [];
      foreach($user->permissions()->get() as $permission){
        $userControllers[] = $permission['controller'];
      }

      return view('user.show', ['user' => $user, 'controllers' => $controllers, 'userControllers' => $userControllers]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $user = User::find($id);
      $controllers = AvailableControllers::getControllers();
      $userControllers = [];
      foreach($user->permissions()->get() as $permission){
        $userControllers[] = $permission['controller'];
      }

      return view('user.edit', ['user' => $user, 'controllers' => $controllers, 'userControllers' => $userControllers]);
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
      $user = User::find($id);
      $user->firstname = $request->input('firstname');
      $user->lastname = $request->input('lastname');
      $user->email = $request->input('email');
      if($request->input('password') != '')
        $user->password = Hash::make($request->input('password'));
      if($request->input('admin') == 'on')
        $user->admin = 1;
      else
        $user->admin = 0;

      $user->save();

      if($user->admin == 0){
        foreach(AvailableControllers::getControllers() as $index => $controller){
          if($request->input($controller['name']) == 'on'){
            if(!($permission = Permission::where([['user_id', '=', $user->id], ['controller', '=', $controller['name']]])->first()))
              $permission = new Permission;
            $permission->user_id = $user->id;
            $permission->controller = $controller['name'];
            $permission->save();
          }
          else{
            if($permission = Permission::where([['user_id', '=', $user->id], ['controller', '=', $controller['name']]])->first()){
              $permission->delete();
            }
          }
        }
      }
      else{
        $user->permissions()->delete();
      }

      return redirect('/user/'.$id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $user = User::find($id);
      $user->permissions()->delete();
      $user->delete();

      return redirect('/user');
    }
}
