<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::get();
        $roles = Role::get();
        return view('pages.user', [
            'users' => $users, 
            'editUser' => null, 
            'edit' => false,
            'roles' => $roles
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        $data = [
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password'))
        ];
        $user = User::create($data);
        $user->assignRole($request->input('role'));
        return redirect(url('/users'))->with('success', 'User Added Successfully!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $users = User::get();
        $editUser = User::with('roles')->find($id);
        $roles = Role::get();
        return view('pages.user', [
            'users' => $users, 
            'editUser' => $editUser, 
            'edit' => true,
            'roles' => $roles
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, $id)
    {
        $user = User::find($id);
        if ($user) {
            $data = [
                'name' => $request->input('name'),
                'email' => $request->input('email')
            ];
            $user->update($data);
            $user->syncRoles($request->input('role'));
            return redirect(url('/users'))->with('editsuccess', 'User Updated Successfully!');
        }
        return redirect(url('/users'))->with('editsuccess', 'User Not found!');
    }
}
