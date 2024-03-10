<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class editController extends Controller
{
    function edit_profile(){
        return view('admin.edit.edit_profile');
    }
    function update_profile( Request $request){
            User::find(Auth::id())->update([
                'name'=>$request->name,

            ]);
            return back()->with('success', 'user name updated');
    }
}
