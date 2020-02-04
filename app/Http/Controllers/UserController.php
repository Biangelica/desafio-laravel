<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function profile(){
        return view('profile');
    }
    public function profileUpdate(Request $request){
        $data = $request->all();
        if($data['password'] != null){
            $data['password'] = bcrypt($data['password']);
        }
        else{
            unset($data['password']);
        }
        $update = auth()->user()->update($data);

        if($update){
            return redirect()->route('profile')
                ->with('sucess', 'Success, profile updated');
        }
        return redirect()->back()
            ->with('error', 'Profile update failed');

    }
}
