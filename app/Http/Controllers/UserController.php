<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //
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
