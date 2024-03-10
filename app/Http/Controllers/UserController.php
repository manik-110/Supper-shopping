<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;
use Symfony\Contracts\Service\Attribute\Required;
use Intervention\Image\Facades\Image;
use function Laravel\Prompts\confirm;
use function Laravel\Prompts\password;

class UserController extends Controller
 {
    function UserList(){
        return view('user.user_list',[
            'users'=> User::all()
        ]);

    }
    function UserDelete($id){
        $user = User::find($id);
        if ($user->photo != null) {
            unlink(public_path('uploads/users/'.$user->photo));
        }
        $user->delete();
        return back()->with('success','user deleted');
    }
        function update_password( Request $request)
        {
            $request->validate([
                'Current_password' => 'required',
                'password' => ['required', Password::min(8)
                ->letters()
                ->mixedCase()
                ->numbers()
                ->symbols(),'confirmed'],
                'password_confirmation' => 'required',
            ]);

            if(password_verify($request->Current_password, Auth::user()->password)){

                User::find(Auth::id())->update([
                    'password'=>bcrypt($request->password),
                ]);
             }
        return back()->with('pass_success' ,'password update successfully');


        }
        function update_photo(Request $request){
            $request->validate([
                'image' => 'required',
                'imgae'=> 'mimes:jpg,png,jpeg',
                'imgae'=> 'max:1124'
            ],[
                'image.required' => 'image de beta',


                // image file extension
        ]);
            $image = $request->image;

            $extension = $image->extension();
            $file_name = Auth::id().'.'.$extension;
            Image::make($image)->save(public_path('uploads/users/'.$file_name));
            User::find(Auth::id())->update([
                'photo'=>$file_name,
            ]);
            return back()->with('photo uploads','profile picture update');

   }
}














