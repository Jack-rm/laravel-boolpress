<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Models\Role;

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

        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $user = new User();
        $roles = Role::all();
        $roleIds = $user->roles->pluck('id')->toArray();

        return view('admin.users.create', compact('user', 'request','roles', 'roleIds'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $data = $request->all();

        $user = new User();
        $user->fill($data);
        $user->save();

        if (array_key_exists('roles', $data))
            $user->roles()->sync($data['roles']);

        return redirect()->route('admin.users.show', compact('user'));
    }

    /**
     * Display the specified resource.
     *
     * @param  User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('admin.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user, Request $request)
    {

        $roles = Role::all();

        $roleIds = $user->roles->pluck('id')->toArray();

        return view('admin.users.edit', compact('user', 'request', 'roles', 'roleIds'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {

        $data = $request->all();

        $user->fill($data);
        $user->update();


        //Esattamente come in store implemento la linea di codice dopo la chiamata update()

        if (array_key_exists('roles', $data))
            $user->roles()->sync($data['roles']);

        return redirect()->route('admin.users.show', compact('user'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('admin.users.index')->with("deleted_title", $user->name )->with('alert-message', "$user->name has been deleted!");
    }
}
