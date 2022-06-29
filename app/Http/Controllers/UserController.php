<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //
    // public function index()
    // {
    //     # code...
    //     $User = User::all();
    //     return view('pages.admin.users.index', ['data' => $User]);
    // }

    // public function edit(User $user)
    // {
    //     # code...
    //     return view('pages.admin.users.edit', ['data' => $user]);
    // }

    // public function update(Request $request, User $user)
    // {
    //     # code...
    //     $user->update([
    //         'roles' => $request->roles
    //     ]);
    //     return redirect()->route('/admin/user');
    // }

    public function changeRole(Request $request)
    {
        # code...
        // dd($request);
        $id = auth()->user()->id;
        if (auth()->user()->roles == 'WISATAWAN') {
            # code...
            $role = User::find($id);
            $role->roles = 'INVESTOR';
            $role->save();
        }
        if (auth()->user()->roles == 'INVESTOR') {
            # code...
            $role = User::find($id);
            $role->roles = 'WISATAWAN';
            $role->save();
        }

        return back();
    }
}
